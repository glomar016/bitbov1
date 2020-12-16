<?php

namespace App\Exports;

use App\Models\TUser;
use App\Models\TRESIDENTBASICINFO;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
//class ResidentsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithMultipleSheets
class OrdinanceExport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

  
    /**
    * @return \Illuminate\Support\Collection
    */

      use RegistersEventListeners;

    public function registerEvents(): array
    {


        $styleArray = [

                'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],    
            'font' => [
                'bold' => true,
                'size' => 12,
            ]
        ];

        return [

            BeforeSheet::class => function(BeforeSheet $event) use ($styleArray){
                $event->sheet->setCellValue('A1', 'BITBO - ORDINANCES/RESOLUTION')
                ->mergeCells('A1:AB1')
                ->getStyle('A1:BA1')->applyFromArray($styleArray)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('aacce8');
           },

            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {
                
                // $event->sheet->getStyle('A5:A51')->getAlignment()->applyFromArray(
                //     array('horizontal' => 'center')
                // );
                
                 $event->sheet->insertNewRowBefore(1, 1);

                 $event->sheet->getStyle("A3:BA3")->applyFromArray($styleArray);
                 $event->sheet->insertNewRowBefore(1, 1);
                
            },
        ];
    }

    public function query()
    {
      
      $result = \DB::TABLE('t_ordinance AS O')
                ->JOIN('r_ordinance_category AS C','C.ORDINANCE_CATEGORY_ID','O.CATEGORY_ID')
                ->JOIN('t_barangay_official AS BO','BO.BARANGAY_OFFICIAL_ID','O.BARANGAY_OFFICIAL_ID')
                ->JOIN('t_resident_basic_info AS RBI','BO.RESIDENT_ID','RBI.RESIDENT_ID')
                ->SELECT(\DB::RAW(
                        "
                        IFNULL(O.ORDINANCE_TITLE,''),
                        IFNULL(O.ORDINANCE_NUMBER,''),
                        IFNULL(O.ORDINANCE_SANCTION,''),
                        IFNULL( O.ORDINANCE_REMARKS,''),
                        IFNULL(O.ORDINANCE_DESCRIPTION,''),
                        IFNULL(C.ORDINANCE_CATEGORY_NAME,''),
                        CONCAT(RBI.LASTNAME, ' ',RBI.FIRSTNAME, ' ',RBI.LASTNAME)AS FULLNAME,
                        O.ACTIVE_FLAG,
                        O.ORDINANCE_TYPE
                        "
                    ))
                ->orderby('O.ORDINANCE_NUMBER');
              // DD($RES);
        return $result;
       
       //return \DB::RAW("SELECT HOUSEHOLD_ID, LASTNAME, FIRSTNAME, MIDDLENAME FROM T_RESIDENT_BASIC_INFO");
    }

   

    public function headings(): array
    {
        return [
            
            'ORDINANCE TITLE',
            'ORDINANCE NUMBER',
            'ORDINANCE SANCTION',
            'ORDINANCE REMARKS',
            'ORDINANCE DESCRIPTION',
            'ORDINANCE CATEGORY',
            'BARANGAY OFFICIAL',
            'ACTIVE FLAG',
            'TYPE',
        ];
    }
}
