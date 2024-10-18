<?php

namespace App\Models\sales;

use Illuminate\Database\Eloquent\Model;

class sale_quotation_qua extends Model
{
   
	protected $fillable = [
	'id', 'sale_quotation_head_id', 'sale_quotation_body_id', 'item_code', 'item_category', 'iqua_char', 'iqua_desc', 'iqua_um', 'char_fromvalue', 'char_tovalue', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];

}
