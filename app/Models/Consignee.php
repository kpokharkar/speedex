<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class Consignee extends Model {

	protected $table = 'consignee_details';

    protected $fillable = [
         'id', 'consignor', 'company_name', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
    
	public function getSaveData() {
        return array('id', 'consignor', 'company_name', 'created_by', 'created_at', 'updated_by', 'updated_at');
    }
    
    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.*,date_format('%d-%m-%Y',c.created_at) as created_at FROM " . $this->table . " as c WHERE c.id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }
    
    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new Consignee;
        foreach ($post as $k => $v) {
            if (in_array($k, $saveFields)) {
                $finalData[$k] = $v;
            }
        }
        
        if (isset($finalData['id'])) {
            $id = (int) $finalData['id'];
        }
        else {
            $id = 0;
            unset($finalData['id']);
        }
        
        if ($id == 0) {
            $finalData['created_at'] = date("Y-m-d H:i:s");
            $finalData['created_by'] = 1;
            $finalData->save();
            $id = $finalData->id;
            return array('id' => $id, 'status' => 'success', 'message' => "Consignee Data Saved.");
        }
        else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('id' => $id, 'status' => 'success', 'message' => "Consignee Data Updated.");
            }
            else {
                return false;
            }
        }
    }
    
    function getDetails(){
        $result = DB::SELECT("SELECT c.id, cm.name, company_name,  c.created_at FROM consignee_details c
        left join company_master cm on
        c.consignor = cm.id order by id desc");
        return $result;
    }
}