<?php

namespace App\Models\sales;

use Illuminate\Database\Eloquent\Model;

class chield_sale_quotation_body extends Model
{
    
	protected $fillable = [
	'id', 'sale_quotation_head_id', 'comp_name', 'fiscal_year', 'tran_code', 'vrno', 'slno', 'vr_date', 'item_code', 'item_name', 'um_code', 'aum_code', 'remark', 'approve_remark', 'quantity', 'Aquantity', 'qty_issued', 'rate', 'tax_code', 'hsn_code','basic_amt','dr_amount','created_by','updated_by','flag',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
    
}
