<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class DeliveryOrderExport implements FromCollection,WithHeadings,WithStrictNullComparison,WithEvents
{
     /**
    * @return \Illuminate\Support\Collection
    */
   protected $exconfig_code;

    public function __construct($exconfig_code)
    {
      $this->exconfig_code = $exconfig_code;
    }


     public function registerEvents(): array
    {
         return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $spreadsheet = $spreadsheet->freezeFirstRow();
                
            },
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->freezePane('A2', 'A2');

                //$protection->setFormatCells(true);
            },
        ];
    }

    public function collection()
    {

    $col_name = $this->exconfig_code;
    

    $tbl_col =  DB::table('MASTER_EXCELCONFIG')->select('EXCEL_COL')->where('EXLCONFIG_CODE',$col_name)->get();
    //echo "<PRE>";
    // print_r($tbl_col);
     //return  $tbl_col ;
     return collect();
    
    }

    public function headings(): array
    {   

        $col_name = $this->exconfig_code;
    

        $tbl_col =  DB::table('MASTER_EXCELCONFIG')->where('EXLCONFIG_CODE',$col_name)->get()->toArray();

        $excelColumn = array();
        for($i=0;$i<count($tbl_col);$i++){

            array_push($excelColumn,$tbl_col[$i]->EXCEL_COL);
           
        }
        // print_r($excelColumn);exit;

        $columns = [   $excelColumn
                                  
               ];
            
                return $columns;
    }

    

}
