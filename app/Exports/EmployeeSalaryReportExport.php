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

class EmployeeSalaryReportExport implements FromCollection, WithHeadings,ShouldAutoSize,WithCustomStartCell,WithEvents
{


	private $comp_code;
    private $macc_year;
    private $monthYear;
    private $PLANT_CODE;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($comp_code,$macc_year,$monthYear,$PLANT_CODE,$address,$db_name) 
    {
        $this->comp_code            = $comp_code;
        $this->macc_year            = $macc_year;
        $this->monthYear            = $monthYear;
        $this->PLANT_CODE           = $PLANT_CODE;
        $this->address              = $address;
        $this->db_name              = $db_name;
        
    }

    public function getCompName(Request $request){

       $compName = $request->session()->get('company_name');
      
    }

    public function headings():array{

       

        $WAGE_BODY = DB::select("SELECT * FROM EMP_PAYTRAN_BODY LEFT JOIN EMP_PAYTRAN_HEAD ON EMP_PAYTRAN_BODY.PAY_TRANHEAD_ID = EMP_PAYTRAN_HEAD.ID
            WHERE EMP_PAYTRAN_HEAD.MONTH_YR = '".$this->monthYear."' AND EMP_PAYTRAN_HEAD.PLANT_CODE = '".$this->PLANT_CODE."' AND EMP_PAYTRAN_HEAD.COMP_CODE = '".$this->comp_code."' AND EMP_PAYTRAN_HEAD.FY_YEAR = '".$this->macc_year."' ");


        $getcount  =  count($WAGE_BODY);
       
       
       for ($i=0; $i < $getcount; $i++) { 


            $IndiCator1 =  DB::table('EMP_PAYTRAN_WAGECAL')->select('EMP_PAYTRAN_WAGECAL.*')->where('PAY_TRANHEAD_ID','=',$WAGE_BODY[$i]->PAY_TRANHEAD_ID)->where('PAY_TRANBODY_ID','=',$WAGE_BODY[$i]->ID)->get()->toArray();


            $IndiCator = DB::select("SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='".$this->db_name."' 
                            AND `TABLE_NAME`='EMP_PAYTRAN_WAGECAL_VIEW';");


            $count = count($IndiCator);

            $colName = array('EMPLOYEE NAME','D-O-J');
                
            for ($j=0; $j < $count; $j++) { 
                
                         
                $srno =$j +1;
                array_push($colName, $IndiCator[$j]->COLUMN_NAME);
                       
            }
                    
            array_push($colName, 'GROSS SALARY','NO OF DAYS','NO OF DAYS PRESENT','ABSENT','EARNING','DEDUCTION','NET PAY','BANK/CASH');

        

            $columns = [   ['Fy_yr'],
                            ['ShowingReport'],
                            $colName
                       ];
    
            return $columns;

        }
    }

    public function collection()
    {


        date_default_timezone_set('Asia/Kolkata');
        
           // DB::enableQueryLog();
        $data = DB::select("SELECT MASTER_EMP.EMP_NAME, MASTER_EMP.DOJ,EMP_PAYTRAN_WAGECAL_VIEW.*,EMP_PAYTRAN_FORM16.GROSS_SAL,EMP_PAYTRAN_FORM16.MONTH_DAY,EMP_PAYTRAN_FORM16.WORKING_DAY,EMP_PAYTRAN_FORM16.ABSENT,EMP_PAYTRAN_BODY.TOT_EARNING,EMP_PAYTRAN_BODY.TOT_DEDUCTION,EMP_PAYTRAN_BODY.TOT_SALARY FROM EMP_PAYTRAN_HEAD 
                LEFT JOIN EMP_PAYTRAN_BODY ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_BODY.PAY_TRANHEAD_ID 
                LEFT JOIN MASTER_EMP ON MASTER_EMP.EMP_CODE = EMP_PAYTRAN_BODY.EMP_CODE 
                LEFT JOIN EMP_PAYTRAN_WAGECAL_VIEW ON EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_WAGECAL_VIEW.PAY_TRANBODY_ID
                LEFT JOIN EMP_PAYTRAN_FORM16 ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_FORM16.PAY_TRANHEAD_ID AND EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_FORM16.PAY_TRANBODY_ID
                
                WHERE  EMP_PAYTRAN_HEAD.MONTH_YR = '".$this->monthYear."' AND EMP_PAYTRAN_HEAD.PLANT_CODE = '".$this->PLANT_CODE."' AND EMP_PAYTRAN_HEAD.COMP_CODE = '".$this->comp_code."' AND EMP_PAYTRAN_HEAD.FY_YEAR = '".$this->macc_year."' ");
        
            // dd(DB::getQueryLog());

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

                 $data = DB::select("SELECT MASTER_EMP.EMP_NAME, MASTER_EMP.DOJ,EMP_PAYTRAN_WAGECAL_VIEW.*,EMP_PAYTRAN_FORM16.GROSS_SAL,EMP_PAYTRAN_FORM16.MONTH_DAY,EMP_PAYTRAN_FORM16.WORKING_DAY,EMP_PAYTRAN_FORM16.ABSENT,EMP_PAYTRAN_BODY.TOT_EARNING,EMP_PAYTRAN_BODY.TOT_DEDUCTION,EMP_PAYTRAN_BODY.TOT_SALARY FROM EMP_PAYTRAN_HEAD 
                LEFT JOIN EMP_PAYTRAN_BODY ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_BODY.PAY_TRANHEAD_ID 
                LEFT JOIN MASTER_EMP ON MASTER_EMP.EMP_CODE = EMP_PAYTRAN_BODY.EMP_CODE 
                LEFT JOIN EMP_PAYTRAN_WAGECAL_VIEW ON EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_WAGECAL_VIEW.PAY_TRANBODY_ID
                LEFT JOIN EMP_PAYTRAN_FORM16 ON EMP_PAYTRAN_HEAD.ID = EMP_PAYTRAN_FORM16.PAY_TRANHEAD_ID AND EMP_PAYTRAN_BODY.ID = EMP_PAYTRAN_FORM16.PAY_TRANBODY_ID WHERE  EMP_PAYTRAN_HEAD.MONTH_YR = '".$this->monthYear."' AND EMP_PAYTRAN_HEAD.PLANT_CODE = '".$this->PLANT_CODE."' AND EMP_PAYTRAN_HEAD.COMP_CODE = '".$this->comp_code."' AND EMP_PAYTRAN_HEAD.FY_YEAR = '".$this->macc_year."' ");


                $countdata = count($data);

                $comp = Session::get('company_name');
                $reportName = '( Employee Salary )';
                $reportType = 'Showing Report For ';

                
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
                $sheet->setCellValue('A2', $this->address);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:T2')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:R2')
                                ->getFont()
                                ->setBold(true);

                // $sheet->getStyle("D1:D7")->getNumberFormat()->setFormatCode('### ### ### ##0.00');

                // $sheet->mergeCells('A3:R3');
                // $sheet->setCellValue('A3', Session::get('macc_year'));
                // $event->sheet->getStyle($cellRange)->getFont()->setSize(12);
                // $event->sheet->getDelegate()->getStyle('A3:R3')
                //                 ->getAlignment()
                //                 ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('A3:R3')
                //                 ->getFont()
                //                 ->setBold(true);

                

                $cellRanges = 'A3:R3';
                $sheet->mergeCells('A3:R3');
                $sheet->setCellValue('A3','SALARY FOR THE MONTH OF '.$this->monthYear.' ');
                $event->sheet->getStyle($cellRanges)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A3:R3')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:R3')
                                ->getFont()
                                ->setBold(true);

                $cellPeriod = 'A4:R4';
                
                $event->sheet->getStyle($cellPeriod)->getFont()->setSize(11);
                $event->sheet->getDelegate()->getStyle('A4:R4')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A4:R4')
                                ->getFont()
                                ->setBold(true);
                $rowcount = $countdata + 4;

                $sheet->getStyle('D5:D'.$rowcount)->getNumberFormat()->setFormatCode('0.00');

                // $sheet->getStyle('D5:D'.$rowcount)->getNumberFormat()->setFormatCode('0.00,')->setFormatCode('#,##0');

                $sheet->getStyle('E5:E'.$rowcount)->getNumberFormat()->setFormatCode("0.00");
                $sheet->getStyle('F5:F'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('G5:G'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('H5:H'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('I5:I'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('J5:J'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('K5:K'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('O5:O'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('P5:P'.$rowcount)->getNumberFormat()->setFormatCode('0.00');
                $sheet->getStyle('Q5:Q'.$rowcount)->getNumberFormat()->setFormatCode('0.00');

                $totalRowData   = $rowcount + 1;
                $totalGrossSal  =  'K5:K'.$rowcount;
                $totalEarning   =  'O5:O'.$rowcount;
                $totalDeduction =  'P5:P'.$rowcount;
                $totalNetSal    =  'Q5:Q'.$rowcount;

                // $sheet->setPreCalculateFormulas(true);

                //  $sheet->mergeCells('A'.$totalRowData' : J'.$totalRowData);
                // $sheet->setCellValue($cellRanges,'TOTAL');
                
                               

                // $sheet->setCellValue('A'.$totalRowData. 'J'.$totalRowData ,'');
                $sheet->setCellValue('K'.$totalRowData ,'=SUM('.$totalGrossSal.')');
                $sheet->setCellValue('O'.$totalRowData ,'=SUM('.$totalEarning.')');
                $sheet->setCellValue('P'.$totalRowData ,'=SUM('.$totalDeduction.')');
                $sheet->setCellValue('Q'.$totalRowData ,'=SUM('.$totalNetSal.')');
                // $sheet->setCellValue('K15',SUM(K8:K9));


                // $event->sheet->getDelegate()->getStyle(\PhpOffice\PhpSpreadsheet\Style\getNumberFormat::setFormatCode('0.00'));
                // $event->sheet->getDelegate()->getStyle('A6:R6')
                //                 ->getAlignment()
                //                 ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // $event->sheet->getDelegate()->getStyle('A6:R6')
                //                 ->getFont()
                //                 ->setBold(true);


            },
        ];

        
    }
}
