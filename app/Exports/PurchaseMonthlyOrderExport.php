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
use Excel;



class PurchaseMonthlyOrderExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    

    private $from_date;
    private $to_date;
    private $comp_code;
    private $macc_year;
    private $code;
    
   

    public function __construct($from_date,$to_date,$comp_code,$macc_year,$code) 
    {

       
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->code                 = $code;
      
    }


    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

   
    public function headings():array{


         $strWhere = '';



                 if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND PORDER_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

         
      //DB::enableQueryLog();

         
                  $CNTR_BODY = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN MASTER_ACC ON PORDER_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");

             
          
            /*$QTN_BODY = DB::select("SELECT SQTN_HEAD.SQTNHID AS headId,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1 $strWhere");*/
        
    // dd(DB::getQueryLog());
       // print_r($QTN_BODY);exit;
            

            $getcount  =  count($CNTR_BODY);

        for ($i=0; $i < $getcount; $i++) { 


              /*  $purchaseTax =  DB::table('SQTN_TAX')->select('SQTN_TAX.*')->where('SQTNHID','=',$QTN_BODY[$i]->SQTNHID)->where('SQTNBID','=',$QTN_BODY[$i]->SQTNBID)->get()->toArray();
                
                
                $count = count($purchaseTax);*/

                if($this->code=='month' || $this->code=='item code month' || $this->code=='acc code month' || $this->code=='acc item code month' || $this->code=='item acc code month'){

                    $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PORDER_MONTH_VIEW';");

                    $taxIndName = array('ITEM_CODE');
                }else{

                     $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PORDER_TAX_VIEW';");

                     if($this->code=='series code'){


                        $taxIndName = array('SERIES_CODE','ACC_CODE','ITEM_CODE');

                     }else if($this->code=='acc code' || $this->code=='acc item code'){

                        $taxIndName = array('ACC_CODE','ITEM_CODE');

                     }else if($this->code=='acc code' || $this->code=='acc item code'){

                        $taxIndName = array('ACC_CODE');

                     }else if($this->code=='item code' && $this->code=='item code acc code'){

                        $taxIndName = array('ITEM_CODE','ACC_CODE');

                     }else if( $this->code=='cost code'){

                        $taxIndName = array('COST_CODE','ACC_CODE','ITEM_CODE');
                     }else if($this->code=='tax code'){

                        $taxIndName = array('TAX_CODE','ACC_CODE','ITEM_CODE');
                     }else if($this->code=='date'){

                        $taxIndName = array('VRDATE','ACC_CODE','ITEM_CODE');
                     }

                    
                   
                }

                

               

                $count = count($saleTax);



                

                  

                    for ($j=0; $j < $count; $j++) { 
                
                          //$taxIndName[] = $purchaseTax[$j]->TAXIND_NAME;
                        $srno =$j +1;
                        //array_push($tax_array, $saleTax[$j]->TAXIND_NAME);

                        if(isset($saleTax[$j]->COLUMN_NAME)){
                        array_push($taxIndName, $saleTax[$j]->COLUMN_NAME);
                    }
                       
                    }

                  /*  $first = reset($tax_array);
                    $end = end($tax_array);

                    array_push($taxIndName,$first);
                    array_push($taxIndName,$end);*/

                     $columns = [   ['Fy_yr'],
                                    ['ShowingReport'],
                                    ['ForPeriod'],
                                    ['ReportName'],
                                    $taxIndName 
                               ];
            
                return $columns;
              

        }

        
    } 

  
    public function collection()
    {
      
        date_default_timezone_set('Asia/Kolkata');
                
        $strWhere = '';

            /*
                if(isset($this->acc_code) && trim($this->acc_code)!="" && $this->acc_code!='0'){
                  
                    $strWhere .= " AND  SQTN_HEAD.ACC_CODE = '".$this->acc_code."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SQTN_BODY.ITEM_CODE = '".$this->item_code."'";
                }*/


                if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND PORDER_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


               if($this->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(PORDER_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_TAX_VIEW ON PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PORDER_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($this->code=='acc code' || $this->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");

                  }else if($this->code=='item code' || $this->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_BODY.ITEM_CODE");

                  }else if($this->code=='month' || $this->code=='acc item code month' || $this->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON    PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($this->code=='month' || $this->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,  PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($this->code=='month' || $this->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN    PORDER_MONTH_VIEW ON    PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.ACC_CODE");
                  }else if($this->code=='tax code'){

                    $data = DB::select("SELECT PORDER_BODY.TAX_CODE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,  PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN     PORDER_TAX_VIEW ON  PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_BODY.TAX_CODE");
                  }else if($this->code=='cost code'){

                    $data = DB::select("SELECT PORDER_HEAD.COST_CENTER,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,   PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN  PORDER_TAX_VIEW ON   PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.COST_CENTER");
                  }else if($this->code=='date'){

                    $data = DB::select("SELECT PORDER_HEAD.VRDATE,CONCAT(PORDER_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PORDER_BODY.ITEM_CODE,' - ',PORDER_BODY.ITEM_NAME) as ITEM_CODE,    PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN   PORDER_TAX_VIEW ON   PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_HEAD.VRDATE");
                  }

   //  dd(DB::getQueryLog());
      /* $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.TAX_CODE,PURCHASE_EXCEL_TEMP.COLUMN1,PURCHASE_EXCEL_TEMP.COLUMN2,PURCHASE_EXCEL_TEMP.COLUMN3,PURCHASE_EXCEL_TEMP.COLUMN4,PURCHASE_EXCEL_TEMP.COLUMN5,PURCHASE_EXCEL_TEMP.COLUMN6,PURCHASE_EXCEL_TEMP.COLUMN7,PURCHASE_EXCEL_TEMP.COLUMN8,PURCHASE_EXCEL_TEMP.COLUMN9,PURCHASE_EXCEL_TEMP.COLUMN10,PURCHASE_EXCEL_TEMP.COLUMN11,PURCHASE_EXCEL_TEMP.COLUMN12 FROM PQCS_BODY LEFT JOIN PURCHASE_EXCEL_TEMP ON PQCS_BODY.ITEM_CODE = PURCHASE_EXCEL_TEMP.ITEM_CODE  WHERE 1=1 $strWhere");

*/

        $data = json_decode(json_encode($data), true); 


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

                $reportName = '( Sale Order Month Summary)';
                
                

               

                $reportType = 'Showing Report For - '.$this->code;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:P1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:P1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:P1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:P1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:P2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:P2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:P2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:P3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:P3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:P3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:P4';
                $sheet->mergeCells('A4:P4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:P4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:P4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:P5';
                $sheet->mergeCells('A5:P5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:P5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:P5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:P6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:P6')
                                ->getFont()
                                ->setBold(true);


            },
        ];
        
    }
}
