<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class store_return_body extends Model
{
    protected $fillable = [
	'id', 'store_return_head_id', 'comp_name', 'fiscal_year', 'pfct_code', 'plant_code', 'tran_code', 'series_code', 'vrno', 'slno', 'vr_date', 'dept_code', 'item_code', 'item_name', 'remark', 'issue_qty_recvd', 'um', 'issue_aq_recvd', 'aum', 'return_qty', 'return_qty_um', 'return_aqty', 'return_qty_aum', 'approve_remark', 'flag', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
