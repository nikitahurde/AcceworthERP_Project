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

class PurchaseEnqueryReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
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
    private $accCodeOperator;
    private $accCodeValue;
    private $QtyOperator;
    private $QtyValue;
    private $comp_code;
    private $macc_year;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($from_date,$to_date,$vr_num,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$accCodeOperator,$accCodeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year) 
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
        $this->accCodeOperator      = $accCodeOperator;
        $this->accCodeValue         = $accCodeValue;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        
    }

    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

    public function headings():array{
        return[
            ['Fy_yr'],
            ['ShowingReport'],
            ['ForPeriod'],
            ['ReportName'],
            [
            'VRDATE','VRNO','TRAN_CODE','PLANT_CODE','SERIES_CODE','PFCT_CODE','ACC_CODE','ACC_NAME','ITEM_CODE','ITEM_NAME','QTYRECVD','UM','AQTYRECD','AUM','ICATG_CODE','IQUA_CHAR','IQUA_DESC','IQUA_UM','CHAR_FROMVALUE','CHAR_TOVALUE'
            ]
            
            ];
    }

    public function collection()
    {


        date_default_timezone_set('Asia/Kolkata');
                
            $strWhere = '';

            if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator != '0' && $this->plantCodeValue != '0'){
                   
                $strWhere .= " AND  PENQ_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
            } 

            
            if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator != '0' && $this->seriesCodeValue != '0'){
                
                $strWhere .= " AND  PENQ_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
            }

            if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator != '0' && $this->profitCenterValue != '0'){
                
                $strWhere .= " AND  PENQ_BODY.SERIES_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
            }

            if(isset($this->accCodeOperator)  && trim($this->accCodeValue)!="" && $this->accCodeOperator != '0' && $this->accCodeValue != '0'){
                $strWhere .= " AND  PENQ_BODY.ACC_CODE ".$this->accCodeOperator." '".$this->accCodeValue."'";
            }

            if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator != '0' && $this->QtyValue != '0'){
                $strWhere .= " AND  PENQ_BODY.QTYRECD ".$this->QtyOperator." '".$this->QtyValue."'";
            }


            if(isset($this->item_code) && trim($this->item_code)!="" && $this->item_code != '0'){
               
                $strWhere .= " AND  PENQ_BODY.ITEM_CODE = '".$this->item_code."'";
            }

            if(isset($this->vr_num) && trim($this->vr_num)!="" && $this->vr_num != '0'){
              
                $strWhere .= " AND  PENQ_HEAD.VRNO = '".$this->vr_num."'";

            }

            if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){

                $ToDt = date("Y-m-d", strtotime($this->to_date));

                $FromDt = date("Y-m-d", strtotime($this->from_date));

                $strWhere .= " AND  PENQ_BODY.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
            }

            if(isset($this->comp_code) && isset($this->macc_year)){
                  
                $strWhere .= " AND  PENQ_HEAD.COMP_CODE = '".$this->comp_code."' AND PENQ_HEAD.FY_CODE = '".$this->macc_year."'";

            }


            $data1 = DB::select("SELECT PENQ_HEAD.VRDATE,PENQ_HEAD.VRNO,PENQ_HEAD.TRAN_CODE,PENQ_HEAD.PLANT_CODE,PENQ_HEAD.SERIES_CODE,PENQ_BODY.PFCT_CODE,PENQ_VENDOR.ACC_CODE,PENQ_VENDOR.ACC_NAME,PENQ_BODY.ITEM_CODE,PENQ_BODY.ITEM_NAME,PENQ_BODY.QTYRECD,PENQ_BODY.UM,PENQ_BODY.AQTYRECD,PENQ_BODY.AUM,PENQ_QUA.ICATG_CODE,PENQ_QUA.IQUA_CHAR,PENQ_QUA.IQUA_DESC,PENQ_QUA.IQUA_UM,PENQ_QUA.CHAR_FROMVALUE,PENQ_QUA.CHAR_TOVALUE FROM PENQ_HEAD LEFT JOIN PENQ_BODY ON PENQ_HEAD.PENQHID = PENQ_BODY.PENQHID LEFT JOIN PENQ_VENDOR ON PENQ_HEAD.PENQHID = PENQ_VENDOR.PENQHID AND PENQ_BODY.PENQBID = PENQ_VENDOR.PENQBID LEFT JOIN PENQ_QUA ON PENQ_HEAD.PENQHID = PENQ_QUA.PENQHID AND PENQ_BODY.PENQBID = PENQ_QUA.PENQBID  WHERE 1=1 $strWhere");
           

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
                $reportName = '( Purchase Enquery )';
                $reportType = 'Showing Report For '.$this->seriesCodeValue;

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
