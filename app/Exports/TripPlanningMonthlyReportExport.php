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



class TripPlanningMonthlyReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    private $fromDt;
    private $toDt;
    private $vehicleType;
    private $Consinee;
    private $transpAgent;
    private $from_place;
    private $to_place;
  

    public function __construct($fromDt,$toDt,$vehicleType,$Consinee,$transpAgent,$from_place,$to_place){

        $this->fromDt      = $fromDt;
        $this->toDt        = $toDt;
        $this->vehicleType = $vehicleType;
        $this->Consinee    = $Consinee;
        $this->transpAgent = $transpAgent;
        $this->from_place  = $from_place;
        $this->to_place    = $to_place;

    }


    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
       $db_name  = $request->session()->get('dbName');
      
    }

   
    public function headings():array{

        $strWhere = '';


        $colName = array('TRIP DATE','TRIP NO','ACCOUNT NAME','ACCOUNT CODE','D.O. NO.','D.O. DATE','CONSINEE NAME','CONSINEE CODE','FROM PLACE','TO PLACE','ITEM NAME','ITEM CODE','QTY','VEHICLE NO.','VEHICLE OWNER','TRANSPORT NAME','TRANSPORT CODE','FREIGHT RATE');
            
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

        if(isset($this->toDt) && trim($this->toDt)!="0" && isset($this->fromDt)){

            $ToDt = date("Y-m-d", strtotime($this->toDt));

            $FromDt = date("Y-m-d", strtotime($this->fromDt));

            $strWhere .= " AND  TRIP_HEAD.VRDATE BETWEEN '$FromDt' AND  '$ToDt' ";
        }
        
        if(isset($this->Consinee)  && trim($this->Consinee)!="0"){

            $strWhere .= " AND TRIP_BODY.CP_CODE = '$this->Consinee' ";

        }

        if(isset($this->transpAgent)  && trim($this->transpAgent)!="0"){

            $strWhere .= " AND TRIP_HEAD.TRANSPORT_CODE = '$this->transpAgent' ";
        }

        if(isset($this->from_place)  && trim($this->from_place)!="0" && isset($this->to_place)  && trim($this->to_place)!="0"){

            $strWhere .= " AND TRIP_BODY.FROM_PLACE = '$this->from_place' AND TRIP_BODY.TO_PLACE = '$this->to_place' ";

        }

        if(isset($this->vehicleType)  && trim($this->vehicleType)!="0" && $this->vehicleType == 'self' || $this->vehicleType == 'market' || $this->vehicleType == 'dump'){

            $strWhere .= " AND TRIP_HEAD.OWNER= '$this->vehicleType' ";

        }else{

            $strWhere .= " AND 2=2 ";
        }

        //DB::enableQueryLog();

        $data = DB::select("SELECT TRIP_HEAD.VRDATE,TRIP_HEAD.TRIP_NO,TRIP_HEAD.ACC_NAME,TRIP_HEAD.ACC_CODE,TRIP_BODY.DO_NO,TRIP_BODY.DO_DATE,TRIP_BODY.CP_NAME,TRIP_BODY.CP_CODE,TRIP_BODY.FROM_PLACE,TRIP_BODY.TO_PLACE,TRIP_BODY.ITEM_NAME,TRIP_BODY.ITEM_CODE,TRIP_BODY.QTY,TRIP_HEAD.VEHICLE_NO,TRIP_HEAD.OWNER,TRIP_HEAD.TRANSPORT_NAME,TRIP_HEAD.TRANSPORT_CODE,TRIP_HEAD.FPO_RATE FROM TRIP_HEAD INNER JOIN TRIP_BODY 
                ON TRIP_HEAD.TRIPHID = TRIP_BODY.TRIPHID WHERE 1=1  $strWhere");
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
                $reportName = '( Monthly Trip Planning Report )';

                $top = "Monthly Report";


                $reportType = 'Showing Report For -  '.$top;

                $ToDt = date("d-m-Y", strtotime($this->toDt));
                $FromDt = date("d-m-Y", strtotime($this->fromDt));

                $PeriodFor = 'Period For Date : '.$FromDt.' TO '.$ToDt;
                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];
                $compAddr = DB::select("SELECT ADD1 FROM `MASTER_COMP` WHERE COMP_CODE='$comp_code'");
               
                $cellRange = 'A1:R1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:R1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:R1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:R1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:R2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:R2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:R2')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A3:R3');
                $sheet->setCellValue('A3', $reportType);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:R3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:R3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:R4';
                $sheet->mergeCells('A4:R4');
                $sheet->setCellValue('A4',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:R4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:R4')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A5:R5';
                $sheet->mergeCells('A5:R5');
                $sheet->setCellValue('A5',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A5:R5')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A5:R5')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('A6:R6')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A6:R6')
                                ->getFont()
                                ->setBold(true);


            },
        ];

        
    }
}
