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
class ResidentsExport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

  
    /**
    * @return \Illuminate\Support\Collection
    */

    use RegistersEventListeners;
    
    protected $filters;

    function __construct($id) {
        $this->filters = $id;
    }

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
                $event->sheet->setCellValue('A1', 'BITBO - Residents Information And Household Information')
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
        
        $result = \DB::table('v_filter_residents')->orderby('HOUSEHOLD_ID');
        if ( array_key_exists('sex', $this->filters) ) {
            $result->where('SEX', $this->filters['sex']);
        }
        if ( array_key_exists('civil_status', $this->filters) ) {
            $result->where('CIVIL_STATUS', $this->filters['civil_status']);
        }
        return $result;

    }
    
   

    public function headings(): array
    {
        return [
            
            'LASTNAME',
            'FIRSTNAME',
            'MIDDLENAME',
            'ADDRESS UNIT NO',
            'ADDRESS PHASE',
            'ADDRESS HOUSE_NO',
            'ADDRESS STREET',
            'QUALIFIER',
            'DATE OF BIRTH (YYYY--MM--DD)',
            'PLACE OF BIRTH',
            'SEX',
            'CIVIL STATUS',
            'IS OFW (Y/N)',
            'OCCUPATION',
            'WORK STATUS',
            'DATE STARTED WORKING',
            'CITIZENSHIP',
            'RELATION TO HOUSEHOLD_HEAD',
            'DATE OF ARRIVAL (YYYY--MM--DD)',
            'ARRIVAL STATUS (NR FOR NATIVE RESIDENTS), (M FOR MIGRANTS)',
            'IS INDIGENOUS (Y/N)',
            'CONTACT NUMBER',
            'EDUCATIONAL ATTAINMENT',


            'HOME OWNERSHIP',
            'PERSON STAYING IN HOUSEHOLD',
            'HOME MATERIALS',
            'NUMBER OF ROOMS',
             
            'TOILET HOME (Y/N)',
            'PLAY AREA HOME (Y/N)',
            'BEDROOM HOME (Y/N)',
            'DINING ROOM HOME (Y/N)',
            'SALA HOME (Y/N)',
            'KITCHEN HOME (Y/N)',
            'WATER UTILITIES (Y/N)',
            'ELECTRICITY UTILITIES (Y/N)',
            'AIRCON UTILITIES (Y/N)',
            'PHONE UTILITIES (Y/N)',
            'COMPUTER UTILITIES (Y/N)',
            'INTERNET UTILITIES (Y/N)',
            'TV UTILITIES (Y/N)',
            'CD PLAYER UTILITIES (Y/N)',
            'RADIO ADDRESS (Y/N)',
            'COMICS ENTERTAINMENT (Y/N)',
            'NEW PAPER ENTERTAINMENT (Y/N)',
            'PETS ENTERTAINMENT (Y/N)',
            'BOOKS ENTERTAINMENT (Y/N)',
            'STORY BOOKS ENTERTAINMENT (Y/N)',
            'TOYS ENTERTAINMENT (Y/N)',
            'BOARD GAMES ENTERTAINMENT (Y/N)',
            'PUZZLES ENTERTAINMENT (Y/N)',
            'POSITION IN THE BARANGAY (LEAVE IT BLANK IF NOT A BARANGAY OFFICIAL)',
            'START TERM (YYYY--MM--DD)',
            'END TERM(YY--MM--DD)',
        ];
    }

  

}
