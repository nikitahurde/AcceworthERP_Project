<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class store_return_head extends Model
{
    protected $fillable = [
	'id', 'comp_name', 'fiscal_year', 'pfct_code', 'pfct_name', 'tran_code', 'series_code', 'series_name', 'vr_no', 'vr_date', 'dept_code', 'dept_name', 'plant_code', 'plant_name', 'emp_code', 'emp_name', 'party_ref_name', 'party_ref_date', 'due_date', 'flag', 'created_by', 'updated_by', 'updated_date',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];

	public function getreturnData($CompanyCode,$macc_year){

       $requistion = store_return_head::where('comp_name', $CompanyCode)->where('fiscal_year',$macc_year)->get();

         return $requistion;

    }
}
