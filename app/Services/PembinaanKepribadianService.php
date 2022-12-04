<?php

namespace App\Services;

use App\Models\PembinaanKepribadian;
use App\Exports\PembinaanKepribadianExport;
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


class PembinaanKepribadianService
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
		$pembinaan_kepribadian = $data->get()->toArray();
		if (empty($pembinaan_kepribadian)) {
			return [];
		}
		foreach ($pembinaan_kepribadian as $val) {
			$result[] = [

				'id' => $val['id'],
				'nama_program' => $val['nama_program'],
				'jnskegiatan' => $val['jnskegiatan'],
				'tempat_pelaksanaan' => $val['tempat_pelaksanaan'],
				'tanggal' => $val['tanggal'],
				'jam_mulai' => $val['jam_mulai'],
				'jam_selesai ' => $val['jam_selesai'],
				'status  ' => $val['status']
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

		$defaultColumn = ['pembinaan_kepribadian.id', 'pembinaan_kepribadian.nama_program', 'daftar_referensi.groups as jnskegiatan', 'pembinaan_kepribadian.tempat_pelaksanaan', 'jadwal_pembinaan_kepribadian.tanggal', 'jadwal_pembinaan_kepribadian.jam_mulai', 'jadwal_pembinaan_kepribadian.jam_selesai', 'pembinaan_kepribadian.status'];
		$q = PembinaanKepribadian::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('daftar_referensi', 'pembinaan_kepribadian.id_jenis_pembinaan_kepribadian', '=', 'daftar_referensi.id_lookup');
		$q = $q->leftJoin('jadwal_pembinaan_kepribadian', 'pembinaan_kepribadian.id', '=', 'jadwal_pembinaan_kepribadian.id_pembinaan_kepribadian');

		$q = $q->where('daftar_referensi.groups', '=', 'jenis pembinaan kepribadian');
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
	 * @param object $pembinaan_kepribadian
	 * @return mixed
	 */
	public function show(object $pembinaan_kepribadian)
	{
		$data = [
			'id' => $pembinaan_kepribadian->id,
			'id_jenis_pembinaan_kepribadian' => $pembinaan_kepribadian->id_jenis_pembinaan_kepribadian,
			'id_upt' => $pembinaan_kepribadian->id_upt,
			'id_mitra' => $pembinaan_kepribadian->id_mitra,
			'nama_program' => $pembinaan_kepribadian->nama_program,
			'program_wajib' => $pembinaan_kepribadian->program_wajib,
			'materi_pembinaan_kepribadian' => $pembinaan_kepribadian->materi_pembinaan_kepribadian,
			'id_instruktur' => $pembinaan_kepribadian->id_instruktur,
			'penangung_jawab' => $pembinaan_kepribadian->penangung_jawab,
			'tanggal_mulai' => $pembinaan_kepribadian->tanggal_mulai,
			'tanggal_selesai' => $pembinaan_kepribadian->tanggal_selesai,
			'tempat_pelaksanaan' => $pembinaan_kepribadian->tempat_pelaksanaan,
			'perlu_kelulusan' => $pembinaan_kepribadian->perlu_kelulusan,
			'id_sarana' => $pembinaan_kepribadian->id_sarana,
			'id_prasarana' => $pembinaan_kepribadian->id_prasarana,
			'realisasi_anggaran' => $pembinaan_kepribadian->realisasi_anggaran,
			'id_jenis_anggaran' => $pembinaan_kepribadian->id_jenis_anggaran,
			'foto' => $pembinaan_kepribadian->foto,
			'keterangan' => $pembinaan_kepribadian->keterangan,
			'status' => $pembinaan_kepribadian->status
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

		$defaultColumn = ['pembinaan_kepribadian.id', 'pembinaan_kepribadian.nama_program', 'daftar_referensi.groups as jnskegiatan', 'pembinaan_kepribadian.tempat_pelaksanaan', 'jadwal_pembinaan_kepribadian.tanggal', 'jadwal_pembinaan_kepribadian.jam_mulai', 'jadwal_pembinaan_kepribadian.jam_selesai', 'pembinaan_kepribadian.status'];
		$q = PembinaanKepribadian::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('daftar_referensi', 'pembinaan_kepribadian.id_jenis_pembinaan_kepribadian', '=', 'daftar_referensi.id_lookup');
		$q = $q->leftJoin('jadwal_pembinaan_kepribadian', 'pembinaan_kepribadian.id', '=', 'jadwal_pembinaan_kepribadian.id_pembinaan_kepribadian');

		$q = $q->where('daftar_referensi.groups', '=', 'jenis pembinaan kepribadian');
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
		$judul = 'Daftar Pembinaan Kepribadian';
		return $file = Excel::download(new PembinaanKepribadianExport($judul, $collection), 'Pembinaan-Kepribadian' . date('Ymdhis') . '.xlsx');
	}

	public function printPDF($data)
	{
		$page = $data['page'] ?? 1;
		$perPage = $data['per_page'] ?? 10;
		$keyword = $data['keyword'] ?? NULL;
		$sort = $data['sort'] ?? NULL;
		$column = $data['column'] ?? 'id';

		$defaultColumn = ['pembinaan_kepribadian.id', 'pembinaan_kepribadian.nama_program', 'daftar_referensi.groups as jnskegiatan', 'pembinaan_kepribadian.tempat_pelaksanaan', 'jadwal_pembinaan_kepribadian.tanggal', 'jadwal_pembinaan_kepribadian.jam_mulai', 'jadwal_pembinaan_kepribadian.jam_selesai', 'pembinaan_kepribadian.status'];
		$q = PembinaanKepribadian::query();
		$q = $q->select($defaultColumn);
		$q = $q->join('daftar_referensi', 'pembinaan_kepribadian.id_jenis_pembinaan_kepribadian', '=', 'daftar_referensi.id_lookup');
		$q = $q->leftJoin('jadwal_pembinaan_kepribadian', 'pembinaan_kepribadian.id', '=', 'jadwal_pembinaan_kepribadian.id_pembinaan_kepribadian');

		$q = $q->where('daftar_referensi.groups', '=', 'jenis pembinaan kepribadian');
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

		$judul = 'Pembinaan Kepribadian';
		$columns = ["Nama Program", "Jenis Kegiatan", "Tempat", "Pelaksanaan", "Jam Pelaksanaan", "Daftar Peserta", "Status"];

		$columnOfValues = ['pembinaan_kepribadian.id', 'pembinaan_kepribadian.nama_program', 'daftar_referensi.groups as jnskegiatan', 'pembinaan_kepribadian.tempat_pelaksanaan', 'jadwal_pembinaan_kepribadian.tanggal', 'jadwal_pembinaan_kepribadian.jam_mulai', 'jadwal_pembinaan_kepribadian.jam_selesai', 'pembinaan_kepribadian.status'];
		$sizeCellcolumns = ["Nama Program" => 1000, "Jenis Kegiatan" => 1000, "Tempat" => 1000, "Pelaksanaan" => 1000, "Jam Pelaksanaan" => 1000, "Daftar Peserta" => 1000, "Status" => 1000];
		$sizeCells = [
			'nama_program' => 1000,
			'jnskegiatan' => 1000,
			'tempat_pelaksanaan' => 1000,
			'tanggal' => 1000,
			'jam_mulai' => 1000,
			'jam_selesai ' => 1000,
			'status  ' => 1000
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

		$namaFileWord = 'Pembinaan-Kepribadian' . Carbon::now()->format('Ymdhis') . '.doc';
		$templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));


		$dataFile['namaFilePdf'] = 'Pembinaan-Kepribadian' . Carbon::now()->format('Ymdhis') . '.pdf';
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
