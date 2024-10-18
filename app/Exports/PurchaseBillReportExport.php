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



class PurchaseBillReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
    private $comp_code;
    private $macc_year;
    

    public function __construct($from_date,$to_date,$vrn,$item_code,$seriesCodeOperator,$seriesCodeValue,$plantCodeOperator,$plantCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCode,$costCetOperator,$costCetCode,$QtyOperator,$QtyValue,$comp_code,$macc_year) 
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
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;

    }


    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

   
    public function headings():array{

        $strWhere = '';


            if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator!='0'){
               
                $strWhere .= " AND  PBILL_BODY.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
            } 


            if(isset($this->vrn)   && $this->vrn!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.VRNO = '".$this->vrn."'";
            }

            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
            }

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->accCodeOperator) && trim($this->accCode)!="" && $this->accCodeOperator!='0'){
              
                $strWhere .= " AND  PBILL_HEAD.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";

            }

            if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator!='0'){
                $strWhere .= " AND  PBILL_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }

            if(isset($this->item_code) && trim($this->item_code)!=""){
              
                $strWhere .= " AND  PBILL_BODY.ITEM_CODE = '".$this->item_code."'";

            }

            if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

                $ToDt = date("Y-m-d", strtotime($this->to_date));

                $FromDt = date("Y-m-d", strtotime($this->from_date));

                $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
              
                $strWhere .= " AND  PBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND PBILL_HEAD.FY_CODE = '".$this->macc_year."'";

            }

            //DB::enableQueryLog();
 
            $data = DB::select("SELECT PBILL_HEAD.PLANT_CODE AS PLANT_CODE,PBILL_HEAD.VRDATE,PBILL_HEAD.SERIES_CODE AS SERIES_CODE,PBILL_HEAD.PREFNO,PBILL_HEAD.PREFDATE,PBILL_HEAD.ACC_CODE AS ACC_CODE,PBILL_HEAD.PFCT_CODE AS PFCT_CODE,PBILL_BODY.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID WHERE 1=1 $strWhere");

        
            // dd(DB::getQueryLog());

            $getcount  =  count($data);

            for ($i=0; $i < $getcount; $i++) { 


               $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PBILL_TAX_VIEW';");

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
               
                $strWhere .= " AND  PBILL_BODY.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
            } 


            if(isset($this->vrn)   && $this->vrn!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.VRNO = '".$this->vrn."'";
            }

            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
            }

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator!='0'){
                
                $strWhere .= " AND  PBILL_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator!='0'){
                $strWhere .= " AND  PBILL_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }

            if(isset($this->accCodeOperator) && trim($this->accCode)!="" && $this->accCodeOperator!='0'){
              
                $strWhere .= " AND  PBILL_HEAD.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";

            }

            if(isset($this->item_code) && trim($this->item_code)!=""){
              
                $strWhere .= " AND  PBILL_BODY.ITEM_CODE = '".$this->item_code."'";

            }

            if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date) && $this->from_date!='0'){

                $ToDt = date("Y-m-d", strtotime($this->to_date));

                $FromDt = date("Y-m-d", strtotime($this->from_date));

                $strWhere .= " AND  PBILL_BODY.VRDATE BETWEEN '$FromDt' and  '$ToDt'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
              
                $strWhere .= " AND  PBILL_HEAD.COMP_CODE = '".$this->comp_code."' AND PBILL_HEAD.FY_CODE = '".$this->macc_year."'";

            }
        //DB::enableQueryLog();
     $data = DB::select("SELECT PBILL_HEAD.VRDATE,PBILL_HEAD.VRNO,PBILL_HEAD.TRAN_CODE,PBILL_HEAD.SERIES_CODE AS SERIES_CODE,PBILL_HEAD.PLANT_CODE AS PLANT_CODE,PBILL_HEAD.PFCT_CODE AS PFCT_CODE,PBILL_HEAD.ACC_CODE AS ACC_CODE,MASTER_ACC.ACC_NAME,PBILL_BODY.ITEM_CODE,PBILL_BODY.ITEM_NAME,PBILL_BODY.QTYRECD,PBILL_BODY.UM,PBILL_BODY.AQTYRECD,PBILL_BODY.AUM,PBILL_BODY.RATE,PBILL_BODY.BASICAMT,PBILL_TAX_VIEW.* FROM PBILL_HEAD LEFT JOIN PBILL_BODY ON PBILL_HEAD.PBILLHID = PBILL_BODY.PBILLHID LEFT JOIN PBILL_TAX_VIEW ON PBILL_TAX_VIEW.PBILLBID = PBILL_BODY.PBILLBID LEFT JOIN MASTER_ACC ON MASTER_ACC.ACC_CODE = PBILL_HEAD.ACC_CODE WHERE 1=1 $strWhere");
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
                $reportName = '( Purchase bill )';

                //$top = $this->vrn;


                $reportType = 'Showing Report For - '.$this->item_code;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:AK1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:AK1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:AK1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:AK1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:AK2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:AK2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:AK2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:AK3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:AK3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:AK3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:AK4';
                $sheet->mergeCells('A4:AK4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:AK4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:AK4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:AK5';
                $sheet->mergeCells('A5:AK5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:AK5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:AK5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:AK6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:AK6')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
