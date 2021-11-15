<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Common;
use App\Models\Quotation;
use App\Mail\SendClientMail;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Models\CargoService;
use App\Models\SfcService;
use App\Models\AirService;
use App\Models\CourierMode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller {
    
    function index() {
        $obj = new Quotation;
        $data['getQuotationDetails'] =  $obj->getQuotationDetails();
        return view('quotation.index',$data);
    }

    function sendMail() {
        $details = [
            'title' => 'adasdasd',
            'body' => 'aqweewqeqw'
        ];
        Mail::to("kpokharkar72@gmail.com")->send(new SendClientMail($details));
        return "Email sent";
    }

    function add(Request $request,$id = null) {
        $id = isset($id) ? (int) $id : (int) 0;
        $data = array();
        $obj = new Quotation;
        $objSfcService = new SfcService;
        $objCargoService = new CargoService;
        $objAirService = new AirService;
        $objCourierMode = new CourierMode;
        if ($id != 0) {
            $data['getSingleData'] = $obj->getSingleData($id);
            $data['getCargoService'] = CargoService::where('quotation_id','=',$id)->first();
            $data['getSfcService'] = SfcService::where('quotation_id','=',$id)->first();
            $data['getAirService'] = AirService::where('quotation_id','=',$id)->first();
            $data['getCourier'] = CourierMode::where('quotation_id','=',$id)->first();
        }
        else {
            $data['getCargoService'] = '';
            $data['getSingleData'] = '';
            $data['getSfcService'] ='';
            $data['getAirService'] ='';
            $data['getCourier'] ='';
        }
        // $pdf = PDF::loadView('quotation.index', $data, [
        //            'format' => 'A4'
        //       ]);
        
        // \Mail::send('quotation.index', $data, function($message) use ($pdf){
        //     $message->from('kpokharkar@sapat.com');
        //     $message->to('kpokharkar72@gmail.com');
        //     $message->subject('Quotation');
        //     $message->attachData($pdf->output(),'Quotation.pdf');
        // });
        $data['getCompanyDetails'] = DB::table('company_master')->where('status', 'Active')->get();
        return view('quotation.add',$data);	
    }

    function save(Request $request) {
        $returnData = array();
        $obj = new Quotation;
        $post = $request->all();
        $id = $request->id;
        if($id==''){
            $objCommon = new Common;
	 		$uniqueFieldValue = array(
	 			'company_id' => $request->company_id
        	);
	        $uniqueCount = $objCommon->checkMultiUnique('quotation_master', $uniqueFieldValue, $request['id']);
	        if ($uniqueCount > 0) {
	            $returnData = array('status' => 'exist', 'message' => 'Already exists!');
	            return json_encode($returnData);
	            exit;
	        }
        }
        $returnData = $obj->saveData($post);
        $quotation_id = $returnData['id'];
        $post['quotation_id'] = $quotation_id;
        $objSfcService = new SfcService;
        $objCargoService = new CargoService;
        $objAirService = new AirService;
        $objCourierMode = new CourierMode;
        $objCargoService->deleteDetails($quotation_id);
        $objSfcService->deleteDetails($quotation_id);
        $objAirService->deleteDetails($quotation_id);
        $objCourierMode->deleteDetails($quotation_id);
        
        $returnData = $objCargoService->saveData($post);
        $returnData = $objSfcService->saveData($post);
        
        $returnData = $objAirService->saveData($post);
        
        $returnData = $objCourierMode->saveData($post);
        $returnData = array('status' => 'success', 'message' => "Quotation Data Saved.");
        return json_encode($returnData);
    }
    
    function getType(Request $request){
        $consignor = $request->consignor;
        return json_encode(Quotation::where('company_id', '=', $consignor)->first());
    }
    
    function alreadyExists(Request $request){
        $objCommon = new Common;
	 		$uniqueFieldValue = array(
	 			'company_id' => $request->company_id
        	);
	        $uniqueCount = $objCommon->checkMultiUnique('quotation_master', $uniqueFieldValue, $request['id']);
	        if ($uniqueCount > 0) {
	            $returnData = array('status' => 'exist', 'message' => 'Already exists!');
	            return json_encode($returnData);
	            exit;
	       }
    }
}