<?php

			namespace App\Exports;

			//use Maatwebsite\Excel\Concerns\FromCollection;
			use Maatwebsite\Excel\Concerns\FromArray;
			use Maatwebsite\Excel\Concerns\WithCustomStartCell;
			use Maatwebsite\Excel\Concerns\ShouldAutoSize;
			use Maatwebsite\Excel\Concerns\WithTitle;
			use Maatwebsite\Excel\Concerns\WithStyles;
			use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

			class PelatihanKeterampilanExport implements FromArray, WithCustomStartCell, ShouldAutoSize, WithTitle, WithStyles //,WithDrawings
			{

				protected $judul = '';
				protected $data = [];
				protected $lastRow = 0;

				public function __construct($judul, $data)
				{
					$this->judul = $judul;
					$this->data = $data;
				}

				/**
				 * @return \Illuminate\Support\Collection
				 */
				// public function collection()
				// {
				//     //
				// }

				public function array(): array
				{

					$valueSheet = [];
					$valueSheet[] = [$this->judul, ''];
					$valueSheet[] = [''];
					$valueSheet[] = ['No', "Nama Program", "Jenis Kegiatan", "Tempat", "Pelaksanaan", "Jam Pelaksanaan", "Daftar Peserta", "Status"];

					//data
					foreach ($this->data as $index => $item) {
						$no = $index + 1;
						$valueSheet[] = [$no, $item['nama_program'], $item['jnskegiatan'], $item['tempat_pelaksanaan'], $item['tanggal'], $item['jam_mulai'], $item['jam_selesai'], $item['status']];
					}

					$this->lastRow = 4 + (count($valueSheet) - 3);

					return $valueSheet;
				}

				public function startCell(): string
				{
					return 'A2';
				}

				public function title(): string
				{
					return $this->judul;
				}

				public function styles(Worksheet $sheet)
				{

					$styleArray = [
						'borders' => [
							'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								// 'color' => ['argb' => 'FFFF0000'],
								'color' => ['argb' => '00000000'],
							],
						],
					];

					$sheet->getStyle('A4:H' . $this->lastRow)->applyFromArray($styleArray);

					//set color background header
					$sheet->getStyle('A4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('C0C0C0C0');

					//set center align text
					$hor_center = ['horizontal' => 'center'];
					$sheet->getStyle('A4:H4')->getAlignment()->applyFromArray($hor_center);

					//set center align for column 'no'
					for ($x = 4; $x <= $this->lastRow; $x++) {
						$sheet->getStyle('A' . $x)->getAlignment()->applyFromArray($hor_center);
					}


					return [
						'2' => ['font' => ['bold' => true, 'size' => 12]],
						'4' => ['font' => ['bold' => true, 'size' => 12]],
					];
				}

				// public function drawings()
				// {
				//     $drawing = new Drawing();
				// }
			}
