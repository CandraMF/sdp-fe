<?php

		namespace App\Services;

		use App\Models\Mitra;
		use App\Exports\MitraExport;
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


		class MitraService
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
				$mitra = $data->get()->toArray();
				if (empty($mitra)) {
					return [];
				}
				foreach ($mitra as $val) {
					$result[] = array(
						 'id_mitra' => $val['id_mitra'],  'nama_mitra ' => $val['nama_mitra '],  'nama_pic' => $val['nama_pic'],  'alamat' => $val['alamat'],  'no_telp' => $val['no_telp'],  'propinsi' => $val['propinsi'],  'kabkota' => $val['kabkota'],  'update_terakhir' => $val['update_terakhir'],  'update_oleh' => $val['update_oleh']
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
				$column = isset($data['column']) ? $data['column'] : 'id_mitra';

				$defaultColumn = ['mitra.id_mitra', 'mitra.nama_mitra', 'mitra.nama_pic', 'mitra.alamat', 'mitra.no_telp', 'provinsi.deskripsi as propinsi', 'dati2.deskripsi as kabkota', 'mitra.update_terakhir', 'mitra.update_oleh'];
				$q = Mitra::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('dati2', 'mitra.id_dati2', '=', 'dati2.id_dati2');
				$q = $q->join('provinsi', 'dati2.id_provinsi', '=', 'provinsi.id_provinsi');
				
				
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
			 * @param object $mitra
			 * @return mixed
			 */
			public function show(object $mitra)
			{
				$data = array(
					'id_mitra' => $mitra->id_mitra, 'nama_mitra ' => $mitra->nama_mitra , 'nama_pic' => $mitra->nama_pic, 'alamat' => $mitra->alamat, 'no_telp' => $mitra->no_telp, 'propinsi' => $mitra->propinsi, 'kabkota' => $mitra->kabkota, 'update_terakhir' => $mitra->update_terakhir, 'update_oleh' => $mitra->update_oleh
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

				$defaultColumn = ['mitra.id_mitra', 'mitra.nama_mitra', 'mitra.nama_pic', 'mitra.alamat', 'mitra.no_telp', 'provinsi.deskripsi as propinsi', 'dati2.deskripsi as kabkota', 'mitra.update_terakhir', 'mitra.update_oleh'];
				$q = Mitra::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('dati2', 'mitra.id_dati2', '=', 'dati2.id_dati2');
				$q = $q->join('provinsi', 'dati2.id_provinsi', '=', 'provinsi.id_provinsi');
				
				
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
				$judul = 'Daftar Mitra';
				return $file = Excel::download(new MitraExport($judul, $collection), 'Mitra' . date('Ymdhis') . '.xlsx');
			}

			public function printPDF($data)
			{
				$page = $data['page'] ?? 1;
				$perPage = $data['per_page'] ?? 10;
				$keyword = $data['keyword'] ?? NULL;
				$sort = $data['sort'] ?? NULL;
				$column = $data['column'] ?? 'id';

				$defaultColumn = ['mitra.id_mitra', 'mitra.nama_mitra', 'mitra.nama_pic', 'mitra.alamat', 'mitra.no_telp', 'provinsi.deskripsi as propinsi', 'dati2.deskripsi as kabkota', 'mitra.update_terakhir', 'mitra.update_oleh'];
				$q = Mitra::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('dati2', 'mitra.id_dati2', '=', 'dati2.id_dati2');
				$q = $q->join('provinsi', 'dati2.id_provinsi', '=', 'provinsi.id_provinsi');
				
				
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

				$judul = 'Mitra';
				$columns = ["Nama", "Mitra", "Penanggung Jawab", "Alamat", "No Telpon", "Provinsi", "Kota", "Update Terakhir", "Update Oleh"];

				$columnOfValues = ['mitra.id_mitra', 'mitra.nama_mitra', 'mitra.nama_pic', 'mitra.alamat', 'mitra.no_telp', 'provinsi.deskripsi as propinsi', 'dati2.deskripsi as kabkota', 'mitra.update_terakhir', 'mitra.update_oleh'];
				$sizeCellcolumns = ["Nama" => 1000, "Mitra" => 1000, "Penanggung Jawab" => 1000, "Alamat" => 1000, "No Telpon" => 1000, "Provinsi" => 1000, "Kota" => 1000, "Update Terakhir" => 1000, "Update Oleh" => 1000];
				$sizeCells = ['nama_mitra ' => 1000, 'nama_pic' => 1000, 'alamat' => 1000, 'no_telp' => 1000, 'propinsi' => 1000, 'kabkota' => 1000, 'update_terakhir' => 1000, 'update_oleh' => 1000];
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

				$namaFileWord = 'Mitra' . Carbon::now()->format('Ymdhis') . '.doc';
				$templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));


				$dataFile['namaFilePdf'] = 'Mitra' . Carbon::now()->format('Ymdhis') . '.pdf';
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
		