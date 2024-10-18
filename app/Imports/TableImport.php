<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class TableImport implements ToModel,WithStartRow,WithHeadingRow
{
   protected $table;
   protected $config_table;
   protected $CompanyName;
   protected $Fiscalyr;
   protected $tempvrno;
   protected $temptransporter;
   protected $column_name;

   public function __construct($table,$config_table,$CompanyName,$Fiscalyr,$tempvrno,$temptransporter,$column_name)
    {
      $this->table        = $table;
      $this->config_table = $config_table;
      $this->company      = $CompanyName;
      $this->fiscalyr     = $Fiscalyr;
      $this->vrno         = $tempvrno;
      $this->transporter  = $temptransporter;
      $this->column_name  = $column_name;
       
    }

    public function model(array $row)
    {

      $table_name       =$this->table;
      $tableconfig_name =$this->config_table;
      $CompanyName      =$this->company;
      $macc_year        =$this->fiscalyr;
      $vrno             =$this->vrno;
      $transporter      =$this->transporter;
      $columnName       =$this->column_name;

      


    
    

     // print_r($row);exit;

if($table_name=='TEMP_DO_ORDER'){

      // print_r($allDate);exit;

$rowcount = count($row);


   

        $Data =array([

                          "VR_NO"            => $vrno,
                          "TRANSPORTER"      => $transporter,
                          "DO_NO"            => $row['DO/STO NO'],
                          "ITEM_CODE"        => $row['MATERIAL NO'],
                          'ITEM_NAME'        => $row['MATERIAL NO'], 
                          'ITEM_REMARK'      => $row['MATERIAL DESC'],
                          'DO_QTY'           => $row['TOTAL DO QTY'],
                          'BAL_QTY'          => $row['BALANCE QTY'],
                          'DO_DATE'          => $row['ALLOCATION DATE'],
                          'CONSINEE'         => $row['CUSTOMER NAME'],
                          'LOT_NO'           => $row['LOT NO'],
                          'DESTINATION_NAME' => $row['DESTINATION NAME'],
                          

         ]);

         $saveData = DB::table($table_name)->insert($Data);


     }
     

    /* $table_name = $this->table;

      foreach($row as $data) 
        {
            $dataArray = array([

            'acctype_code' => $data[1], 
            'acctype_name' => $data[2],

            ]);



        $saveData = DB::table($table_name)->insert($dataArray);
        }
*/

      
    }


    public function startRow(): int
    {
         return 1;
    }
}
