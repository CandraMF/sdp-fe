<?php

		namespace App\Services;

		use App\Models\PrasaranaLahan;
		use App\Exports\PrasaranaLahanExport;
		use GuzzleHttp\Client;
		use Illuminate\Pagination\LengthAwarePaginator;
		use Illuminate\Pagination\Paginator;
		use Illuminate\Support\Carbon;
		use Illuminate\Support\Collection;
		use Illuminate\Support\Facades\DB;
		use Illuminate\Support\Facades\Auth;
		use Illuminate\Support\Facades\File;
		use Maatwebsite\Excel\Facades\Excel;
		use PhpOffice\PhpWord\Element\Table;
		use PhpOffice\PhpWord\TemplateProcessor;


		class PrasaranaLahanService
		{

			public function __construct()
			{
			}

			/**
			 * Make http client
			 * 
			 * @param string $baseURI
			 * @param bool $httpErrors
			 * @param string $token
			 */
			private function makeApi(string $baseURI, ?bool $httpErrors = true, ?string $token = NULL)
			{
				$data = [
					'base_uri' => $baseURI,
					'headers'  => ['Accept' => 'application/json'],
					'http_errors' => $httpErrors,
				];

				if (!is_null($token)) {
					$data['headers']['Authorization'] = 'bearer ' . $token;
				}

				return new Client($data);
			}

			/**
			 * Create pagination
			 * 
			 * @param array $items
			 * @param int $perPage
			 * @param int $page
			 * @return mixed
			 */
			private function paginate($items, $perPage = 10, $page = null)
			{
				$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
				$items = $items instanceof Collection ? $items : Collection::make($items);
				return new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page);
			}

			/**
			 * Mapping index list
			 * 
			 * @param object $data
			 * @return mixed
			 */
			private function mapping(object $data)
			{
				$prasarana_lahan = $data->get()->toArray();
				if (empty($prasarana_lahan)) {
					return [];
				}
				foreach ($prasarana_lahan as $val) {
					$result[] = array(
						 'id_prasarana_lahan' => $val['id_prasarana_lahan'],  'jenis_prasarana' => $val['jenis_prasarana'],  'nama_prasarana_lahan' => $val['nama_prasarana_lahan'],  'nmupt' => $val['nmupt'],  'tgl_pengadaan' => $val['tgl_pengadaan'],  'keterangan' => $val['keterangan'],  'update_terakhir' => $val['update_terakhir'],  'update_oleh' => $val['update_oleh']
					);
				}

				return $result;
			}

			/**
			 * Get list
			 * 
			 * @param array $data
			 * @param string $url
			 * @return mixed
			 */
			public function search(array $data, $url = null)
			{
				$page = isset($data['page']) ? (int) $data['page'] : 1;
				$perPage = isset($data['per_page']) ? (int) $data['per_page'] : 10;
				$keyword = isset($data['keyword']) ? $data['keyword'] : NULL;
				$sort = isset($data['sort']) ? $data['sort'] : NULL;
				$column = isset($data['column']) ? $data['column'] : 'id_prasarana_lahan';

				$defaultColumn = ['prasarana_lahan.id_prasarana_lahan', 'daftar_referensi.deskripsi as jenis_prasarana', 'prasarana_lahan.nama_prasarana_lahan', 'upt.uraian as nmupt', 'prasarana_lahan.tgl_pengadaan', 'prasarana_lahan.keterangan', 'prasarana_lahan.update_terakhir', 'prasarana_lahan.update_oleh'];
				$q = PrasaranaLahan::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('daftar_referensi', 'prasarana_lahan.id_jenis_prasarana_lahan', '=', 'daftar_referensi.id_lookup');
				$q = $q->join('upt', 'prasarana_lahan.id_upt', '=', 'upt.id_upt');
				
				$q = $q->where('daftar_referensi.groups', '=', 'jenis prasarana lahan');
				$data = $this->mapping($q);
				$collection = collect(array_values($data));

				if (!is_null($keyword) && !is_null($column)) {
					$collection = $collection->filter(function ($value, $key) use ($keyword, $column) {
						return (false !== stripos($value[$column], $keyword));
					});
				}

				if (!is_null($sort)) {
					$exSort = explode(',', $sort);
					foreach ($exSort as $key => $value) {
						$xdir = explode(':', $value);
						if (empty($xdir[0])) {
							return response()->json([
								'message' => 'Invalid format sort.'
							]);
						}
						$colSort = $xdir[0];
						$direction = empty($xdir[1]) ? 'asc' : $xdir[1];
						$sorted[] = [$colSort, $direction];
					}
					$collection = $collection->sortBy($sorted);
				}

				$collection->all();
				$paginate = $this->paginate($collection, $perPage, $page);
				$paginate->setPath($url);

				return $paginate;
			}

			/**
			 * Mapping details
			 * 
			 * @param object $prasarana_lahan
			 * @return mixed
			 */
			public function show(object $prasarana_lahan)
			{
				$data = array(
					'id_prasarana_lahan' => $prasarana_lahan->id_prasarana_lahan, 'jenis_prasarana' => $prasarana_lahan->jenis_prasarana, 'nama_prasarana_lahan' => $prasarana_lahan->nama_prasarana_lahan, 'nmupt' => $prasarana_lahan->nmupt, 'tgl_pengadaan' => $prasarana_lahan->tgl_pengadaan, 'keterangan' => $prasarana_lahan->keterangan, 'update_terakhir' => $prasarana_lahan->update_terakhir, 'update_oleh' => $prasarana_lahan->update_oleh
				);
				return $data;
			}

			public function exportExcel($data)
			{
				$page = $data['page'] ?? 1;
				$perPage = $data['per_page'] ?? 10;
				$keyword = $data['keyword'] ?? NULL;
				$sort = $data['sort'] ?? NULL;
				$column = $data['column'] ?? 'id';

				$defaultColumn = ['prasarana_lahan.id_prasarana_lahan', 'daftar_referensi.deskripsi as jenis_prasarana', 'prasarana_lahan.nama_prasarana_lahan', 'upt.uraian as nmupt', 'prasarana_lahan.tgl_pengadaan', 'prasarana_lahan.keterangan', 'prasarana_lahan.update_terakhir', 'prasarana_lahan.update_oleh'];
				$q = PrasaranaLahan::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('daftar_referensi', 'prasarana_lahan.id_jenis_prasarana_lahan', '=', 'daftar_referensi.id_lookup');
				$q = $q->join('upt', 'prasarana_lahan.id_upt', '=', 'upt.id_upt');
				
				$q = $q->where('daftar_referensi.groups', '=', 'jenis prasarana lahan');
				$data = $this->mapping($q);
				$collection = collect(array_values($data));

				if (!is_null($keyword) && !is_null($column)) {
					$collection = $collection->filter(function ($value, $key) use ($keyword, $column) {
						return (false !== stripos($value[$column], $keyword));
					});
				}

				if (!is_null($sort)) {
					$exSort = explode(',', $sort);
					foreach ($exSort as $key => $value) {
						$xdir = explode(':', $value);
						if (empty($xdir[0])) {
							return response()->json([
								'message' => 'Invalid format sort.'
							]);
						}
						$colSort = $xdir[0];
						$direction = empty($xdir[1]) ? 'asc' : $xdir[1];
						$sorted[] = [$colSort, $direction];
					}
					$collection = $collection->sortBy($sorted);
				}

				//manual pagination
				$collection = $collection->values()->toArray();
				if ($page != null && $perPage != null) {
					$startingPoint = ($page * $perPage) - $perPage;
					$collection = array_slice($collection, $startingPoint, $perPage, false);
				}

				//return $collection;
				$judul = 'Daftar Prasarana Lahan';
				return $file = Excel::download(new PrasaranaLahanExport($judul, $collection), 'Prasarana-Lahan' . date('Ymdhis') . '.xlsx');
			}

			public function printPDF($data)
			{
				$page = $data['page'] ?? 1;
				$perPage = $data['per_page'] ?? 10;
				$keyword = $data['keyword'] ?? NULL;
				$sort = $data['sort'] ?? NULL;
				$column = $data['column'] ?? 'id';

				$defaultColumn = ['prasarana_lahan.id_prasarana_lahan', 'daftar_referensi.deskripsi as jenis_prasarana', 'prasarana_lahan.nama_prasarana_lahan', 'upt.uraian as nmupt', 'prasarana_lahan.tgl_pengadaan', 'prasarana_lahan.keterangan', 'prasarana_lahan.update_terakhir', 'prasarana_lahan.update_oleh'];
				$q = PrasaranaLahan::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('daftar_referensi', 'prasarana_lahan.id_jenis_prasarana_lahan', '=', 'daftar_referensi.id_lookup');
				$q = $q->join('upt', 'prasarana_lahan.id_upt', '=', 'upt.id_upt');
				
				$q = $q->where('daftar_referensi.groups', '=', 'jenis prasarana lahan');
				$data = $this->mapping($q);
				$collection = collect(array_values($data));

				if (!is_null($keyword) && !is_null($column)) {
					$collection = $collection->filter(function ($value, $key) use ($keyword, $column) {
						return (false !== stripos($value->$column, $keyword));
					});
				}

				if (!is_null($sort)) {
					$exSort = explode(',', $sort);
					foreach ($exSort as $key => $value) {
						$xdir = explode(':', $value);
						if (empty($xdir[0])) {
							return response()->json([
								'message' => 'Invalid format sort.'
							]);
						}
						$colSort = $xdir[0];
						$direction = empty($xdir[1]) ? 'asc' : $xdir[1];
						$sorted[] = [$colSort, $direction];
					}
					$collection = $collection->sortBy($sorted);
				}

				$collection->all();

				if (!empty($data['page']) && !empty($data['per_page'])) {
					$paginate = $this->paginate($collection, $perPage, $page);
					$collection = $paginate->getCollection();
				}

				$judul = 'Prasarana Lahan';
				$columns = ["Jenis Prasarana", " Nama Prasarana", " UPT", " Tanggal Pengadaan", " Keterangan", " Update Terakhir", " Update Oleh" ];

				$columnOfValues = ['prasarana_lahan.id_prasarana_lahan', 'daftar_referensi.deskripsi as jenis_prasarana', 'prasarana_lahan.nama_prasarana_lahan', 'upt.uraian as nmupt', 'prasarana_lahan.tgl_pengadaan', 'prasarana_lahan.keterangan', 'prasarana_lahan.update_terakhir', 'prasarana_lahan.update_oleh'];
				$sizeCellcolumns = ["Jenis Prasarana" => 1000, " Nama Prasarana" => 1000, " UPT" => 1000, " Tanggal Pengadaan" => 1000, " Keterangan" => 1000, " Update Terakhir" => 1000, " Update Oleh"  => 1000];
				$sizeCells = ['jenis_prasarana' => 1000, 'nama_prasarana_lahan' => 1000, 'nmupt' => 1000, 'tgl_pengadaan' => 1000, 'keterangan' => 1000, 'update_terakhir' => 1000, 'update_oleh' => 1000];
				$collection = json_decode(json_encode($collection), true);

				setlocale(LC_TIME, 'id_ID');
				Carbon::setLocale('id');

				$templateProcessor = new TemplateProcessor(Storage_path('template/word/base_template_word.docx'));
				$templateProcessor->setValue('judul', $judul);
				$templateProcessor->setValue('tglCetak', Carbon::now()->format('d/m/Y'));
				//$templateProcessor->setValue('tabel', $tablexml);

				$sectionStyle = [
					'orientation' => 'landscape',
					'marginTop' => 600,
					'colsNum' => 2,
				];

				//$table = new Table(array('borderSize' => 12, 'borderColor' => 'green', 'width' => 6000));
				$table = new Table(['borderSize' => 5, 'borderColor' => '1e1e1e', 'width' => 20000, 'cellMargin' => 75]);
				$firstRowStyle = ['bgColor' => 'e5eecc'];
				$cellHCentered = ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER];
				$cellVCentered = ['valign' => 'center'];
				$styleCell = ['name' => 'TimesNewRomanPSMT', 'size' => '10', 'bold' => false];

				//tabel header
				$table->addRow();
				foreach ($columns as $column) {
					if ($column == 'No' || $column == 'no' || $column == 'Nomor' || $column == 'Nomer') {
						$table->addCell($sizeCellcolumns[$column], $firstRowStyle)->addText(htmlspecialchars($column), $styleCell, $cellHCentered);
					} else {
						$table->addCell($sizeCellcolumns[$column], $firstRowStyle)->addText(htmlspecialchars($column), $styleCell, $cellHCentered);
					}
				}

				//tabel body
				foreach ($collection as $index => $item) {
					$no = $index + 1;
					$table->addRow();
					foreach ($columnOfValues as $columnOfValue) {
						if ($columnOfValue == 'No' || $columnOfValue == 'no' || $columnOfValue == 'Nomor' || $columnOfValue == 'Nomer') {
							$table->addCell($sizeCells[$columnOfValue])->addText(htmlspecialchars($no), $styleCell, $cellHCentered);
						} else {
							$table->addCell($sizeCells[$columnOfValue], $cellVCentered)->addText(htmlspecialchars(!empty($item[$columnOfValue]) ? $item[$columnOfValue] : ''), $styleCell);
						}
					}
				}

				$templateProcessor->setComplexBlock('tabel', $table);

				$namaFileWord = 'Prasarana-Lahan' . Carbon::now()->format('Ymdhis') . '.doc';
				$templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));


				$dataFile['namaFilePdf'] = 'Prasarana-Lahan' . Carbon::now()->format('Ymdhis') . '.pdf';
				$dataFile['pathfile'] = Storage_path('temp/word/' . $namaFileWord);

				$pdf = $this->exportToPdf($dataFile);

				//delete file
				File::delete(Storage_path('temp/word/' . $namaFileWord));

				return $pdf;
			}

			public function exportToPdf($dataFile)
			{

				$domPdfPath = base_path('vendor/dompdf/dompdf');
				\PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
				\PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

				//Load word file
				$Content = \PhpOffice\PhpWord\IOFactory::load($dataFile['pathfile']);

				//Save it into PDF
				$PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');

				$filename = Storage_path('temp/pdf/' . $dataFile['namaFilePdf']);
				$contents = $PDFWriter->save($filename);

				return response()->download($filename);
			}
		}
		