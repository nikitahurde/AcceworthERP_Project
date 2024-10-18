<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class store_requisition_approve extends Model
{
    protected $fillable = [
	'id', 'comp_name', 'fiscal_year', 'pfct_code', 'plant_code', 'tran_code', 'series_code', 'vr_no', 'slno', 'vr_date', 'acc_code', 'approved_ind', 'approve_user', 'level_no', 'approve_status', 'approve_date', 'approve_remark', 'flag', 'lastuser', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
