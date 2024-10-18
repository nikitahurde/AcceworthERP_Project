<?php

namespace App\Models\sales;

use Illuminate\Database\Eloquent\Model;

class sale_quotation_tax extends Model
{
    protected $fillable = [
		'id', 'sale_quotation_head_id', 'sale_quotation_body_id', 'tax_ind_name', 'rate_index', 'tax_rate', 'tax_amt', 'flag', 'tax_logic', 'static', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
