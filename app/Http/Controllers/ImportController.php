<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TableImport;
use App\Exports\TableExport;
use Auth;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

//use Excel;

ini_set ('max_execution_time', 3600);

class ImportController extends Controller
{

	public function __cunstruct(Request $request,$data){

		//$this->data = "smit@121";
        //print_r($data);exit;

           }

	 public function FormImportFile(Request $request){

	 	$title='Import File';
	 	$data['table_name'] = DB::table('input_table')->get();

        //print_r($data['table_name']);exit;

	 	return view('admin.finance.master.importfile',$data,compact('title'));
	 }

     public function exportExcel(Request $request) 
    {
        //print_r($request->table_name);exit;
       

      $table = $request->input("get_table_name");

   //   $table = 'master_party';

    

      return Excel::download(New TableExport($table), $table.'.xlsx');


        

    }


    public function importExcel(Request $request) 
    {
       //$data = new ImportAccType;

    // print_r(request()->file('import_file'));exit;
         $validate = $this->validate($request, [
                
                'table_name'  => 'required',
                'import_file' => 'required|mimes:xlsx,xls',
        ]);

        $table = $request->input("table_name");

        $CompanyName                = $request->session()->get('company_name');
    
        $macc_year                  = $request->session()->get('macc_year');

        //config(['excel.import.startRow' => 1]);
            
        $saveData = Excel::import(new TableImport($table,$CompanyName,$macc_year),request()->file('import_file'));

        //return redirect()->back();

       if ($saveData) {

                $request->session()->flash('alert-success', 'Import Data Successfully Added...!');
                return redirect('/finance/importfile');

            } else {

                $request->session()->flash('alert-error', 'Data Can Not Import...!');
                return redirect('/finance/importfile');

            }

            
    }


    
	public function importExcelCsv(Request $request) 
    {

    	/*$ImportAccType =  new ImportAccType;

    	$file =  $request->file('import_file');

    
        Excel::import($ImportAccType,$file);
             
        return back();*/



        $validate = $this->validate($request, [
                
                'table_name'  => 'required',
                'import_file' => 'required',
        ]);

        $CompanyName                = $request->session()->get('company_name');
    
        $macc_year                  = $request->session()->get('macc_year');

         $file = $request->file("import_file");

         $path = $file->getPathname();

            
            $table_name = $request->input("table_name");

         if (($handle = fopen ( $file->getPathname(), 'r' )) !== FALSE) {

        while (($data = fgetcsv ($handle, 1000, ',' )) !== FALSE ) {




             if($table_name=='master_finance_acctypes'){

                $Data = array(

                        "comp_name"    => $CompanyName,
                        "fiscal_year"  => $macc_year,
                        "acctype_code" => $data[1],
                        "acctype_name" => $data[2],

                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_finance'){

                $Data = array(
                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "item_code"      => $data[1],
                        "item_name"      => $data[2],
                        "hsn_code"       => $data[3],
                        "tax_code"       => $data[4],
                        "tax_type"       => $data[5],
                        "valuation_code" => $data[6],
                        "item_detail"    => $data[7],
                        "item_type"      => $data[8],
                        "item_group"     => $data[9],
                        "item_class"     => $data[10],
                        "item_category"  => $data[11],
                        "item_sch"       => $data[12],
                        "um"             => $data[13],
                        "aum"            => $data[14],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_party'){

                $Data = array(

                        "comp_name"        => $CompanyName,
                        "fiscal_year"      => $macc_year,
                        "acc_code"         => $data[1],
                        "acc_name"         => $data[2],
                        "acctype_code"     => $data[3],
                        "acccategory_code" => $data[4],
                        "accclass_code"    => $data[5],
                        "bill_track"       => $data[6],
                        "contact_person"   => $data[7],
                        "address1"         => $data[8],
                        "address2"         => $data[9],
                        "address3"         => $data[10],
                        "bank_name"        => $data[11],
                        "acc_number"       => $data[12],
                        "branch_name"      => $data[13],
                        "ifsc_code"        => $data[14],
                        "bank_address"     => $data[15],
                        "city"             => $data[16],
                        "pin"              => $data[17],
                        "district"         => $data[18],
                        "state"            => $data[19],
                        "phone1"           => $data[20],
                        "phone2"           => $data[21],
                        "fax"              => $data[22],
                        "email"            => $data[23],
                        "tax_code"         => $data[24],
                        "tan_no"           => $data[25],
                        "tinno"            => $data[26],
                        "sales_taxno"      => $data[27],
                        "csales_taxno"     => $data[28],
                        "panno"            => $data[29],
                        "gst_type"         => $data[30],
                        "gst_num"          => $data[31],
                        "ecc_no"           => $data[32],
                        "range_no"         => $data[33],
                       
                    );

                 $saveData = DB::table($table_name)->insert($Data);
            }else if($table_name=='master_acc_bal'){

                $Data = array(
                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "vr_date"     => $data[1],
                        "pfct_code"   => $data[2],
                        "acc_code"    => $data[3],
                        "yropdr"      => $data[4],
                        "yropcr"      => $data[5],
                        "yrcrAmt"     => $data[6],
                        "yrdrAmt"     => $data[7],
                        "reference"   => $data[8],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_acc_category'){

                $Data = array(
                        "comp_name"          => $CompanyName,
                        "fiscal_year"        => $macc_year,
                        "acc_category_code " => $data[1],
                        "acc_category_name"  => $data[2],
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_acc_class'){

                $Data = array(
                        "comp_name"        => $CompanyName,
                        "fiscal_year"      => $macc_year,
                        "acc_class_code  " => $data[1],
                        "acc_class_name"   => $data[2],
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_area'){

                $Data = array(
                        "comp_name"        => $CompanyName,
                        "fiscal_year"      => $macc_year,
                        "name"   => $data[1],
                        "code  " => $data[2],
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_comp'){

                $Data = array(
                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "add1"        => $data[1],
                        "add2"        => $data[2],
                        "add3"        => $data[3],
                        "country"     => $data[4],
                        "district"    => $data[5],
                        "city"        => $data[6],
                        "pin_code"    => $data[7],
                        "phone1"      => $data[8],
                        "phone2"      => $data[9],
                        "fax_no"      => $data[10],
                        "email_id"    => $data[11],
                       
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_config'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "tran_code"   => $data[1],
                        "series_code" => $data[2],
                        "series_name" => $data[3],
                        "gl_code"     => $data[4],
                        "post_code"   => $data[5],
                        "rfhead1"     => $data[6],
                        "rfhead2"     => $data[7],
                        "rfhead3"     => $data[8],
                        "rfhead4"     => $data[9],
                        "rfhead5"     => $data[10],
                      
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_cost'){

                $Data = array(

                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "cost_code"      => $data[1],
                        "cost_name"      => $data[2],
                        "costtype_code"  => $data[3],
                        "costgroup_code" => $data[4],
                        "costcatg_code"  => $data[5],
                        "costclass_code" => $data[6],
                        "pfct_code"      => $data[7],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_costcatg'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "costcatg_code"   => $data[1],
                        "costcatg_name" => $data[2],
                        
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_cost_class'){

                $Data = array(

                        "comp_name"       => $CompanyName,
                        "fiscal_year"     => $macc_year,
                        "cost_class_code" => $data[1],
                        "cost_class_name" => $data[2],
                        
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_cost_group'){

                $Data = array(

                        "comp_name"        => $CompanyName,
                        "fiscal_year"      => $macc_year,
                        "cost_group_code " => $data[1],
                        "cost_group_name"  => $data[2],
                        "cost_type_code"   => $data[3],
                        
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_cost_type'){

                $Data = array(

                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "cost_type_code" => $data[1],
                        "cost_type_name" => $data[2],
                       
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_fy'){

                $Data = array(

                        "comp_code"    => $data[1],
                        "fy_code"      => $data[2],
                        "fy_from_date" => $data[3],
                        "fy_to_date"   => $data[4],
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_gl'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "gl_code"     => $data[1],
                        "gl_name"     => $data[2],
                        "glsch_type"  => $data[3],
                        "account_tag" => $data[4],
                        "cost_tag"    => $data[5],
                        "asset_tag"   => $data[6],
                        "glsch_code " => $data[7],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_glbal'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "pfct_code"   => $data[1],
                        "gl_code"     => $data[2],
                        "yropdr"      => $data[3],
                        "yropcr"      => $data[4],
                        "yrDrAmp"     => $data[5],
                        "yrCrAmp"     => $data[6],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_glsch'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "glsch_type"  => $data[1],
                        "glsch_code"  => $data[2],
                        "glsch_name"  => $data[3],
                        "glsch_seqno" => $data[4],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_hsn'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "hsn_code"  => $data[1],
                        "hsn_name"  => $data[2],
                        "hsn_discription"  => $data[3],
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_hsn_rate'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "hsn_code"  => $data[1],
                        "tax_code"  => $data[2],
                        "tax_rate"  => $data[3],
                    
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_itemgroup'){

                $Data = array(

                        "comp_name"       => $CompanyName,
                        "fiscal_year"     => $macc_year,
                        "itemgroup_code " => $data[1],
                        "itemgroup_name"  => $data[2],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_itemsch'){

                $Data = array(

                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "item_sch_code " => $data[1],
                        "item_sch_name"  => $data[2],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_itemum_finance'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "item_code"   => $data[1],
                        "um_code"     => $data[2],
                        "aum"         => $data[3],
                        "aum_factor"  => $data[4],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_balance'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "plant_code"  => $data[1],
                        "item_code"   => $data[2],
                        "yropqty"     => $data[3],
                        "yropaqty"    => $data[4],
                        "yropval"     => $data[5],
                        "mavrate"     => $data[6],
                        "yrQtyRecd"   => $data[7],
                        "yrAQtyRecd"  => $data[8],
                        "yrQtyIssued" => $data[9],
                        "yrAQtyIssue" => $data[10],
                        "yrQtyBlock"  => $data[11],
                        "BlockQty"    => $data[12],
                        "BlockAQty"   => $data[13],
                        "stdrate"     => $data[14],
                        "batchNo"     => $data[15],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_category'){

                $Data = array(

                        "comp_name"         => $CompanyName,
                        "fiscal_year"       => $macc_year,
                        "itemcategory_code" => $data[1],
                        "itemcategory_name" => $data[2],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_class'){

                $Data = array(

                        "comp_name"       => $CompanyName,
                        "fiscal_year"     => $macc_year,
                        "item_class_code" => $data[1],
                        "item_class_name" => $data[2],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_rack'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "item_code"   => $data[1],
                        "rack_code"   => $data[2],
                      
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_item_type'){

                $Data = array(

                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "item_type_code" => $data[1],
                        "item_type_name" => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_pfct'){

                $Data = array(

                        "comp_name"    => $CompanyName,
                        "fiscal_year"  => $macc_year,
                        "pfct_code"    => $data[1],
                        "pfct_name"    => $data[2],
                        "company_code" => $data[3],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_plant'){

                $Data = array(

                        "comp_name"     => $CompanyName,
                        "fiscal_year"   => $macc_year,
                        "plant_code"    => $data[1],
                        "plant_name"    => $data[2],
                        "company_code"  => $data[3],
                        "pfct_code"     => $data[4],
                        "address1"      => $data[5],
                        "address2"      => $data[6],
                        "address3"      => $data[7],
                        "city"          => $data[8],
                        "pin"           => $data[9],
                        "district"      => $data[10],
                        "state"         => $data[11],
                        "country"       => $data[13],
                        "std_code"      => $data[14],
                        "phone1"        => $data[15],
                        "phone2"        => $data[16],
                        "fax"           => $data[17],
                        "email"         => $data[18],
                        "tan_no"        => $data[19],
                        "tin_no"        => $data[20],
                        "cin_no"        => $data[21],
                        "pan_no"        => $data[22],
                        "gst_no"        => $data[23],
                        "sales_taxno"   => $data[24],
                        "csales_taxno"  => $data[25],
                        "service_taxno" => $data[26],
                        "ecc_no"        => $data[27],
                        "range_no"      => $data[28],
                        "range_name"    => $data[29],
                        
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_rack'){

                $Data = array(

                        "comp_name"    => $CompanyName,
                        "fiscal_year"  => $macc_year,
                        "rack_code"    => $data[1],
                        "rack_name"    => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_state'){

                $Data = array(

                        "state_code"    => $data[1],
                        "state_name"    => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_tax'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "tax_code"    => $data[1],
                        "tax_type"    => $data[2],
                        
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_tax_indicator'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "tax_ind_code"    => $data[1],
                        "tax_ind_name"    => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_tds'){

                $Data = array(

                        "comp_name"        => $CompanyName,
                        "fiscal_year"      => $macc_year,
                        "tds_code"         => $data[1],
                        "tds_name"         => $data[2],
                        "tds_rate"         => $data[3],
                        "surcharge_rate"   => $data[4],
                        "surchargegl_code" => $data[5],
                        "cess_rate"        => $data[6],
                        "cessgl_code"      => $data[7],
                        "form_no"          => $data[8],
                        "gl_code "         => $data[9],
                        "tds_section "     => $data[10],
                        "from_date "       => $data[11],
                        "to_date "         => $data[12],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_tds_rate'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "tds_code"    => $data[1],
                        "acc_code"    => $data[2],
                        "tds_rate"    => $data[3],
                        "from_date"   => $data[4],
                        "to_date"     => $data[5],
                       
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_transaction'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "tran_code"    => $data[1],
                        "tran_head"    => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else if($table_name=='master_valuation'){

                $Data = array(

                        "comp_name"   => $CompanyName,
                        "fiscal_year" => $macc_year,
                        "valuation_code"    => $data[1],
                        "valuation_name"    => $data[2],
                        
                    );

                $saveData = DB::table($table_name)->insert($Data);

            }else{
                $Data ='';
            }

            
        }
            fclose ( $handle );
        }

        // print_r($path);exit;

       

        if ($saveData) {

				$request->session()->flash('alert-success', 'Import Data Successfully Added...!');
				return redirect('/finance/importfile');

			} else {

				$request->session()->flash('alert-error', 'Data Can Not Import...!');
				return redirect('/finance/importfile');

			}

       
    }


public function importData(Request $request){

      /*  $validate = $this->validate($request, [
                
                'table_name'  => 'required',
                'import_file' => 'required',
        ]);*/

        $CompanyName                = $request->session()->get('company_name');
    
        $macc_year                  = $request->session()->get('macc_year');

         $file = $request->file("import_file");

         $path = $file->getPathname();

            
        $table_name = $request->input("table_name");

        $data           =       array();
        $request->validate([
            "import_file" => "required",
        ]);

        $file = $request->file("import_file");
        $table_name = $request->input("table_name");
        $csvData = file_get_contents($file);
        //$table_name ='input_table';
       //print_r($csvData);exit;

        $path = $file->getPathname();

        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);
     //  print_r($rows);exit;
        foreach($rows as $row){

             if (isset($row[0])) {

                if ($row[0] != "") {
           
                   $row = array_combine($header, $row);

          if($table_name=='master_finance_acctypes'){
               
                    $Data = array(
                        "id"           => $row["id"],
                        "comp_name"    => $CompanyName,
                        "fiscal_year"  => $macc_year,
                        "acctype_code" => $row["code"],
                        "acctype_name" => $row["name"],
                       
                    );

             }else if($table_name='master_item_finance_temp'){

                $Data = array(
                        "id"             => $row["id"],
                        "comp_name"      => $CompanyName,
                        "fiscal_year"    => $macc_year,
                        "item_code"      => $row["item_code"],
                        "item_name"      => $row["item_name"],
                        "hsn_code"       => $row["hsn_code"],
                        "tax_code"       => $row["tax_code"],
                        "tax_type"       => $row["tax_type"],
                        "valuation_code" => $row["valuation_code"],
                        "item_detail"    => $row["item_detail"],
                        "item_type"      => $row["item_type"],
                        "item_group"     => $row["item_group"],
                        "item_class"     => $row["item_class"],
                        "item_category"  => $row["item_category"],
                        "item_sch"       => $row["item_sch"],
                        "um"             => $row["um"],
                        "aum"            => $row["aum"],
                       
                    );
            }else{

                $Data='';

            }
           

            $saveData = DB::table($table_name)->insert($Data);

            

                   }
               }                   
             
        }
}



function import2(Request $request)
    {

      $validate = $this->validate($request, [
                
                'table_name'  => 'required',
                'import_file' => 'required',
        ]);

     //$file = $request->file("import_file");
     $path = $request->file('import_file')->getRealPath();

     $data = Excel::import($path);

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'id'           => $row['id'],
         'acctype_code' => $row['acctype_code'],
         'acctype_name' => $row['acctype_name'],
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('master_finance_acctypes')->insert($insert_data);
      }
     }
     return back()->with('success', 'Excel Data Imported successfully.');
    }

    

}
