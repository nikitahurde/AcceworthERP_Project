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



class DeliveryOrderPendingReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    private $from_date;
    private $to_date;
    private $vrn;
    private $do_no;
    private $cust_no;
    private $from_place;
    private $to_place;
    private $seriesCodeOperator;
    private $seriesCodeValue;
    private $plantCodeOperator;
    private $plantCodeValue;
    private $profitCenterOperator;
    private $profitCenterValue;
    private $QtyOperator;
    private $QtyValue;
    private $odcOperator;
    private $odcValue;
    private $ReportTypes;
    private $comp_code;
    private $macc_year;
    private $type;
    

    public function __construct($from_date,$to_date,$vrn,$do_no,$cust_no,$from_place,$to_place,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$odcOperator,$odcValue,$ReportTypes,$comp_code,$macc_year,$type) 
    {
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->vrn                  = $vrn;
        $this->do_no                = $do_no;
        $this->cust_no              = $cust_no;
        $this->from_place           = $from_place;
        $this->to_place             = $to_place;
        $this->seriesCodeOperator   = $seriesCodeOperator;
        $this->seriesCodeValue      = $seriesCodeValue;
        $this->plantCodeOperator    = $plantCodeOperator;
        $this->plantCodeValue       = $plantCodeValue;
        $this->profitCenterOperator = $profitCenterOperator;
        $this->profitCenterValue    = $profitCenterValue;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
        $this->odcOperator          = $odcOperator;
        $this->odcValue             = $odcValue;
        $this->ReportTypes          = $ReportTypes;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->type                 = $type;

    }


    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
       $db_name  = $request->session()->get('dbName');
      
    }

   
    public function headings():array{

        $strWhere = '';


        $colName = array('D.O.No','D.O.DATE','CUSTOMER CODE','CUSTOMER NAME','CONSINEE CODE','CONSINEE NAME','FROM PLACE','TO PLACE','ITEM CODE','ITEM NAME','ORDER QTY','DISPATCH QTY','CANCEL QTY','BALANCE QTY','STATUS');
            
        $columns = [    ['Fy_yr'],
                                ['ShowingReport'],
                                ['ForPeriod'],
                                ['ReportName'],
                                $colName 
                            ];
            
        return $columns;
           
    } 

  
    public function collection(){
      
        date_default_timezone_set('Asia/Kolkata');
                
        $strWhere = '';


        if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="0"){
                       
            $strWhere .= " AND  DORDER_BODY.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
        } 

        if(isset($this->vr_num)  && trim($this->vr_num)!="0"){
            
            $strWhere .= " AND  DORDER_HEAD.VRNO = '".$vr_num."'";
        }

        if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="0"){

            $strWhere .= " AND  DORDER_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
        }

        if(isset($this->cust_no) && trim($this->cust_no)!="0"){
                
            $strWhere .= " AND  DORDER_HEAD.ACC_CODE = '".$this->cust_no."' ";

        }

        if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="0"){
            
            $strWhere .= " AND  DORDER_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
        }

        if(isset($this->QtyOperator)  && trim($this->QtyValue)!="0"){
            $strWhere .= " AND  DORDER_BODY.QTY ".$this->QtyOperator." '".$this->QtyValue."'";
        }

        if(isset($this->odcOperator)  && trim($this->odcValue)!="0"){
            $strWhere .= " AND  DORDER_BODY.ODC ".$this->odcOperator." '".$this->odcValue."'";
        }

        if(isset($this->from_place)  && trim($this->from_place)!="0"){
            
            $strWhere .= " AND  DORDER_BODY.FROM_PLACE = '".$this->from_place."'";
        }

        if(isset($this->to_place)  && trim($this->to_place)!="0"){
            
            $strWhere .= " AND  DORDER_BODY.TO_PLACE = '".$this->to_place."'";
        }

        if(isset($this->to_date) && trim($this->to_date)!="0" && isset($this->from_date)){

            $ToDt = date("Y-m-d", strtotime($this->to_date));

            $FromDt = date("Y-m-d", strtotime($this->from_date));

            $strWhere .= " AND  DORDER_BODY.VRDATE BETWEEN '$FromDt' AND  '$ToDt' ";
        }
        

        if(isset($this->comp_code) && isset($this->macc_year)){
              
                $strWhere .= " AND  DORDER_HEAD.COMP_CODE = '".$this->comp_code."' AND DORDER_HEAD.FY_CODE = '".$this->macc_year."'";

        }

        if(isset($this->do_no) && trim($this->do_no)!="0"){
              
                $strWhere .= " AND  DORDER_BODY.DORDER_NO = '".$this->do_no."' ";

        }
        //DB::enableQueryLog();

        


        if($this->ReportTypes == 'pending'){

            // DB::enableQueryLog();

           $data = DB::select("SELECT DORDER_BODY.DORDER_NO,DORDER_BODY.DORDER_DATE,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_BODY.CP_CODE,DORDER_BODY.CP_NAME,DORDER_BODY.FROM_PLACE,DORDER_BODY.TO_PLACE,DORDER_BODY.ITEM_CODE,DORDER_BODY.ITEM_NAME,DORDER_BODY.QTY,DORDER_BODY.DISPATCH_PLAN_QTY,DORDER_BODY.CANCEL_QTY,(DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY) AS BALANCE_QTY,'PENDING' AS STATUS FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere AND DORDER_HEAD.DO_STATUS = 0 " );
           // dd(DB::getQueryLog());


        }else if($this->ReportTypes == 'complete'){

            $data = DB::select("SELECT DORDER_BODY.DORDER_NO,DORDER_BODY.DORDER_DATE,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_BODY.CP_CODE,DORDER_BODY.CP_NAME,DORDER_BODY.FROM_PLACE,DORDER_BODY.TO_PLACE,DORDER_BODY.ITEM_CODE,DORDER_BODY.ITEM_NAME,DORDER_BODY.QTY,DORDER_BODY.DISPATCH_PLAN_QTY,DORDER_BODY.CANCEL_QTY,(DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY) AS BALANCE_QTY,'COMPLETE' AS STATUS FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere AND DORDER_HEAD.DO_STATUS = 1" );

        }else{

            $data = DB::select("SELECT DORDER_BODY.DORDER_NO,DORDER_BODY.DORDER_DATE,DORDER_HEAD.ACC_CODE AS ACC_CODE,DORDER_HEAD.ACC_NAME AS ACC_NAME,DORDER_BODY.CP_CODE,DORDER_BODY.CP_NAME,DORDER_BODY.FROM_PLACE,DORDER_BODY.TO_PLACE,DORDER_BODY.ITEM_CODE,DORDER_BODY.ITEM_NAME,DORDER_BODY.QTY,DORDER_BODY.DISPATCH_PLAN_QTY,DORDER_BODY.CANCEL_QTY,(DORDER_BODY.QTY-DORDER_BODY.DISPATCH_PLAN_QTY-DORDER_BODY.CANCEL_QTY) AS BALANCE_QTY,'ALL' AS STATUS FROM DORDER_HEAD LEFT JOIN DORDER_BODY ON DORDER_HEAD.DORDERHID = DORDER_BODY.DORDERHID  WHERE 1=1 $strWhere" );

        }


        // }
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
                $reportName = '( Delivery Order )';

                $top = ($this->vrn !='' && $this->vrn != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' VR NO : '.$this->vrn : (($this->do_no !='' && $this->do_no != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Delivery Order : '.$this->do_no : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Profit Center : '.$this->profitCenterValue : (($this->from_place !='' && $this->from_place != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).'From Place : '.$this->from_place : (($this->cust_no !='' && $this->cust_no != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Party : '.$this->cust_no : (($this->odcValue !='' && $this->odcValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' ODV Value : '.$this->odcValue : (($this->from_place !='' && $this->from_place != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' From Place : '.$this->from_place : (($this->to_place !='' && $this->to_place != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).'To Place : '.$this->to_place : (($this->QtyValue !='' && $this->QtyValue != '0' && $this->ReportTypes !='') ? ucfirst($this->ReportTypes).' Quatity : '.$this->QtyOperator.' '.$this->QtyValue : ucfirst($this->ReportTypes).' - D.O'))))))))));


                $reportType = 'Showing Report For -  '.$top;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:M1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:M1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:M1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:M1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:M2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:M2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:M2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:M3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:M3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:M3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:M4';
                $sheet->mergeCells('A4:M4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:M4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:M4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:M5';
                $sheet->mergeCells('A5:M5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:M5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:M5')
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
