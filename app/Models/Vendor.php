<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class Vendor extends Model {

	protected $table = 'vendor_master';

    protected $fillable = [
        'id', 'name', 'mobile_no', 'email_id', 'status','created_at', 'created_by', 'updated_at'
    ];
    
	public function getSaveData() {
        return array('id', 'name', 'mobile_no', 'email_id', 'status','created_at', 'created_by', 'updated_at');
	}

    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }
    
    public function saveData($post) {
        
        $saveFields = $this->getSaveData();
        
        $finalData = new Vendor;
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
            return array('id' => $id, 'status' => 'success', 'message' => "Vendor 1 Data Saved.");
        }
        else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('id' => $id, 'status' => 'success', 'message' => "Vendor 1 Data Updated.");
            }
            else {
                return false;
            }
        }
    }
    
}