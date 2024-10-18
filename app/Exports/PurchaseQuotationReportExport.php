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



class PurchaseQuotationReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    
    
    private $item_code;
    private $acct_code;
    private $plantCodeOperator;
    private $plantCodeValue;
    private $seriesCodeOperator;
    private $seriesCodeValue;
    private $profitCenterOperator;
    private $profitCenterValue;
    private $accCodeOperator;
    private $accCode;
    private $QtyOperator;
    private $QtyValue;
    private $from_date;
    private $to_date;
    private $ReportTypes;
    private $comp_code;
    private $macc_year;
    private $type;
    
   

    public function __construct($item_code,$acct_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type) 
    {

       

        $this->item_code            = $item_code;
        $this->acct_code            = $acct_code;
        $this->plantCodeOperator    = $plantCodeOperator;
        $this->plantCodeValue       = $plantCodeValue;
        $this->seriesCodeOperator   = $seriesCodeOperator;
        $this->seriesCodeValue      = $seriesCodeValue;
        $this->profitCenterOperator = $profitCenterOperator;
        $this->profitCenterValue    = $profitCenterValue;
        $this->accCodeOperator      = $accCodeOperator;
        $this->accCode              = $accCode;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->ReportTypes          = $ReportTypes;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->type                 = $type;
       
      
    }


    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

   
    public function headings():array{


         $strWhere = '';


            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeOperator)!="" && $this->seriesCodeOperator!='0'){
               
                $strWhere .= " AND  PQCS_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


            } 

            if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
               
                $strWhere .= " AND  PQCS_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                
            } 

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                
                $strWhere .= " AND  PQCS_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                
                $strWhere .= " AND  PQCS_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }

            if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                $strWhere .= " AND  PQCS_BODY.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
            }

            if(isset($this->acct_code) && trim($this->acct_code)!="" && $this->acct_code!='0'){
              
                $strWhere .= " AND  PQCS_HEAD.PQCSHID = '".$this->acct_code."'";

            }

            if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                
                $strWhere .= " AND  PQCS_BODY.ITEM_CODE = '".$this->item_code."'";
            }

            if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

                $ToDt = date("Y-m-d", strtotime($this->to_date));

                $FromDt = date("Y-m-d", strtotime($this->from_date));

                $strWhere .= " AND  PQCS_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
                  
                $strWhere .= " AND  PQCS_HEAD.COMP_CODE = '".$this->comp_code."' AND PQCS_HEAD.FY_CODE = '".$this->macc_year."'";

            }

            
            //DB::enableQueryLog();
 
            $QTN_BODY = DB::select("SELECT PQCS_HEAD.PQCSHID AS qcNo,PQCS_HEAD.RFQNO AS rfqNo,PQCS_HEAD.PQCSHID AS QcsHeadId,PQCS_BODY.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID WHERE 1=1 $strWhere");
        
            // dd(DB::getQueryLog());
        

            $getcount  =  count($QTN_BODY);

        for ($i=0; $i < $getcount; $i++) { 


               /* $purchaseTax1 =  DB::table('PQTN_TAX')->select('PQTN_TAX.*')->where('PQTNHID','=',$QTN_BODY[$i]->PQTNHID)->where('PQTNBID','=',$QTN_BODY[$i]->PQTNBID)->get()->toArray();*/
               if($this->type=='month'){

                $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PQTN_MONTH_VIEW';");

               }else{

                $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PQTN_TAX_VIEW';");

               }

                

                $count = count($purchaseTax);

                $taxIndName = array('VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','QTYRECVD','UM','AQTYRECD','AUM','LEVEL','STATUS','TAX_CODE');

                $taxIndName1 = array();
                for ($j=0; $j < $count; $j++) { 
                
                    $srno =$j +1;
                    if(isset($purchaseTax[$j]->COLUMN_NAME)){
                        array_push($taxIndName, $purchaseTax[$j]->COLUMN_NAME);
                    }
                    
                   
                }

                $columns = [    ['Fy_yr'],
                                ['ShowingReport'],
                                ['ForPeriod'],
                                ['ReportName'],
                                $taxIndName 
                            ];
            
                return $columns;
         

        }

        
    } 

  
    public function collection(){
      
        date_default_timezone_set('Asia/Kolkata');
                
        $strWhere = '';


       

        if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeOperator)!="" && $this->seriesCodeOperator!='0'){
           
            $strWhere .= " AND  PQCS_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


        } 

        if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
           
            $strWhere .= " AND  PQCS_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

            
        } 

        if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
            
            $strWhere .= " AND  PQCS_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
        }

        if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
            
            $strWhere .= " AND  PQCS_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
        }

        if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
            $strWhere .= " AND  PQCS_BODY.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";
        }

        if(isset($this->acct_code) && trim($this->acct_code)!="" && $this->acct_code!='0'){
          
            $strWhere .= " AND  PQCS_BODY.PQCSHID = '".$this->acct_code."'";

        }

        if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
            
            $strWhere .= " AND  PQCS_BODY.ITEM_CODE = '".$this->item_code."'";
        }

        if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

            $ToDt = date("Y-m-d", strtotime($this->to_date));

            $FromDt = date("Y-m-d", strtotime($this->from_date));

            $strWhere .= " AND  PQCS_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
        }

        if(isset($this->comp_code) && isset($this->macc_year)){
                  
            $strWhere .= " AND  PQCS_HEAD.COMP_CODE = '".$this->comp_code."' AND PQCS_HEAD.FY_CODE = '".$this->macc_year."'";

        }

        if($this->type=='month'){

            $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.LEVEL,CASE WHEN(PQCS_BODY.PCNTRHID = '0' AND PQCS_BODY.PCNTRBID = '0') THEN 'Pending' WHEN(PQCS_BODY.PCNTRHID != '0' AND PQCS_BODY.PCNTRBID != '0') THEN 'Complete' END AS 'All',PQCS_BODY.TAX_CODE,PQTN_MONTH_VIEW.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID LEFT JOIN PQTN_MONTH_VIEW ON PQCS_BODY.ACC_CODE = PQTN_MONTH_VIEW.ACC_CODE WHERE 1=1 $strWhere GROUP BY PQTN_MONTH_VIEW.ACC_CODE");
        }else{


        if($this->ReportTypes == 'pending'){

         $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.LEVEL,if(PQCS_BODY.PCNTRHID = '0' && PQCS_BODY.PCNTRBID = '0','Pending',' '),PQCS_BODY.TAX_CODE,PQTN_TAX_VIEW.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID LEFT JOIN PQTN_TAX_VIEW ON PQCS_BODY.PQTNBID = PQTN_TAX_VIEW.PQTNBID WHERE 1=1 $strWhere AND PQCS_BODY.PCNTRHID = '0' AND PQCS_BODY.PCNTRBID = '0'");

        }else if($this->ReportTypes == 'complete'){

            $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.LEVEL,if(PQCS_BODY.PCNTRHID != '0' && PQCS_BODY.PCNTRBID != '0','Complete',' '),PQCS_BODY.TAX_CODE,PQTN_TAX_VIEW.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID LEFT JOIN PQTN_TAX_VIEW ON PQCS_BODY.PQTNBID = PQTN_TAX_VIEW.PQTNBID WHERE 1=1 $strWhere AND PQCS_BODY.PCNTRHID != '0' AND PQCS_BODY.PCNTRBID != '0'");


        }else{


            $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.LEVEL,CASE WHEN(PQCS_BODY.PCNTRHID = '0' AND PQCS_BODY.PCNTRBID = '0') THEN 'Pending' WHEN(PQCS_BODY.PCNTRHID != '0' AND PQCS_BODY.PCNTRBID != '0') THEN 'Complete' END AS 'All',PQCS_BODY.TAX_CODE,PQTN_TAX_VIEW.* FROM PQCS_HEAD LEFT JOIN PQCS_BODY ON PQCS_HEAD.PQCSHID = PQCS_BODY.PQCSHID LEFT JOIN PQTN_TAX_VIEW ON PQCS_BODY.PQTNBID = PQTN_TAX_VIEW.PQTNBID WHERE 1=1 $strWhere GROUP BY PQCS_BODY.PQCSBID");

        }

    }

        $data = json_decode(json_encode($data1), true); 


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
                $reportName = '( Purchase Quotation )';
                $top = ($this->acct_code !='' && $this->acct_code != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' VR NO : '.$this->acct_code : (($this->item_code !='' && $this->item_code != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' ITEM : '.$this->item_code : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Profit Center : '.$this->profitCenterValue : (($this->accCode !='' && $this->accCode != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Party : '.$this->accCode : (($this->QtyValue !='' && $this->QtyValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Quality : '.$this->QtyOperator.' '.$this->QtyValue : ucfirst($this->ReportTypes).' - Item'))))));
                
                $reportType = 'Showing Report For - '.$top;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:X1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:X1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:X1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:X1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:X2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:X2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:X2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:X3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:X3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:X3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:X4';
                $sheet->mergeCells('A4:X4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:X4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:X4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:X5';
                $sheet->mergeCells('A5:X5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:X5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:X5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:X6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:X6')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
