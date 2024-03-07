<?php

namespace App\Exports;

use App\Models\TimeKeeping;
use App\ModelTimeKeeping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeKeepingExport implements FromCollection,WithHeadingRow, WithEvents,WithStyles, WithColumnFormatting, WithCustomStartCell,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $listTime;
    public function collection()
    {
        return TimeKeeping::all('id','staff_name','date_in','date_out','time','date');
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array {
        return [
            'ID',
            'Tên giảng viên',
            'Giờ check in',
            "Giờ check out",
            "Tổng phút",
            "Ngày"
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A5')->getFont()->setBold(true);
        // $sheet->getStyle('A5')->getColor('#ffffff');
        $sheet->getStyle('B5')->getFont()->setBold(true);
        $sheet->getStyle('C5')->getFont()->setBold(true);
        $sheet->getStyle('D5')->getFont()->setBold(true);
        $sheet->getStyle('E5')->getFont()->setBold(true);
        $sheet->getStyle('F5')->getFont()->setBold(true);
        $sheet->getStyle('A')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('B')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('C')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('D')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('E')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('F')->getAlignment()->applyFromArray(
            array('horizontal' => 'center'),
            array('Some big header here')
        );

        $sheet->mergeCells('A1:F1');
    }

    public function columnWidths(Worksheet $sheet): array
    {
        return [
            'A' => 60,
            'B' => 60,
            'C' => 60,
            'D' => 60,
            'E' => 60,
            'F' => 60,
        ];

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $columns = ['A', 'B', 'C', 'D','E', 'F'];
                foreach($columns as $column){
                    $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
                    $event->sheet->getDelegate()->getStyle('A5:F5')
                    ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('F5A89A');
                }
            },
        ];
    }
}
