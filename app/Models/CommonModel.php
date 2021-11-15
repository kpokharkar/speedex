<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonModel extends Model
{
    use HasFactory;

    public static function getSingle($table,$data){
		$result = DB::table($table)
		->where($data)
		->get();
		if($result){
			return $result;
		}else{
			return false;
		}	
	}
	Public function checkUnique($table, $uniqueField, $uniqueFieldValue, $id = 0) {
        $query = "SELECT COUNT(*) as total FROM " . $table . " WHERE $uniqueField = '" . $uniqueFieldValue . "'";
        $id = (int) $id;
        if ($id > 0) {
            $query .= " AND id != " . $id . "";
        }
        $resultSet = DB::select(DB::raw($query));
        if (!$resultSet) {
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }
    Public function checkMultiUnique($table, $uniqueFieldValue, $id = 0) {
        $query = "SELECT COUNT(*) as total FROM " . $table . " WHERE 1=1 ";
        foreach ($uniqueFieldValue as $key => $value) {
            $query .= " AND $key = '" . $value . "'";
        }
        $id = (int) $id;
        if ($id > 0) {
            $query .= " AND id != " . $id . "";
        }
        $resultSet = DB::select(DB::raw($query));
        if (!$resultSet) {
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }

    public static function simpleUpdate($table,$condition,$data){
        $result = DB::table($table)
        ->where($condition)
        ->update($data);
        if($result){
            return $result;
        }else{
            return false;
        }   
    }
}