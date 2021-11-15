<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class SfcService extends Model {
    
    public $timestamps = false;
	protected $table = 'sfc_service';

    protected $fillable = [
        'id', 'quotation_id', 's_column_1', 's_column_2', 's_column_3', 's_column_4', 's_column_5'
    ];

    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    } 

    function deleteDetails($id) {
        DB::delete("delete from " . $this->table. " where quotation_id=$id");            
    }

    function getQuotationDetails() {
        $query = "SELECT qm.id,name,email_id,DATE_FORMAT(qm.created_at,'%d-%m-%Y') as create_date FROM quotation_master qm
            left join company_master cm on
            qm.company_id = cm.id order by qm.id DESC";
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function getSaveData() {
        return array('id', 'quotation_id', 's_column_1', 's_column_2', 's_column_3', 's_column_4', 's_column_5');
    }

    public function saveData($post) {
        
        $saveFields = $this->getSaveData();
        $finalData = new SfcService;
        foreach ($post as $k => $v) {
            if (in_array($k, $saveFields)) {
                $finalData[$k] = $v;
            }
        }
        $finalData->save();
        return array('status' => 'success', 'message' => "Quotation Data Saved.");
    }

}