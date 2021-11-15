<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class Quotation extends Model {

	protected $table = 'quotation_master';

    protected $fillable = [
        'id', 'company_id','charges1','charges2','charges3','quotation_type','surface_multi','created_at', 'created_by','updated_at'
    ];
        
    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }    

    function getQuotationDetails() {
        $query = "SELECT qm.id,name,email_id,DATE_FORMAT(qm.created_at,'%d-%m-%Y') as create_date FROM quotation_master qm
            left join company_master cm on
            qm.company_id = cm.id order by qm.id DESC";
        $result = DB::select(DB::raw($query));
        return $result;
    }
    
    public function getSaveData() {
        return array('id', 'company_id','charges1','charges2','charges3','quotation_type','surface_multi','created_at', 'created_by','updated_at');
    }

    public function saveData($post) {
        
        $saveFields = $this->getSaveData();
        
        $finalData = new Quotation;
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
            return array('id' => $id, 'status' => 'success', 'message' => "Quotation Data Saved.");
        }
        else {
            if ($this->getSingleData($id)) {
                $finalData['updated_at'] = date("Y-m-d H:i:s");
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('id' => $id, 'status' => 'success', 'message' => "Quotation Data Updated.");
            }
            else {
                return false;
            }
        }
    }

}