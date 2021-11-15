<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class AirService extends Model {

    public $timestamps = false;
	protected $table = 'air_service';

    protected $fillable = [
         'id', 'quotation_id', 'a_column_1', 'a_column_2', 'a_column_3', 'a_column_4', 'a_column_5'
    ];
    
    public function getSaveData() {
        return array('id', 'quotation_id', 'a_column_1', 'a_column_2', 'a_column_3', 'a_column_4', 'a_column_5');
    }

    function deleteDetails($id){
        DB::delete("delete from " . $this->table. " where quotation_id=$id");            
    }

    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $finalData = new AirService;
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