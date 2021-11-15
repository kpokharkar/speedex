<?php

namespace App\Models;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTypeModel extends Model
{
    use HasFactory;

    protected $table = 'user_types';
    protected $departmentsTable = 'departments';
    protected $accesspermissionsTable = 'accesspermissions';

    protected $fillable = [
        'id', 'name', 'department_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    public function getSaveData() {
        return array('id', 'name', 'department_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at');
    }

    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new UserTypeModel;
        $objAccessPermissionsModel = new AccessPermissionsModel;
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

            $subMenuId  =  $post['menu_codes'];  
            $menu_codess        = array();
            foreach ($subMenuId as $key => $value) {
             $menu_codess[] = $value;
            }

            $imenu_codes = join(',', $menu_codess);
            $countMenu = count($menu_codess);
            $accessValue = array();
            for($i=0;$i<$countMenu;$i++){
                $accessValue[].= '1,1,1,1-'; 
                
            }
            $string_version = implode(',', $accessValue);
            $output = str_replace('-,', '-', $string_version);
            $user_access = rtrim($output, '-');

        if ($id == 0) {
            $finalData['created_at'] = date("Y-m-d H:i:s");
            $finalData->save();
            $id = $finalData->id;
            $objAccessPermissionsModel->user_type_id = $id;
            $objAccessPermissionsModel->module_id = 1;
            $objAccessPermissionsModel->sub_module_id = $imenu_codes;
            $objAccessPermissionsModel->user_access = $user_access;
            $objAccessPermissionsModel->status = 0;
            $objAccessPermissionsModel->created_by = Session::get('id');
            $objAccessPermissionsModel->created_at = date("Y-m-d H:i:s");
            $objAccessPermissionsModel->save();
            return array('id' => $id, 'status' => 'success', 'message' => "Role data saved!" );
        }else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                DB::delete("delete from $this->accesspermissionsTable where user_type_id = $id");
                $objAccessPermissionsModel->user_type_id = $id;
                $objAccessPermissionsModel->module_id = 1;
                $objAccessPermissionsModel->sub_module_id = $imenu_codes;
                $objAccessPermissionsModel->user_access = $user_access;
                $objAccessPermissionsModel->status = 0;
                $objAccessPermissionsModel->updated_by = Session::get('id');
                $objAccessPermissionsModel->updated_at = date("Y-m-d H:i:s");
                $objAccessPermissionsModel->save();
                return array('id' => $id, 'status' => 'success', 'message' => "Role data updated!");
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

    function typeDetails($param= array()){
        $result = DB::select("SELECT t.id, t.name,d.name as department_name,case when t.status = 0  then 'Active' when t.status = 1 then 'Inactive' end as status,date_format(t.created_at,'%d-%m-%Y') as created_at FROM " . $this->table ." as t 
            left join " . $this->departmentsTable . " as d on
            t.department_id = d.id
            order by t.id DESC");
        return $result;
    }
}
