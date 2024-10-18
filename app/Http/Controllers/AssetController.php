<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use PDF;

class AssetController extends Controller{

    public function __construct(){

    }

    public function AssetSuccessMessage(Request $request,$getName){

       $transName = base64_decode($getName);

       if($transName == 'AssetTran'){

          $request->session()->flash('alert-success', 'Asset Is Successfully Saved...!');
            return redirect('/finance/transaction/asset/asset-transaction');
        }

    }

    public function AssetGroup(Request $request){

        $title = 'Asset Group';

        $getData['gl_list'] = DB::table('MASTER_GL')->get();


        return view('admin.finance.master.asset.master_asset_group',$getData+compact('title'));


    }

    public function AssetGroupSave(Request $request){

        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $validate = $this->validate($request, [

            'asset_group_code' => 'required|max:6|unique:MASTER_ASGROUP,ASGROUP_CODE',
            'asset_group_name' => 'required|max:30',
            'gl_code'          => 'required|max:6',
            'gl_dep_code'      => 'required|max:6',

        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');
        
        $newCrDate = date("Y-m-d ");

        $data = array(
                
                "ASGROUP_CODE" =>  $request->input('asset_group_code'),
                "ASGROUP_NAME"  =>  $request->input('asset_group_name'),
                "GL_CODE"       =>  $request->input('gl_code'),
                "GL_NAME"       =>  $request->input('gl_name'),
                "GL_DEP_CODE"   =>  $request->input('gl_dep_code'),
                "FLAG"          =>  $flag,
                "CREATED_BY"    =>  $userid,
                "CREATED_DATE"  =>  $newCrDate
     
            );

        $saveData = DB::table('MASTER_ASGROUP')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Asset Group Was Successfully Added...!');
            return redirect('Master/Asset/View-Asset-Group');

        } else {

            $request->session()->flash('alert-error', 'Asset Group Can Not Added...!');
            return redirect('Master/Asset/Asset-Group');

        }


    }


    

    public function ViewAssetGroup(Request $request){

        $title = 'List of Asset Group';

        if($request->ajax()) {


            $data = DB::table('MASTER_ASGROUP')->get()->toArray();

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset_group',compact('title'));


        }

    }


    public function AssetDeleteData(Request $request){
        
        $AssetCode = $request->input('AssetCode');
        // print_r($AssetCode);exit();

        $Link      = $request->input('AssetViewLink');
        
        $TblName   = $request->input('tblName');
        $TblName2  = $request->input('tblName2');
        // print_r($TblName2);exit();

        $del_remark = $request->input('del_remark');
        // $emp_code   = $request->input('EmpCode');
        
        $colName1   = $request->input('colName1');
        $colName2   = $request->input('colName2');
        $colName3   = $request->input('colName3');
        $colName4   = $request->input('colName4');
        $colName5   = $request->input('colName5');
        $colName6   = $request->input('colName6');
        

        $comp_code = $request->input('codeNameComp');
        
        $comp_fy   = $request->input('codeNameFy');
        
        $compName  = $request->session()->get('company_name');
        $userid   = $request->session()->get('userid');
        $compcode  = explode('-', $compName);


        if ($AssetCode!='') {

            // print_r('asset');
               
            // try{

            //     IF COMP CODE AND COMP CODE //
                if($comp_code && $comp_fy){

                   $compName  = $request->session()->get('company_name');
                   $compcode  = explode('-', $compName);
                   $comp_Code  = $compcode[0];
                   $fisYear  =  $request->session()->get('macc_year');

                   $getData = DB::table($TblName)->where($colName1, $AssetCode)->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->get()->toArray();
                   // print_r('if');exit();

                   $getInfo = array();
                   
                   foreach ($getData as $value) {

                    $getCode = $value->$colName1;
                    $getName = $value->$colName2;

                    if(isset($colName3)) {
                        $col3 = $value->$colName3;

                    }else{
                        $col3 = '';
                    }
                    if(isset($colName4)){
                        $col4 = $value->$colName4;
                    }else{
                        $col4 = '';
                    } 
                    if(isset($colName5)){
                        $col5 = $value->$colName5;
                    }else{
                        $col5 = '';
                    } 
                    if(isset($colName6)){
                        $col6 = $value->$colName6;
                    }else{
                        $col6 = '';
                    }

                    if($col3 == '' && $col4 == '' && $col5=='' && $col6 ==''){
                      $PARTICULAR = '--------';
                    }else{
                      $PARTICULAR = $col3.'~'.$col4.'~'.$col5.'~'.$col6;
                    }
                    
                    
                    $data1 = array(

                        "CODE"          => $getCode,
                        "NAME"          => $getName,
                        "PARTICULAR"    => $PARTICULAR,
                        "DELETE_REMARK" => $del_remark,
                        "DELETED_BY"    => $userid,

                    );

                    $saveData = DB::table('MASTER_USER_LOG')->insert($data1);
                 }
                    
                  $DeleteMast = DB::table($TblName)->where($colName1, $AssetCode)->where('COMP_CODE', $comp_Code)->where('FY_CODE', $fisYear)->delete();
                  
                  if($DeleteMast){

                        $request->session()->flash('alert-success', ' Data Was Deleted Successfully...!');
                        // return redirect($Link);

                        $response_array = array();

                        $response_array['response'] = 'success';
                        $data = json_encode($response_array);
                        print_r($data);


                  }else{

                        $request->session()->flash('alert-error', 'Data Can Not Be Deleted...!');
                        // return redirect($Link);
                        $response_array['response'] = 'errorif';
                        $data = json_encode($response_array);
                        print_r($data);

                  } 


                }else{

                    // print_r('else');exit();

                    // COMP CODE AND FY CODE NOT AVAILABLE

                    $getData = DB::table($TblName)->where($colName1, $AssetCode)->get()->toArray();
                    // print_r($getData);exit();
                    $getInfo = array();
                   
                   foreach ($getData as $value) {

                    $getCode = $value->$colName1;
                    // print_r($colName2);
                    $getName = $value->$colName2;

                     // print_r($getName);exit();
                   
                        if(isset($colName3)) {
                            $col3 = $value->$colName3;

                        }else{
                            $col3 = '';
                        }
                        if(isset($colName4)){
                            $col4 = $value->$colName4;
                        }else{
                            $col4 = '';
                        } 
                        if(isset($colName5)){
                            $col5 = $value->$colName5;
                        }else{
                            $col5 = '';
                        } 
                        if(isset($colName6)){
                            $col6 = $value->$colName6;
                        }else{
                            $col6 = '';
                        }

                        if($col3 == '' && $col4 == '' && $col5=='' && $col6 ==''){
                          $PARTICULAR = '--------';
                        }else{
                          $PARTICULAR = $col3.'~'.$col4.'~'.$col5.'~'.$col6;
                        }
                    
                    
                        $data1 = array(

                            "CODE"          => $getCode,
                            "NAME"          => $getName,
                            "PARTICULAR"    => $PARTICULAR,
                            "DELETE_REMARK" => $del_remark,
                            "DELETED_BY"    => $userid,

                        );

                        $saveData = DB::table('MASTER_USER_LOG')->insert($data1);
                     }
                    
                    $delwithoutComp = DB::table($TblName)->where($colName1, $AssetCode)->delete();
                
                    if($delwithoutComp){

                        if($TblName2){

                           $delete1 = DB::table($TblName2)->where($colName2, $AssetCode)->delete();

                           // $delete2 = DB::table($TblName3)->where($colName3, $AssetCode)->delete(); 

                           // $delete3 = DB::table($TblName4)->where($colName4, $AssetCode)->delete();

                           if($delete1){

                            $request->session()->flash('alert-success', ' Data Was Deleted Successfully...!');
                            // return redirect($Link);

                            $response_array = array();

                            $response_array['response'] = 'success';
                            $data = json_encode($response_array);
                            print_r($data);


                            }else{

                            $request->session()->flash('alert-error', 'Data Can Not Be Deleted...!');
                            // return redirect($Link);
                            $response_array['response'] = 'error1';
                            $data = json_encode($response_array);
                            print_r($data);

                           } 

                        }else{

                            $request->session()->flash('alert-success', ' Data Was Deleted Successfully...!');
                                // return redirect($Link);

                            $response_array = array();

                            $response_array['response'] = 'success';
                            $data = json_encode($response_array);
                            print_r($data);
                        }

                    }  
                }     

            // }catch(Exception $ex){

            //    $request->session()->flash('alert-error', 'Data Can Not Be Deleted...! Used In Another Transaction...!');
            //             // return redirect($Link);

            //    $response_array['response'] = 'error';
            //    $data = json_encode($response_array);
            //    print_r($data);
            // }


        }

    }

    public function DeleteMulTbl(Request $request){

        $AssetCode = $request->post('AssetCode');
        
        $Link      = $request->post('AssetViewLink');
        
        $TblName   = $request->post('tblNameArr');

        $countTbl  = count($TblName);
        $del_remark = $request->post('del_remark');
        
        $colName1   = $request->post('colName1');
        $colName2   = $request->post('colName2');
        $colName3   = $request->post('colName3');
        $colName4   = $request->post('colName4');
        $colName5   = $request->post('colName5');
        $colName6   = $request->post('colName6');
        

        $comp_code = $request->post('codeNameComp');
        
        $comp_fy   = $request->post('codeNameFy');
        
        $compName  = $request->session()->get('company_name');
        $userid   = $request->session()->get('userid');
        $compcode  = explode('-', $compName);
        // $companycode  = $compcode[0];
        $companycode  = 'MT01';
        $response_array = array();

        try{

        if($AssetCode != ''){

           if($comp_code && $comp_fy){

           }else{
             
             $getInfo = array();

            

                for($i=0;$i<$countTbl;$i++){

                    // print_r($TblName[$i]);

                    $getData = DB::table($TblName[$i])->where($colName1, $AssetCode)->get()->toArray();

                    foreach ($getData as $value) {

                        $getCode = $value->$colName1;
                        $getName = $value->$colName2;
                       
                            if(isset($colName3)) {
                                $col3 = $value->$colName3;

                            }else{
                                $col3 = '';
                            }
                            if(isset($colName4)){
                                $col4 = $value->$colName4;
                            }else{
                                $col4 = '';
                            } 
                            if(isset($colName5)){
                                $col5 = $value->$colName5;
                            }else{
                                $col5 = '';
                            } 
                            if(isset($colName6)){
                                $col6 = $value->$colName6;
                            }else{
                                $col6 = '';
                            }

                            if($col3 == '' && $col4 == '' && $col5=='' && $col6 ==''){
                              $PARTICULAR = '--------';
                            }else{
                              $PARTICULAR = $col3.'~'.$col4.'~'.$col5.'~'.$col6;
                            }
                        
                        
                            $data1 = array(

                                "CODE"          => $getCode,
                                "NAME"          => $getName,
                                "PARTICULAR"    => $PARTICULAR,
                                "DELETE_REMARK" => $del_remark,
                                "DELETED_BY"    => $userid,

                            );

                            $saveData = DB::table('MASTER_USER_LOG')->insert($data1);
                    }

                    $DeleteMast = DB::table($TblName[$i])->where($colName1, $AssetCode)->where('COMP_CODE', $companycode)->delete();

                    if($DeleteMast){
                        array_push($getInfo, $DeleteMast);
                    }
                }

                $countgetInfo = count($getInfo);
                // print_r($countgetInfo);exit();
                 // DB::commit();
                if($countgetInfo > 0){

                    DB::commit();

                    $request->session()->flash('alert-success', ' Data Was Deleted Successfully...!');

                    $response_array['response'] = 'success';
                    $data = json_encode($response_array);
                    print_r($data);

                }else{

                    // DB::rollBack();
                    //throw $e;
                    $request->session()->flash('alert-error', 'Data Can Not Be Deleted...! Used In Another Transaction...!');
                    $response_array['response'] = 'error';
                    $data = json_encode($response_array);
                    print_r($data);
                }

               }

            
          
          
        }

        }catch(Exception $e){

            
            DB::rollBack();
            $request->session()->flash('alert-error', 'Data Can Not Be Deleted...! Used In Another Transaction...!');
            //throw $e;
            $response_array['response'] = 'error';
            $data = json_encode($response_array);
            print_r($data);
          }


     
    }


    public function EditAssetGroup($id){

        $title = 'Update Asset Group';

        $id = base64_decode($id);
       
        if($id!=''){

            $query = DB::table('MASTER_ASGROUP');
            $query->where('ASGROUP_CODE', $id);
            $classData= $query->get()->first();

            $ASGROUP_CODE = $classData->ASGROUP_CODE;
            $ASGROUP_NAME = $classData->ASGROUP_NAME;
            $GL_CODE      = $classData->GL_CODE;
            $GL_NAME      = $classData->GL_NAME;
            $GL_DEP_CODE  = $classData->GL_DEP_CODE;

            $button='Update';
            $action='/finance/form-mast-item-class-update';

            $gl_list = DB::table('MASTER_GL')->get();

            return view('admin.finance.master.asset.master_edit_asset_group',compact('title','ASGROUP_CODE','ASGROUP_NAME','GL_CODE','GL_NAME','GL_DEP_CODE','button','action','gl_list'));
        }else{
            $request->session()->flash('alert-error', 'Config Not Found...!');
            return redirect('/finance/view-mast-item-class');
        }

    }


    public function UpdateAssetGroup(Request $request){


        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $ASGROUPCODE   = $request->input('asgroupCode');

        $validate = $this->validate($request, [

            'asset_group_code' => 'required|max:6',
            'asset_group_name' => 'required|max:30',
            'gl_code'          => 'required|max:6',
            'gl_dep_code'      => 'required|max:6',

        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d H:i:s");

        $data = array(
                
                "ASGROUP_CODE"     =>  $request->input('asset_group_code'),
                "ASGROUP_NAME"     =>  $request->input('asset_group_name'),
                "GL_CODE"          =>  $request->input('gl_code'),
                "GL_NAME"       =>  $request->input('gl_name'),
                "GL_DEP_CODE"      =>  $request->input('gl_dep_code'),
                "FLAG"             =>  $flag,
                "LAST_UPDATE_BY"   =>  $userid,
                "LAST_UPDATE_DATE" =>  $newCrDate
     
            );

        try{

            $UpdateData = DB::table('MASTER_ASGROUP')->where('ASGROUP_CODE',$ASGROUPCODE)->update($data);

            if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Group Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Group');

            } else {

                $request->session()->flash('alert-error', 'Asset Group Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Group');

            }

        }catch(Exception $ex){

            $request->session()->flash('alert-error', 'Asset Group Can Not Be Updated...! Used In Another Transaction...!');
                return redirect('Master/Asset/View-Asset-Group');
        }


    }

    public function AssetClass(Request $request){

        $title = 'Asset Class';

        $compDetails = $request->session()->get('company_name');

        $getData['gl_list'] = DB::table('MASTER_GL')->get();

        if($compDetails){

            return view('admin.finance.master.asset.master_asset_class',$getData+compact('title'));
        }else{
            return redirect('/useractivity');
        }


    }

    public function AssetClassSave(Request $request){

        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $validate = $this->validate($request, [

            'asset_class_code' => 'required|max:6|unique:MASTER_ASCLASS,ASCLASS_CODE',
            'asset_class_name' => 'required|max:30'

        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');
        
        $newCrDate = date("Y-m-d");

        $data = array(
                
                "ASCLASS_CODE" =>  $request->input('asset_class_code'),
                "ASCLASS_NAME"  =>  $request->input('asset_class_name'),
                "FLAG"          =>  $flag,
                "CREATED_BY"    =>  $userid,
                "CREATED_DATE"  =>  $newCrDate
     
            );

        $saveData = DB::table('MASTER_ASCLASS')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Asset Class Was Successfully Added...!');
            return redirect('Master/Asset/Asset-Class');

        } else {

            $request->session()->flash('alert-error', 'Asset Class Can Not Added...!');
            return redirect('Master/Asset/Asset-Class');

        }


    }


    public function ViewAssetClass(Request $request){

        $title = 'List of Asset Class';

        if($request->ajax()) {


            $data = DB::table('MASTER_ASCLASS')->get()->toArray();

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset_class',compact('title'));


        }

    }

    public function EditAssetClass($id){
       
        $title = 'Update Asset Class';
        
        $id = base64_decode($id);
         //print_r($id);exit();
        if($id!=''){

            $query = DB::table('MASTER_ASCLASS');
            $query->where('ASCLASS_CODE', $id);
            $classData= $query->get()->first();
             //print_r($classData);exit();
            $ASCLASS_CODE = $classData->ASCLASS_CODE;
            $ASCLASS_NAME = $classData->ASCLASS_NAME;
            $ASCLASS_BLOCK= $classData->ASCLASS_BLOCK;
            $FLAG         = $classData->FLAG;
           
          
              return view('admin.finance.master.asset.master_edit_asset_class',compact('title','ASCLASS_CODE','ASCLASS_NAME','ASCLASS_BLOCK','FLAG'));
           
           }else{
             $request->session()->flash('alert-error', 'Config Not Found...!');
             return redirect('/finance/view-mast-item-class');
           }

    }



    public function UpdateAssetClass(Request $request){


        $compName    = $request->session()->get('company_name');

        $fisYear     =  $request->session()->get('macc_year');

        $userid      = $request->session()->get('userid');

        $ASCLASSCODE = $request->input('asclassCode');

        $validate = $this->validate($request, [

            'asset_class_code' => 'required|max:6',
            'asset_class_name' => 'required|max:30'

        ]);

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d H:i:s");

        $data = array(
                
                "ASGROUP_CODE"     =>  $request->input('asset_class_code'),
                "ASGROUP_NAME"     =>  $request->input('asset_class_name'),
                "FLAG"             =>  $request->input('asset_class_block'),
                "LAST_UPDATE_BY"   =>  $userid,
                "LAST_UPDATE_DATE" =>  $newCrDate
     
            );
        //print_r($data);exit();
             $UpdateData = DB::table('MASTER_ASCLASS')->where('ASCLASS_CODE',$ASCLASSCODE)->update($data);
           if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Class Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Class');

            } else {

                $request->session()->flash('alert-error', 'Asset Class Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Class');

            }


        // try{

        //     $UpdateData = DB::table('MASTER_ASCLASS')->where('ASCLASS_CODE',$ASCLASSCODE)->update($data);

        //     if ($UpdateData) {

        //         $request->session()->flash('alert-success', 'Asset Class Was Successfully Update...!');
        //         return redirect('Master/Asset/View-Asset-Class');

        //     } else {

        //         $request->session()->flash('alert-error', 'Asset Class Can Not Be Update...!');
        //         return redirect('Master/Asset/View-Asset-Class');

        //     }

        // }catch(Exception $ex){

        //     $request->session()->flash('alert-error', 'Asset Class Can Not Be Updated...! Used In Another Transaction...!');
        //         return redirect('Master/Asset/View-Asset-Class');
        // }


    }


    public function AssetCategory(Request $request){

        $title = 'Asset Category';

        return view('admin.finance.master.asset.master_asset_category',compact('title'));


    }

    public function AssetCategorySave(Request $request){

        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $validate = $this->validate($request, [

            'asset_category_code' => 'required|max:6|unique:MASTER_ASCATG,ASCATG_CODE',
            'asset_category_name' => 'required|max:30'

        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d");

        $data = array(
                
                "ASCATG_CODE" =>  $request->input('asset_category_code'),
                "ASCATG_NAME"  =>  $request->input('asset_category_name'),
                "FLAG"          =>  $flag,
                "CREATED_BY"    =>  $userid,
                "CREATED_DATE"  =>  $newCrDate
     
            );

        $saveData = DB::table('MASTER_ASCATG')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Asset Category Was Successfully Added...!');
            return redirect('Master/Asset/Asset-Category');

        } else {

            $request->session()->flash('alert-error', 'Asset Category Can Not Added...!');
            return redirect('Master/Asset/Asset-Category');

        }


    }


    public function ViewAssetCategory(Request $request){

        $title = 'List of Asset Category';

        if($request->ajax()) {


            $data = DB::table('MASTER_ASCATG')->get()->toArray();

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset_category',compact('title'));


        }

    }

    public function EditAssetCategory($id){

        $title = 'Update Asset Category';

        $id = base64_decode($id);
       
        if($id!=''){

            $query = DB::table('MASTER_ASCATG');
            $query->where('ASCATG_CODE', $id);
            $classData= $query->get()->first();

            $ASCATG_CODE = $classData->ASCATG_CODE;
            $ASCATG_NAME = $classData->ASCATG_NAME;
            $ASCATG_BLOCK = $classData->ASCATG_BLOCK;
            $FLAG        = $classData->FLAG;
           

            return view('admin.finance.master.asset.master_edit_asset_category',compact('title','ASCATG_CODE','ASCATG_NAME','FLAG','ASCATG_BLOCK'));
        }else{
            $request->session()->flash('alert-error', 'Data Not Found...!');
            return redirect('Master/Asset/View-Asset-Category');
        }

    }


    public function UpdateAssetCategory(Request $request){


        $compName    = $request->session()->get('company_name');

        $fisYear     =  $request->session()->get('macc_year');

        $userid      = $request->session()->get('userid');

        $ASCATGCODE  = $request->input('asCategoryCode');

        $validate = $this->validate($request, [

            'asset_category_code' => 'required|max:6',
            'asset_category_name' => 'required|max:30'

        ]);

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d H:i:s");

        $data = array(
                
                "ASCATG_CODE"     =>  $request->input('asset_category_code'),
                "ASCATG_NAME"     =>  $request->input('asset_category_name'),
                "FLAG"             =>  $request->input('asset_category_block'),
                "LAST_UPDATE_BY"   =>  $userid,
                "LAST_UPDATE_DATE" =>  $newCrDate
     
            );

        try{

            $UpdateData = DB::table('MASTER_ASCATG')->where('ASCATG_CODE',$ASCATGCODE)->update($data);

            if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Category Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Category');

            } else {

                $request->session()->flash('alert-error', 'Asset Category Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Category');

            }

        }catch(Exception $ex){

            $request->session()->flash('alert-error', 'Asset Category Can Not Be Updated...! Used In Another Transaction...!');
                return redirect('Master/Asset/View-Asset-Category');
        }


    }

    /*Asset*/

    public function AssetMaster(Request $request){

        $title = 'Asset Master';

        $getData['plant_list'] = DB::table('MASTER_PLANT')->groupBy('PLANT_CODE')->get();
        $getData['pfct_list'] = DB::table('MASTER_PFCT')->get();
                
        $getData['asgroup_list'] = DB::table('MASTER_ASGROUP')->get();

        $getData['asclass_list'] = DB::table('MASTER_ASCLASS')->get();

        $getData['ascategory_list'] = DB::table('MASTER_ASCATG')->get();

        $getData['costcenter_list'] = DB::table('MASTER_COST')->get();
        
        $getData['gl_list'] = DB::table('MASTER_GL')->get();

        $getData['acc_list'] = DB::table('MASTER_ACC')->get();

        $getData['item_list'] = DB::table('MASTER_ITEM')->get();

        $dep_list = DB::table('MASTER_ASDEPRATE')->get();

    

       
        return view('admin.finance.master.asset.master_asset',$getData+compact('title','dep_list'));


    }

    public function AssetMasterSave(Request $request){

        $compName = $request->session()->get('company_name');

        $compcode      = explode('-', $compName);
        $getcompcode   =    $compcode[0];

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $validate = $this->validate($request, [

            'asset_code'      => 'required|max:6|unique:MASTER_ASSET,ASSET_CODE',
            'asset_name'      => 'required|max:30',
            'plant_code'      => 'required|max:6',
            'pfct_code'       => 'required|max:6',
            'asgroup_code'    => 'required|max:6',
            'asclass_code'    => 'required|max:6',
            'ascategory_code' => 'required|max:6',
            'asset_no'        => 'required|max:11',
            'gl_code'         => 'required|max:6',
            'dep_code'        => 'required|max:6',
            'pur_cod'         => 'required|max:11',
            'ASEOD'           => 'required|max:11',
            'location'        => 'required|max:30'
           
        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d");

        $purDt     = $request->input('pur_date');
        $newPurDt  = date("Y-m-d", strtotime($purDt));

        $purCod    = $request->input('pur_cod');
        $newPurCod = date("Y-m-d", strtotime($purCod));
        $aseod_dt  = $request->input('ASEOD');
        $aseodDt = date("Y-m-d", strtotime($aseod_dt));

        $data = array(
                
            "COMP_CODE"       =>  $getcompcode,
            "FY_CODE"         =>  $fisYear,
            "ASSET_CODE"      =>  $request->input('asset_code'),
            "ASSET_NAME"      =>  $request->input('asset_name'),
            "PLANT_CODE"      =>  $request->input('plant_code'),
            "PLANT_NAME"      =>  $request->input('plant_name'),
            "PFCT_CODE"       =>  $request->input('pfct_code'),
            "PTCF_NAME"       =>  $request->input('pfct_name'),
            "ASGROUP_CODE"    =>  $request->input('asgroup_code'),
            "ASGROUP_NAME"    =>  $request->input('asgroup_name'),
            "ASCLASS_CODE"    =>  $request->input('asclass_code'),
            "ASCLASS_NAME"    =>  $request->input('asclass_name'),
            "ASCATG_CODE"     =>  $request->input('ascategory_code'),
            "ASCATG_NAME"     =>  $request->input('ascategory_name'),
            "ASSET_NO"        =>  $request->input('asset_no'),
            "COST_CENTER"     =>  $request->input('cost_center'),
            "COST_CENTER_NAME"     =>  $request->input('cost_center_name'),
            "GL_CODE"         =>  $request->input('gl_code'),
            "GL_NAME"         =>  $request->input('gl_name'),
            "DEP_CODE"        =>  $request->input('dep_code'),
            "ITEM_CODE"       =>  $request->input('item_code'),
            "ITEM_NAME"       =>  $request->input('item_name'),
            "PUR_DATE"        =>  $newPurDt,
            "PUR_ACC_CODE"    =>  $request->input('acc_code'),
            "PUR_ACC_NAME"    =>  $request->input('acc_name'),
            "CAPITALIZE_DATE" =>  $newPurCod,
            "ASEOD_DATE"      =>  $aseodDt,
            "PUR_RATE"        =>  $request->input('pur_rate'),
            "PUR_AMT"         =>  $request->input('pur_amt'),
            "PUR_QTY"         =>  $request->input('pur_qty'),
            "LOCATION"        =>  $request->input('location'),
            "MFG"             =>  $request->input('as_mfg'),
            "MADE_IN"         =>  $request->input('as_madeIn'),
            "OLD_ASSET"       =>  $request->input('old_asset'),
            "FLAG"            =>  $flag,
            "CREATED_BY"      =>  $userid
     
        );

        $saveData = DB::table('MASTER_ASSET')->insert($data);

        // echo "<pre>";
        // print_r($data);
        // exit();

        $getVal = '0.00';

        $data1 = array(
                
            "COMP_CODE"  =>  $getcompcode,
            "FY_CODE"    =>  $fisYear,
            "ASSET_CODE" =>  $request->input('asset_code'),
            "YROPGB"     =>  $getVal,
            "YRDRGB"     =>  $getVal,
            "YRCRGB"     =>  $getVal,
            "YRCLGB"     =>  $getVal,
            "YROPDB"     =>  $getVal,
            "RYDRDB"     =>  $getVal,
            "YRCRDB"     =>  $getVal,
            "YRCLDB"     =>  $getVal,
            "YRCLNB"     =>  $getVal,
            "YROPNB"     =>  $getVal,
            "FLAG"       =>  $flag,
            "CREATED_BY" =>  $userid
     
        );

        
        $saveData1 = DB::table('MASTER_ASBAL')->insert($data1);

        if ($saveData && $saveData1) {

            $request->session()->flash('alert-success', 'Asset Was Successfully Added...!');
            return redirect('Master/Asset/Asset-Master');

        } else {

            $request->session()->flash('alert-error', 'Asset Can Not Added...!');
            return redirect('Master/Asset/Asset-Master');

        }


    }


    public function ViewAssetMaster(Request $request){

        $title = 'List of Asset Master';

        if($request->ajax()) {

            $compName = $request->session()->get('company_name');

            $compcode      = explode('-', $compName);
            $getcompcode   =    $compcode[0];

            $fisYear  =  $request->session()->get('macc_year');

            $data = DB::select("SELECT * FROM MASTER_ASSET WHERE COMP_CODE = '$getcompcode' AND FY_CODE = '$fisYear'");

            // print_r($data);exit();

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset',compact('title'));


        }

    }

    public function EditAssetMaster($id){

        $title = 'Update Asset Master';

        $id = base64_decode($id);
       
        if($id!=''){

            date_default_timezone_set('Asia/Kolkata');

            $query = DB::table('MASTER_ASSET');
            $query->where('ASSET_CODE', $id);
            $classData= $query->get()->first();

            $ASSET_CODE      = $classData->ASSET_CODE;
            $ASSET_NAME      = $classData->ASSET_NAME;
            $PLANT_CODE      = $classData->PLANT_CODE;
            $PLANT_NAME      = $classData->PLANT_NAME;
            $PFCT_CODE       = $classData->PFCT_CODE;
            $PTCF_NAME       = $classData->PTCF_NAME;
            $ASGROUP_CODE    = $classData->ASGROUP_CODE;
            $ASGROUP_NAME    = $classData->ASGROUP_NAME;
            $ASCLASS_CODE    = $classData->ASCLASS_CODE;
            $ASCLASS_NAME    = $classData->ASCLASS_NAME;
            $ASCATG_CODE     = $classData->ASCATG_CODE;
            $ASCATG_NAME      = $classData->ASCATG_NAME;
            $ASSET_NO        = $classData->ASSET_NO;
            $COST_CENTER     = $classData->COST_CENTER;
            $COST_CENTER_NAME     = $classData->COST_CENTER_NAME;
            $GL_CODE         = $classData->GL_CODE;
            $GL_NAME        = $classData->GL_NAME;
            $PURDATE        = $classData->PUR_DATE;
            $PUR_DATE = date("d-m-Y", strtotime($PURDATE));
            $PUR_ACC_CODE    = $classData->PUR_ACC_CODE;
            $PUR_ACC_NAME     = $classData->PUR_ACC_NAME;
            $CAPITALIZEDATE = $classData->CAPITALIZE_DATE;
            $CAPITALIZE_DATE = date("d-m-Y", strtotime($CAPITALIZEDATE));
            $ASEODDT      = $classData->ASEOD_DATE;
            $ASEODDATE       = date("d-m-Y", strtotime($ASEODDT));
            $PUR_RATE        = $classData->PUR_RATE;
            $PUR_AMT         = $classData->PUR_AMT;
            $PUR_QTY         = $classData->PUR_QTY;
            $LOCATION        = $classData->LOCATION;
            $MFG             = $classData->MFG;
            $MADE_IN         = $classData->MADE_IN;
            $OLD_ASSET       = $classData->OLD_ASSET;
            $DEP_CODE        = $classData->DEP_CODE;
            $ITEM_CODE       = $classData->ITEM_CODE;
            $ITEM_NAME        = $classData->ITEM_NAME;
            $FLAG            = $classData->FLAG;
            
            $getData['plant_list'] = DB::table('MASTER_PLANT')->get();
            $getData['pfct_list'] = DB::table('MASTER_PFCT')->get();
                    
            $getData['asgroup_list'] = DB::table('MASTER_ASGROUP')->get();

            $getData['asclass_list'] = DB::table('MASTER_ASCLASS')->get();

            $getData['ascategory_list'] = DB::table('MASTER_ASCATG')->get();

            $getData['costcenter_list'] = DB::table('MASTER_COST')->get();
            
            $getData['gl_list'] = DB::table('MASTER_GL')->get();

            $getData['acc_list'] = DB::table('MASTER_ACC')->get();

            $getData['item_list'] = DB::table('MASTER_ITEM')->get();

            $getData['dep_list'] = DB::table('MASTER_ASDEPRATE')->get();


            return view('admin.finance.master.asset.master_edit_asset',$getData+compact('title','ASSET_CODE','ASSET_NAME','PLANT_CODE','PFCT_CODE','PTCF_NAME','PLANT_NAME','ASGROUP_CODE','ASGROUP_NAME','ASCLASS_NAME','ASCLASS_CODE','ASCATG_CODE','ASCATG_NAME','ASSET_NO','COST_CENTER','COST_CENTER_NAME','GL_CODE','GL_NAME','PUR_DATE','PUR_ACC_CODE','PUR_ACC_NAME','CAPITALIZE_DATE','PUR_RATE','PUR_AMT','PUR_QTY','LOCATION','MFG','MADE_IN','OLD_ASSET','DEP_CODE','ITEM_CODE','ITEM_NAME','ASEODDATE','FLAG'));
        }else{
            $request->session()->flash('alert-error', 'Data Not Found...!');
            return redirect('Master/Asset/View-Asset-Master');
        }

    }


    public function UpdateAssetMaster(Request $request){


        $compName    = $request->session()->get('company_name');
        $compcode    = explode('-', $compName);
        $getcompcode =    $compcode[0];

        $fisYear     =  $request->session()->get('macc_year');

        $userid      = $request->session()->get('userid');

        $ASSETCODE   = $request->input('AssetCode');

        $validate = $this->validate($request, [

            'asset_code'      => 'required',
            'asset_name'      => 'required|max:30',
            'plant_code'      => 'required|max:6',
            'pfct_code'       => 'required|max:6',
            'asgroup_code'    => 'required|max:6',
            'asclass_code'    => 'required|max:6',
            'ascategory_code' => 'required|max:6',
            'asset_no'        => 'required|max:11',
            'gl_code'         => 'required|max:6',
            'dep_code'        => 'required|max:6',
            'pur_cod'         => 'required|max:11',
            'ASEOD'           => 'required|max:11',
            'location'        => 'required|max:30'
           
        ]);

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d");

        $newCrDate = date("Y-m-d");

        $purDt     = $request->input('pur_date');
        $newPurDt  = date("Y-m-d", strtotime($purDt));

        $purCod    = $request->input('pur_cod');
        $newPurCod = date("Y-m-d", strtotime($purCod));

        $ASEOD    = $request->input('ASEOD');
        $ASEODT = date("Y-m-d", strtotime($ASEOD));
        $lastUpDt  = date("Y-m-d H:i:s");

        $data = array(
                
            "COMP_CODE"       =>  $getcompcode,
            "FY_CODE"         =>  $fisYear,
            "ASSET_CODE"      =>  $request->input('asset_code'),
            "ASSET_NAME"      =>  $request->input('asset_name'),
            "PLANT_CODE"      =>  $request->input('plant_code'),
            "PLANT_NAME"      =>  $request->input('plant_name'),
            "PFCT_CODE"       =>  $request->input('pfct_code'),
            "PTCF_NAME"       =>  $request->input('pfct_name'),
            "ASGROUP_CODE"    =>  $request->input('asgroup_code'),
            "ASGROUP_NAME"    =>  $request->input('asgroup_name'), 
            "ASCLASS_CODE"    =>  $request->input('asclass_code'),
            "ASCLASS_NAME"    =>  $request->input('asclass_name'), 
            "ASCATG_CODE"     =>  $request->input('ascategory_code'),
            "ASCATG_NAME"     =>  $request->input('ascategory_name'), 
            "ASSET_NO"        =>  $request->input('asset_no'),
            "COST_CENTER"     =>  $request->input('cost_center'),
            "COST_CENTER_NAME"     =>  $request->input('cost_center_name'), 
            "GL_CODE"         =>  $request->input('gl_code'),
            "GL_NAME"         =>  $request->input('gl_name'), 
            "DEP_CODE"        =>  $request->input('dep_code'),
            "ITEM_CODE"       =>  $request->input('item_code'),
            "ITEM_NAME"       =>  $request->input('item_name'), 
            "PUR_DATE"        =>  $newPurDt,
            "PUR_ACC_CODE"    =>  $request->input('acc_code'),
            "PUR_ACC_NAME"    =>  $request->input('acc_name'), 
            "CAPITALIZE_DATE" =>  $newPurCod,
            "ASEOD_DATE"      =>  $ASEODT,
            "PUR_RATE"        =>  $request->input('pur_rate'),
            "PUR_AMT"         =>  $request->input('pur_amt'),
            "PUR_QTY"         =>  $request->input('pur_qty'),
            "LOCATION"        =>  $request->input('location'),
            "MFG"             =>  $request->input('as_mfg'),
            "MADE_IN"         =>  $request->input('as_madeIn'),
            "OLD_ASSET"       =>  $request->input('old_asset'),
            "FLAG"            =>  $request->input('asset_block'),
            "LAST_UPDATE_BY"  =>  $userid,
            "LAST_UPDATE_DATE"=>  $lastUpDt
     
        );

        // echo '<PRE>';print_r($data);exit();

        try{

            $UpdateData = DB::table('MASTER_ASSET')->where('ASSET_CODE',$ASSETCODE)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($data);

            if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Master');

            } else {

                $request->session()->flash('alert-error', 'Asset Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Master');

            }

        }catch(Exception $ex){

            $request->session()->flash('alert-error', 'Asset Can Not Be Updated...! Used In Another Transaction...!');
                return redirect('Master/Asset/View-Asset-Master');
        }


    }


    public function AssetDepreciationMaster(Request $request){

        $title = 'Asset Depreciation';

        $getData['asgroup_list'] = DB::table('MASTER_ASGROUP')->get();

        return view('admin.finance.master.asset.master_asset_depreciation',$getData+compact('title'));


    }

    public function AssetDepreciationMasterSave(Request $request){

        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $validate = $this->validate($request, [

            'asset_dep_code' => 'required|max:6|unique:MASTER_ASDEPRATE,DEP_CODE',
            'group_code'       => 'required|max:6',
            'from_dt'          => 'required|max:10',
            'to_dt'            => 'required|max:10',
            'dep_rate'         => 'required|max:9'

        ]);

        $flag = 1;

        date_default_timezone_set('Asia/Kolkata');

        $fmDt    = $request->input('from_dt');
        $from_dt = date("Y-m-d", strtotime($fmDt));

        $toDt    = $request->input('to_dt');
        $to_dt = date("Y-m-d", strtotime($toDt));


        $data = array(
                
            "DEP_CODE"     =>  $request->input('asset_dep_code'),
            "ASGROUP_CODE" =>  $request->input('group_code'),
            "ASGROUP_NAME" =>  $request->input('group_name'),
            "FROM_DATE"    =>  $from_dt,
            "TO_DATE"      =>  $to_dt,
            "DEP_RATE"     =>  $request->input('dep_rate'),
            "FLAG"         =>  $flag,
            "CREATED_BY"   =>  $userid
            
        );

        $saveData = DB::table('MASTER_ASDEPRATE')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Asset Depreciation Was Successfully Added...!');
            return redirect('Master/Asset/Asset-Dep-Rate-Master');

        } else {

            $request->session()->flash('alert-error', 'Asset Depreciation Can Not Added...!');
            return redirect('Master/Asset/Asset-Dep-Rate-Master');

        }


    }


    

    public function ViewAssetDepreciationMaster(Request $request){

        $title = 'List of Asset Depreciation';

        if($request->ajax()) {


            $data = DB::select("SELECT MASTER_ASDEPRATE.*,MASTER_ASGROUP.ASGROUP_NAME FROM MASTER_ASDEPRATE,MASTER_ASGROUP WHERE MASTER_ASDEPRATE.ASGROUP_CODE = MASTER_ASGROUP.ASGROUP_CODE");

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset_depreciation',compact('title'));


        }

    }

    public function EditAssetDepreciationMaster($id){

        $title = 'Update Asset Depreciation';

        $id = base64_decode($id);
       
        if($id!=''){

            date_default_timezone_set('Asia/Kolkata');

            $query = DB::table('MASTER_ASDEPRATE');
            $query->where('DEP_CODE', $id);
            $classData= $query->get()->first();

            $ASGROUP_CODE = $classData->ASGROUP_CODE;
            $ASGROUP_NAME = $classData->ASGROUP_NAME;
            $FROMDATE     = $classData->FROM_DATE;
            $FROM_DATE    = date("d-m-Y", strtotime($FROMDATE));
            $TODATE       = $classData->TO_DATE;
            $TO_DATE      = date("d-m-Y", strtotime($TODATE));
            $DEP_RATE   = $classData->DEP_RATE;
            $DEP_CODE   = $classData->DEP_CODE;
            $BLOCK_ASDEP = $classData->BLOCK_ASDEP;
            $FLAG         = $classData->FLAG;

             $getData['asgroup_list'] = DB::table('MASTER_ASGROUP')->get();

            return view('admin.finance.master.asset.master_edit_asset_depreciation',$getData+compact('title','ASGROUP_CODE','ASGROUP_NAME','FROM_DATE','TO_DATE','DEP_RATE','DEP_CODE','BLOCK_ASDEP','FLAG'));
        }else{
            $request->session()->flash('alert-error', 'Data Not Found...!');
            return redirect('Master/Asset/View-Asset-Dep-Rate-Master');
        }

    }


    public function UpdateAssetDepreciationMaster(Request $request){


        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $ASDEPCODE= $request->input('asdepcode');

        $validate = $this->validate($request, [

            'asset_dep_code' => 'required|max:6',
            'group_code'     => 'required|max:6',
            'from_dt'        => 'required|max:10',
            'to_dt'          => 'required|max:10',
            'dep_rate'       => 'required|max:9'

        ]);

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d H:i:s");
        
        $fmDt      = $request->input('from_dt');
        $from_dt   = date("Y-m-d", strtotime($fmDt));

        $toDt      = $request->input('to_dt');
        $to_dt     = date("Y-m-d", strtotime($toDt));


        $data = array(
                
            "DEP_CODE"       =>  $request->input('asset_dep_code'),
            "ASGROUP_CODE"     =>  $request->input('group_code'),
            "ASGROUP_NAME"     =>  $request->input('group_name'),
            "FROM_DATE"        =>  $from_dt,
            "TO_DATE"          =>  $to_dt,
            "DEP_RATE"       =>  $request->input('dep_rate'),
            "FLAG"             =>  $request->input('asset_dep_block'),
            "LAST_UPDATE_BY"   =>  $userid,
            "LAST_UPDATE_DATE" =>  $newCrDate
            
        );

        try{

            $UpdateData = DB::table('MASTER_ASDEPRATE')->where('DEP_CODE',$ASDEPCODE)->update($data);

            if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Depreciation Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Dep-Rate-Master');

            } else {

                $request->session()->flash('alert-error', 'Asset Depreciation Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Dep-Rate-Master');

            }

        }catch(Exception $ex){

            $request->session()->flash('alert-error', 'Asset Depreciation Can Not Be Updated...! Used In Another Transaction...!');
                return redirect('Master/Asset/View-Asset-Dep-Rate-Master');
        }


    }


    public function AssetBalanceMaster(Request $request){

        $title = 'Asset Balance';

        $compName    = $request->session()->get('company_name');
        $compcode    = explode('-', $compName);
        $getcompcode =    $compcode[0];

        $fisYear     =  $request->session()->get('macc_year');

        $getData['asset_list'] = DB::table('MASTER_ASSET')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

        $getData['comp_list'] = DB::table('MASTER_COMP')->get();

        $getData['fy_list'] = DB::table('MASTER_FY')->groupBy('FY_CODE')->get();
        // echo '<PRE>';print_r($getData['asset_list']);exit();
        if($compName){
          return view('admin.finance.master.asset.master_asset_balance',$getData+compact('title'));
        }else{
            return redirect('/useractivity');
        }

    }

    public function AssetBalanceMasterSave(Request $request){

        $compName = $request->session()->get('company_name');

        $fisYear  =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $rules = [  
                    'comp_code'  => 'required|max:6',
                    'fy_code'    => 'required|max:9',
                    'asset_code' => 'required|max:6',
                    'comp_code'  => ['required', 'string',Rule::unique('MASTER_ASBAL')->where(function ($query) use ($request) {
                        return $query->where('COMP_CODE', $request->comp_code)->where('FY_CODE', $request->fy_code)->where('ASSET_CODE', $request->asset_code);
                            })],
                ];

                $customMessages = [
                    'comp_code.unique'=>'The Comp code has already been taken for this <b><u> FY code and Asset code</u></b>',
                ];

                $this->validate($request, $rules, $customMessages);


        $flag = 1;

        $data = array(
                
            "COMP_CODE"  =>  $request->input('comp_code'),
            "COMP_NAME"  =>  $request->input('comp_name'),
            "FY_CODE"    =>  $request->input('fy_code'),
            "ASSET_CODE" =>  $request->input('asset_code'),
            "ASSET_NAME" =>  $request->input('asset_name'),
            "YROPGB"     =>  $request->input('YROPGB'),
            "YRDRGB"     =>  $request->input('YRDRGB'),
            "YRCRGB"     =>  $request->input('YRCRGB'),
            "YRCLGB"     =>  $request->input('YRCLGB'),
            "YROPDB"     =>  $request->input('YROPDB'),
            "RYDRDB"     =>  $request->input('RYDRDB'),
            "YRCRDB"     =>  $request->input('YRCRDB'),
            "YRCLDB"     =>  $request->input('YRCLDB'),
            "YRCLNB"     =>  $request->input('YRCLNB'),
            "YROPNB"     =>  $request->input('YROPNB'),
            "FLAG"       =>  $flag,
            "CREATED_BY" =>  $userid
            
            
        );

        $saveData = DB::table('MASTER_ASBAL')->insert($data);

        if ($saveData) {

            $request->session()->flash('alert-success', 'Asset Balance Was Successfully Added...!');
            return redirect('Master/Asset/View-Asset-Balance-Master');

        } else {

            $request->session()->flash('alert-error', 'Asset Balance Can Not Added...!');
            return redirect('Master/Asset/View-Asset-Balance-Master');

        }


    }


    

    public function ViewAssetBalanceMaster(Request $request){


        $title = 'List of Asset Balance';

        if($request->ajax()) {

            $compName    = $request->session()->get('company_name');
            $compcode    = explode('-', $compName);
            $getcompcode =    $compcode[0];

            $fisYear     =  $request->session()->get('macc_year');

            $data = DB::select("
                SELECT * FROM MASTER_ASBAL WHERE MASTER_ASBAL.COMP_CODE = '$getcompcode' AND MASTER_ASBAL.FY_CODE = '$fisYear'");


            // print_r($data);
            // exit();

            return DataTables()->of($data)->addIndexColumn()->toJson();


        }else{


            return view('admin.finance.master.asset.master_view_asset_balance',compact('title'));


        }

    }

    public function EditAssetBalanceMaster($id,$compCode,$fyCode){

        $title = 'Update Asset Balance';

        $id = base64_decode($id);
        $compCode = base64_decode($compCode);
        $fyCode = base64_decode($fyCode);
       
        if($id!=''){

            $query = DB::table('MASTER_ASBAL');
            $query->where('ASSET_CODE', $id);
            $query->where('FY_CODE', $fyCode);
            $query->where('COMP_CODE', $compCode);
            $classData= $query->get()->first();
            
            $COMP_CODE  = $classData->COMP_CODE;
            $COMP_NAME  = $classData->COMP_NAME;
            $FY_CODE    = $classData->FY_CODE;
            $ASSET_CODE = $classData->ASSET_CODE;
            $ASSET_NAME = $classData->ASSET_NAME;
            $YROPGB     = $classData->YROPGB;
            $YRDRGB     = $classData->YRDRGB;
            $YRCRGB     = $classData->YRCRGB;
            $YRCLGB     = $classData->YRCLGB;
            $YROPDB     = $classData->YROPDB;
            $RYDRDB     = $classData->RYDRDB;
            $YRCRDB     = $classData->YRCRDB;
            $YRCLDB     = $classData->YRCLDB;
            $YRCLNB     = $classData->YRCLNB;
            $YROPNB     = $classData->YROPNB;
            $FLAG       = $classData->FLAG;
            

            $getData['asset_list'] = DB::table('MASTER_ASSET')->get();

            $getData['comp_list'] = DB::table('MASTER_COMP')->get();

            $getData['fy_list'] = DB::table('MASTER_FY')->get();

            return view('admin.finance.master.asset.master_edit_asset_balance',$getData+compact('title','COMP_CODE','COMP_NAME','FY_CODE','ASSET_CODE','ASSET_NAME','YROPGB','YRDRGB','YRCRGB','YRCLGB','YROPDB','RYDRDB','YRCRDB','YRCLDB','YRCLNB','YROPNB','FLAG'));
        }else{
            $request->session()->flash('alert-error', 'Data Not Found...!');
            return redirect('Master/Asset/View-Asset-Dep-Rate-Master');
        }

    }


    public function UpdateAssetBalanceMaster(Request $request){

        $compName    = $request->session()->get('company_name');
        $compcode    = explode('-', $compName);
        $getcompcode =    $compcode[0];
        $fisYear     =  $request->session()->get('macc_year');

        $userid   = $request->session()->get('userid');

        $COMPCODE  = $request->input('compCode');
        $FYCODE    = $request->input('fyCode');
        $ASSETCODE = $request->input('assetCode');

        $validate = $this->validate($request, [

            'comp_code'  => 'required|max:6',
            'fy_code'    => 'required|max:9',
            'asset_code' => 'required|max:6'

        ]);

        date_default_timezone_set('Asia/Kolkata');

        $newCrDate = date("Y-m-d H:i:s");
       
        $data = array(
                
            "COMP_CODE"  =>  $request->input('comp_code'),
            "COMP_NAME"  =>  $request->input('comp_name'),
            "FY_CODE"    =>  $request->input('fy_code'),
            "ASSET_CODE" =>  $request->input('asset_code'),
            "ASSET_NAME" =>  $request->input('asset_name'),
            "YROPGB"     =>  $request->input('YROPGB'),
            "YRDRGB"     =>  $request->input('YRDRGB'),
            "YRCRGB"     =>  $request->input('YRCRGB'),
            "YRCLGB"     =>  $request->input('YRCLGB'),
            "YROPDB"     =>  $request->input('YROPDB'),
            "RYDRDB"     =>  $request->input('RYDRDB'),
            "YRCRDB"     =>  $request->input('YRCRDB'),
            "YRCLDB"     =>  $request->input('YRCLDB'),
            "YRCLNB"     =>  $request->input('YRCLNB'),
            "YROPNB"     =>  $request->input('YROPNB'),
            "FLAG"       =>  $request->input('asset_bal_block'),
            "LAST_UPDATE_BY" =>  $userid,
            "LAST_UPDATE_DATE" =>  $newCrDate
            
        );
        //print_r($data);exit();
         $UpdateData = DB::table('MASTER_ASBAL')->where('COMP_CODE',$COMPCODE)->where('FY_CODE',$FYCODE)->where('ASSET_CODE',$ASSETCODE)->update($data);

            if ($UpdateData) {

                $request->session()->flash('alert-success', 'Asset Balance Was Successfully Update...!');
                return redirect('Master/Asset/View-Asset-Balance-Master');

            } else {

                $request->session()->flash('alert-error', 'Asset Balance Can Not Be Update...!');
                return redirect('Master/Asset/View-Asset-Balance-Master');

            }

        // try{

        //     $UpdateData = DB::table('MASTER_ASBAL')->where('COMP_CODE',$COMPCODE)->where('FY_CODE',$FYCODE)->where('ASSET_CODE',$ASSETCODE)->update($data);

        //     if ($UpdateData) {

        //         $request->session()->flash('alert-success', 'Asset Balance Was Successfully Update...!');
        //         return redirect('Master/Asset/View-Asset-Balance-Master');

        //     } else {

        //         $request->session()->flash('alert-error', 'Asset Balance Can Not Be Update...!');
        //         return redirect('Master/Asset/View-Asset-Balance-Master');

        //     }

        // }catch(Exception $ex){

        //     $request->session()->flash('alert-error', 'Asset Balance Can Not Be Updated...! Used In Another Transaction...!');
        //         return redirect('Master/Asset/View-Asset-Balance-Master');
        // }


    }

    public function getGlfromGroupCode(Request $request){

        if($request->ajax()) {

            $ASGROUPCODE = $request->input('ASGROUPCODE');

           /* $asgroupdata = DB::table('MASTER_ASGROUP')->where('ASGROUP_CODE',$ASGROUPCODE)->get();*/

           $asgroupdata = DB::select("SELECT MASTER_ASGROUP.*,MASTER_GL.GL_NAME FROM MASTER_ASGROUP,MASTER_GL WHERE MASTER_ASGROUP.GL_CODE = MASTER_GL.GL_CODE AND MASTER_ASGROUP.ASGROUP_CODE = '$ASGROUPCODE'");

           if ($asgroupdata!='') {

                $response_array['response']    = 'success';
                $response_array['message']     = '';
                $response_array['data']        = $asgroupdata;
                
                $data = json_encode($response_array);
                print_r($data);

            }else{

                $response_array['response'] = 'error';
                $response_array['message']     = 'GL Not Found...!';
                $response_array['data']     = '' ;
                $data = json_encode($response_array);
                print_r($data);
                
            }

        }else{


        return view('admin.finance.master.asset.master_asset');


        }

    }

    /*AssetTransaction
ViewAssetTransaction*/

    public function AssetTransaction(Request $request){

        $title = 'Asset Transaction';

        $compName    = $request->session()->get('company_name');
        $compcode    = explode('-', $compName);
        $getcompcode =    $compcode[0];
        $fisYear     =  $request->session()->get('macc_year');

        $getData['asset_list'] = DB::table('MASTER_ASSET')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

        $YRBEGDT = $request->session()->get('yrbgdate');

        $exp = explode('-', $YRBEGDT);

        if (isset($exp[1])) {
            $MM = $exp[1];
            $YY = $exp[2];
        }else{
            $MM = 00;
            $YY = 0000;
        }

        

        $YRBEGDATE = $MM.'-'.$YY;

        $YRENDDT = $request->session()->get('yrenddate');

        $expl = explode('-', $YRENDDT);

        

        if (isset($expl[1])) {
            $MMM = $expl[1];
            $YYY = $expl[2];
        }else{
            $MMM = 00;
            $YYY = 0000;
        }

        $YRENDDATE = $MMM.'-'.$YYY;

        return view('admin.finance.transaction.asset.asset_transaction',$getData+compact('title','YRBEGDATE','YRENDDATE'));

    }

    public function getDataAssetDepTran(Request $request){
        if($request->ajax()){

            $compName    = $request->session()->get('company_name');
            $compcode    = explode('-', $compName);
            $getcompcode = $compcode[0];
            $fisYear     = $request->session()->get('macc_year');
            $userid      = $request->session()->get('userid');
            $ajxCode     = $request->input('ajxCode');
            $MMYY        = $request->input('mmYY');
            $exp         = explode('-',$MMYY);
            $mm          = $exp[0];
            $yy          = $exp[1];
            
            $Fday        = '01';
            $Lday        = '30';
            $FirstDate   = $yy.'-'.$mm.'-'.$Fday;
            $LastDate    = date('Y-m-t',strtotime($FirstDate));
            
            if ($ajxCode == 101) {

                if ($mm == 01) {

                    $newmm = 12;
                    $NewMmYy = $newmm.'-'.$yy;

                }else if($mm == 04){

                    $NewMmYy = $mm.'-'.$yy;

                }else{
                    $zero = 0;
                    $newMonth = $mm - 1;
                    $NewMmYy = $zero.$newMonth.'-'.$yy;

                }
               // DB::enableQueryLog();
                $ASDEPTRANTBL1 = DB::table('ASDEP_TRAN')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('YR_MM',$NewMmYy)->get();
                $ASDEPTRANTBL = json_decode( json_encode($ASDEPTRANTBL1), true);
                //dd(DB::getQueryLog());
                $TBLCOUNT = count($ASDEPTRANTBL);

                if ($TBLCOUNT > 0) {

                    $existMM =  $ASDEPTRANTBL[0]['YR_MM'];
                    $splimY = explode('-', $existMM);

                    $yearM = $mm.'-'.$yy;

                    $currentMD = DB::table('ASDEP_TRAN')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->where('YR_MM',$yearM)->get();

                    if(isset($currentMD[0]->POST_AMT)){
                        $postAmt = $currentMD[0]->POST_AMT;
                    }else{
                        $postAmt = 0.000;
                    }

                    

                    if($splimY[0] == $mm){
                        $response_array['response'] = 'AlreadyExist';
                        $response_array['data'] = $ASDEPTRANTBL;
                        $data = json_encode($response_array);
                        print_r($data);
                    }else{

                        if($postAmt != 0.000){
                            $response_array['response'] = 'AlreadyExist';
                            $response_array['data'] = $currentMD;
                            $data = json_encode($response_array);
                            print_r($data);
                        }else{
                            $response_array['response'] = 'success';
                            $response_array['data'] = '';
                            $data = json_encode($response_array);
                            print_r($data); 
                        }
                        
                    }
                    
                }else{

                    if(($mm == 04)){

                        $response_array['response'] = 'success';
                        $response_array['data'] = '';
                        $data = json_encode($response_array);
                        print_r($data);

                    }else{
                        $response_array['response'] = 'error';
                        $response_array['data'] = '';
                        $data = json_encode($response_array);
                        print_r($data);
                    }

                }
            }else if($ajxCode == 103){

                    if(($mm == 04)){

                        $response_array['response'] = 'success';
                        $response_array['data'] = '';
                        $data = json_encode($response_array);
                        print_r($data);

                    }else{
                        $response_array['response'] = 'successM';
                        $response_array['data'] = '';
                        $data = json_encode($response_array);
                        print_r($data);
                    }

                    
            }else{

                if(($mm == 04)){

                    $data = DB::select("SELECT T.ASGROUP_CODE,T.ASSET_CODE, T.ASSET_NAME,T.ASSET_NO,T.CAPITALIZE_DATE,T.COST_CENTER,T.PFCT_CODE,T.PARTICULAR, T.DEP_CODE,assetval, T.DEP_RATE,ROUND(SUM(T.PLAN_AMT),3) AS PLANAMT, ROUND(SUM(T.POST_AMT),3) AS POSTAMT, ROUND(SUM(T.TBP_AMT),3) AS TBPAMT, ROUND(SUM(T.POST_AMT)+SUM(T.TBP_AMT),3) AS CUM_AMT FROM
                      (SELECT A.ASGROUP_CODE,A.ASSET_CODE, A.ASSET_NAME,A.ASSET_NO,A.CAPITALIZE_DATE,A.COST_CENTER,A.PFCT_CODE,'' AS PARTICULAR, D.DEP_CODE,B.YROPGB+B.YRDRGB-B.YRCRGB as assetval, D.DEP_RATE,0 AS PLAN_AMT, 0 AS POST_AMT, ((B.YROPGB+B.YRDRGB-B.YRCRGB)*D.DEP_RATE/100/12) AS TBP_AMT, 0 AS CUM_AMT from MASTER_ASSET A, MASTER_ASBAL B, MASTER_ASDEPRATE D WHERE B.ASSET_CODE = A.ASSET_CODE AND B.FY_CODE = '$fisYear' AND A.ASGROUP_CODE = D.ASGROUP_CODE AND A.CAPITALIZE_DATE <= '$FirstDate' AND A.ASEOD_DATE > '$LastDate' AND ('$FirstDate' BETWEEN D.FROM_DATE AND D.TO_DATE)
                            UNION ALL
                         SELECT '' AS ASGROUP_CODE,ASSET_CODE, '' AS ASSET_NAME, '' AS ASSET_NO, '' AS CAPITALIZE_DATE, '' AS COST_CENTER, '' AS PFCT_CODE, '' AS PARTICULAR, '' AS DEP_CODE,0 as assetval,0 AS DEP_RATE, SUM(PLAN_AMT), SUM(POST_AMT), 0 AS TBP_AMT, SUM(POST_AMT)+TBP_AMT AS CUM_AMT from ASDEP_TRAN WHERE FY_CODE='$fisYear' GROUP BY ASSET_CODE) T
                            GROUP BY T.ASSET_CODE");

                    return DataTables()->of($data)->addIndexColumn()->toJson();

                }else if($mm != 04){
                    $data = DB::select("SELECT T.ASGROUP_CODE,T.ASSET_CODE, T.ASSET_NAME,T.ASSET_NO,T.CAPITALIZE_DATE,T.COST_CENTER,T.PFCT_CODE,T.PARTICULAR, T.DEP_CODE,assetval, T.DEP_RATE,ROUND(SUM(T.PLAN_AMT),3) AS PLANAMT, ROUND(SUM(T.POST_AMT),3) AS POSTAMT, ROUND(SUM(T.TBP_AMT),3) AS TBPAMT, ROUND(SUM(T.POST_AMT)+SUM(T.TBP_AMT),3) AS CUM_AMT FROM
                      (SELECT A.ASGROUP_CODE,A.ASSET_CODE, A.ASSET_NAME,A.ASSET_NO,A.CAPITALIZE_DATE,A.COST_CENTER,A.PFCT_CODE,'' AS PARTICULAR, D.DEP_CODE,B.YROPGB+B.YRDRGB-B.YRCRGB as assetval, D.DEP_RATE,0 AS PLAN_AMT, 0 AS POST_AMT, ((B.YROPGB+B.YRDRGB-B.YRCRGB)*D.DEP_RATE/100/12) AS TBP_AMT, 0 AS CUM_AMT from MASTER_ASSET A, MASTER_ASBAL B, MASTER_ASDEPRATE D WHERE B.ASSET_CODE = A.ASSET_CODE AND B.FY_CODE = '$fisYear' AND A.ASGROUP_CODE = D.ASGROUP_CODE AND A.CAPITALIZE_DATE <= '$FirstDate' AND A.ASEOD_DATE > '$LastDate' AND ('$FirstDate' BETWEEN D.FROM_DATE AND D.TO_DATE)
                            UNION ALL
                         SELECT '' AS ASGROUP_CODE,ASSET_CODE, '' AS ASSET_NAME, '' AS ASSET_NO, '' AS CAPITALIZE_DATE, '' AS COST_CENTER, '' AS PFCT_CODE, '' AS PARTICULAR, '' AS DEP_CODE,0 as assetval,0 AS DEP_RATE, SUM(PLAN_AMT), SUM(POST_AMT), 0 AS TBP_AMT, SUM(POST_AMT)+TBP_AMT AS CUM_AMT from ASDEP_TRAN WHERE FY_CODE='$fisYear' GROUP BY ASSET_CODE) T
                            GROUP BY T.ASSET_CODE");

                    return DataTables()->of($data)->addIndexColumn()->toJson();
                }else{

                    $data = array();
                    return DataTables()->of($data)->addIndexColumn()->toJson();
                }

            }

        }
    }


    public function SaveAssetPlanAmt(Request $request){


            $MMYY        = $request->input('mmYY');
            $exp = explode('-',$MMYY);
            $mm = $exp[0];
            $yy = $exp[1];

            $BTNNAME     = $request->input('nameBtn');

            $compName    = $request->session()->get('company_name');
            $compcode    = explode('-', $compName);
            $getcompcode =    $compcode[0];
            $fisYear     =  $request->session()->get('macc_year');
            $userid      = $request->session()->get('userid');

            $getData     = DB::table('ASDEP_TRAN')->where('YR_MM',$MMYY)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

            $getCount = count($getData);

            $Fday = '01';
            $FirstDate = $yy.'-'.$mm.'-'.$Fday;
            $LastDate = date('Y-m-t',strtotime($FirstDate));;

            $response_array = [];


            if ($getCount > 0) {

                $strWhere = '';

                if(isset($MMYY) && trim($MMYY)!=""){
                  
                    $strWhere .= " AND  T.YR_MM = '".$MMYY."'";

                }

                $data = DB::select("SELECT T.COMPCODE,T.FYCODE,T.ASGROUP_CODE,T.ASSET_CODE, T.ASSET_NAME,T.ASSET_NO,T.CAPITALIZE_DATE,T.COST_CENTER,T.GL_CODE,T.PLANT_CODE,T.PFCT_CODE,T.PARTICULAR, T.DEP_CODE,assetval, T.DEP_RATE,ROUND(SUM(T.PLAN_AMT),3) AS PLANAMT, ROUND(SUM(T.POST_AMT),3) AS POSTAMT, ROUND(SUM(T.TBP_AMT),3) AS TBPAMT, ROUND(SUM(T.POST_AMT)+SUM(T.TBP_AMT),3) AS CUM_AMT FROM
              (SELECT A.COMP_CODE AS COMPCODE,A.FY_CODE AS FYCODE,A.ASGROUP_CODE,A.ASSET_CODE, A.ASSET_NAME,A.ASSET_NO,A.CAPITALIZE_DATE,A.COST_CENTER,A.GL_CODE,A.PLANT_CODE,A.PFCT_CODE,'' AS PARTICULAR, D.DEP_CODE,B.YROPGB+B.YRDRGB-B.YRCRGB as assetval, D.DEP_RATE,0 AS PLAN_AMT, 0 AS POST_AMT, ((B.YROPGB+B.YRDRGB-B.YRCRGB)*D.DEP_RATE/100/12) AS TBP_AMT, 0 AS CUM_AMT from MASTER_ASSET A, MASTER_ASBAL B, MASTER_ASDEPRATE D WHERE B.ASSET_CODE = A.ASSET_CODE AND B.FY_CODE = '$fisYear' AND A.ASGROUP_CODE = D.ASGROUP_CODE AND A.CAPITALIZE_DATE <= '$FirstDate' AND A.ASEOD_DATE > '$LastDate' AND ('$FirstDate' BETWEEN D.FROM_DATE AND D.TO_DATE)
                    UNION ALL
                 SELECT '' AS COMPCODE, '' AS FYCODE, '' AS ASGROUP_CODE,ASSET_CODE, '' AS ASSET_NAME, '' AS ASSET_NO, '' AS CAPITALIZE_DATE, '' AS COST_CENTER,'' AS GL_CODE,'' AS PLANT_CODE, '' AS PFCT_CODE, '' AS PARTICULAR, '' AS DEP_CODE,0 as assetval,0 AS DEP_RATE, SUM(PLAN_AMT), SUM(POST_AMT), 0 AS TBP_AMT, SUM(POST_AMT)+TBP_AMT AS CUM_AMT from ASDEP_TRAN WHERE FY_CODE='$fisYear' GROUP BY ASSET_CODE) T
                    GROUP BY T.ASSET_CODE");

                $ASDEPDATA = json_decode(json_encode($getData), true); 

                if ($BTNNAME == 'planBtn') {


                    $flag = 1;
                    $srNo=0;
                    try{
                            foreach ($data as $key) {
                                
                                $data = array(
                            
                                    "PLAN_AMT"     =>  $key->TBPAMT,
                                    "TBP_AMT"      =>  $key->TBPAMT,
                                    "ACCUPOST_AMT" =>  $key->CUM_AMT,

                                );

                                $IDASDEP = $ASDEPDATA[$SLNO]['ASDEPID'];

                                $saveData = DB::table('ASDEP_TRAN')->where('ASDEPID',$IDASDEP)->where('YR_MM',$MMYY)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($data);

                                if ($saveData) {

                                    $response_array['response'] = 'success';
                                    $data = json_encode($response_array);
                                    print_r($data);

                                }else{

                                    $response_array['response'] = 'error';
                                    $data = json_encode($response_array);
                                    print_r($data);
                                    
                                }
                            $srNo++;
                            }

                        DB::commit();

                        $response_array['response'] = 'success';
                        $data = json_encode($response_array);
                        print_r($data);
                    
                    } catch (\Exception $e) {
                        
                        DB::rollBack();
                        //throw $e;
                        $response_array['response'] = 'error';
                        $data = json_encode($response_array);
                        print_r($data);
                        
                    }


                }else{


                    $flag = 1;
                    $SLNO=0;
                    $GLSRNO=1;
                    try {

                        foreach ($data as $keys) {
                            
                            

                            $CONFIGASSET1 = DB::table('MASTER_CONFIG')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->get();

                            $CONFIGASSET = json_decode(json_encode($CONFIGASSET1), true); 


                            $VRSEQASSET1 = DB::table('MASTER_VRSEQ')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

                            $VRSEQASSET = json_decode(json_encode($VRSEQASSET1), true); 

                            $GLSLNO = 1;
                            $VRDATE = date('Y-m-d');

                            $LASTUPDATE = date('Y-m-d');

                            $PARTICULAR = 'Depreciation Postated for Asset  '.$keys->ASSET_CODE;
                            
                            $TCODE = 'J1';

                            $GLTRANARRY = array(
                        
                                "COMP_CODE"   =>  $getcompcode,
                                "FY_CODE"     =>  $fisYear,
                                "TRAN_CODE"   =>  $CONFIGASSET[0]['TRAN_CODE'],
                                "SERIES_CODE" =>  $CONFIGASSET[0]['SERIES_CODE'],
                                "VRNO"        =>  $VRSEQASSET[0]['LAST_NO'],
                                "SLNO"        =>  $GLSRNO,
                                "VRDATE"      =>  $VRDATE,
                                "PFCT_CODE"   =>  $keys->PFCT_CODE,
                                "GL_CODE"     =>  $keys->GL_CODE,
                                "GL_NAME"     =>  $keys->GL_CODE,
                                "CRAMT"       =>  $keys->TBPAMT,
                                "PARTICULAR"  =>  $PARTICULAR,
                                "FLAG"        =>  $flag,
                                "CREATED_BY"  =>  $userid

                            );

                            $GLTRANASSET = DB::table('GL_TRAN')->insert($GLTRANARRY);

                            $GLTRANVRNO = $VRSEQASSET[0]['LAST_NO'];
                            $GLTRANSLNO = $GLSRNO + 1;

                            $GLTRANARRYSECOND = array(
                        
                                "COMP_CODE"   =>  $getcompcode,
                                "FY_CODE"     =>  $fisYear,
                                "TRAN_CODE"   =>  $CONFIGASSET[0]['TRAN_CODE'],
                                "SERIES_CODE" =>  $CONFIGASSET[0]['SERIES_CODE'],
                                "VRNO"        =>  $GLTRANVRNO,
                                "SLNO"        =>  $GLTRANSLNO,
                                "VRDATE"      =>  $VRDATE,
                                "PFCT_CODE"   =>  $keys->PFCT_CODE,
                                "GL_CODE"     =>  $CONFIGASSET[0]['POST_CODE'],
                                "GL_NAME"     =>  $CONFIGASSET[0]['POST_CODE'],
                                "DRAMT"       =>  $keys->TBPAMT,
                                "PARTICULAR"  =>  $PARTICULAR,
                                "FLAG"        =>  $flag,
                                "CREATED_BY"  =>  $userid

                            );

                            $GLTRAN = DB::table('GL_TRAN')->insert($GLTRANARRYSECOND);


                                $data = array(
                            
                                    "PLAN_AMT"     =>  $keys->TBPAMT,
                                    "POST_AMT"     =>  $keys->TBPAMT,
                                    "TBP_AMT"      =>  $keys->TBPAMT,
                                    "ACCUPOST_AMT" =>  $keys->CUM_AMT,

                                );

                                $IDASDEP = $ASDEPDATA[$SLNO]['ASDEPID'];

                               
                                $saveData = DB::table('ASDEP_TRAN')->where('ASDEPID',$IDASDEP)->where('YR_MM',$MMYY)->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($data);

                                date_default_timezone_set('Asia/Kolkata');
                                $LASTUPDATE = date('Y-m-d H:i:s');

                                $VRSEQARR = array(

                                    "LAST_NO"          =>  $GLTRANVRNO + 1,
                                    "FLAG"             =>  $flag,
                                    "LAST_UPDATE_BY"   =>  $userid,
                                    "LAST_UPDATE_DATE" =>  $LASTUPDATE

                                );

                                $UPDATEVRSEQ = DB::table('MASTER_VRSEQ')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($VRSEQARR);

                        $SLNO++;

                        }

                                DB::commit();

                                $response_array['response'] = 'success';
                                $data = json_encode($response_array);
                                print_r($data);

                    } catch (\Exception $e) {
                        //throw $e;
                        DB::rollback();

                        $response_array['response'] = 'error';
                        $data = json_encode($response_array);
                        print_r($data);
                        
                    }

                }


           }else{


            //DB::enableQueryLog();
            $data = DB::select("SELECT T.COMPCODE,T.FYCODE,T.ASGROUP_CODE,T.ASSET_CODE, T.ASSET_NAME,T.ASSET_NO,T.CAPITALIZE_DATE,T.COST_CENTER,T.GL_CODE,T.PLANT_CODE,T.PFCT_CODE,T.PARTICULAR, T.DEP_CODE,assetval, T.DEP_RATE,ROUND(SUM(T.PLAN_AMT),3) AS PLANAMT, ROUND(SUM(T.POST_AMT),3) AS POSTAMT, ROUND(SUM(T.TBP_AMT),3) AS TBPAMT, ROUND(SUM(T.POST_AMT)+SUM(T.TBP_AMT),3) AS CUM_AMT FROM
              (SELECT A.COMP_CODE AS COMPCODE,A.FY_CODE AS FYCODE,A.ASGROUP_CODE,A.ASSET_CODE, A.ASSET_NAME,A.ASSET_NO,A.CAPITALIZE_DATE,A.COST_CENTER,A.GL_CODE,A.PLANT_CODE,A.PFCT_CODE,'' AS PARTICULAR, D.DEP_CODE,B.YROPGB+B.YRDRGB-B.YRCRGB as assetval, D.DEP_RATE,0 AS PLAN_AMT, 0 AS POST_AMT, ((B.YROPGB+B.YRDRGB-B.YRCRGB)*D.DEP_RATE/100/12) AS TBP_AMT, 0 AS CUM_AMT from MASTER_ASSET A, MASTER_ASBAL B, MASTER_ASDEPRATE D WHERE B.ASSET_CODE = A.ASSET_CODE AND B.FY_CODE = '$fisYear' AND A.ASGROUP_CODE = D.ASGROUP_CODE AND A.CAPITALIZE_DATE <= '$FirstDate' AND A.ASEOD_DATE > '$LastDate' AND ('$FirstDate' BETWEEN D.FROM_DATE AND D.TO_DATE)
                    UNION ALL
                 SELECT '' AS COMPCODE, '' AS FYCODE, '' AS ASGROUP_CODE,ASSET_CODE, '' AS ASSET_NAME, '' AS ASSET_NO, '' AS CAPITALIZE_DATE, '' AS COST_CENTER,'' AS GL_CODE,'' AS PLANT_CODE, '' AS PFCT_CODE, '' AS PARTICULAR, '' AS DEP_CODE,0 as assetval,0 AS DEP_RATE, SUM(PLAN_AMT), SUM(POST_AMT), 0 AS TBP_AMT, SUM(POST_AMT)+TBP_AMT AS CUM_AMT from ASDEP_TRAN WHERE FY_CODE='$fisYear' GROUP BY ASSET_CODE) T
                    GROUP BY T.ASSET_CODE");


            if ($BTNNAME == 'planBtn') {

                $Fday = '01';
                $FirstDate = $yy.'-'.$mm.'-'.$Fday;
                $LastDate = date('Y-m-t',strtotime($FirstDate));
                    
                $flag = 1;

                try{

                    foreach ($data as $key) {

                        if ($key->PLANAMT !='') {

                            $newPlanAmt = $key->PLANAMT + $key->TBPAMT;
                            
                        }else{

                            $newPlanAmt = $key->TBPAMT;

                        }
                        
                        $data = array(
                            "COMP_CODE"    =>  $key->COMPCODE,
                            "FY_CODE"      =>  $key->FYCODE,
                            "YR_MM"        =>  $MMYY,
                            "ASSET_CODE"   =>  $key->ASSET_CODE,
                            "ASGROUP_CODE" =>  $key->ASGROUP_CODE,
                            "PLANT_CODE"   =>  $key->PLANT_CODE,
                            "PFCT_CODE"    =>  $key->PFCT_CODE,
                            "GL_CODE"      =>  $key->GL_CODE,
                            "DEP_CODE"     =>  $key->DEP_CODE,
                            "DEP_AMT"      =>  $key->DEP_RATE,
                            "PARTICULAR"   =>  'Not Found',
                            "GL_VRNO"      =>  $flag,
                            "GL_SLNO"      =>  $flag,
                            "PLAN_AMT"     =>  $newPlanAmt,
                            "POST_AMT"     =>  $key->POSTAMT,
                            "TBP_AMT"      =>  $key->TBPAMT,
                            "ACCUPOST_AMT" =>  $key->CUM_AMT,
                            "FLAG"         =>  $flag
                        );

                        $saveData = DB::table('ASDEP_TRAN')->insert($data);

                        
                    }

                    DB::commit();

                    $response_array['response'] = 'success';
                    $data = json_encode($response_array);
                    print_r($data);
                
                } catch (\Exception $e) {
                    
                    DB::rollBack();
                    //throw $e;
                    $response_array['response'] = 'error';
                    $data = json_encode($response_array);
                    print_r($data);
                    
                }

            }else{

                $flag = 1;
                $GLSRNO = 1;

                try{

                foreach ($data as $key) {

                    

                        if ($key->PLANAMT !='') {

                            $newPlanAmt = $key->PLANAMT + $key->TBPAMT;
                            
                        }else{

                            $newPlanAmt = $key->TBPAMT;

                        }

                        if ($key->POSTAMT !='') {

                            $newPostAmt = $key->POSTAMT + $key->TBPAMT;
                            
                        }else{

                            $newPostAmt = $key->TBPAMT;

                        }

                        $CONFIGASSET1 = DB::table('MASTER_CONFIG')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->get();

                        $CONFIGASSET = json_decode(json_encode($CONFIGASSET1), true); 


                        $VRSEQASSET1 = DB::table('MASTER_VRSEQ')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->get();

                        $VRSEQASSET = json_decode(json_encode($VRSEQASSET1), true); 

                        $GLSLNO = 1;
                        $VRDATE = date('Y-m-d');

                        $LASTUPDATE = date('Y-m-d');

                        $PARTICULAR = 'Depreciation Postated for Asset  '.$key->ASSET_CODE;
                        
                        $TCODE = 'J1';

                        $GLTRANARRY = array(
                    
                            "COMP_CODE"   =>  $getcompcode,
                            "FY_CODE"     =>  $fisYear,
                            "TRAN_CODE"   =>  $CONFIGASSET[0]['TRAN_CODE'],
                            "SERIES_CODE" =>  $CONFIGASSET[0]['SERIES_CODE'],
                            "VRNO"        =>  $VRSEQASSET[0]['LAST_NO'],
                            "SLNO"        =>  $GLSRNO,
                            "VRDATE"      =>  $VRDATE,
                            "PFCT_CODE"   =>  $key->PFCT_CODE,
                            "GL_CODE"     =>  $key->GL_CODE,
                            "GL_NAME"     =>  $key->GL_CODE,
                            "CRAMT"       =>  $newPostAmt,
                            "PARTICULAR"  =>  $PARTICULAR,
                            "FLAG"        =>  $flag,
                            "CREATED_BY"  =>  $userid

                        );

                        $GLTRANASSET = DB::table('GL_TRAN')->insert($GLTRANARRY);

                        $GLTRANVRNO = $VRSEQASSET[0]['LAST_NO'];
                        $GLTRANSLNO = $GLSRNO + 1;

                        $GLTRANARRYSECOND = array(
                    
                            "COMP_CODE"   =>  $getcompcode,
                            "FY_CODE"     =>  $fisYear,
                            "TRAN_CODE"   =>  $CONFIGASSET[0]['TRAN_CODE'],
                            "SERIES_CODE" =>  $CONFIGASSET[0]['SERIES_CODE'],
                            "VRNO"        =>  $GLTRANVRNO,
                            "SLNO"        =>  $GLTRANSLNO,
                            "VRDATE"      =>  $VRDATE,
                            "PFCT_CODE"   =>  $key->PFCT_CODE,
                            "GL_CODE"     =>  $CONFIGASSET[0]['POST_CODE'],
                            "GL_NAME"     =>  $CONFIGASSET[0]['POST_CODE'],
                            "DRAMT"       =>  $newPostAmt,
                            "PARTICULAR"  =>  $PARTICULAR,
                            "FLAG"        =>  $flag,
                            "CREATED_BY"  =>  $userid

                        );

                        $GLTRAN = DB::table('GL_TRAN')->insert($GLTRANARRYSECOND);
                        
                        $data = array(
                    
                            "COMP_CODE"    =>  $key->COMPCODE,
                            "FY_CODE"      =>  $key->FYCODE,
                            "YR_MM"        =>  $MMYY,
                            "ASSET_CODE"   =>  $key->ASSET_CODE,
                            "ASGROUP_CODE" =>  $key->ASGROUP_CODE,
                            "PLANT_CODE"   =>  $key->PLANT_CODE,
                            "PFCT_CODE"    =>  $key->PFCT_CODE,
                            "GL_CODE"      =>  $key->GL_CODE,
                            "DEP_CODE"     =>  $key->DEP_CODE,
                            "DEP_AMT"      =>  $key->DEP_RATE,
                            "PARTICULAR"   =>  'Not Found',
                            "GL_VRNO"      =>  $flag,
                            "GL_SLNO"      =>  $flag,
                            "PLAN_AMT"     =>  $newPlanAmt,
                            "POST_AMT"     =>  $newPostAmt,
                            "TBP_AMT"      =>  $key->TBPAMT,
                            "ACCUPOST_AMT" =>  $key->CUM_AMT,
                            "FLAG"         =>  $flag
                    
                            
                        );

                        $saveData = DB::table('ASDEP_TRAN')->insert($data);

                        $VRSEQARR = array(

                                    "LAST_NO"          =>  $GLTRANVRNO + 1,
                                    "FLAG"             =>  $flag,
                                    "LAST_UPDATE_BY"   =>  $userid,
                                    "LAST_UPDATE_DATE" =>  $LASTUPDATE

                                );

                        $UPDATEVRSEQ = DB::table('MASTER_VRSEQ')->where('TRAN_CODE','J1')->where('COMP_CODE',$getcompcode)->where('FY_CODE',$fisYear)->update($VRSEQARR);

                    $GLSRNO++;

                    }

                    DB::commit();

                    $response_array['response'] = 'success';
                    $data = json_encode($response_array);
                    print_r($data);
                
                } catch (\Exception $e) {
                    
                    DB::rollBack();
                    //throw $e;
                    $response_array['response'] = 'error';
                    $data = json_encode($response_array);
                    print_r($data);
                    
                }


            }

               
                


           }

    }

}


?>
