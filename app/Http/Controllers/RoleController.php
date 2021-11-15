<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\UserTypeModel;
use App\Models\DepartmentModel;
use App\Models\CommonModel;
use Illuminate\Http\Request;
use App\Models\AccessPermissionsModel;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $table = 'user_types';

    function index(){
        $param = array();
    	$objUserTypeModel = new UserTypeModel;
    	$data['types'] = $objUserTypeModel->typeDetails($param);
        $data['title'] = 'Roles';
    	return view('user_type.index',$data);
    }

    function add(Request $request,$id = null){
    	$id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $data['title'] = 'Role Add';
        $objUserTypeModel = new UserTypeModel;
        if ($id != 0) {
            $data['singleData'] = $objUserTypeModel->getSingleData($id);
            $data['getMenus'] = AccessPermissionsModel::where('user_type_id','=',$id)->get();
        }else{
        	$data['singleData'] = '';
            $data['getMenus'] = '';
        }
        $data['departments'] = DepartmentModel::where('status','=','0')->get();
        $accessPermissions = new AccessPermissionsModel;
        $data['menus'] = $accessPermissions->getMenus();
    	return view('user_type.add',$data);
    }

    function save(Request $request){
    	$returnData = array();
    	$id = $request['id'];
    	if($id==''){
	    	$validator = Validator::make($request->all(), ([
					'name' => 'required|max:255|unique:'.$this->table,
	        ]));

	        if ($validator->fails()) {
	            $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
	            return json_encode($returnData);
	        }

	        $objCommon = new CommonModel;
	 		$uniqueField = "name";
	        $uniqueFieldValue = $request[$uniqueField];
	        $uniqueCount = $objCommon->checkUnique($this->table, $uniqueField, $uniqueFieldValue, $request['id']);        
	        if ($uniqueCount > 0) {
	            $returnData = array('status' => 'exist', 'message' => 'Role Name already exists!', 'unique_field' => $uniqueField);
	            return json_encode($returnData);
	        }
    	}
        
        $objUserTypeModel = new UserTypeModel;
        $returnData = $objUserTypeModel->saveData($request->all());
        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in data insertion');
        }
        return json_encode($returnData);
    }
}