<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Common extends Model {
    
    use Notifiable;
    
    public function getQueryWithFilters($qry, $searchFormVlaue, $returnFilters = false) {
        $returnParams = array();
        if (count($searchFormVlaue)) {
            foreach ($searchFormVlaue as $key => $arrtypeValue) {
                $type = $arrtypeValue['type'];
                $value = trim($arrtypeValue['value']);
                if ($value != "") {
                    $key = str_replace("-", ".", $key);
                    if (strtolower($type) == "text") {
                        $sqry = " AND $key LIKE '%" . $value . "%' ";
                    } else {
                        $sqry = " AND $key = '" . $value . "' ";
                    }
                    $qry .= $sqry;
                    $returnParams[$key] = array($value, $sqry);
                }
            }
        }
        if ($returnFilters) {
            return $returnParams;
        }
        else {
            return $qry;
        }
    }
    
    public function getDistinct($table, $field) {
        $query = "SELECT distinct($field), id FROM $table WHERE status = 'Active'";
        $result = DB::select(DB::raw($query));
        $resultData = array();
        foreach ($result as $data) {
            $row = json_decode(json_encode($data), True);
            $resultData[$row['id']] = $row[$field];
        }
        return $resultData;
    }
    
    Public function checkUnique($table, $uniqueField, $uniqueFieldValue, $id = 0) {
        $query = "SELECT COUNT(*) as total FROM " . $table . " WHERE $uniqueField = '" . $uniqueFieldValue . "'";
        $id = (int) $id;
        if ($id > 0) {
            $query .= " AND id != " . $id . "";
        }
        $resultSet = DB::select(DB::raw($query));
        if (!$resultSet) {
            //throw new \Exception("Could not find row $id");
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
            //throw new \Exception("Could not find row $id");
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }
    
    Public function checkDependency($parentTable, $parentTableField, $id) {
        $query = "SELECT COUNT(*) as total FROM " . $parentTable . " WHERE " . $parentTableField . " = " . $id . "";
        $resultSet = DB::select(DB::raw($query));
        if (!$resultSet) {
            //throw new \Exception("Could not find row $id");
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }
    
    Public function checkMultiFieldDependency($parentTable, $parentTableFields = array(), $id = "") {
        $where = " ";
        $resultSet = false;
        if (count($parentTableFields) > 0) {
            $where = " WHERE 1=1 AND ";
            $c = 0;
            foreach ($parentTableFields as $field) {
                if ($c == 0) {
                    $where .= " ( $field = '" . $id . "' ";
                } else {
                    $where .= " OR $field = '" . $id . "'";
                }
                if ($c == count($parentTableFields) - 1) {
                    $where .= " )";
                }
                $c++;
            }
            $query = "SELECT COUNT(*) as total
            FROM " . $parentTable . " 
            $where ";
            $resultSet = DB::select(DB::raw($query));
        }
        if (!$resultSet) {
            //throw new \Exception("Could not find row $id");
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }

}