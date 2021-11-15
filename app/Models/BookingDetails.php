<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class BookingDetails extends Model {

	protected $table = 'booking_details';

    protected $fillable = [
        'id', 'booking_id', 'package', 'method_packing', 'nature_goods', 'net_weight', 'length', 'width', 'height', 'divide','chargeable_weight','created_at','updated_at'
    ];

    public function getSingleData($id) {
        $result = DB::select("SELECT c.* FROM " . $this->table . " as c WHERE c.booking_id=$id");
        return $result;
    }

    function saveData($postData) {
        if(isset($postData['package'])) {
            $id = $postData['id'];
            DB::delete("Delete from " . $this->table .  " where booking_id = $id");
            $package = $postData['package'];
            $method_packing = $postData['method_packing'];
            $nature_goods = $postData['nature_goods'];
            $net_weight = $postData['net_weight'];
            $length = $postData['length'];
            $width = $postData['width'];
            $height = $postData['height'];
            $divide = $postData['divide'];
            $chargeable_weight = $postData['chargeable_weight'];
            $created_at = date("Y-m-d H:i:s");
            for($i=0;$i<count($package);$i++) {
                DB::insert("insert into " . $this->table ." (booking_id, package, method_packing, nature_goods, net_weight, length, width, height,divide, chargeable_weight,created_at) values ($id,'$package[$i]','$method_packing[$i]','$nature_goods[$i]','$net_weight[$i]','$length[$i]','$width[$i]','$height[$i]','$divide[$i]','$chargeable_weight[$i]','$created_at')");
            }
            return array( 'status' => 'success', 'message' => "Booking data saved!");
        }
    }
}