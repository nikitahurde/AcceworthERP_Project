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

class SaleEnqueryReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{


	private $from_date;
    private $to_date;
    private $vr_num;
    private $item_code;
    private $plantCodeOperator;
    private $plantCodeValue;
    private $seriesCodeOperator;
    private $seriesCodeValue;
    private $profitCenterOperator;
    private $profitCenterValue;
    private $QtyOperator;
    private $QtyValue;
    private $comp_code;
    private $macc_year;
    private $type;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$QtyOperator,$QtyValue,$comp_code,$macc_year,$type) 
    {
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->vr_num               = $vr_num;
        $this->item_code            = $item_code;
        $this->plantCodeOperator    = $plantCodeOperator;
        $this->plantCodeValue       = $plantCodeValue;
        $this->seriesCodeOperator   = $seriesCodeOperator;
        $this->seriesCodeValue      = $seriesCodeValue;
        $this->profitCenterOperator = $profitCenterOperator;
        $this->profitCenterValue    = $profitCenterValue;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->type                 = $type;
        
    }

    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

    public function headings():array{

                     $columns = [   ['Fy_yr'],
                                    ['ShowingReport'],
                                    ['ForPeriod'],
                                    ['ReportName'],
                                    ['VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','ORDERQTY','UM','ORDERAQTY','AUM','TAX_CODE','STATUS']
                               ];
            
                return $columns;
                  

        
    }

    public function collection()
    {


        date_default_timezone_set('Asia/Kolkata');
                
            $strWhere = '';

            if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator != '0' && $this->plantCodeValue != '0'){
                   
                $strWhere .= " AND  SENQ_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
            } 

            
            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator != '0' && $this->seriesCodeValue != '0'){
                
                $strWhere .= " AND  SENQ_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
            }

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator != '0' && $this->profitCenterValue != '0'){
                
                $strWhere .= " AND  SENQ_BODY.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }


            if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator != '0' && $this->QtyValue != '0'){
                $strWhere .= " AND  SENQ_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }


            if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code != '0'){
               
                $strWhere .= " AND  SENQ_BODY.ITEM_CODE = '".$this->item_code."'";
            }

            if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num != '0'){
              
                $strWhere .= " AND  SENQ_HEAD.VRNO = '".$this->vr_num."'";

            }

                  if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){
                  
                  $ToDt = date("Y-m-d", strtotime($this->to_date));
                  
                  $FromDt = date("Y-m-d", strtotime($this->from_date));
                  
                  $strWhere .= " AND  SENQ_BODY.VRDATE BETWEEN '".$FromDt."' AND  '".$ToDt."'";
                  }
                  
                  if(isset($this->comp_code) && isset($this->macc_year)){
                  
                  $strWhere .= " AND  SENQ_HEAD.COMP_CODE = '".$this->comp_code."' AND SENQ_HEAD.FY_CODE = '".$this->macc_year."'";
                  
                  }

       // DB::enableQueryLog();
            $data1 = DB::select("SELECT SENQ_HEAD.VRDATE,SENQ_HEAD.VRNO,SENQ_HEAD.TRAN_CODE,SENQ_HEAD.PLANT_CODE,SENQ_HEAD.SERIES_CODE,SENQ_BODY.PFCT_CODE,SENQ_VENDOR.ACC_CODE,SENQ_VENDOR.ACC_NAME,SENQ_BODY.ITEM_CODE,SENQ_BODY.ITEM_NAME,SENQ_BODY.QTYRECD,SENQ_BODY.UM,SENQ_BODY.AQTYRECD,SENQ_BODY.AUM,SENQ_QUA.ICATG_CODE,SENQ_QUA.IQUA_CHAR,SENQ_QUA.IQUA_DESC,SENQ_QUA.IQUA_UM,SENQ_QUA.CHAR_FROMVALUE,SENQ_QUA.CHAR_TOVALUE FROM SENQ_HEAD LEFT JOIN SENQ_BODY ON SENQ_HEAD.SENQHID = SENQ_BODY.SENQHID LEFT JOIN SENQ_VENDOR ON SENQ_HEAD.SENQHID = SENQ_VENDOR.SENQHID AND SENQ_BODY.SENQBID = SENQ_VENDOR.SENQBID LEFT JOIN SENQ_QUA ON SENQ_HEAD.SENQHID = SENQ_QUA.SENQHID AND SENQ_BODY.SENQBID = SENQ_QUA.SENQBID  WHERE 1=1 $strWhere");
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
                $reportName = '( Sales Enquery )';

                $top = ($this->vr_num !='' && $this->vr_num != '0') ? ucfirst($this->vr_num).' VR NO : '.$this->vr_num : (($this->item_code !='' && $this->item_code != '0' && $this->item_code !='') ? ucfirst($this->item_code).' ITEM : '.$this->item_code : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->plantCodeValue !='') ? ucfirst($this->plantCodeValue).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->seriesCodeValue !='') ? ucfirst($this->seriesCodeValue).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->profitCenterValue !='') ? ucfirst($this->profitCenterValue).' Profit Center : '.$this->profitCenterValue :  (($this->QtyValue !='' && $this->QtyValue != '0' && $this->QtyValue !='') ? ucfirst($this->QtyValue).' Quality' : '')))));


                $reportType = 'Showing Report For '. $top;

                $ToDt = date("d-m-Y", strtotime($this->to_date));
                $FromDt = date("d-m-Y", strtotime($this->from_date));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:T1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:T1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:T1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:T1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:T2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:T2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:T2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:T3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:T3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:T3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:T4';
                $sheet->mergeCells('A4:T4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:T4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:T4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:T5';
                $sheet->mergeCells('A5:T5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:T5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:T5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:T6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:T6')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
