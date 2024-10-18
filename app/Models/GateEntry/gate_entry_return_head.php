<?php

namespace App\Models\GateEntry;

use Illuminate\Database\Eloquent\Model;

class gate_entry_return_head extends Model
{
    protected $fillable = [
	'id', 'comp_name', 'fiscal_year', 'pfct_code', 'pfct_name', 'tran_code', 'series_code', 'series_name', 'vr_no', 'vr_date', 'dept_code', 'dept_name', 'plant_code', 'plant_name', 'emp_code', 'emp_name', 'party_ref_name', 'party_ref_date','flag', 'acc_code', 'order_no', 'created_by', 'updated_by', 'updated_date',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
