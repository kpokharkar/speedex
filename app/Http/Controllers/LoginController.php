<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {
    
    protected $table = 'users';
    
    function login() {
        return view('auth.login');
    }
    
   function loginCheck(Request $request){
        $returnData = array();
        $validator = Validator::make($request->all(), ([
                    'email' => 'required',
                    'password' => 'required',
        ]));

        if ($validator->fails()) {
            $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
            return json_encode($returnData);
        }
        $arry['email'] = $request['email'];
        $arry['password'] = $request['password'];
        $arry['account_activation'] = 1;
        $arry['status'] = 0;
        $objUser = New User();
        $result = $objUser->checkLoginDetails($arry);

        if($result['status'] == 'success'){

            $getData = $result['data'];
            if($getData[0]->account_activation==0 || $getData[0]->account_activation==2 || $getData[0]->account_activation==3){
                return redirect('/')->with('message', 'Your Account is deactivated. Please Contact System Administrator.')->with('status', 'error');
            }
            if(Auth::attempt($arry)){
                    foreach($getData[3] as $individual_submodule){
                        $all_submodules[$individual_submodule->id] =  $individual_submodule->sub_module_short_name;
                    }

                    $sub_modules = explode(",", $getData[1][0]->sub_module_id);
                    $permission = explode("-", $getData[1][0]->user_access);
                    $count = 0;
                    foreach ($sub_modules as $module) {
                        $permission_array = explode(",", $permission[$count]);
                        $access_count = 0;
                        foreach ($permission_array as $permis) {
                            if($access_count == 0){
                                $final_permision['view'] =  $permis;
                                $access_count++;
                            }elseif($access_count == 1){
                                $final_permision['add'] =  $permis;
                                $access_count++;
                            }elseif($access_count == 2){
                                $final_permision['edit'] =  $permis;
                                $access_count++;
                            }elseif($access_count == 3){
                                $final_permision['delete'] =  $permis;
                                $access_count = 0;
                            }
                        }
                        $access_permission[$all_submodules[$module]] = $final_permision;
                        $count++;
                    }
                    Session::put('module', $getData[2]);
                    Session::put('sub_module', $getData[3]);
                    Session::put('id', $getData[0]->id);
                    Session::put('user_access', $access_permission);
                    Session::put('first_name', $getData[0]->first_name);
                    Session::put('last_name', $getData[0]->last_name);
                    Session::put('email', $getData[0]->email);
                    Session::put('user_type', $getData[0]->user_type);
                    Session::put('user_image', $getData[0]->user_image);
                    Session::put('user_gender', $getData[0]->gender);
                    return redirect('/dashboard');
           }
        }else{
            return redirect('/')->with('message', 'Invalid email/password entered.Please try again.')->with('status', 'error');
        }
    }

    function logout(){
        Session::flush();
        return redirect('/login');
    }

}