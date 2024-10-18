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

class FreightSaleOrderExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
	private $fsoid;

    public function __construct($fsoid) 
    {
       
        $this->fsoid = $fsoid;
      
    }
    public function headings():array{

                     $columns = [   
                                    ['Fy_yr'],
                                    ['ShowingReport'],
                                    ['ForPeriod'],
                                    ['VRDATE',
                                    'VRNO',
                                    'ACC_CODE',
                                    'ACC_NAME',
                                    'REF_NO',
                                    'REF_DATE','FROM_PLACE','TO_PLACE',
                                    'VEHICLE_TYPE','VALID_FROM_DATE','VALID_TO_DATE','RATE_BASIS','RATE']
                               ];
            
                return $columns;
        
    }

    public function collection()
    {
    	date_default_timezone_set('Asia/Kolkata');

    	$fsoid = $this->fsoid;
    	//DB::enableQueryLog();
    	$data1 = DB::select("SELECT H.VRDATE AS VR_DATE,H.VRNO AS VR_NO,H.ACC_CODE AS ACCCODE,H.ACC_NAME AS ACCNAME,H.REF_NO AS REFNO,H.REF_DATE AS REFDATE,B.FROM_PLACE AS FROMPLACE,B.TO_PLACE AS TOPLACE,B.VEHICLE_TYPE AS VEHICLETYPE, B.VALID_FROM_DATE AS VALIDFROMDATE,B.VALID_TO_DATE AS VALIDTODATE,B.RATE_BASIS AS RATEBASIS,B.RATE  AS RATE  FROM FSO_HEAD H LEFT JOIN FSO_BODY B ON H.FSOHID = B.FSOHID WHERE H.FSOHID ='$fsoid'");
        //print_r($data1);exit();
    	//dd(DB::getQueryLog());
    	$data = json_decode(json_encode($data1), true); 
         //print_r($data);exit();
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
                $reportName = '( REPORT )';

                $compCode  = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];

                $PeriodFor = 'Period For Date : 16-05-2023 To 17-05-2023';

                $reportType = '';

                $cellRange = 'A1:T1';
                $sheet = $event->sheet;
                $sheet->mergeCells('A1:T1');
                $sheet->setCellValue('A1',$comp_name);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A1:T1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A1:T1')
                                ->getFont()
                                ->setBold(true);

                $sheet->mergeCells('A2:T2');
                $sheet->setCellValue('A2', Session::get('macc_year'));
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:T2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A2:T2')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A3:T3';
                $sheet->mergeCells('A3:T3');
                $sheet->setCellValue('A3',$PeriodFor);
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A3:T3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A3:T3')
                                ->getFont()
                                ->setBold(true);

                $cellRanges = 'A4:T4';
                $sheet->mergeCells('A4:T4');
                $sheet->setCellValue('A4',$reportName);
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:T4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A4:T4')
                                ->getFont()
                                ->setBold(true);

            },
        ];
    }



}