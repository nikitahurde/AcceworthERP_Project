<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use DataTables;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Schema;
use PDF;

class CommonAjaxFun extends Controller{
	
	$data = '';


	public function __cunstruct($data =){


		$this->data = $data;

	}

	public function commonFunctionOne(Request $request){




	}


}

?>