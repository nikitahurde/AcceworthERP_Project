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



class SaleQuotationReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    
    
    private $item_code;
    private $vr_num;
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
    
   

    public function __construct($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$ReportTypes,$comp_code,$macc_year,$type) 
    {

       

        $this->item_code            = $item_code;
        $this->vr_num               = $vr_num;
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
                   
                    $strWhere .= " AND  SQTN_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SQTN_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SQTN_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SQTN_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SQTN_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SQTN_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SQTN_BODY.ITEM_CODE = '".$this->item_code."'";
                }

                 if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SQTN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SQTN_HEAD.COMP_CODE = '".$this->comp_code."' AND SQTN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

         
      //DB::enableQueryLog();

                if($this->type=='month'){

                  $QTN_BODY = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");

                }else{

                  if($this->ReportTypes == 'pending'){

                      $QTN_BODY = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID = '0' AND SQTN_BODY.SCNTRBID = '0'");



                  }else if($this->ReportTypes == 'complete'){

                      $QTN_BODY = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID != '0' AND SQTN_BODY.SCNTRBID != '0'");
                     


                  }else{

                      $QTN_BODY = DB::select("SELECT SQTN_HEAD.VRDATE,SQTN_HEAD.PFCT_CODE,SQTN_HEAD.PLANT_CODE,SQTN_HEAD.TRAN_CODE,MASTER_ACC.ACC_NAME AS ACC_NAME,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN MASTER_ACC ON SQTN_HEAD.ACC_CODE = MASTER_ACC.ACC_CODE WHERE 1=1 $strWhere");

                       
                  }
                  
                }
            /*$QTN_BODY = DB::select("SELECT SQTN_HEAD.SQTNHID AS headId,SQTN_BODY.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID WHERE 1=1 $strWhere");*/
        
   //  dd(DB::getQueryLog());
        //print_r($QTN_BODY);exit;
            

            $getcount  =  count($QTN_BODY);

        for ($i=0; $i < $getcount; $i++) { 


              /*  $purchaseTax =  DB::table('SQTN_TAX')->select('SQTN_TAX.*')->where('SQTNHID','=',$QTN_BODY[$i]->SQTNHID)->where('SQTNBID','=',$QTN_BODY[$i]->SQTNBID)->get()->toArray();
                
                
                $count = count($purchaseTax);*/

                if($this->type=='month'){

                  $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SALES_QTN_MONTH_VIEW';");

                }else{

                   $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SQTN_TAX_VIEW';");
                }

               

                $count = count($saleTax);



                $taxIndName = array('VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','QTYISSUED','UM','AQTYISSUED','AUM','TAX_CODE','STATUS');

                  

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


       

     if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeOperator)!="" && $this->seriesCodeOperator!='0'){
                   
                    $strWhere .= " AND  SQTN_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SQTN_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SQTN_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SQTN_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SQTN_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SQTN_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SQTN_BODY.ITEM_CODE = '".$this->item_code."'";
                }


                if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SQTN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SQTN_HEAD.COMP_CODE = '".$this->comp_code."' AND SQTN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

//DB::enableQueryLog();

               /* $data1 = DB::select("SELECT SQTN_BODY.VRDATE,SQTN_BODY.VRNO,SQTN_BODY.TRAN_CODE,SQTN_BODY.SERIES_CODE,SQTN_BODY.PLANT_CODE,SQTN_BODY.PFCT_CODE,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME,SQTN_BODY.QTYISSUED,SQTN_BODY.UM,SQTN_BODY.AQTYISSUED,SQTN_BODY.AUM,SQTN_BODY.TAX_CODE,if(SQTN_BODY.SCNTRBID = '0','pending','completed') as STATUS,PURCHASE_EXCEL_TEMP.COLUMN1,PURCHASE_EXCEL_TEMP.COLUMN2,PURCHASE_EXCEL_TEMP.COLUMN3,PURCHASE_EXCEL_TEMP.COLUMN4,PURCHASE_EXCEL_TEMP.COLUMN5,PURCHASE_EXCEL_TEMP.COLUMN6,PURCHASE_EXCEL_TEMP.COLUMN7,PURCHASE_EXCEL_TEMP.COLUMN8,PURCHASE_EXCEL_TEMP.COLUMN9,PURCHASE_EXCEL_TEMP.COLUMN10,PURCHASE_EXCEL_TEMP.COLUMN11,PURCHASE_EXCEL_TEMP.COLUMN12 FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN PURCHASE_EXCEL_TEMP ON SQTN_BODY.ITEM_CODE = PURCHASE_EXCEL_TEMP.ITEM_CODE WHERE 1=1 $strWhere AND PURCHASE_EXCEL_TEMP.FLAG='SQ' GROUP BY SQTN_BODY.SQTNBID");*/
//DB::enableQueryLog();

  if($this->type=='month'){

     $data1 = DB::select("SELECT SQTN_BODY.VRDATE,SQTN_BODY.VRNO,SQTN_BODY.TRAN_CODE,SQTN_BODY.SERIES_CODE,SQTN_BODY.PLANT_CODE,SQTN_BODY.PFCT_CODE,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME,SQTN_BODY.QTYISSUED,SQTN_BODY.UM,SQTN_BODY.AQTYISSUED,SQTN_BODY.AUM,SQTN_BODY.TAX_CODE,CASE WHEN(SQTN_BODY.SCNTRBID = '0' AND SQTN_BODY.SCNTRHID = '0') THEN 'Pending' WHEN(SQTN_BODY.SCNTRBID != '0' AND SQTN_BODY.SCNTRHID != '0') THEN 'Complete' END AS 'All', SALES_QTN_MONTH_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SALES_QTN_MONTH_VIEW ON SALES_QTN_MONTH_VIEW.ACC_CODE = SQTN_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALES_QTN_MONTH_VIEW.ACC_CODE");
     

   }else{


    if($this->ReportTypes == 'pending'){
     
     $data1 = DB::select("SELECT SQTN_BODY.VRDATE,SQTN_BODY.VRNO,SQTN_BODY.TRAN_CODE,SQTN_BODY.SERIES_CODE,SQTN_BODY.PLANT_CODE,SQTN_BODY.PFCT_CODE,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME,SQTN_BODY.QTYISSUED,SQTN_BODY.UM,SQTN_BODY.AQTYISSUED,SQTN_BODY.AUM,SQTN_BODY.TAX_CODE,if(SQTN_BODY.SCNTRBID = '0','pending','completed') as STATUS,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID WHERE 1=1 $strWhere AND SQTN_BODY.SCNTRHID = 0 AND SQTN_BODY.SCNTRBID = 0 GROUP BY SQTN_BODY.SQTNBID");
     
     }else if($this->ReportTypes == 'complete'){
     
     $data1 = DB::select("SELECT SQTN_BODY.VRDATE,SQTN_BODY.VRNO,SQTN_BODY.TRAN_CODE,SQTN_BODY.SERIES_CODE,SQTN_BODY.PLANT_CODE,SQTN_BODY.PFCT_CODE,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME,SQTN_BODY.QTYISSUED,SQTN_BODY.UM,SQTN_BODY.AQTYISSUED,SQTN_BODY.AUM,SQTN_BODY.TAX_CODE,if(SQTN_BODY.SCNTRBID != '0','completed','pending') as STATUS,SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID WHERE 1=1 $strWhere GROUP BY SQTN_BODY.SQTNBID");
     }else{
     $data1 = DB::select("SELECT SQTN_BODY.VRDATE,SQTN_BODY.VRNO,SQTN_BODY.TRAN_CODE,SQTN_BODY.SERIES_CODE,SQTN_BODY.PLANT_CODE,SQTN_BODY.PFCT_CODE,SQTN_BODY.ITEM_CODE,SQTN_BODY.ITEM_NAME,SQTN_BODY.QTYISSUED,SQTN_BODY.UM,SQTN_BODY.AQTYISSUED,SQTN_BODY.AUM,SQTN_BODY.TAX_CODE,CASE WHEN(SQTN_BODY.SCNTRBID = '0' AND SQTN_BODY.SCNTRHID = '0') THEN 'Pending' WHEN(SQTN_BODY.SCNTRBID != '0' AND SQTN_BODY.SCNTRHID != '0') THEN 'Complete' END AS 'All', SQTN_TAX_VIEW.* FROM SQTN_HEAD LEFT JOIN SQTN_BODY ON SQTN_HEAD.SQTNHID = SQTN_BODY.SQTNHID LEFT JOIN SQTN_TAX_VIEW ON SQTN_TAX_VIEW.SQTNBID = SQTN_BODY.SQTNBID WHERE 1=1 $strWhere GROUP BY SQTN_BODY.SQTNBID");
     }


   }

   //  dd(DB::getQueryLog());
      /* $data1 = DB::select("SELECT PQCS_BODY.VRDATE,PQCS_BODY.VRNO,PQCS_BODY.TRAN_CODE,PQCS_BODY.SERIES_CODE,PQCS_BODY.PLANT_CODE,PQCS_BODY.PFCT_CODE,PQCS_BODY.ITEM_CODE,PQCS_BODY.ITEM_NAME,PQCS_BODY.QTYRECD,PQCS_BODY.UM,PQCS_BODY.AQTYRECD,PQCS_BODY.AUM,PQCS_BODY.TAX_CODE,PURCHASE_EXCEL_TEMP.COLUMN1,PURCHASE_EXCEL_TEMP.COLUMN2,PURCHASE_EXCEL_TEMP.COLUMN3,PURCHASE_EXCEL_TEMP.COLUMN4,PURCHASE_EXCEL_TEMP.COLUMN5,PURCHASE_EXCEL_TEMP.COLUMN6,PURCHASE_EXCEL_TEMP.COLUMN7,PURCHASE_EXCEL_TEMP.COLUMN8,PURCHASE_EXCEL_TEMP.COLUMN9,PURCHASE_EXCEL_TEMP.COLUMN10,PURCHASE_EXCEL_TEMP.COLUMN11,PURCHASE_EXCEL_TEMP.COLUMN12 FROM PQCS_BODY LEFT JOIN PURCHASE_EXCEL_TEMP ON PQCS_BODY.ITEM_CODE = PURCHASE_EXCEL_TEMP.ITEM_CODE  WHERE 1=1 $strWhere");

*/

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

                if($this->type='month'){
                  $reportName = '( Sale Quotation Month Summary)';
                }else{
                  $reportName = '( Sale Quotation )';
                }
                

                $top = ($this->vr_num !='' && $this->vr_num != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' VR NO : '.$this->vr_num : (($this->item_code !='' && $this->item_code != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' ITEM : '.$this->item_code : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Profit Center : '.$this->profitCenterValue : (($this->accCode !='' && $this->accCode != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Account : '.$this->accCode :  (($this->QtyValue !='' && $this->QtyValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Quality' : ''))))));

                $reportType = 'Showing Report For - '.$top;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:W1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:W1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:W1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:W1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:W2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:W2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:W2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:W3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:W3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:W3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:W4';
                $sheet->mergeCells('A4:W4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:W4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:W4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:W5';
                $sheet->mergeCells('A5:W5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:W5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:W5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:W6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:W6')
                                ->getFont()
                                ->setBold(true);


            },
        ];
        
    }
}
