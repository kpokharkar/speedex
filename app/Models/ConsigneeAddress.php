<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class ConsigneeAddress extends Model {

public $timestamps = false;
	protected $table = 'consignee_address';

    protected $fillable = [
         'id', 'consignee_id', 'name', 'mobile', 'destination', 'address', 'pincode','status'
    ];
    
	public function getSaveData() {
        return array('id', 'consignee_id', 'name', 'mobile', 'destination', 'address', 'pincode','status');
    }
    
    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.consignee_id=$id");
        return $result;
    }
    
    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new ConsigneeAddress;
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
            $finalData->save();
            $id = $finalData->id;
            return array('status' => 'success', 'message' => "Consignee Data Saved.");
        }
        else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('status' => 'success', 'message' => "Consignee Data Updated.");
            }
            else {
                return false;
            }
        }
    }
}