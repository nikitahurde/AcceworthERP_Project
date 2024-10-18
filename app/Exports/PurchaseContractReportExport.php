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



class PurchaseContractReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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


            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeOperator)!="" && $this->seriesCodeOperator!='0'){
               
                $strWhere .= " AND  PCNTR_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


            } 

            if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
               
                $strWhere .= " AND  PCNTR_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

                
            } 

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
                
                $strWhere .= " AND  PCNTR_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
                
                $strWhere .= " AND  PCNTR_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }

            if(isset($this->costCetOperator)  && trim($this->costCetOperator)!="" && $this->costCetOperator!='0'){
                
                $strWhere .= " AND  PCNTR_BODY.COST_CENTER ".$this->costCetOperator." '".$this->costCetCode."'";
            }

            if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
                $strWhere .= " AND  PCNTR_BODY.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";
            }

            if(isset($this->vrn) && trim($this->vrn)!="" && $this->vrn!='0'){
              
                $strWhere .= " AND  PCNTR_HEAD.VRNO = '".$this->vrn."'";

            }

            if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
                
                $strWhere .= " AND  PCNTR_BODY.ITEM_CODE = '".$this->item_code."'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
                  
                $strWhere .= " AND  PCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND PCNTR_HEAD.FY_CODE = '".$this->macc_year."'";

            }
            //DB::enableQueryLog();
 
            $data = DB::select("SELECT PCNTR_HEAD.PLANT_CODE AS plantCode,PCNTR_HEAD.VRNO,PCNTR_HEAD.SERIES_CODE AS seriesCode,PCNTR_HEAD.PREFNO,PCNTR_HEAD.PREFDATE,PCNTR_HEAD.ACC_CODE AS accCode,PCNTR_HEAD.PFCT_CODE AS pfctCode,PCNTR_BODY.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID WHERE 1=1 $strWhere");
        
            // dd(DB::getQueryLog());

            $getcount  =  count($data);

            for ($i=0; $i < $getcount; $i++) { 


               /*$purchaseTax1 =  DB::table('PCNTR_TAX')->select('PCNTR_TAX.*')->where('PCNTRHID','=',$data[$i]->PCNTRHID)->where('PCNTRBID','=',$data[$i]->PCNTRBID)->get()->toArray();*/

               if($this->type=='month'){

                $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PCNTR_MONTH_VIEW';");

               }else{

                $purchaseTax = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='Biztech_ERP_DEV' 
                            AND `TABLE_NAME`='PCNTR_TAX_VIEW';");
               }

               

                $count = count($purchaseTax);


                $taxIndName = array('VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','QTYRECVD','UM','AQTYRECD','AUM','STATUS','TAX_CODE');
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
               
            $strWhere .= " AND  PCNTR_BODY.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";


        } 

        if(isset($this->plantCodeOperator)  && trim($this->plantCodeOperator)!="" && $this->plantCodeOperator!='0'){
           
            $strWhere .= " AND  PCNTR_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";

            
        } 

        if(isset($this->profitCenterOperator)  && trim($this->profitCenterOperator)!="" && $this->profitCenterOperator!='0'){
            
            $strWhere .= " AND  PCNTR_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
        }

        if(isset($this->QtyOperator)  && trim($this->QtyOperator)!="" && $this->QtyOperator!='0'){
            
            $strWhere .= " AND  PCNTR_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
        }

        if(isset($this->costCetOperator)  && trim($this->costCetOperator)!="" && $this->costCetOperator!='0'){
            
            $strWhere .= " AND  PCNTR_BODY.COST_CENTER ".$this->costCetOperator." '".$this->costCetCode."'";
        }

        if(isset($this->accCodeOperator)  && trim($this->accCodeOperator)!="" && $this->accCodeOperator!='0'){
            $strWhere .= " AND  PCNTR_BODY.ACC_CODE ".$this->accCodeOperator." '".$this->accCode."'";
        }

        if(isset($this->vrn) && trim($this->vrn)!="" && $this->vrn!='0'){
          
            $strWhere .= " AND  PCNTR_HEAD.VRNO = '".$this->vrn."'";

        }

        if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code!='0'){
            
            $strWhere .= " AND  PCNTR_BODY.ITEM_CODE = '".$this->item_code."'";
        }

        if(isset($this->comp_code) && isset($this->macc_year)){
              
            $strWhere .= " AND  PCNTR_HEAD.COMP_CODE = '".$this->comp_code."' AND PCNTR_HEAD.FY_CODE = '".$this->macc_year."'";

        }

        if($this->type=='month'){

            $data1 = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.VRNO,PCNTR_HEAD.TRAN_CODE,PCNTR_HEAD.SERIES_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.PFCT_CODE,PCNTR_BODY.ITEM_CODE,PCNTR_BODY.ITEM_NAME,PCNTR_BODY.QTYRECD,PCNTR_BODY.UM,PCNTR_BODY.AQTYRECD,PCNTR_BODY.AUM,CASE WHEN(PCNTR_BODY.PORDERHID = '0' AND PCNTR_BODY.PORDERBID = '0') THEN 'Pending' WHEN(PCNTR_BODY.PORDERHID != '0' AND PCNTR_BODY.PORDERBID != '0') THEN 'Complete' END AS 'All',PCNTR_BODY.TAX_CODE,PCNTR_MONTH_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_MONTH_VIEW ON PCNTR_MONTH_VIEW.ACC_CODE = PCNTR_HEAD.ACC_CODE WHERE 1=1 $strWhere GROUP BY PCNTR_MONTH_VIEW.ACC_CODE");

        }else{

        if($this->ReportTypes == 'pending'){
            
            //DB::enableQueryLog();

             $data1 = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.VRNO,PCNTR_HEAD.TRAN_CODE,PCNTR_HEAD.SERIES_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.PFCT_CODE,PCNTR_BODY.ITEM_CODE,PCNTR_BODY.ITEM_NAME,PCNTR_BODY.QTYRECD,PCNTR_BODY.UM,PCNTR_BODY.AQTYRECD,PCNTR_BODY.AUM,if(PCNTR_BODY.PORDERHID = '0' && PCNTR_BODY.PORDERBID = '0','Pending',' ') AS STATUS,PCNTR_BODY.TAX_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID = 0 AND PCNTR_BODY.PORDERBID = 0");

            //dd(DB::getQueryLog());
                    
            
       
        }else if($this->ReportTypes == 'complete'){

            $data1 = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.VRNO,PCNTR_HEAD.TRAN_CODE,PCNTR_HEAD.SERIES_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.PFCT_CODE,PCNTR_BODY.ITEM_CODE,PCNTR_BODY.ITEM_NAME,PCNTR_BODY.QTYRECD,PCNTR_BODY.UM,PCNTR_BODY.AQTYRECD,PCNTR_BODY.AUM,if(PCNTR_BODY.PORDERHID != '0' && PCNTR_BODY.PORDERBID != '0','Complete',' ') AS STATUS,PCNTR_BODY.TAX_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID WHERE 1=1 $strWhere AND PCNTR_BODY.PORDERHID != 0 AND PCNTR_BODY.PORDERBID != 0");

        }else{

            $data1 = DB::select("SELECT PCNTR_HEAD.VRDATE,PCNTR_HEAD.VRNO,PCNTR_HEAD.TRAN_CODE,PCNTR_HEAD.SERIES_CODE,PCNTR_HEAD.PLANT_CODE,PCNTR_HEAD.PFCT_CODE,PCNTR_BODY.ITEM_CODE,PCNTR_BODY.ITEM_NAME,PCNTR_BODY.QTYRECD,PCNTR_BODY.UM,PCNTR_BODY.AQTYRECD,PCNTR_BODY.AUM,CASE WHEN(PCNTR_BODY.PORDERHID = '0' AND PCNTR_BODY.PORDERBID = '0') THEN 'Pending' WHEN(PCNTR_BODY.PORDERHID != '0' AND PCNTR_BODY.PORDERBID != '0') THEN 'Complete' END AS 'All',PCNTR_BODY.TAX_CODE,PCNTR_TAX_VIEW.* FROM PCNTR_HEAD LEFT JOIN PCNTR_BODY ON PCNTR_HEAD.PCNTRHID = PCNTR_BODY.PCNTRHID LEFT JOIN PCNTR_TAX_VIEW ON PCNTR_TAX_VIEW.PCNTRBID = PCNTR_BODY.PCNTRBID WHERE 1=1 $strWhere");
        }
    }
        //dd(DB::getQueryLog());
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
                $reportName = '( Purchase Contract )';

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
