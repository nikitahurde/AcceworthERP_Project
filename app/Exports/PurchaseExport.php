<?php

namespace App\Exports;

use DB;
use App\Models\purchase_indent_head;
use Session;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;



class PurchaseExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function getCompName(Request $request){
       $compName = $request->session()->get('company_name');
      
    }

   
    

    public function headings():array{
        return[

            
            ['Fy_yr'],
            ['Address'],
            [
            'PFCT CODE',
            'TRAN CODE',
            'VR DATE',
            'VR NO',
            'ITEM CODE',
            'ITEM NAME',
            'REMARK',
            'QTY RECEIVED',
            'UM',
            'AQ RECEIVED','AUM']
            ];
    } 
    public function collection()
    {
        $data = DB::SELECT("SELECT T1.PFCT_CODE,T1.TRAN_CODE,DATE_FORMAT(T1.VRDATE, '%d-%m-%Y'),CONCAT(T1.SERIES_CODE,'-',substring_index(T1.FY_CODE,'-',1),' ',T1.VRNO) as Vrno,T2.ITEM_CODE, T2.ITEM_NAME,T2.REMARK, T2.QTYRECVD,T2.UM,T2.AQTYRECD,T2.AUM
            FROM PINDENT_HEAD AS T1
            LEFT JOIN PINDENT_BODY AS T2 ON T1.PINDHID = T2.PINDHID");
        
        return collect($data);
       
     }
    
    public function startCell(): string
    {
        return 'A2';
    }
     
    public function registerEvents(): array
    {
        
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $comp = Session::get('company_name');
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:K1'; // All headers
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:K1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:K1')
                                ->getFont()
                                ->setBold(true);
                $sheet->mergeCells('A2:K2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:K1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:K2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:K2')
                                ->getFont()
                                ->setBold(true);
                $sheet->mergeCells('A3:K3');
                $sheet->setCellValue('A3', $compAddr[0]->ADD1);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:K3')
                                ->getFont()
                                ->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:K3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:K4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:K4')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
