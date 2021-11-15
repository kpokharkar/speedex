<?php

namespace App\Models;
use DB;
use Auth;
use Session;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $table = 'users';
    protected $tableUserTypes = 'user_types';
    protected $tableModules = 'modules';
    protected $tableSubModules = 'submodules';
    protected $tableAccessPermissions = 'accesspermissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token', 'user_type', 'account_activation', 'gender', 'mobile_no', 'user_image', 'ip_address', 'last_login_date', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function checkLoginDetails($arry){
        $emailId = $arry['email'];
        $accountActivation = $arry['account_activation'];
        $status = $arry['status'];
        $password = $arry['password'];

        $result = DB::table($this->table)
        ->where('email', '=', $emailId)
        ->where('status', '=', $status)
        ->first();


        if($result){
            $getPassword = $result->password; 
            if (Hash::check($password, $getPassword)) {
                $id = $result->id;
                $dt = date('Y-m-d H:i:s');
                $ip = $_SERVER['REMOTE_ADDR'];
                $result1 = DB::table($this->table)->where(array('id' => $id))
                       ->update(array('last_login_date' => $dt,'ip_address' => $ip));
                $access_param['user_type_id'] = $result->user_type;
                $objCommonModel = New CommonModel(); 
                $access_permission = $objCommonModel->getSingle($this->tableAccessPermissions,$access_param);
                $module_param['status']=0;
                $module = $objCommonModel->getSingle($this->tableModules,$module_param);
                $sub_module = DB::table($this->tableSubModules)
                            ->select('id','module_id','sub_module_name','sub_module_short_name','controller_name')
                            ->where(array('status' => 0))->orderBy('sequence','asc')->get();
                 
                $array[0] = $result;
                $array[1] = $access_permission;
                $array[2] = $module;
                $array[3] = $sub_module;   

                $returnData = array('status' => 'success', 'data' => $array);
                return $returnData;

            }else{
                $returnData = array('status' => 'error', 'message' => 'Email Id or password wrong!');
                return $returnData;
            }
        }else{
            $returnData = array('status' => 'error', 'message' => 'Email Id or password wrong!');
            return $returnData;
        }
    }


    public function getSaveData() {
        return array('id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token','user_type', 'account_activation', 'gender', 'mobile_no', 'user_image', 'ip_address', 'last_login_date', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at');
    }


    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new User;
        foreach ($post as $k => $v) {
            if (in_array($k, $saveFields)) {
                $finalData[$k] = $v;
            }
        }
        if (isset($finalData['id'])) {
            $id = (int) $finalData['id'];
        } else {
            $id = 0;
            unset($finalData['id']);
        }

        if ($id == 0) {
            $finalData['created_at'] = date("Y-m-d H:i:s");
            $finalData['password'] = Hash::make('12345678');
            $finalData['account_activation'] = 1;
            $finalData->save();
            $id = $finalData->id;
            return array('id' => $id, 'status' => 'success', 'message' => "User data saved!");
        } else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('id' => $id, 'status' => 'success', 'message' => "User data updated!");
            } else {
                return false;
            }
        }
    }

    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }

        return false;
    }

    function userDetails($param = array()){
        $query = "SELECT u.id, concat(first_name,' ',last_name) as fullName,u.first_name,u.last_name, email, t.name as user_type,mobile_no,u.status FROM " . $this->table. " u
        left join " . $this->tableUserTypes . " t on
        u.user_type = t.id ";
        if(isset($param['user_type'])){
            $userTypeValue = $param['user_type'];
            $query.=" and u.user_type=$userTypeValue";
        }
        if(isset($param['id'])){
            $userId = $param['id'];
            $query.=" and u.id=$userId";
        }
        // else{
        //     $query.=" and u.user_type<>4 and u.user_type<>1";   
        // }
        $result = DB::select($query);
        return $result;
    }

    public static function SingleUserDetails($param = array()){ 
            $objCommonModel = new CommonModel();
        return $objCommonModel->getSingle('users',$param);
    }
}