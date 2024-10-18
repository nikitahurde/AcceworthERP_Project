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



class PurchaseMonthlyBillExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
                  
                  $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  PBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND PBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

         
      //DB::enableQueryLog();

         
                  $CNTR_BODY = DB::select("SELECT PBILL_HEAD.VRDATE,PBILL_HEAD.PFCT_CODE,PBILL_HEAD.PLANT_CODE,PBILL_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,PBILL_BODY.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN MASTER_ACC ON PBILL_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");

             
          
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
                            AND `TABLE_NAME`='PBILL_MONTH_VIEW';");

                    $taxIndName = array('ITEM_CODE');
                }else{

                     $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PBILL_TAX_VIEW';");

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

           

                if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  PBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND PBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


              if($this->code=='series code'){
                  //  DB::enableQueryLog();

                     $data = DB::select("SELECT  CONCAT(PBILL_BODY.SERIES_CODE,' - ',MASTER_CONFIG.SERIES_NAME) as SERIES_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN PBILL_TAX_VIEW ON PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_CONFIG ON MASTER_CONFIG.SERIES_CODE = PBILL_HEAD.SERIES_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.SERIES_CODE");

                     //dd(DB::getQueryLog());

                  }else if($this->code=='acc code' || $this->code=='acc item code'){
                    $data = DB::select("SELECT  CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");

                  }else if($this->code=='item code' || $this->code=='item code acc code'){

                    $data = DB::select("SELECT  CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_BODY.ITEM_CODE");

                  }else if($this->code=='month' || $this->code=='acc item code month' || $this->code=='item acc code month'){

                    $data = DB::select("SELECT  CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON    PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($this->code=='month' || $this->code=='item code month'){

                    $data = DB::select("SELECT CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($this->code=='month' || $this->code=='acc code month'){

                    $data = DB::select("SELECT CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,PBILL_MONTH_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN    PBILL_MONTH_VIEW ON    PBILL_MONTH_VIEW.ACC_CODE = PBILL_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.ACC_CODE");
                  }else if($this->code=='tax code'){

                    $data = DB::select("SELECT PBILL_BODY.TAX_CODE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,  PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN     PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_BODY.TAX_CODE");
                  }else if($this->code=='cost code'){

                    $data = DB::select("SELECT PBILL_HEAD.COST_CENTER,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE, PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN  PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.COST_CENTER");
                  }else if($this->code=='date'){

                    $data = DB::select("SELECT PBILL_HEAD.VRDATE,CONCAT(PBILL_HEAD.ACC_CODE,' - ',MASTER_ACC.ACC_NAME) as ACC_CODE,CONCAT(PBILL_BODY.ITEM_CODE,' - ',PBILL_BODY.ITEM_NAME) as ITEM_CODE,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN   PBILL_TAX_VIEW ON  PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PBILL_HEAD.VRDATE");
                  }

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
