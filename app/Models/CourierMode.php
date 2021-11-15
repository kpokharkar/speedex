<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class CourierMode extends Model {
    
    public $timestamps = false;
	protected $table = 'courier_mode';

    protected $fillable = [
         'id', 'quotation_id', 'type', 'c_column_1', 'c_column_2', 'c_column_3', 'c_column_4', 'c_column_5', 'c_column_6', 'c_column_7', 'c_column_8', 'c_column_9', 'c_column_10', 'c_column_11', 'c_column_12', 'c_column_13', 'c_column_14'
    ];
    
    public function getSaveData() {
        return array('id', 'quotation_id', 'type', 'c_column_1', 'c_column_2', 'c_column_3', 'c_column_4', 'c_column_5', 'c_column_6', 'c_column_7', 'c_column_8', 'c_column_9', 'c_column_10', 'c_column_11', 'c_column_12', 'c_column_13', 'c_column_14');
    }

    function deleteDetails($id){
        DB::delete("delete from " . $this->table. " where quotation_id=$id");            
    }

    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new CourierMode;
        foreach ($post as $k => $v) {
            if (in_array($k, $saveFields)) {
                $finalData[$k] = $v;
            }
        }
            $finalData->save();
            $id = $finalData->id;
            return array('id' => $id, 'status' => 'success', 'message' => "Company data saved!");
    }

}