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



class PurchaseOrderReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    private $from_date;
    private $to_date;
    private $vrn;
    private $item_code;
    private $seriesCodeOperator;
    private $seriesCodeValue;
    private $plantCodeOperator;
    private $plantCodeValue;
    private $profitCenterOperator;
    private $profitCenterValue;
    private $accCodeOperator;
    private $accCode;
    private $costCetOperator;
    private $costCetCode;
    private $QtyOperator;
    private $QtyValue;
    private $ReportTypes;
    private $comp_code;
    private $macc_year;
    private $type;
    

    public function __construct($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$ReportTypes,$comp_code,$macc_year,$type) 
    {
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->vrn                  = $vrn;
        $this->item_code            = $item_code;
        $this->seriesCodeOperator   = $seriesCodeOperator;
        $this->seriesCodeValue      = $seriesCodeValue;
        $this->plantCodeOperator    = $plantCodeOperator;
        $this->plantCodeValue       = $plantCodeValue;
        $this->profitCenterOperator = $profitCenterOperator;
        $this->profitCenterValue    = $profitCenterValue;
        $this->accCodeOperator      = $accCodeOperator;
        $this->accCode              = $accCode;
        $this->costCetOperator      = $costCetOperator;
        $this->costCetCode          = $costCetCode;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
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


            if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator!='0'){
               
                $strWhere .= " AND  PORDER_BODY.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
            } 


            if(isset($this->vr_num)  && trim($OrderVrno)!="" && $this->vr_num!='0'){
                
                $strWhere .= " AND  PORDER_HEAD.VRNO = '".$OrderVrno."'";
            }

            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator!='0'){
                
                $strWhere .= " AND  PORDER_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
            }

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator!='0'){
                
                $strWhere .= " AND  PORDER_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->item_code)  && trim($this->item_code)!="" && $this->item_code!='0'){
                $strWhere .= " AND  PORDER_BODY.ITEM_CODE = '".$this->item_code."'";
            }

            if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator!='0'){
                $strWhere .= " AND  PORDER_BODY.ORDERQTY ".$this->QtyOperator." '".$this->QtyValue."'";
            }


            if(isset($this->costCetOperator) && trim($this->costCetCode)!="" && $this->costCetOperator!='0'){
               
                $strWhere .= " AND  PORDER_HEAD.COST_CENTER ".$this->costCetOperator." '".$this->costCetCode."'";
            }

            if(isset($this->accCodeOperator) && trim($this->accCode)!="" && $this->accCodeOperator!='0'){
              
                $strWhere .= " AND  PORDER_HEAD.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";

            }

            if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

                $ToDt = date("Y-m-d", strtotime($this->to_date));

                $FromDt = date("Y-m-d", strtotime($this->from_date));

                $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
              
                $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND PORDER_HEAD.FY_CODE = '".$this->macc_year."'";

            }

            //DB::enableQueryLog();
 
            $data = DB::select("SELECT PORDER_BODY.PLANT_CODE AS PLANT_CODE,PORDER_HEAD.VRDATE,PORDER_HEAD.SERIES_CODE AS SERIES_CODE,PORDER_HEAD.PREFNO,PORDER_HEAD.PREFDATE,PORDER_HEAD.ACC_CODE AS ACC_CODE,PORDER_HEAD.PFCT_CODE AS PFCT_CODE,PORDER_BODY.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID WHERE 1=1 $strWhere");
        
            // dd(DB::getQueryLog());

            $getcount  =  count($data);

            for ($i=0; $i < $getcount; $i++) { 


                if($this->type=='month'){

                    $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PORDER_MONTH_VIEW';");
                }else{
                    $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PORDER_TAX_VIEW';");

                }

               

                $count = count($purchaseTax);


                $taxIndName = array('VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ACC_CODE','ACC_NAME','ITEM_CODE','ITEM_NAME','QTYRECVD','UM','AQTYRECD','AUM','STATUS','TAX_CODE');
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


        if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator!='0'){
               
            $strWhere .= " AND  PORDER_BODY.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
        } 


        if(isset($this->vr_num)  && trim($OrderVrno)!="" && $this->vr_num!='0'){
            
            $strWhere .= " AND  PORDER_HEAD.VRNO = '".$OrderVrno."'";
        }

        if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator!='0'){
            
            $strWhere .= " AND  PORDER_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
        }

        if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator!='0'){
            
            $strWhere .= " AND  PORDER_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
        }

        if(isset($this->item_code)  && trim($this->item_code)!="" && $this->item_code!='0'){
            $strWhere .= " AND  PORDER_BODY.ITEM_CODE = '".$this->item_code."'";
        }

        if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator!='0'){
            $strWhere .= " AND  PORDER_BODY.ORDERQTY ".$this->QtyOperator." '".$this->QtyValue."'";
        }


        if(isset($this->costCetOperator) && trim($this->costCetCode)!="" && $this->costCetOperator!='0'){
           
            $strWhere .= " AND  PORDER_HEAD.COST_CENTER ".$this->costCetOperator." '".$this->costCetCode."'";
        }

        if(isset($this->accCodeOperator) && trim($this->accCode)!="" && $this->accCodeOperator!='0'){
          
            $strWhere .= " AND  PORDER_HEAD.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";

        }

        if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

            $ToDt = date("Y-m-d", strtotime($this->to_date));

            $FromDt = date("Y-m-d", strtotime($this->from_date));

            $strWhere .= " AND  PORDER_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
        }

        if(isset($this->comp_code) && isset($this->macc_year)){
          
            $strWhere .= " AND  PORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND PORDER_HEAD.FY_CODE = '".$this->macc_year."'";

        }
        //DB::enableQueryLog();

        if($this->type=='month'){

           $data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.VRNO,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.SERIES_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,PORDER_BODY.ITEM_CODE,PORDER_BODY.ITEM_NAME,PORDER_BODY.QTYRECD,PORDER_BODY.UM,PORDER_BODY.AQTYRECD,PORDER_BODY.AUM,CASE WHEN(PORDER_BODY.GRNHID = '0' AND PORDER_BODY.GRNBID = '0') THEN 'Pending' WHEN(PORDER_BODY.GRNHID != '0' AND PORDER_BODY.GRNBID != '0') THEN 'Complete' END AS 'All',PORDER_BODY.TAX_CODE,PORDER_MONTH_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_MONTH_VIEW ON PORDER_MONTH_VIEW.ACC_CODE = PORDER_HEAD.ACC_CODE LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PORDER_MONTH_VIEW.ACC_CODE");

        }else{


        if($this->ReportTypes == 'pending'){

         $data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.VRNO,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.SERIES_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,PORDER_BODY.ITEM_CODE,PORDER_BODY.ITEM_NAME,PORDER_BODY.QTYRECD,PORDER_BODY.UM,PORDER_BODY.AQTYRECD,PORDER_BODY.AUM,if(PORDER_BODY.GRNHID = '0' && PORDER_BODY.GRNBID = '0','Pending',' '),PORDER_BODY.TAX_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_TAX_VIEW ON PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID = 0 AND PORDER_BODY.GRNBID = 0");


        }else if($this->ReportTypes == 'complete'){

            $data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.VRNO,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.SERIES_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,PORDER_BODY.ITEM_CODE,PORDER_BODY.ITEM_NAME,PORDER_BODY.QTYRECD,PORDER_BODY.UM,PORDER_BODY.AQTYRECD,PORDER_BODY.AUM,if(PORDER_BODY.GRNHID != '0' && PORDER_BODY.GRNBID != '0','Complete',' '),PORDER_BODY.TAX_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_TAX_VIEW ON PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere AND PORDER_BODY.GRNHID != 0 AND PORDER_BODY.GRNBID != 0");

        }else{

            $data = DB::select("SELECT PORDER_HEAD.VRDATE,PORDER_HEAD.VRNO,PORDER_HEAD.TRAN_CODE,PORDER_HEAD.SERIES_CODE,PORDER_HEAD.PLANT_CODE,PORDER_HEAD.PFCT_CODE,PORDER_HEAD.ACC_CODE,MASTER_ACC.ACC_NAME,PORDER_BODY.ITEM_CODE,PORDER_BODY.ITEM_NAME,PORDER_BODY.QTYRECD,PORDER_BODY.UM,PORDER_BODY.AQTYRECD,PORDER_BODY.AUM,if(PORDER_BODY.GRNHID != '0' && PORDER_BODY.GRNBID != '0','Complete',' '),PORDER_BODY.TAX_CODE,PORDER_TAX_VIEW.* FROM PORDER_HEAD LEFT JOIN PORDER_BODY ON PORDER_HEAD.PORDERHID = PORDER_BODY.PORDERHID LEFT JOIN PORDER_TAX_VIEW ON PORDER_TAX_VIEW.PORDERBID = PORDER_BODY.PORDERBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PORDER_HEAD.ACC_CODE WHERE 1=1 $strWhere");

        }


        }
        //dd(DB::getQueryLog());
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
                $reportName = '( Purchase Order )';

                $top = ($this->vrn !='' && $this->vrn != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' VR NO : '.$this->vrn : (($this->item_code !='' && $this->item_code != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' ITEM : '.$this->item_code : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Profit Center : '.$this->profitCenterValue : (($this->costCetCode !='' && $this->costCetCode != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Cost Center : '.$this->costCetCode : (($this->accCode !='' && $this->accCode != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Party : '.$this->accCode : (($this->QtyValue !='' && $this->QtyValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Quality : '.$this->QtyOperator.' '.$this->QtyValue : ucfirst($this->ReportTypes).' - Item')))))));


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
