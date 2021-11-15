<?php

namespace App\Http\Controllers;

use App\Models\Common;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyDetails extends Controller {
    
    function index() {
        $data['getCompanyDetails'] = DB::table('company_master')->orderBy('id', 'desc')->get();
        return view('company_detail.index',$data);
    }

    function add(Request $request,$id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $obj = new CompanyDetail;
        if ($id != 0) {
            $data = $obj->getSingleData($id);
        }
        return view('company_detail.add',compact('data'));
    }

    function save(Request $request) {
        $returnData = array();
        
        $validator = Validator::make($request->all(), ([
            'name' => 'required|string|max:50',
            'email_id' => 'required',
            'gst_no' => 'required',
            'contact_person' => 'required',
            'contact_person_mobile' => 'required|numeric',
            'address' => 'required',
            'status' => 'required|in:Active,Inactive',
        ]));
        
        if ($validator->fails()) {
            $returnData = array('status' => 'error', 'message' => 'Validation Error.', 'errors' => $validator->errors());
            return json_encode($returnData);
        }
        
        $objCommon = new Common;
        
        // check for unique
        $uniqueField = "contact_person_mobile";
        $uniqueFieldValue = $request[$uniqueField];
        $uniqueCount = $objCommon->checkUnique('company_master', $uniqueField, $uniqueFieldValue, $request['id']);
        
        if ($uniqueCount > 0) {
            $returnData = array('status' => 'exist', 'message' => 'Mobile No. Already Exists.', 'unique_field' => $uniqueField);
            return json_encode($returnData);
        }
        
        $obj = new CompanyDetail;
        $returnData = $obj->saveData($request->all());
        
        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in Data Insertion.');
        }
        
        return json_encode($returnData);
    }

}