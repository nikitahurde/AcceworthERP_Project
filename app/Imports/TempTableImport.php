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

class TempTableImport implements ToModel,WithStartRow,WithHeadingRow
{
  
  public function model(array $row)
  {
              // dd($row);

  }
    public function startRow(): int
    {
         return 1;
    }
}
