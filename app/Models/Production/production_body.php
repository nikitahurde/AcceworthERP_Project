<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;

class production_body extends Model
{
   protected $fillable = [
	'id', 'production_head_id', 'comp_name', 'fiscal_year', 'plant_code', 'tran_code', 'series_code', 'vrno', 'slno', 'vr_date', 'item_code', 'item_name', 'remark', 'qty_recvd', 'um', 'aq_recvd', 'aum', 'qty_issue', 'um_issue', 'aq_issue', 'aum_issue', 'approve_remark', 'flag', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
