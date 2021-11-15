<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class BookingTrackDetails extends Model {
    
    public $timestamps = false;
    
	protected $table = 'booking_track';

    protected $fillable = [
        'id', 'track_id', 'track_date', 'track_io', 'track_description', 'status'
    ];

    public function getSingleData($id) {
        $result = DB::select("SELECT c.*,DATE_FORMAT(c.track_date,'%d/%m/%Y') as track_date FROM " . $this->table . " as c WHERE c.track_id=$id");
        return $result;
    }

    function saveData($postData) {
        if(isset($postData['track_io'])) {
            $id = $postData['track_id'];
            DB::delete("Delete from " . $this->table .  " where track_id = $id");
            $track_date = $postData['track_date'];
            $track_io = $postData['track_io'];
            $track_description = $postData['track_description'];
            for($i=0;$i<count($track_io);$i++) {
                $track_date_convert = date("Y-m-d", strtotime($track_date[$i]));
                DB::insert("insert into " . $this->table ." (track_id, track_date, track_io, track_description,status) values ($id,'$track_date_convert','$track_io[$i]','$track_description[$i]','0')");
            }
            $reason=$postData['reason'];
            $attach_file=$postData['attach_file'];
            if($reason) {
                DB::update("update booking_master set reason='$reason' where id=$id");
            }
            if($attach_file) {
                DB::update("update booking_master set attach_file='$attach_file' where id=$id");
            }
        }
    }

}