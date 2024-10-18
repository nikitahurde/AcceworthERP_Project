<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;

class wo_production_quality extends Model
{
    protected $fillable = [
	'id', 'wo_production_head_id', 'wo_production_body_id', 'comp_name', 'fiscal_year', 'tran_code', 'series_code', 'vr_no', 'vr_date', 'plant_code', 'item_code', 'item_category', 'iqua_char', 'iqua_desc', 'iqua_um', 'char_fromvalue', 'char_tovalue', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
