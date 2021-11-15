<?php

namespace App\Models;

use Session;
use App\Models\CommonModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessPermissionsModel extends Model
{
    use HasFactory;

    protected $table = 'accesspermissions';
    protected $tableUser = 'users';
    protected $tableUserTypes = 'user_types';
    protected $tableModules = 'modules';
    protected $tableSubModules = 'submodules';  


    protected $fillable = [
       'id', 'user_type_id', 'module_id', 'sub_module_id', 'user_access', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    function userDetails(){
    	$id = Session::get('id');
    	$system_number = Session::get('system_number');
    	$result = DB::select("SELECT u.id, concat(first_name,' ',last_name) as fullName, email, t.user_type,contact_number FROM " . $this->tableUser. " u
        left join " . $this->tableUserTypes . " t on
        u.user_type = t.id where u.id<>$id and u.system_number='$system_number'");
        return $result;
    }

    public static function GetModule($param = array()){
		$query=DB::table('modules')
				->where('status',0);
		if(isset($param['id'])){
			$query->where('id',$param['id']);
			$module=$query->first();
		}else
			$module=$query->get();
		if($module){
			return $module;
		}
		else{
			return false;
		}	
	}

	function getMainMenu(){
		$plan_id = Session::get('plan_id');
		$result = DB::select("SELECT DISTINCT main_id as id,module_name FROM menu_master 
			left join modules on
			main_id = modules.id
			WHERE plan_id=$plan_id");
		return $result;
	}

	public static function GetSubModule($param = array()){
		$sub_module = DB::table('submodules')
			->where('status','=',0)
			->orderBy('sequence')
			->get();
		if($sub_module){
			return $sub_module;
		}else{
			return false;
		}	
	}

	public static function getAccessPermission($param = array()){
		$access_permission = DB::table('accesspermissions')
			->where($param)
			->where('status','=',0)
			->get();
		if($access_permission){
			return $access_permission;
		}
		else{
			return false;
		}	
	}

	public static function updateAccesspermission($param = array()){
		$objCommonModel = new CommonModel();
		$result = $objCommonModel->simpleUpdate('accesspermissions',['user_id' => $param['user_id']],$param);
		if($result){
			return true;
		}else{
			return false;
		}
	} 

	function getMenus(){
		$query=DB::table('modules');
		$query->where('status',0);
		$result = $query->get();
		$returnMenu = array();
		foreach($result as $data){
			$mainId = $data->id;
			$getSubMenuList = $this->getSubMenu($mainId);
			foreach($getSubMenuList as $data1){
					$returnMenu[$data->id]['module_name'] = $data->module_name;
					$returnMenu[$data->id]['module_id'] = $data->id;
					$returnMenu[$data->id]['subMenu'][$data1->id]['sub_module_name'] = $data1->sub_module_name;
					$returnMenu[$data->id]['subMenu'][$data1->id]['sub_menu_id'] = $data1->id;
				}
		}
		return $returnMenu;
	}

	function getSubMenu($mainId){
		$result = DB::table('submodules')
			->where('status','=',0)
			->where('module_id','=',$mainId)
			->get();
		return $result;
	}
}