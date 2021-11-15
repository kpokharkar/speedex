<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\User;
use App\Models\UserTypeModel;
use App\Models\CommonModel;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $table = 'users';
    protected $userTypeTable = 'user_types';

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $param = array();
    	$objUser = new User;
    	$data['userDetails'] = $objUser->userDetails($param);
        $data['title'] = 'Users List';
    	return view('user.index',$data);
    }

    function add(Request $request,$id = null){
    	$id = isset($id) ? (int) $id : (int) 0;
        $user_id = Session::get('id');
        $data = array();
        $objUser = new User;
        if ($id != 0) {
            $data['singleData'] = $objUser->getSingleData($id);
        }else{
        	$data['singleData'] = '';
        }
        $data['userTypes'] = UserTypeModel::where('status','=','0')->get();
        $data['title'] = 'Add User';
    	return view('user.add',$data);
    }

    function save(Request $request){
    	$returnData = array();
    	$id = $request['id'];
        $post = $request->all();
    	if($id==''){
	    	$validator = Validator::make($request->all(), ([
					'first_name' => 'required|string|max:255',
					'mobile_no' => 'required|numeric|digits_between:8,20'.$this->table,
					'email' => 'required|max:255|unique:'.$this->table,
					'user_type' => 'required',
	        ]));

	        if ($validator->fails()) {
	            $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
	            return json_encode($returnData);
	        }

	        $objCommon = new CommonModel;
	 		$uniqueField = "mobile_no";
	        $uniqueFieldValue = $request[$uniqueField];
	        $uniqueCount = $objCommon->checkUnique($this->table, $uniqueField, $uniqueFieldValue, $request['id']);        
	        if ($uniqueCount > 0) {
	            $returnData = array('status' => 'exist', 'message' => 'Mobile Number already exists!', 'unique_field' => $uniqueField);
	            return json_encode($returnData);
	        }

	        $uniqueFieldEmail = "email";
	        $uniqueFieldValueEmail = $request[$uniqueFieldEmail];
	        $uniqueCountEmail = $objCommon->checkUnique($this->table, $uniqueFieldEmail, $uniqueFieldValueEmail, $request['id']);        
	        if ($uniqueCount > 0) {
	            $returnData = array('status' => 'exist', 'message' => 'Email id already exists!', 'unique_field' => $uniqueField);
	            return json_encode($returnData);
	        }
    	}
        $objUser = new User;
        $returnData = $objUser->saveData($post);

        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in data insertion');
        }
        return json_encode($returnData);
    }

    function profile(){
        $id = Session::get('id');
        $param = array('id' => $id);
        $objUser = new User;
        $data['singleData'] = $objUser->getSingleData($id);
        $data['title'] = 'User Profile';
        return view('profile.index',$data);
    }


    function passwordChange(){
        $id = Session::get('id');
        $param = array('id' => $id);
        $objUser = new User;
        $data['singleData'] = $objUser->getSingleData($id);
        $data['title'] = 'Change Password';
        return view('profile.change_password',$data);   
    }

    function passwordUpdate(Request $request){
        $validator = Validator::make($request->all(), ([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]));

        if ($validator->fails()) {
                $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
                return json_encode($returnData);
        }

        $id = Session::get('id');
        $objUser = new User;
        $singleData = $objUser->getSingleData($id);
        $password = $singleData['password'];
        //$password_convert = Hash::make($request->current_password);
        if (Hash::check($request->current_password, $password)) {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            Session::flush();
            $returnData = array('status' => 'success', 'message' => 'Password change successfully!');
            return json_encode($returnData);
        }else{
            $returnData = array('status' => 'error', 'message' => 'Current password not match with old password!');
            return json_encode($returnData);
        }
        
    }
}