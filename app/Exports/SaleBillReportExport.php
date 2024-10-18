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



class SaleBillReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
    private $comp_code;
    private $macc_year;
    private $type;
    
   

    public function __construct($item_code,$vr_num,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$QtyOperator,$QtyValue,$from_date,$to_date,$comp_code,$macc_year,$type) 
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
                   
                    $strWhere .= " AND  SBILL_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SBILL_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SBILL_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SBILL_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SBILL_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SBILL_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SBILL_BODY.ITEM_CODE = '".$this->item_code."'";
                }

                 if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND SBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

         
      //DB::enableQueryLog();
 
            $QTN_BODY = DB::select("SELECT SBILL_HEAD.SBILLHID AS headId,SBILL_BODY.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID WHERE 1=1 $strWhere");
        
    // dd(DB::getQueryLog());
        /*$QTN_BODY =  DB::table('PQTN_BODY')->select('PQTN_BODY.*')->where('ITEM_CODE','=',$this->item_code)->get()->toArray();*/
            

            $getcount  =  count($QTN_BODY);

        for ($i=0; $i < $getcount; $i++) { 


               /*$purchaseTax =  DB::table('SBILL_TAX')->select('SBILL_TAX.*')->where('SBILLHID','=',$QTN_BODY[$i]->SBILLHID)->where('SBILLBID','=',$QTN_BODY[$i]->SBILLBID)->get()->toArray();


                $count = count($purchaseTax);*/

                if($this->type=='month'){

                     $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SALE_BILL_MONTH_VIEW';");

                }else{

                     $saleTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='SBILL_TAX_VIEW';");

                }

               

                $count = count($saleTax);


                $taxIndName = array('VRDATE','VRNO','TRAN CODE','SERIES CODE','PLANT CODE','PFCT CODE','ITEM_CODE','ITEM NAME','QTYISSUED','UM','AQTYISSUED','AUM','TAX_CODE');

                $tax_array=array();

                    for ($j=0; $j < $count; $j++) { 
                
                          //$taxIndName[] = $purchaseTax[$j]->TAXIND_NAME;
                        $srno =$j +1;
                        // array_push($tax_array, $saleTax[$j]->TAX_AMT);

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
                   
                    $strWhere .= " AND  SBILL_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


                } 

                if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
                   
                    $strWhere .= " AND  SBILL_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                    
                } 

                if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                    
                    $strWhere .= " AND  SBILL_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
                }

                if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                    
                    $strWhere .= " AND  SBILL_BODY.QTYISSUED ".$this->QtyOperator." '".$this->QtyValue."'";
                }

                if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                    $strWhere .= " AND  SBILL_HEAD.ACC_CODE ".$this->accCodeOperator." '$this->accCode'";
                }

                if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num!='0'){
                  
                    $strWhere .= " AND  SBILL_BODY.VRNO = '".$this->vr_num."'";

                }

                if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                    
                    $strWhere .= " AND  SBILL_BODY.ITEM_CODE = '".$this->item_code."'";
                }


                 if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SBILL_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND SBILL_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }


    if($this->type=='month'){

        $data1 = DB::select("SELECT SBILL_BODY.VRDATE,SBILL_BODY.VRNO,SBILL_BODY.TRAN_CODE,SBILL_BODY.SERIES_CODE,SBILL_BODY.PLANT_CODE,SBILL_BODY.PFCT_CODE,SBILL_BODY.ITEM_CODE,SBILL_BODY.ITEM_NAME,SBILL_BODY.QTYISSUED,SBILL_BODY.UM,SBILL_BODY.AQTYISSUED,SBILL_BODY.AUM,SBILL_BODY.TAX_CODE,SALE_BILL_MONTH_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SALE_BILL_MONTH_VIEW ON SALE_BILL_MONTH_VIEW.ACC_CODE = SBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY SALE_BILL_MONTH_VIEW.ACC_CODE");

    }else{

        $data1 = DB::select("SELECT SBILL_BODY.VRDATE,SBILL_BODY.VRNO,SBILL_BODY.TRAN_CODE,SBILL_BODY.SERIES_CODE,SBILL_BODY.PLANT_CODE,SBILL_BODY.PFCT_CODE,SBILL_BODY.ITEM_CODE,SBILL_BODY.ITEM_NAME,SBILL_BODY.QTYISSUED,SBILL_BODY.UM,SBILL_BODY.AQTYISSUED,SBILL_BODY.AUM,SBILL_BODY.TAX_CODE,SBILL_TAX_VIEW.* FROM SBILL_HEAD LEFT JOIN SBILL_BODY ON SBILL_HEAD.SBILLHID = SBILL_BODY.SBILLHID LEFT JOIN SBILL_TAX_VIEW ON SBILL_TAX_VIEW.SBILLBID = SBILL_BODY.SBILLBID WHERE 1=1 $strWhere GROUP BY SBILL_BODY.SBILLBID");

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

                if($this->type=='month'){
                 $reportName = '( Sale Bill Month Summary)';
                }else{
                 $reportName = '( Sale Bill )';
                }
                

                   

                $reportType = 'Showing Report For - '.$this->item_code;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:V1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:V1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:V1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:V1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:V2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:V2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:V2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:V3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:V3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:V3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:V4';
                $sheet->mergeCells('A4:V4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:V4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:V4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:V5';
                $sheet->mergeCells('A5:V5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:V5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:V5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:V6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:V6')
                                ->getFont()
                                ->setBold(true);


            },
        ];
        
    }
}
