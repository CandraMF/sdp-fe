<?php

		namespace App\Services;

		use App\Models\Instruktur;
		use App\Exports\InstrukturExport;
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


		class InstrukturService
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
				$instruktur = $data->get()->toArray();
				if (empty($instruktur)) {
					return [];
				}
				foreach ($instruktur as $val) {
					$result[] = array(
						 'id_instruktur ' => $val['id_instruktur '],  'nama_program' => $val['nama_program'],  'nama_instruktur' => $val['nama_instruktur'],  'asal_institusi_instruktur' => $val['asal_institusi_instruktur'],  'jenis_instruktur' => $val['jenis_instruktur'],  'keterangan' => $val['keterangan'],  'no_telp' => $val['no_telp'],  'email' => $val['email'],  'keterangan' => $val['keterangan']
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
				$column = isset($data['column']) ? $data['column'] : 'id_instruktur';

				$defaultColumn = ['instruktur.id_instruktur', 'pembinaan_kepribadian.nama_program', 'instruktur.nama_instruktur', 'instruktur.asal_institusi_instruktur', 'instruktur.jenis_instruktur', 'instruktur.keterangan', 'instruktur.no_telp', 'instruktur.email', 'instruktur.keterangan'];
				$q = Instruktur::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('pembinaan_kepribadian', 'instruktur.id_pembinaan_kepribadian', '=', 'pembinaan_kepribadian.id_pembinaan_kepribadian');
				
				
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
			 * @param object $instruktur
			 * @return mixed
			 */
			public function show(object $instruktur)
			{
				$data = array(
					'id_instruktur ' => $instruktur->id_instruktur , 'nama_program' => $instruktur->nama_program, 'nama_instruktur' => $instruktur->nama_instruktur, 'asal_institusi_instruktur' => $instruktur->asal_institusi_instruktur, 'jenis_instruktur' => $instruktur->jenis_instruktur, 'keterangan' => $instruktur->keterangan, 'no_telp' => $instruktur->no_telp, 'email' => $instruktur->email, 'keterangan' => $instruktur->keterangan
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

				$defaultColumn = ['instruktur.id_instruktur', 'pembinaan_kepribadian.nama_program', 'instruktur.nama_instruktur', 'instruktur.asal_institusi_instruktur', 'instruktur.jenis_instruktur', 'instruktur.keterangan', 'instruktur.no_telp', 'instruktur.email', 'instruktur.keterangan'];
				$q = Instruktur::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('pembinaan_kepribadian', 'instruktur.id_pembinaan_kepribadian', '=', 'pembinaan_kepribadian.id_pembinaan_kepribadian');
				
				
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
				$judul = 'Daftar Instruktur';
				return $file = Excel::download(new InstrukturExport($judul, $collection), 'Instruktur' . date('Ymdhis') . '.xlsx');
			}

			public function printPDF($data)
			{
				$page = $data['page'] ?? 1;
				$perPage = $data['per_page'] ?? 10;
				$keyword = $data['keyword'] ?? NULL;
				$sort = $data['sort'] ?? NULL;
				$column = $data['column'] ?? 'id';

				$defaultColumn = ['instruktur.id_instruktur', 'pembinaan_kepribadian.nama_program', 'instruktur.nama_instruktur', 'instruktur.asal_institusi_instruktur', 'instruktur.jenis_instruktur', 'instruktur.keterangan', 'instruktur.no_telp', 'instruktur.email', 'instruktur.keterangan'];
				$q = Instruktur::query();
				$q = $q->select($defaultColumn);
				$q = $q->join('pembinaan_kepribadian', 'instruktur.id_pembinaan_kepribadian', '=', 'pembinaan_kepribadian.id_pembinaan_kepribadian');
				
				
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

				$judul = 'Instruktur';
				$columns = ["Jenis Program", "Nama Instruktur", "Asal Institusi", "Jenis Instruktur", "Keterangan", "No Telpon", "Email", "Keterangan"];

				$columnOfValues = ['instruktur.id_instruktur', 'pembinaan_kepribadian.nama_program', 'instruktur.nama_instruktur', 'instruktur.asal_institusi_instruktur', 'instruktur.jenis_instruktur', 'instruktur.keterangan', 'instruktur.no_telp', 'instruktur.email', 'instruktur.keterangan'];
				$sizeCellcolumns = ["Jenis Program" => 1000, "Nama Instruktur" => 1000, "Asal Institusi" => 1000, "Jenis Instruktur" => 1000, "Keterangan" => 1000, "No Telpon" => 1000, "Email" => 1000, "Keterangan" => 1000];
				$sizeCells = ['id_instruktur ' => 1000, 'nama_program' => 1000, 'nama_instruktur' => 1000, 'asal_institusi_instruktur' => 1000, 'jenis_instruktur' => 1000, 'keterangan' => 1000, 'no_telp' => 1000, 'email' => 1000, 'keterangan' => 1000];
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

				$namaFileWord = 'Instruktur' . Carbon::now()->format('Ymdhis') . '.doc';
				$templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));


				$dataFile['namaFilePdf'] = 'Instruktur' . Carbon::now()->format('Ymdhis') . '.pdf';
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
		