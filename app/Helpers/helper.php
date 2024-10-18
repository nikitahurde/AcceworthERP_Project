<?php 


	function MyConstruct(){
      
         $ConstructData['master_party']     = DB::table('MASTER_ACC')->get()->toArray();
         $ConstructData['master_plant']     = DB::table('MASTER_PLANT')->get()->toArray();
         $ConstructData['master_dept']      = DB::table('MASTER_DEPT')->get()->toArray();
         $ConstructData['master_config']    = DB::table('MASTER_CONFIG')->get()->toArray();
         $ConstructData['master_item']      = DB::table('MASTER_ITEM')->get();
         $ConstructData['master_rateValue'] = DB::table('MASTER_RATE_VALUE')->get()->toArray();
         $ConstructData['master_comp']      = DB::table('MASTER_COMP')->get()->toArray();
         $ConstructData['master_pfct']      = DB::table('MASTER_PFCT')->get()->toArray();
         $ConstructData['master_bank']      = DB::table('MASTER_BANK')->get()->toArray();
         $ConstructData['master_tax']       = DB::table('MASTER_TAX')->get()->toArray();
         $ConstructData['transp_code']      = DB::table('MASTER_ACC')->where('ATYPE_CODE','T')->get()->toArray();
         $ConstructData['sale_rep_code']    = DB::table('MASTER_ACC')->where('ATYPE_CODE','E')->get()->toArray();
         
         $ConstructData['master_cost']      = DB::table('MASTER_COST')->get()->toArray();
         
         $ConstructData['master_gl']        = DB::table('MASTER_GL')->get()->toArray();
         $ConstructData['master_glkey']     = DB::table('MASTER_GLKEY')->get()->toArray();

         $ConstructData['master_taxRate']   = DB::table('MASTER_TAX')
                ->select('MASTER_TAX.*', 'MASTER_TAXRATE.*')
                   ->leftjoin('MASTER_TAXRATE', 'MASTER_TAXRATE.TAX_CODE', '=', 'MASTER_TAX.TAX_CODE')
                   ->groupBy('MASTER_TAXRATE.TAX_CODE')
                   ->get()->toArray();

        return $ConstructData;
	}


	function MyCommonFun($transCode,$CompCode,$MaccYear){


      $CommonFunData['getseries']   = DB::table('MASTER_CONFIG')->where('COMP_CODE',$CompCode)->where('TRAN_CODE',$transCode)->get();

      $CommonFunData['getdate']     = DB::table('MASTER_FY')->where(['COMP_CODE'=>$CompCode,'FY_CODE'=>$MaccYear])->get();

      $CommonFunData['cashtrans']   = DB::table('CB_TRAN')->where('COMP_CODE',$CompCode)->where('FY_CODE',$MaccYear)->get();

      $CommonFunData['vr_no_list']  = DB::table('MASTER_VRSEQ')->where('TRAN_CODE',$transCode)->get()->toArray();
      $CommonFunData['remark_data'] = DB::table('MASTER_REMARK')->where('COMP_CODE',$CompCode)->where('FY_CODE',$MaccYear)->where('TRAN_CODE',$transCode)->get()->toArray();

      $CommonFunData['masterPFCT']  = DB::table('MASTER_PFCT')->where('COMP_CODE',$CompCode)->get()->toArray();
     
      $CommonFunData['master_GL']  = DB::table('MASTER_GL')->where('COMP_CODE',$CompCode)->orWhere('COMP_CODE',NULL)->orWhere('COMP_CODE','')->get()->toArray();

      $CommonFunData['masterPlant']   = DB::table('MASTER_PLANT')->where('COMP_CODE',$CompCode)->get();

      return $CommonFunData;

		
	}