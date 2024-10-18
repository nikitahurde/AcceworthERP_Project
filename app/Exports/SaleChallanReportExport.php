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



class SaleChallanReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
                   
                    $strWhere .= " AND  SCHALLAN_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SCHALLAN_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SCHALLAN_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SCHALLAN_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.ITEM_CODE = '".$this->item_code."'";
                }


                if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SCHALLAN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SCHALLAN_HEAD.COMP_CODE = '".$this->comp_code."' AND SCHALLAN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

         
      //DB::enableQueryLog();
 
           /* $QTN_BODY = DB::select("SELECT SCHALLAN_HEAD.SCHALLANHID AS headId,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");*/


           if($this->type='month'){

            $QTN_BODY = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");

           }else{

            if($this->ReportTypes == 'pending'){

                     $QTN_BODY = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID = '0' AND SCHALLAN_BODY.SBILLBID = '0' ");



                }else if($this->ReportTypes == 'complete'){

                     $QTN_BODY = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLHID != '0' AND SCHALLAN_BODY.SBILLBID != '0'");


                }else{

                     $QTN_BODY = DB::select("SELECT SCHALLAN_HEAD.PLANT_CODE AS plantCode,SCHALLAN_HEAD.VRDATE,SCHALLAN_HEAD.SERIES_CODE  AS seriesCode,SCHALLAN_HEAD.PREFNO,SCHALLAN_HEAD.PREFDATE,SCHALLAN_HEAD.ACC_CODE AS accCode,SCHALLAN_HEAD.PFCT_CODE AS pfctCode,SCHALLAN_BODY.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID WHERE 1=1 $strWhere");


                }
        }
    // dd(DB::getQueryLog());
        /*$QTN_BODY =  DB::table('PQTN_BODY')->select('PQTN_BODY.*')->where('ITEM_CODE','=',$this->item_code)->get()->toArray();*/
            

            $getcount  =  count($QTN_BODY);

        for ($i=0; $i < $getcount; $i++) { 


               /*$purchaseTax =  DB::table('SCHALLAN_TAX')->select('SCHALLAN_TAX.*')->where('SCHALLANHID','=',$QTN_BODY[$i]->SCHALLANHID)->where('SCHALLANBID','=',$QTN_BODY[$i]->SCHALLANBID)->get()->toArray();


                $count = count($purchaseTax);*/

                if($this->type='month'){

                   $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SALE_CHALLAN_MONTH_VIEW';");

                }else{

                   $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SCHALLAN_TAX_VIEW';");

                }

                

                $count = count($saleTax);


                $taxIndName = array('VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','QTYISSUED','UM','AQTYISSUED','AUM','TAX_CODE','STATUS');

                 $tax_array=array();

                    for ($j=0; $j < $count; $j++) { 
                
                          //$taxIndName[] = $purchaseTax[$j]->TAXIND_NAME;
                        $srno =$j +1;
                       // array_push($tax_array, $purchaseTax[$j]->TAXIND_NAME);
                         if(isset($saleTax[$j]->COLUMN_NAME)){
                        array_push($taxIndName, $saleTax[$j]->COLUMN_NAME);
                    }
                       
                    }

                   /* $first = reset($tax_array);
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
                   
                    $strWhere .= " AND  SCHALLAN_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SCHALLAN_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SCHALLAN_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SCHALLAN_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SCHALLAN_BODY.ITEM_CODE = '".$this->item_code."'";
                }

                if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SCHALLAN_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SCHALLAN_HEAD.COMP_CODE = '".$this->comp_code."' AND SCHALLAN_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


       if($this->type='month'){

         $data1 = DB::select("SELECT SCHALLAN_BODY.VRDATE,SCHALLAN_BODY.VRNO,SCHALLAN_BODY.TRAN_CODE,SCHALLAN_BODY.SERIES_CODE,SCHALLAN_BODY.PLANT_CODE,SCHALLAN_BODY.PFCT_CODE,SCHALLAN_BODY.ITEM_CODE,SCHALLAN_BODY.ITEM_NAME,SCHALLAN_BODY.QTYISSUED,SCHALLAN_BODY.UM,SCHALLAN_BODY.AQTYISSUED,SCHALLAN_BODY.AUM,SCHALLAN_BODY.TAX_CODE,CASE WHEN(SCHALLAN_BODY.SBILLBID = '0' AND SCHALLAN_BODY.SBILLHID = '0') THEN 'Pending' WHEN(SCHALLAN_BODY.SBILLBID != '0' AND SCHALLAN_BODY.SBILLHID != '0') THEN 'Complete' END AS 'All',SALE_CHALLAN_MONTH_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SALE_CHALLAN_MONTH_VIEW ON SALE_CHALLAN_MONTH_VIEW.ACC_CODE = SCHALLAN_HEAD.ACC_CODE WHERE 1=1 $strWhere  GROUP BY SALE_CHALLAN_MONTH_VIEW.ACC_CODE");

       }else{


        if($this->ReportTypes == 'pending'){

            $data1 = DB::select("SELECT SCHALLAN_BODY.VRDATE,SCHALLAN_BODY.VRNO,SCHALLAN_BODY.TRAN_CODE,SCHALLAN_BODY.SERIES_CODE,SCHALLAN_BODY.PLANT_CODE,SCHALLAN_BODY.PFCT_CODE,SCHALLAN_BODY.ITEM_CODE,SCHALLAN_BODY.ITEM_NAME,SCHALLAN_BODY.QTYISSUED,SCHALLAN_BODY.UM,SCHALLAN_BODY.AQTYISSUED,SCHALLAN_BODY.AUM,SCHALLAN_BODY.TAX_CODE,if(SCHALLAN_BODY.SBILLBID = '0' && SCHALLAN_BODY.SBILLHID = '0','pending',' '),SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLBID = '0' AND SCHALLAN_BODY.SBILLHID = '0' GROUP BY SCHALLAN_BODY.SCHALLANBID");
            
        }else if($this->ReportTypes == 'complete'){

            $data1 = DB::select("SELECT SCHALLAN_BODY.VRDATE,SCHALLAN_BODY.VRNO,SCHALLAN_BODY.TRAN_CODE,SCHALLAN_BODY.SERIES_CODE,SCHALLAN_BODY.PLANT_CODE,SCHALLAN_BODY.PFCT_CODE,SCHALLAN_BODY.ITEM_CODE,SCHALLAN_BODY.ITEM_NAME,SCHALLAN_BODY.QTYISSUED,SCHALLAN_BODY.UM,SCHALLAN_BODY.AQTYISSUED,SCHALLAN_BODY.AUM,SCHALLAN_BODY.TAX_CODE,if(SCHALLAN_BODY.SBILLBID != '0' && SCHALLAN_BODY.SBILLHID != '0','complete',' '),SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID WHERE 1=1 $strWhere AND SCHALLAN_BODY.SBILLBID != '0' AND SCHALLAN_BODY.SBILLHID != '0' GROUP BY SCHALLAN_BODY.SCHALLANBID");
        }else{

            $data1 = DB::select("SELECT SCHALLAN_BODY.VRDATE,SCHALLAN_BODY.VRNO,SCHALLAN_BODY.TRAN_CODE,SCHALLAN_BODY.SERIES_CODE,SCHALLAN_BODY.PLANT_CODE,SCHALLAN_BODY.PFCT_CODE,SCHALLAN_BODY.ITEM_CODE,SCHALLAN_BODY.ITEM_NAME,SCHALLAN_BODY.QTYISSUED,SCHALLAN_BODY.UM,SCHALLAN_BODY.AQTYISSUED,SCHALLAN_BODY.AUM,SCHALLAN_BODY.TAX_CODE,CASE WHEN(SCHALLAN_BODY.SBILLBID = '0' AND SCHALLAN_BODY.SBILLHID = '0') THEN 'Pending' WHEN(SCHALLAN_BODY.SBILLBID != '0' AND SCHALLAN_BODY.SBILLHID != '0') THEN 'Complete' END AS 'All',SCHALLAN_TAX_VIEW.* FROM SCHALLAN_HEAD LEFT JOIN SCHALLAN_BODY ON SCHALLAN_HEAD.SCHALLANHID = SCHALLAN_BODY.SCHALLANHID LEFT JOIN SCHALLAN_TAX_VIEW ON SCHALLAN_TAX_VIEW.SCHALLANBID = SCHALLAN_BODY.SCHALLANBID WHERE 1=1 $strWhere  GROUP BY SCHALLAN_BODY.SCHALLANBID");
        }

    }

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
                  $reportName = '( Sale Challan Month Summary )';
                }else{
                  $reportName = '( Sale Challan )';

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
