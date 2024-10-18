<?php

namespace App\Models\sales;

use Illuminate\Database\Eloquent\Model;

class sale_quotation_head extends Model
{



    protected $fillable = [
	'id', 'comp_name', 'fiscal_year', 'pfct_code', 'tran_code', 'series_code', 'vr_no', 'vr_date', 'acc_code', 'plant_code', 'tax_code', 'partyref_no', 'partyref_date', 'consine_code', 'rfhead1', 'rfhead2', 'rfhead3', 'rfhead4', 'rfhead5', 'payment_terms','cr_amt','due_date','adv_rate_i','adv_rate','adv_amt','created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];


	public function getquoatationData($CompanyCode,$macc_year){

       $quoatation = sale_quotation_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();

         return $quoatation;

    }


}


