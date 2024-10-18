<?php

namespace App\Exports;

use DB;
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



class ContractExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
            'PFCT CODE','TRAN CODE','VR NO','ACC CODE','QUOTATION COMP_NO','PLANT CODE','TAX CODE','VR DATE','ITEM CODE',
            'ITEM NAME','LEVEL_I','UM CODE','AUM_CODE','REMARK','QUANTITY','AQUANTITY','RATE','HSN CODE','BASIC AMT','CR AMOUNT','QTO COMP NO','BASIC','DISCOUNT','SGST','CGST','OTHER','ROUND OFF','GRAND TOTAL'
            ]
            ];
    } 

   
    public function collection()
    {
      

      $data1 = DB::SELECT("SELECT T1.PCNTRHID,T1.PCNTRBID,T1.TAX_AMT FROM PCNTR_TAX AS T1 LEFT JOIN PCNTR_HEAD AS T2 ON T2.PCNTRHID = T1.PCNTRHID LEFT JOIN PCNTR_BODY AS T3 ON T3.PCNTRBID = T1.PCNTRBID");

      $taxDatacount = count($data1);
      // echo '<pre>';
      // print_r($data1);
     
      $createdBy = session::get('userid');

      for($i=0;$i<$taxDatacount;$i++){

        
        $headId = $data1[$i]->PCNTRHID;
        $bodyId = $data1[$i]->PCNTRBID;

        // echo '</pre>';
        // print_r($headId);
        // print_r($bodyId);
        // echo '<br>';

        $taxData = DB::table('PCNTR_TAX')->where('PCNTRHID',$headId)->where('PCNTRBID',$bodyId)->get();
        $taxRC = count($taxData);

        $taxDetails = DB::table('CONTRACT_TAX_CAL')->where('CHID',$headId)->where('CBODYID',$bodyId)->get();

        // echo '<pre>';

        // print_r($taxDetails);

        $taxDC=count($taxDetails);
      // print_r($taxDataC);

      if($taxDC == 0){

         $srno = 0;
            for ($j=0; $j < $taxRC; $j++) { 
                
                if($srno == 0){

                 $tax_cal = array(
                    'CHID' => $data1[$j]->PCNTRHID,
                    'CBODYID' => $data1[$j]->PCNTRBID,
                    'TAX_IND_1' => $data1[$j]->TAX_AMT,
                    'FLAG'       => '0',
                    'CREATED_BY' => $createdBy,
                    'UPDATED_BY' => $createdBy
                );
                
                DB::table('CONTRACT_TAX_CAL')->insert($tax_cal);  
                $lastId=DB::getPdo()->lastInsertId();
               
                }else{ 
                 $k = $j+1;
                 
                   $tax_calUpdate = array(
                    'CHID' => $data1[$j]->PCNTRHID,
                    'CBODYID' => $data1[$j]->PCNTRBID,
                    'TAX_IND_'.$k => $data1[$j]->TAX_AMT,
                    'FLAG'       => '0',
                    'CREATED_BY' => $createdBy,
                    'UPDATED_BY' => $createdBy
                );   
                 DB::table('CONTRACT_TAX_CAL')->where('ID',$lastId)->update($tax_calUpdate); 
                 }
                 
                
                $srno++;
               
            }

      }else{
        
         $deltaxData =DB::table('CONTRACT_TAX_CAL')->where('CHID',$headId)->where('CBODYID',$bodyId)->delete();

          if($deltaxData){

             $srno = 0;
            for ($j=0; $j < $taxRC; $j++) { 
                
                if($srno == 0){

                 $tax_cal = array(
                    'CHID' => $data1[$j]->PCNTRHID,
                    'CBODYID' => $data1[$j]->PCNTRBID,
                    'TAX_IND_1' => $data1[$j]->TAX_AMT,
                    'FLAG'       => '0',
                    'CREATED_BY' => $createdBy,
                    'UPDATED_BY' => $createdBy
                );
                
                DB::table('CONTRACT_TAX_CAL')->insert($tax_cal);  
                $lastId=DB::getPdo()->lastInsertId();
               
                }else{ 
                 $k = $j+1;
                 $tax_calUpdate = array(
                    'CHID' => $data1[$j]->PCNTRHID,
                    'CBODYID' => $data1[$j]->PCNTRBID,
                    'TAX_IND_'.$k => $data1[$j]->TAX_AMT,
                    'FLAG'       => '0',
                    'CREATED_BY' => $createdBy,
                    'UPDATED_BY' => $createdBy
                );   
                 DB::table('CONTRACT_TAX_CAL')->where('ID',$lastId)->update($tax_calUpdate);
                }
                $srno++;
               
            }

          }
      }
      

      }

    $data = DB::SELECT("SELECT T1.PFCT_CODE,T1.TRAN_CODE ,CONCAT(T1.SERIES_CODE,'-',substring_index(T1.FY_CODE ,'-',1),' ',T1.VRNO) as Vrno,T1.ACC_CODE,T1.PQTNHID,T1.PFCT_CODE,T1.TAX_CODE,DATE_FORMAT(T1.VRDATE,'%d-%m-%Y'),T2.ITEM_CODE, T2.ITEM_NAME,T2.UM,T2.AUM,T2.APPROVE_REMARK,T2.QTYRECD,T2.AQTYRECD,T2.RATE,T2.HSN_CODE,T2.BASICAMT,T2.CRAMT,T2.POQTY,T2.GRNQTY,T3.TAX_IND_1,T3.TAX_IND_2,T3.TAX_IND_4,T3.TAX_IND_5,T3.TAX_IND_7,T3.TAX_IND_8,T3.TAX_IND_9
            FROM PCNTR_HEAD AS T1
            LEFT JOIN PCNTR_BODY AS T2 ON T1.PCNTRHID  = T2.PCNTRHID 
            LEFT JOIN CONTRACT_TAX_CAL as T3 ON T1.PCNTRHID =T3.CHID group by(T3.CHID)");

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
               
                $cellRange = 'A1:AB1'; // All headers
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:AB1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:U1')
                                ->getFont()
                                ->setBold(true);
                $sheet->mergeCells('A2:AB2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:AB1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:AB2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:AB2')
                                ->getFont()
                                ->setBold(true);
                $sheet->mergeCells('A3:AB3');
                $sheet->setCellValue('A3', $compAddr[0]->ADD1);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:AB3')
                                ->getFont()
                                ->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:AB3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:AB4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:AB4')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
