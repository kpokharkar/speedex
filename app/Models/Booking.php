<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Request;

class Booking extends Model {
    
    public $timestamps = false;
    
	protected $table = 'booking_master';

    protected $fillable = [
        'id', 'consignor', 'method_type', 'date', 'awb_no', 'origin', 'destination', 'consignee', 'pincode', 'service', 'types', 'invoice', 'e_way_bill_no',  'address', 'attach_file', 'contact_person', 'contact_no', 'vendor_id', 'document_type', 'shipping_mode', 'reason', 'vendor_2','created_date'
    ];
    
    public function getSaveData() {
        return array('id', 'consignor', 'method_type', 'date', 'awb_no', 'origin', 'destination', 'consignee', 'pincode', 'service', 'types', 'invoice', 'e_way_bill_no',  'address', 'attach_file', 'contact_person', 'contact_no', 'vendor_id', 'document_type', 'shipping_mode', 'reason', 'vendor_2','created_date');
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
        
        $finalData = new Booking;
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
            $finalData['created_date'] = date("Y-m-d H:i:s");
            $new_destination = $post['new_destination'];
            if($new_destination){
                $finalData['destination'] = $new_destination;
                $consignee = $post['consignee'];
                $contact_person = $post['contact_person'];
                $contact_no = $post['contact_no'];
                $address = $post['address'];
                $pincode = $post['pincode'];
                DB::insert("INSERT INTO consignee_address(consignee_id, name, mobile, destination, address, pincode, status) 
                VALUES ('$consignee','$contact_person','$contact_no','$address','$pincode',0)");
            }
            $finalData->save();
            $id = $finalData->id;
            return array('id' => $id, 'status' => 'success', 'message' => "Booking Data Saved.");
        }
        else {
            if ($this->getSingleData($id)) {
                $finalData->exists = true;
                $finalData->id = $id;
                $finalData->save();
                return array('id' => $id, 'status' => 'success', 'message' => "Booking Data Updated.");
            }
            else {
                return false;
            }
        }
    }

    function getBookingDetails() {
        $result = DB::select(DB::raw("SELECT bm.id, cm.name, bm.contact_person, company_name as consignee, origin, destination, DATE_FORMAT(date,'%d-%m-%Y') as bookingDate, 
                document_type, shipping_mode, types, vm.name as vendor_name,awb_no,pincode  FROM booking_master bm
                left join company_master cm on
                bm.consignor = cm.id
                left join consignee_details cd on
                bm.consignee = cd.id
                left join vendor_master vm on
                bm.vendor_id = vm.id WHERE bm.id not in(SELECT track_id FROM booking_track) order by bm.id DESC"));
        return $result;
    }
    
    function inscanCount() {
        $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
            destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
            inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
            left join company_master cm on bm.consignor = cm.id
            left join vendor_master vm on bm.vendor_id = vm.id 
            where td.status=0 and attach_file IS NULL and track_io IN('Inscan','Outscan','InTransit') order by bm.id DESC");
            // where td.status=0 and attach_file IS NULL OR attach_file = '' and track_io IN('Inscan','Outscan','InTransit') order by bm.id DESC");
        return $result;
    }

    function countAll($param= array()) {
        $filter = $param['filter'];
        $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
            destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
            inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
            left join company_master cm on bm.consignor = cm.id
            left join vendor_master vm on bm.vendor_id = vm.id 
            where td.status=0 and attach_file IS NULL and track_io='$filter' order by bm.id DESC");
            // where td.status=0 and attach_file='' and track_io='$filter' order by bm.id DESC");
        return $result;
    }

    function podCount() {
        $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
            destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
            inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
            left join company_master cm on bm.consignor = cm.id
            left join vendor_master vm on bm.vendor_id = vm.id 
            where td.status=0 and attach_file<>'' and track_io='Delivered' order by bm.id DESC");
            // where td.status=0 and attach_file<>'' and track_io='Delivered' order by bm.id DESC");
        return $result;
    }
    
    function getFilter($filter) {
        if($filter=='inscan') {
            $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
                destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
                inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
                left join company_master cm on bm.consignor = cm.id
                left join vendor_master vm on bm.vendor_id = vm.id 
                where td.status=0 and attach_file IS NULL and track_io IN('Inscan','Outscan','InTransit') order by bm.id DESC");
                // where td.status=0 and attach_file IS NULL OR attach_file = '' and track_io IN('Inscan','Outscan','InTransit') order by bm.id DESC");
            return $result;
        }
        else if($filter=='pod_attached') {
            $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
                destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
                inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
                left join company_master cm on bm.consignor = cm.id
                left join vendor_master vm on bm.vendor_id = vm.id 
                where td.status=0 and attach_file<>'' and track_io='Delivered' order by bm.id DESC");
            return $result;
        }
        else if($filter=='new_record') {
            $result = DB::select(DB::raw("SELECT bm.id, cm.name, bm.contact_person, consignee, origin, destination, DATE_FORMAT(date,'%d-%m-%Y') as bookingDate, 
                document_type, shipping_mode, types, vm.name as vendor_name,awb_no  FROM booking_master bm
                left join company_master cm on
                bm.consignor = cm.id
                left join vendor_master vm on
                bm.vendor_id = vm.id WHERE bm.id not in(SELECT track_id FROM booking_track)"));
            return $result;
        }
        else {
            $result = DB::select("SELECT bm.id,cm.name,vm.name as vendor_name, track_io, consignor, date_format(date,'%d-%m-%Y') as bookingDate, awb_no, origin,
                destination, consignee, pincode, invoice, e_way_bill_no, package,attach_file, contact_no, reason, created_date FROM booking_master bm
                inner join(select * from booking_track  where id in (select max(id) from booking_track group by track_id)) as td on bm.id = td.track_id
                left join company_master cm on bm.consignor = cm.id
                left join vendor_master vm on bm.vendor_id = vm.id 
                where td.status=0 and attach_file IS NULL and track_io='$filter' order by bm.id DESC");
                // where td.status=0 and attach_file IS NULL OR attach_file = '' and track_io='$filter' order by bm.id DESC");
            return $result;
        }
        //return $result->result_array();
    }
}