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

class DynQueryReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{
	private $getdynQuery;
    private $comp_code;
    private $macc_year;
    private $columnNameFr;
    private $columnNameSc;
    private $columnNameThr;
    private $queryName;
    private $fromdate;
    private $todate;

    public function __construct($getdynQuery,$comp_code,$macc_year,$columnNameFr,$columnNameSc,$columnNameThr,$columnNameFour,$queryName,$fromdate,$todate) 
    {
       
        $this->getdynQuery    = $getdynQuery;
        $this->comp_code      = $comp_code;
        $this->macc_year      = $macc_year;
        $this->columnNameFr   = $columnNameFr;
        $this->columnNameSc   = $columnNameSc;
        $this->columnNameThr  = $columnNameThr;
        $this->columnNameFour = $columnNameFour;
        $this->queryName      = $queryName;
        $this->fromdate       = $fromdate;
        $this->todate         = $todate;
    }

    public function headings():array{

                    $colThre = $this->columnNameThr;
                    
                    $spliColThr = explode(',', $colThre);
                    $colName = array($this->columnNameFr,$this->columnNameSc);

                    for($i=0;$i<count($spliColThr);$i++){
                        
                        array_push($colName,$spliColThr[$i]);
                    }

                    $colFour = $this->columnNameFour;
                    $spliColFour = explode(',', $colFour);

                    for($i=0;$i<count($spliColFour);$i++){
                        
                        array_push($colName,$spliColFour[$i]);
                    }

                     $columns = [   ['Fy_yr'],
                                    ['ShowingReport'],
                                    ['ForPeriod'],
                                    $colName
                               ];
            
                return $columns;
        
    }

    public function collection()
    {
    	date_default_timezone_set('Asia/Kolkata');

    	$getdynQuery = $this->getdynQuery;
    	//DB::enableQueryLog();
    	$data1 = DB::select("SELECT $getdynQuery");
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
                $reportName = '( '.$this->queryName.' )';

                $compCode = explode('-', $comp);
                $comp_code = $compCode[0];
                $comp_name = $compCode[1];

                $PeriodFor = 'Period For Date : '.$this->fromdate.' To '.$this->todate.'';

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