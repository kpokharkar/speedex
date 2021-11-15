<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Common;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\BookingDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CashController extends Controller
{
    function index(){
    	return view('cash.index');
    }

    function add(){
        return view('cash.add');
    }

}
