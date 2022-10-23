<?php

namespace App\Services;

use App\Models\RefJenisSarana;
use App\Exports\RefJenisSaranaExport;
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

class RefJenisSaranaService
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
        $perPage = (int) $perPage;
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
        $ref_jenis_sarana = $data->get()->toArray();
        if (empty($ref_jenis_sarana)) {
            return [];
        }
        $results = [];
        
        foreach ($ref_jenis_sarana as $val) {
            $result = $val;
            $results[] = $result;
        }

        return $results;
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
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $keyword = $data['keyword'] ?? NULL;
        $sort = $data['sort'] ?? NULL;
        $column = $data['column'] ?? 'id';

       

		$defaultColumn = ["id_jenissarana", "jenissarana", "keterangan", "updateterakhir", "updateoleh"];
        $q = RefJenisSarana::query();
        $q = $q->select($defaultColumn);

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
     * @param object $ref_jenis_sarana
     * @return mixed
     */
 
    public function exportExcel($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $keyword = $data['keyword'] ?? NULL;
        $sort = $data['sort'] ?? NULL;
        $column = $data['column'] ?? 'id';

        $defaultColumn = ["id_jenissarana", "jenissarana", "keterangan", "updateterakhir", "updateoleh"];
        $q = RefJenisSarana::query();
        $q = $q->select($defaultColumn);

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
        $judul = "Daftar Referensi Jenis Sarana";
        return $file = Excel::download(new RefJenisSaranaExport($judul, $collection), "Referensi-Jenis-Sarana- " . date("Ymdhis") . ".xlsx");
    }

    public function printPDF($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $keyword = $data['keyword'] ?? NULL;
        $sort = $data['sort'] ?? NULL;
        $column = $data['column'] ?? 'id';

		$defaultColumn = ["id_jenissarana", "jenissarana", "keterangan", "updateterakhir", "updateoleh"];
        $q = RefJenisSarana::query();
        $q = $q->select($defaultColumn);

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

        $judul = "Referensi-Jenis-Sarana";
        $columns = ["Jenis Sarana", "Keterangan"];
        $columnOfValues = ['jenissarana', 'keterangan'];
        $sizeCellcolumns = ["Jenis Sarana" => 1500, "Keterangan" => 1500];
        $sizeCells = ['jenissarana' => 1500, 'keterangan' => 1500];
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
            if ($column == "No" || $column == "no" || $column == "Nomor" || $column == "Nomer") {
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
                if ($columnOfValue == "No" || $columnOfValue == "no" || $columnOfValue == "Nomor" || $columnOfValue == "Nomer") {
                    $table->addCell($sizeCells[$columnOfValue])->addText(htmlspecialchars($no), $styleCell, $cellHCentered);
                } else {
                    $table->addCell($sizeCells[$columnOfValue], $cellVCentered)->addText(htmlspecialchars(!empty($item[$columnOfValue]) ? $item[$columnOfValue] : ""), $styleCell);
                }
            }
        }

        $templateProcessor->setComplexBlock('tabel', $table);

        $namaFileWord = 'Referensi-Jenis-Sarana-' . Carbon::now()->format('Ymdhis') . '.doc';
        $templateProcessor->saveAs(Storage_path('temp/word/' . $namaFileWord));

        

        $dataFile["pathfile"] = Storage_path('temp/word/' . $namaFileWord);

        $pdf = $this->exportToPdf($dataFile);

        //delete file
        File::delete(Storage_path('temp/word/' . $namaFileWord));
        return $pdf;

    }

    public function exportToPdf($dataFile)
    {
        $uri = '/unoconv/pdf';
        $token = null;

        $data = [
            'base_uri' => env('API_UNOCONV'),
            'headers'  => ['Accept' => 'application/json'],
            'http_errors' => true,
        ];

        if (!is_null($token)) {
            $data['headers']['Authorization'] = 'bearer ' . $token;
        }

        $data['multipart'][0]['Content-type'] = 'multipart/form-data';
        //$data['multipart'][0]['contents'] = file_get_contents($dataFile['pathfile']);
        $data['multipart'][0]['contents'] = $dataFile['pathfile'] != null ? fopen($dataFile['pathfile'], 'r') : null;
        $data['multipart'][0]['name'] = 'file';

        $client = new Client($data);

        $response = $client->post($uri);
        $contents = $response->getBody()->getContents();
        
        return $contents;
        
    }
}
