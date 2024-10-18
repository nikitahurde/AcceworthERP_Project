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

class TableExport implements FromCollection,WithHeadings,WithStrictNullComparison,WithEvents
{
     /**
    * @return \Illuminate\Support\Collection
    */
   protected $table;

    public function __construct($table)
    {
      $this->table = $table;
    }


     public function registerEvents(): array
    {
         return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $spreadsheet = $spreadsheet->freezeFirstRow();
                
                //$security->setWorkbookPassword("test");
               // $security->setRevisionsPassword('test');
            },
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->freezePane('A2', 'A2');

                //$protection->setFormatCells(true);
            },
        ];
    }

    public function collection()
    {

    $table_name = $this->table;
    

     $table =  DB::getSchemaBuilder()->getColumnListing($table_name);

     $todaydate = date('Y-m-d');

      return  DB::table($table_name)->where('created_date',$todaydate)->get($table);

    
    }

    public function headings(): array
    {

    $table_name = $this->table;
   

     $table =  DB::getSchemaBuilder()->getColumnListing($table_name);

     $todaydate = date('Y-m-d');

      $data =  DB::table($table_name)->where('created_date',$todaydate)->get();

    // print_r($data);exit;

        return [

           $table,
       
        ];
    }
}
