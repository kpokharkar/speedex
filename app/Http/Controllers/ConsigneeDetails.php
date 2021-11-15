<?php

namespace App\Http\Controllers;

use App\Models\Common;
use Illuminate\Http\Request;
use App\Models\Consignee;
use App\Models\ConsigneeAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConsigneeDetails extends Controller {
    
    protected $table = 'consignee_details';
    
    function index() {
        $objConsignee = new Consignee;
        $data['details'] = $objConsignee->getDetails();
        return view('consignee_detail.index',$data);
    }

    function add(Request $request,$id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $objConsignee = new Consignee;
        $objConsigneeAddress = new ConsigneeAddress;
        if ($id != 0) {
            $data['singleData'] = $objConsignee->getSingleData($id);
            $data['addressDetails'] = $objConsigneeAddress->getSingleData($id);
        }else{
        	$data['singleData'] = '';
        	$data['addressDetails'] = '';
        }
        $data['getCompanyDetails'] = DB::table('company_master')->where('status', 'Active')->get();
        return view('consignee_detail.add',$data);
    }
    
    function save(Request $request) {
    	$returnData = array();
    	$id = $request['id'];
    	if($id=='') {
	    	$validator = Validator::make($request->all(), ([
	    	    'consignor' => 'required|max:255',
	    	    'company_name' => 'required|max:255|unique:'.$this->table,
	        ]));
	        if ($validator->fails()) {
	            $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
	            return json_encode($returnData);
	        }
    	}
        $post = $request->all();
        $objConsignee = new Consignee;
        $returnData = $objConsignee->saveData($post);
        $consignee_id = $returnData['id'];
        $objConsigneeAddress = new ConsigneeAddress;
        $name = $request->name;
        $mobile = $request->mobile;
        $destination = $request->destination;
        $address = $request->address;
        $pincode = $request->pincode;
        $status = $request->status;
        DB::delete("delete from consignee_address where consignee_id='$consignee_id'");
        $data = [];
        $objConsigneeAddress = new ConsigneeAddress;
        for($i=0;$i<count($name);$i++){
                $data = array(
                    'consignee_id' => $consignee_id,
                    'name' => $name[$i],
                    'mobile' => $mobile[$i],
                    'destination' => $destination[$i],
                    'address' => $address[$i],
                    'pincode' => $pincode[$i],
                    'status' => $status[$i],
                    );
                 $objConsigneeAddress->saveData($data);
            }
        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in data insertion');
        }
        return json_encode($returnData);
    }
}