<?php

namespace App\Services;

use App\Models\StatusPrasaranaRuang;
use App\Exports\StatusPrasaranaRuangExport;
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


class StatusPrasaranaRuangService
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
		$status_prasarana_ruang = $data->get()->toArray();
		if (empty($status_prasarana_ruang)) {
			return [];
		}
		foreach ($status_prasarana_ruang as $val) {
			$result[] = [

				'id' => $val['id'],
				'nama_prasarana_ruang' => $val['nama_prasarana_ruang'],
				'status' => $val['status'],
				'kepemilikan' => $val['kepemilikan'],
				'luas' => $val['luas'],
				'jumlah_lantai' => $val['jumlah_lantai'],
				'jumlah_ruang' => $val['jumlah_ruang'],
				'kondisi_baik' => $val['kondisi_baik'],
				'kondisi_rusak' => $val['kondisi_rusak']
			];
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
		$column = isset($data['column']) ? $data['column'] : 'id';

		$defaultColumn = ['status_prasarana_ruang.id', 'prasarana_ruang.nama_prasarana_ruang', 'status_prasarana_ruang.status', 'status_prasarana_ruang.kepemilikan', 'status_prasarana_ruang.luas', 'status_prasarana_ruang.jumlah_lantai', 'status_prasarana_ruang.jumlah_ruang', 'status_prasarana_ruang.kondisi_baik', 'status_prasarana_ruang.kondisi_rusak'];
		$q = StatusPrasaranaRuang::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('prasarana_ruang', 'status_prasarana_ruang.id_prasarana_ruang', '=', 'prasarana_ruang.id');


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
	 * @param object $status_prasarana_ruang
	 * @return mixed
	 */
	public function show(object $status_prasarana_ruang)
	{
		$data = [
			'id' => $status_prasarana_ruang->id,
			'id_prasarana_ruang' => $status_prasarana_ruang->id_prasarana_ruang,
			'tanggal' => $status_prasarana_ruang->tanggal,
			'status' => $status_prasarana_ruang->status,
			'kepemilikan' => $status_prasarana_ruang->kepemilikan,
			'luas' => $status_prasarana_ruang->luas,
			'satuan_luas' => $status_prasarana_ruang->satuan_luas,
			'jumlah_lantai' => $status_prasarana_ruang->jumlah_lantai,
			'jumlah_ruang' => $status_prasarana_ruang->jumlah_ruang,
			'kondisi_baik' => $status_prasarana_ruang->kondisi_baik,
			'kondisi_rusak' => $status_prasarana_ruang->kondisi_rusak,
			'satuan_kondisi' => $status_prasarana_ruang->satuan_kondisi,
			'foto' => $status_prasarana_ruang->foto,
			'pendaftaran_disnaker' => $status_prasarana_ruang->pendaftaran_disnaker,
			'catatan_disnaker' => $status_prasarana_ruang->catatan_disnaker,
			'keterangan' => $status_prasarana_ruang->keterangan

		];
		return $data;
	}

	public function exportExcel($data)
	{
		$page = $data['page'] ?? 1;
		$perPage = $data['per_page'] ?? 10;
		$keyword = $data['keyword'] ?? NULL;
		$sort = $data['sort'] ?? NULL;
		$column = $data['column'] ?? 'id';

		$defaultColumn = ['status_prasarana_ruang.id', 'prasarana_ruang.nama_prasarana_ruang', 'status_prasarana_ruang.status', 'status_prasarana_ruang.kepemilikan', 'status_prasarana_ruang.luas', 'status_prasarana_ruang.jumlah_lantai', 'status_prasarana_ruang.jumlah_ruang', 'status_prasarana_ruang.kondisi_baik', 'status_prasarana_ruang.kondisi_rusak'];
		$q = StatusPrasaranaRuang::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('prasarana_ruang', 'status_prasarana_ruang.id_prasarana_ruang', '=', 'prasarana_ruang.id');


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
		$judul = 'Daftar Status Prasarana Ruang';
		return $file = Excel::download(new StatusPrasaranaRuangExport($judul, $collection), 'Status-Prasarana-Ruang' . date('Ymdhis') . '.xlsx');
	}

	public function printPDF($data)
	{
		$page = $data['page'] ?? 1;
		$perPage = $data['per_page'] ?? 10;
		$keyword = $data['keyword'] ?? NULL;
		$sort = $data['sort'] ?? NULL;
		$column = $data['column'] ?? 'id';

		$defaultColumn = ['status_prasarana_ruang.id', 'prasarana_ruang.nama_prasarana_ruang', 'status_prasarana_ruang.status', 'status_prasarana_ruang.kepemilikan', 'status_prasarana_ruang.luas', 'status_prasarana_ruang.jumlah_lantai', 'status_prasarana_ruang.jumlah_ruang', 'status_prasarana_ruang.kondisi_baik', 'status_prasarana_ruang.kondisi_rusak'];
		$q = StatusPrasaranaRuang::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('prasarana_ruang', 'status_prasarana_ruang.id_prasarana_ruang', '=', 'prasarana_ruang.id');


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

		$judul = 'Status Prasarana Ruang';
		$columns = ["Nama Prasarana", " Status", " Kepemilikan", "Luas", "Jumlah Lantai", "Jumlah Ruang", "Kondisi Baik", "Kondisi Rusak"];

		$columnOfValues = ['status_prasarana_ruang.id', 'prasarana_ruang.nama_prasarana_ruang', 'status_prasarana_ruang.status', 'status_prasarana_ruang.kepemilikan', 'status_prasarana_ruang.luas', 'status_prasarana_ruang.jumlah_lantai', 'status_prasarana_ruang.jumlah_ruang', 'status_prasarana_ruang.kondisi_baik', 'status_prasarana_ruang.kondisi_rusak'];
		$sizeCellcolumns = ["Nama Prasarana" => 1000, " Status" => 1000, " Kepemilikan" => 1000, "Luas" => 1000, "Jumlah Lantai" => 1000, "Jumlah Ruang" => 1000, "Kondisi Baik" => 1000, "Kondisi Rusak" => 1000];
		$sizeCells = [
			'nama_prasarana_ruang' => 1000,
			'status' => 1000,
			'kepemilikan' => 1000,
			'luas' => 1000,
			'jumlah_lantai' => 1000,
			'jumlah_ruang' => 1000,
			'kondisi_baik' => 1000,
			'kondisi_rusak' => 1000
		];
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

		$namaFileWord = 'Status-Prasarana-Ruang' . Carbon::now()->format('Ymdhis') . '.doc';
		$templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));


		$dataFile['namaFilePdf'] = 'Status-Prasarana-Ruang' . Carbon::now()->format('Ymdhis') . '.pdf';
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
