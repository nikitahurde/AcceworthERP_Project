<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Model;

class wo_production_head extends Model
{
     protected $fillable = [
	'id', 'comp_name', 'fiscal_year', 'tran_code', 'series_code', 'series_name', 'vr_no', 'vr_date', 'plant_code', 'plant_name', 'fg_code', 'fg_name', 'created_by', 'updated_by',
	];

	protected $hidden = [
	'created_at', 'updated_at'
	];
}
