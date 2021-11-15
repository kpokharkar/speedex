<?php

namespace App\Http\Controllers;

use App\Models\Common;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller {
    
    function index() {
        $data['getVendorDetails'] = DB::table('vendor_master')->get();
        return view('vendor_master.index',$data);
    }

    function add(Request $request,$id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $obj = new Vendor;
        if ($id != 0) {
            $data = $obj->getSingleData($id);
        }
        return view('vendor_master.add',compact('data'));
    }

    function save(Request $request) {
        $returnData = array();
        
        $validator = Validator::make($request->all(), ([
            'name' => 'required|string|max:50',
            'mobile_no' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
        ]));
        
        if ($validator->fails()) {
            $returnData = array('status' => 'error', 'message' => 'Validation Error.', 'errors' => $validator->errors());
            return json_encode($returnData);
        }
        
        $objCommon = new Common;
        
        // check for unique
        $uniqueField = "mobile_no";
        $uniqueFieldValue = $request[$uniqueField];
        $uniqueCount = $objCommon->checkUnique('vendor_master', $uniqueField, $uniqueFieldValue, $request['id']);
        
        if ($uniqueCount > 0) {
            $returnData = array('status' => 'exist', 'message' => 'Mobile No. Already Exists.', 'unique_field' => $uniqueField);
            return json_encode($returnData);
        }
        
        $obj = new Vendor;
        $returnData = $obj->saveData($request->all());
        
        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in Data Insertion.');
        }
        
        return json_encode($returnData);
    }

}