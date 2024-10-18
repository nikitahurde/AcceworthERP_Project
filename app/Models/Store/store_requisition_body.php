<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class store_requisition_body extends Model
{
   protected $fillable = [
	'id', 'store_requistion_head_id', 'comp_name', 'fiscal_year', 'pfct_code', 'plant_code', 'tran_code', 'series_code', 'vrno', 'slno', 'vr_date', 'dept_code', 'item_code', 'item_name', 'remark', 'qty_recvd', 'um', 'aq_recvd', 'aum', 'approve_remark', 'flag', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];


	
}
