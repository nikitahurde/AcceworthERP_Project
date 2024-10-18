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



class PurchaseIndentReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $vr_num;
    private $from_date;
    private $to_date;
    private $item_code;
    private $plantCodeOperator;
    private $plantCodeValue;
    private $seriesCodeOperator;
    private $seriesCodeValue;
    private $profitCenterOperator;
    private $profitCenterValue;
    private $departmentOperator;
    private $departmentValue;
    private $employeeOperator;
    private $employeeValue;
    private $QtyOperator;
    private $QtyValue;
    private $comp_code;
    private $macc_year;
    private $reportTypes;

    public function __construct($vr_num,$from_date,$to_date,$item_code,$plantCodeOperator,$plantCodeValue,$seriesCodeOperator,$seriesCodeValue,$profitCenterOperator,$profitCenterValue,$departmentOperator,$departmentValue,$employeeOperator,$employeeValue,$QtyOperator,$QtyValue,$comp_code,$macc_year,$reportTypes) 
    {
        $this->vr_num               = $vr_num;
        $this->item_code            = $item_code;
        $this->from_date            = $from_date;
        $this->to_date              = $to_date;
        $this->plantCodeOperator    = $plantCodeOperator;
        $this->plantCodeValue       = $plantCodeValue;
        $this->seriesCodeOperator   = $seriesCodeOperator;
        $this->seriesCodeValue      = $seriesCodeValue;
        $this->profitCenterOperator = $profitCenterOperator;
        $this->profitCenterValue    = $profitCenterValue;
        $this->departmentOperator   = $departmentOperator;
        $this->departmentValue      = $departmentValue;
        $this->employeeOperator     = $employeeOperator;
        $this->employeeValue        = $employeeValue;
        $this->QtyOperator          = $QtyOperator;
        $this->QtyValue             = $QtyValue;
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->reportTypes          = $reportTypes;
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
            'VRDATE','VRNO','TRAN_CODE','SERIES_CODE','PLANT_CODE','DEPT_CODE','EMP_CODE','PFCT_CODE','ITEM_CODE','ITEM_NAME','QTYRECVD','UM','AQTYRECD','AUM','ICATG_CODE','IQUA_CHAR','IQUA_DESC','IQUA_UM','CHAR_FROMVALUE','CHAR_TOVALUE','VENDQCVAL','ACTUALQCVAL','TPQCVAL','Status'
            ]
            
            ];
    } 

  
    public function collection()
    {
      
        date_default_timezone_set('Asia/Kolkata');
                
        $strWhere = '';


        if(isset($this->vr_num)  && trim($this->vr_num)!="" && $this->vr_num != '0'){
            
            $strWhere .= " AND  PINDENT_HEAD.VRNO = '".$this->vr_num."'";
        }

        if(isset($this->item_code)  && trim($this->item_code)!="" && $this->item_code != '0'){
            $strWhere .= " AND  PINDENT_BODY.ITEM_CODE = '".$this->item_code."'";
        }

       if(isset($this->plantCodeOperator)  && trim($this->plantCodeValue)!="" && $this->plantCodeOperator != '0' && $this->plantCodeValue != '0'){
           
            $strWhere .= " AND  PINDENT_HEAD.PLANT_CODE ".$this->plantCodeOperator." '".$this->plantCodeValue."'";
        } 


        if(isset($this->seriesCodeOperator)  && trim($this->seriesCodeValue)!="" && $this->seriesCodeOperator != '0' && $this->seriesCodeValue != '0'){
            
            $strWhere .= " AND  PINDENT_HEAD.SERIES_CODE ".$this->seriesCodeOperator." '".$this->seriesCodeValue."'";
        }

        if(isset($this->profitCenterOperator)  && trim($this->profitCenterValue)!="" && $this->profitCenterOperator != '0' && $this->profitCenterValue != '0'){
            
            $strWhere .= " AND  PINDENT_HEAD.PFCT_CODE ".$this->profitCenterOperator." '".$this->profitCenterValue."'";
        }

        if(isset($this->departmentOperator)  && trim($this->departmentValue)!="" && $this->departmentOperator != '0' && $this->departmentValue != '0'){
            
            $strWhere .= " AND  PINDENT_HEAD.DEPT_CODE ".$this->departmentOperator." '".$this->departmentValue."'";
        }

        if(isset($this->employeeOperator)  && trim($this->employeeValue)!="" && $this->employeeOperator != '0' && $this->employeeValue != '0'){
            
            $strWhere .= " AND  PINDENT_HEAD.EMP_CODE ".$this->employeeOperator." '".$this->employeeValue."'";
        }
      

        if(isset($this->QtyOperator)  && trim($this->QtyValue)!="" && $this->QtyOperator != '0' && $this->QtyValue != '0'){
            $strWhere .= " AND  PINDENT_BODY.QTYRECVD ".$this->QtyOperator." '".$this->QtyValue."'"; 
        }
       
        if(isset($this->to_date) && trim($this->to_date)!="" && isset($this->from_date)){

            $ToDt   = $this->to_date;

            $FromDt = $this->from_date;

            $strWhere .= " AND  PINDENT_HEAD.VRDATE BETWEEN '".$FromDt."' and  '".$ToDt."'";
        }

        if(isset($this->comp_code) && isset($this->macc_year)){
                  
            $strWhere .= " AND  PINDENT_HEAD.COMP_CODE = '".$this->comp_code."' AND PINDENT_HEAD.FY_CODE = '".$this->macc_year."'";

        }

        
       
       //DB::enableQueryLog();

        if($this->reportTypes == 'pending'){

            $data1 = DB::select("SELECT PINDENT_HEAD.VRDATE,PINDENT_HEAD.VRNO,PINDENT_HEAD.TRAN_CODE,PINDENT_HEAD.SERIES_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.DEPT_CODE,PINDENT_HEAD.EMP_CODE,PINDENT_BODY.PFCT_CODE,PINDENT_BODY.ITEM_CODE,PINDENT_BODY.ITEM_NAME,PINDENT_BODY.QTYRECVD,PINDENT_BODY.UM,PINDENT_BODY.AQTYRECD,PINDENT_BODY.AUM,PINDENT_QUA.ICATG_CODE,PINDENT_QUA.IQUA_CHAR,PINDENT_QUA.IQUA_DESC,PINDENT_QUA.IQUA_UM,PINDENT_QUA.CHAR_FROMVALUE,PINDENT_QUA.CHAR_TOVALUE,PINDENT_QUA.VENDQCVAL,PINDENT_QUA.ACTUALQCVAL,PINDENT_QUA.TPQCVAL,if(PINDENT_BODY.PENQBID = '0' && PINDENT_BODY.PENQHID = '0','Pending',' ') FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID LEFT JOIN PINDENT_QUA ON PINDENT_HEAD.PINDHID = PINDENT_QUA.PINDHID AND PINDENT_BODY.PINDBID = PINDENT_QUA.PINDBID  WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID = '0' AND PINDENT_BODY.PENQHID = '0'");

        }else if($this->reportTypes == 'complete'){

            $data1 = DB::select("SELECT PINDENT_HEAD.VRDATE,PINDENT_HEAD.VRNO,PINDENT_HEAD.TRAN_CODE,PINDENT_HEAD.SERIES_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.DEPT_CODE,PINDENT_HEAD.EMP_CODE,PINDENT_BODY.PFCT_CODE,PINDENT_BODY.ITEM_CODE,PINDENT_BODY.ITEM_NAME,PINDENT_BODY.QTYRECVD,PINDENT_BODY.UM,PINDENT_BODY.AQTYRECD,PINDENT_BODY.AUM,PINDENT_QUA.ICATG_CODE,PINDENT_QUA.IQUA_CHAR,PINDENT_QUA.IQUA_DESC,PINDENT_QUA.IQUA_UM,PINDENT_QUA.CHAR_FROMVALUE,PINDENT_QUA.CHAR_TOVALUE,PINDENT_QUA.VENDQCVAL,PINDENT_QUA.ACTUALQCVAL,PINDENT_QUA.TPQCVAL,if(PINDENT_BODY.PENQBID != '0' && PINDENT_BODY.PENQHID != '0','Complete',' ') FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID LEFT JOIN PINDENT_QUA ON PINDENT_HEAD.PINDHID = PINDENT_QUA.PINDHID AND PINDENT_BODY.PINDBID = PINDENT_QUA.PINDBID  WHERE 1=1 $strWhere AND PINDENT_BODY.PENQBID != '0' AND PINDENT_BODY.PENQHID != '0'");

        }else{

            $data1 = DB::select("SELECT PINDENT_HEAD.VRDATE,PINDENT_HEAD.VRNO,PINDENT_HEAD.TRAN_CODE,PINDENT_HEAD.SERIES_CODE,PINDENT_HEAD.PLANT_CODE,PINDENT_HEAD.DEPT_CODE,PINDENT_HEAD.EMP_CODE,PINDENT_BODY.PFCT_CODE,PINDENT_BODY.ITEM_CODE,PINDENT_BODY.ITEM_NAME,PINDENT_BODY.QTYRECVD,PINDENT_BODY.UM,PINDENT_BODY.AQTYRECD,PINDENT_BODY.AUM,PINDENT_QUA.ICATG_CODE,PINDENT_QUA.IQUA_CHAR,PINDENT_QUA.IQUA_DESC,PINDENT_QUA.IQUA_UM,PINDENT_QUA.CHAR_FROMVALUE,PINDENT_QUA.CHAR_TOVALUE,PINDENT_QUA.VENDQCVAL,PINDENT_QUA.ACTUALQCVAL,PINDENT_QUA.TPQCVAL,CASE WHEN(PINDENT_BODY.PENQBID = '0' AND PINDENT_BODY.PENQHID = '0') THEN 'Pending' WHEN(PINDENT_BODY.PENQBID != '0' AND PINDENT_BODY.PENQHID != '0') THEN 'Complete' END AS 'All' FROM PINDENT_HEAD LEFT JOIN PINDENT_BODY ON PINDENT_HEAD.PINDHID = PINDENT_BODY.PINDHID LEFT JOIN PINDENT_QUA ON PINDENT_HEAD.PINDHID = PINDENT_QUA.PINDHID AND PINDENT_BODY.PINDBID = PINDENT_QUA.PINDBID  WHERE 1=1 $strWhere");


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
                $reportName = '( Purchase Indent )';
               
                $top = ($this->vr_num !='' && $this->vr_num != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' VR NO : '.$this->vr_num : (($this->item_code !='' && $this->item_code != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' ITEM : '.$this->item_code : (($this->plantCodeValue !='' && $this->plantCodeValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Plant : '.$this->plantCodeValue : (($this->seriesCodeValue !='' && $this->seriesCodeValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Series : '.$this->seriesCodeValue : (($this->profitCenterValue !='' && $this->profitCenterValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Profit Center : '.$this->profitCenterValue : (($this->departmentValue !='' && $this->departmentValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Department : '.$this->departmentValue : (($this->employeeValue !='' && $this->employeeValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Employee : '.$this->employeeValue : (($this->QtyValue !='' && $this->QtyValue != '0' && $this->reportTypes !='') ? ucfirst($this->reportTypes).' Quality : '.$this->QtyOperator.' '.$this->QtyValue : ucfirst($this->ReportTypes).' - Item')))))));

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
