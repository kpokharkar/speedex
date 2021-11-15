<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Common;
use App\Models\Booking;
use App\Models\Consignee;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\BookingDetails;
use App\Models\VendorDestination;
use App\Models\ConsigneeAddress;
use App\Models\BookingTrackDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller {
    
    function index() {
        $obj = new Booking;
        $data['getBookingDetails'] = $obj->getBookingDetails();
        $data['inscanCount'] = $obj->inscanCount();
        $param = array('filter' => 'reason');
        $data['reasonCount'] = $obj->countAll($param);
        $param = array('filter' => 'Out_For_Delivery');
        $data['outForDeliveryCount'] = $obj->countAll($param);
        $param = array('filter' => 'Delivered');
        $data['deliveredCount'] = $obj->countAll($param);
        $data['podCount'] = $obj->podCount();
        return view('booking.index',$data);
    }

    function add(Request $request,$id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $obj = new Booking;
        $objBookingDetails = new BookingDetails;
        $objBookingTrackDetails = new BookingTrackDetails;
        if ($id != 0) {
            $data['singleData'] = $obj->getSingleData($id);
            $data['singleBookingDetails'] = $objBookingDetails->getSingleData($id);
            $consignee = $data['singleData']['consignee'];
            $vendor_2 = $data['singleData']['vendor_2'];
            $data['contactDetails'] = ConsigneeAddress::where('consignee_id','=',$consignee)->get();
            $data['vendorDestination'] = VendorDestination::where('id','=',$vendor_2)->get();
        }
        else {
            $data['singleData'] = '';
            $data['singleBookingDetails'] = '';
            $data['contactDetails'] = '';
            $data['vendorDestination'] ='';
        }
        $data['getCompanyDetails'] = DB::table('company_master')->where('status', 'Active')->get();
        $data['getVendorDetails'] = DB::table('vendor_master')->where('status', 'Active')->get();
        $data['getConsignees'] = Consignee::get();
        return view('booking.add',$data);
    }

    function view($id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $obj = new Booking;
        $objBookingDetails = new BookingDetails;
        $objBookingTrackDetails = new BookingTrackDetails;
        $data['track_id'] = $id;
        if ($id != 0) {
            $data['singleData'] = $obj->getSingleData($id);
            $data['singleBookingTrackDetails'] = BookingTrackDetails::where('track_id','=',$id)->get();
        }
        else {
            $data['singleData'] = '';
            $data['singleBookingTrackDetails'] = '';
        }
        return view('booking.view',$data);
    }

    function save(Request $request) {
        $returnData = array();
    	$id = $request['id'];
    	if($id==''){
	    	$validator = Validator::make($request->all(), ([
					'consignor' => 'required',
					'consignee' => 'required',
					'origin' => 'required',
					'awb_no' => 'required',
					'date' => 'required',
					'document_type' => 'required',
					'shipping_mode' => 'required',
					'address' => 'required',
					'pincode' => 'required',
	        ]));

	        if ($validator->fails()) {
	            $returnData = array('status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors());
	            return json_encode($returnData);
	        }
    	}

        $obj = new Booking;
        $post = $request->all();
        $returnData = $obj->saveData($post);
        $post['id'] = $returnData['id'];
        $objBookingDetails = new BookingDetails;
        $returnData = $objBookingDetails->saveData($post);
        if (count($returnData) <= 0) {
            $returnData = array('status' => 'error', 'message' => 'Error in data insertion');
        }
        return json_encode($returnData);
        
    // 	$returnData = array();
    //     $obj = new Booking;
    //     $post = $request->all();
    //     $ger_last_id = $obj->saveData($post);
    //     $id = $ger_last_id['id'];
    //     $objBookingDetails = new BookingDetails;
    //     $objBookingDetails->saveData($request->all(),$id);
    //     return redirect('booking')->with('success', 'Booking Data Saved.');   
    }
    
    function saveTrack(Request $request) {
    	$returnData = array();
        $obj = new Booking;
        $post = $request->all();
        $post['attach_file'] = '';
        if(isset($_FILES['attach_file']['name']) && $_FILES['attach_file']['name'] != "") {
            $thumbnail_image = $_FILES['attach_file']['name'];
            $subfolder = './public/attach_file/';
            $ext = strtolower(pathinfo($_FILES['attach_file']['name'], PATHINFO_EXTENSION));
            $randNumber = rand(10000,99999);
            $imageName = 'attach_file' . $randNumber . '.' . $ext;
            $post['attach_file'] = $imageName;
            $path = $subfolder . '/' . $imageName;
            move_uploaded_file($_FILES['attach_file']['tmp_name'],$path);
        }
        $objBookingTrackDetails = new BookingTrackDetails;
        $objBookingTrackDetails->saveData($post);
        return redirect('booking')->with('success', 'Tracking Data Saved.');   
    }
    function viewInscan(Request $request) {
        $obj = new Booking;
        $data['getBookingDetails'] = $obj->getFilter($request->filter);
        $data['type'] = $request->filter;
    	return view('booking.inscan',$data);
    }
    
    function getConsignee(Request $request){
        $consignor = $request->consignor;
        return json_encode(Consignee::where('consignor','=',$consignor)->get());
    }
    
    function getDestination(Request $request){
        $consignee = $request->consignee;
        return json_encode(ConsigneeAddress::where('consignee_id','=',$consignee)->get());
    }
    
    function getVendorDestination(Request $request){
        $destination = $request->destination;
        $consignee = $request->consignee;
        $data['vendorDetails'] = VendorDestination::where('destination','=',$destination)->get();
        if($consignee){
            $data['contactDetails'] = ConsigneeAddress::where('destination','=',$destination)->where('consignee_id','=',$consignee)->first();
        }
        return json_encode($data);
    }
    
    function destory($id){
        $obj = new Booking;
        $booking = $obj->find($id);
        $booking->delete();
        DB::delete("delete from booking_details where booking_id=$id");
        $returnData = array('status' => 'success', 'message' => 'Booking data deleted');
        return json_encode($returnData);
    }
}