@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Booking</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="<?php echo url('booking')?>" title="Back To Booking Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Booking Lists</a>
                        </div>
                    </div>
                </div>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="booking_details" method="post" enctype="multipart/form-data" action ="<?php echo url('/booking/save')?>">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Booking Form</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#booking" role="tab">
                                    <span class="d-md-block d-block"><i class="mdi mdi-book-open h5"></i> Booking</span>
                                </a>
                            </li>
                            <?php if(isset($singleData['id'])){?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#track" role="tab">
                                    <span class="d-md-block d-block"><i class="mdi mdi-truck h5"></i> Track</span>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="booking" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Booking Date <span class="text-danger">*</span></label>
                                            <input type="date" id="date" name="date" class="form-control" value="{{isset($singleData['date']) ? $singleData['date'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Airway Bill No. (AWB No.) <span class="text-danger">*</span></label>
                                            <input type="text" id="awb_no" name="awb_no" class="form-control" value="{{isset($singleData['awb_no']) ? $singleData['awb_no'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Origin <span class="text-danger">*</span></label>
                                            <input type="text" id="origin" name="origin" class="form-control" value="{{isset($singleData['origin']) ? $singleData['origin'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Destination <span class="text-danger">*</span></label>
                                            <input type="text" id="destination" name="destination" class="form-control" value="{{isset($singleData['destination']) ? $singleData['destination'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Consignor <span class="text-danger">*</span></label>
                                            <select id="consignor" name="consignor" class="form-control" required="">
                                                <option value="">Select Consignor</option>
                                                <?php foreach($getCompanyDetails as $company) { ?>
                                                <option value="<?php echo $company->id?>" {{ isset($singleData['consignor']) && $singleData['consignor'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Method <span class="text-danger">*</span></label>
                                            <select id="method_type" name="method_type" class="form-control" required="">
                                                <option value="">Select Method</option>
                                                <?php 
                                                 if($singleData){
                                                foreach($getMethodList as $method) { ?>
                                                <option value="<?php echo $method->quotation_type?>" {{ isset($singleData['method_type']) && $singleData['method_type'] == $method->quotation_type ? 'selected' : ''}}><?php echo $method->quotation_type?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Consignee Name <span class="text-danger">*</span></label>
                                            <input type="text" id="consignee" name="consignee" class="form-control" value="{{isset($singleData['consignee']) ? $singleData['consignee'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Contact Person Name</label>
                                            <input type="text" id="contact_person" name="contact_person" class="form-control" value="{{isset($singleData['contact_person']) ? $singleData['contact_person'] : ''}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Contact Person Mobile No.</label>
                                            <input type="text" id="contact_no" name="contact_no" class="form-control" value="{{isset($singleData['contact_no']) ? $singleData['contact_no'] : ''}}" minlength="10" maxlength="10" />
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Address <span class="text-danger">*</span></label>
                                            <input type="text" id="address" name="address" class="form-control" value="{{isset($singleData['address']) ? $singleData['address'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Pincode <span class="text-danger">*</span></label>
                                            <input type="text" id="pincode" name="pincode" class="form-control" value="{{isset($singleData['pincode']) ? $singleData['pincode'] : ''}}" minlength="6" maxlength="6" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Invoice No.</label>
                                            <input type="text" id="invoice" name="invoice" class="form-control" value="{{isset($singleData['invoice']) ? $singleData['invoice'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>E-Way Bill No.</label>
                                            <input type="text" id="e_way_bill_no" name="e_way_bill_no" class="form-control" value="{{isset($singleData['e_way_bill_no']) ? $singleData['e_way_bill_no'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Vendor</label>
                                            <select id="vendor_id" name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                                <?php foreach($getVendorDetails as $vendor) { ?>
                                                <option value="<?php echo $vendor->id?>" {{ isset($singleData['vendor_id']) && $singleData['vendor_id'] == $vendor->id ? 'selected' : ''}}><?php echo $vendor->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Service <span class="text-danger">*</span></label>
                                            <select id="service" name="service" class="form-control" required="">
                                                <option value="">Select Service</option>
                                                <option value="oda" {{ isset($singleData['service']) && $singleData['service'] == 'oda' ? 'selected' : ''}}>ODA</option>
                                                <option value="da" {{ isset($singleData['service']) && $singleData['service'] == 'da' ? 'selected' : ''}}>Delivery Area</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Type <span class="text-danger">*</span></label>
                                            <select id="types" name="types" class="form-control" required="">
                                                <option value="">Select Type</option>
                                                <option value="metro" {{ isset($singleData['types']) && $singleData['types'] == 'metro' ? 'selected' : ''}}>Metro</option>
                							    <option value="within_state" {{ isset($singleData['types']) && $singleData['types'] == 'within_state' ? 'selected' : ''}}>Within State</option>
                							    <option value="rest_of_india" {{ isset($singleData['types']) && $singleData['types'] == 'rest_of_india' ? 'selected' : ''}}>Rest of India</option>
                							    <option value="east_north_east" {{ isset($singleData['types']) && $singleData['types'] == 'east_north_east' ? 'selected' : ''}}>East (North East)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Document Type <span class="text-danger">*</span></label>
                                            <?php 
                                                $checkedTypeDoc ='';
                                                $checkedTypeNonDoc = '';
                                                if(isset($singleData['document_type']) == 'doc') {
                                                    $checkedTypeDoc = 'checked';
                                                }
                                                else if(isset($singleData['document_type']) == 'non_doc') {
                                                    $checkedTypeNonDoc = 'checked';
                                                }
                                            ?>
                                            <br>
                                            <label><input type="radio" class="radio-inline" name="document_type" id="document_type" onchange="documentType('doc')" value="doc" <?php echo $checkedTypeDoc?>>Doc</label>
                                            <label><input type="radio" class="radio-inline" name="document_type" id="document_type" onchange="documentType('non_doc')" value="non_doc" <?php echo $checkedTypeNonDoc?>>Non Doc</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Shipping Mode <span class="text-danger">*</span></label>
                                            <?php 
                                                $shippingTypeAir ='';
                                                $checkedTypeCargo = '';
                                                $checkedTypeSurface = '';
                                                $checkedTypeCourier = '';
                                                if(isset($singleData['shipping_mode']) == 'air') {
                                                    $shippingTypeAir = 'checked';
                                                }
                                                else if(isset($singleData['shipping_mode']) == 'cargo') {
                                                    $checkedTypeCargo = 'checked';
                                                }
                                                else if(isset($singleData['shipping_mode']) == 'surface') {
                                                    $checkedTypeSurface = 'checked';
                                                }
                                                else if(isset($singleData['shipping_mode']) == 'courier') {
                                                    $checkedTypeCourier = 'checked';
                                                }
                                            ?>
                                            <br>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="air" <?php echo $shippingTypeAir?>>Air</label>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="cargo" <?php echo $checkedTypeCargo?>>Cargo</label>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="surface" <?php echo $checkedTypeSurface?>>Surface</label>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="courier" <?php echo $checkedTypeCourier?>>Courier</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr><h4 class="mt-0 header-title">Package Details</h4><br>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-4">
                                        <button type="button" class="btn btn-outline-secondary" id="add_package" name="add_package"><i class="fa fa-plus"></i>&nbsp; Add Package</button>
                                    </div>
                                </div>
                                <div class="row form-group" id="table_packagees" style="display: none;">
                                    <div class="col-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped" id="table_package_add">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>No. of Package</th>
                                                        <th>Method of Packing</th>
                                                        <th>Nature of Goods</th>
                                                        <th>Actual Weight</th>
                                                        <th>Dimension</th>
                                                        <th>Chargeable Weight</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_table"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="track" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row form-group">
                                            <div class="col-12 col-md-4">
                                                <button type="button" class="btn btn-outline-secondary" id="add_track" name="add_track"><i class="fa fa-plus"></i>&nbsp; Add Track</button>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="table_track" style="display: none;">
                                            <div class="col-12 col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped" id="table_track_add">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Date</th>
                                                                <th>Inscan / Outscan</th>
                                                                <th>Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody_table_track"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="display_only_in_delivered">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Reason </label>
                                                    <input type="text" id="reason" name="reason" class="form-control" value="{{isset($singleData['reason']) ? $singleData['reason'] : ''}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>POD </label>
                                                    <input type="file" id="attach_file" name="attach_file" class="form-control" onchange="attach_file_url(this);" accept="image/png, image/gif, image/jpeg">
                                                    <?php
                                                        $pod_image = isset($singleData['attach_file']) ? $singleData['attach_file'] :'';
                                                        if($pod_image!='') {
                                                            $url = 'https://webdharmaa.com/speedex/public/attach_file/'.$pod_image;
                                                            $dis = "readonly";
                                                        }
                                                        else {
                                                            $url = 'https://webdharmaa.com/speedex/public/assets/images/blank.jpg';
                                                            $dis = "";
                                                        }
                                                    ?>
                                                    <center><div class="m-t-30"><img id="attach_file_preview" class="img-thumbnail" src="<?php echo $url?>" class="img-fluid" alt="Responsive image"></div></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" id="submit" name="submit" class="btn btn-success">
                        <button id="loading" class="btn btn-success" type="button" style="display:none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $("#display_only_in_delivered").hide();
        $( "#booking_details" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                consignor: {
                    required: true,
                },
                method_type: {
                    required: true,
                },
                consignee : {
                    required: true,
                },
                origin : {
                    required: true,
                },
                destination: {
                    required: true,
                },
                awb_no : {
                    required: true,
                },
                date : {
                    required: true,
                },
                document_type : {
                    required: true,
                },
                shipping_mode : {
                    required: true,
                },
                address : {
                    required: true,
                },
                pincode : {
                    required: true,
                },
            },messages: {
                consignor: {
                    required: "Please Select Consignor",
                },
                method_type: {
                    required: "Please Select Method",
                },
                consignee: {
                    required: "Please Enter Consignee Name",
                },
                origin: {
                    required: "Please Enter Origin",
                },
                destination: {
                    required: "Please Enter Destination",
                },
                awb_no: {
                    required: "Please Enter Airway Bill No.",
                },
                date: {
                    required: "Please Enter Booking Date",
                },
                document_type: {
                    required: "Please Select Document Type",
                },
                shipping_mode: {
                    required: "Please Select Shipping Mode",
                },
                address : {
                    required: "Please Enter Address",
                },
                pincode : {
                    required: "Please Enter pincode",
                },
            },submitHandler: function(form) {
                $("#submit").css("display", "none");
                $("#loading").css("display", "block");
                $("#loading").prop( "disabled", true );
                
                $( "#booking_details" ).submit();
            }
        })
        
        $("#origin").keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z- .]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        
        $("#destination").keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z- .]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        
        $("#consignee").keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z- .]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        
        $("#contact_person").keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z- .]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
    
        $("#contact_no").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#contact_no").focus();
                return false;
            }
        });
        
        $("#pincode").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#pincode").focus();
                return false;
            }
        });
        
        $("#invoice").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#invoice").focus();
                return false;
            }
        });
        
        $("#e_way_bill_no").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#e_way_bill_no").focus();
                return false;
            }
        });

        var singleBookingDetails = <?php echo json_encode($singleBookingDetails)?>;
        for(var j=0;j<singleBookingDetails.length;j++) {
            var autoId = '0_'+j;
            $("#table_packagees").show();
            $('#table_package_add').append('<tr id="rowadd'+autoId+'">'+
            '<td><input type="hidden" id="track_auto_id'+autoId+'" name="track_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemovePackageesSingleRow('+autoId+','+j+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
            '<td><input type="text" id="package'+autoId+'" name="package[]" class="form-control width-auto int" /></td>'+
            '<td><select id="method_packing'+autoId+'" name="method_packing[]" class="form-control width-auto"><option value="" selected="true" disabled="disabled">Select</option><option value="PVC">PVC</option><option value="Pallet">Pallet</option><option value="Wooden">Wooden</option><option value="Plastic">Plastic</option><option value="Box">Box</option><option value="Sample">Sample</option></select></td>'+
            '<td><input type="text" id="nature_goods'+autoId+'" name="nature_goods[]" class="form-control width-auto varchar" /></td>'+
            '<td><input type="text" id="net_weight'+autoId+'" name="net_weight[]" class="form-control width-auto float" /></td>'+
            '<td><input type="text" id="length'+autoId+'" name="length[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="L" /> X <input type="text" id="width'+autoId+'" name="width[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="B" /> X <input type="text" id="height'+autoId+'" name="height[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="H" /> / <input type="text" id="divide'+autoId+'" name="divide[]" class="form-control dmtnsty" placeholder="vol." readonly="" /></td>'+
            '<td><input type="text" id="chargeable_weight'+autoId+'" name="chargeable_weight[]" class="form-control width-auto float"  /></td>'+
            '</tr>');
            var  package_id = singleBookingDetails[j]['package'];
            var  method_packing = singleBookingDetails[j]['method_packing'];
            var  nature_goods = singleBookingDetails[j]['nature_goods'];
            var  net_weight = singleBookingDetails[j]['net_weight'];
            var  length = singleBookingDetails[j]['length'];
            var  width = singleBookingDetails[j]['width'];
            var  height = singleBookingDetails[j]['height'];
            var  divide = singleBookingDetails[j]['divide'];
            var  chargeable_weight = singleBookingDetails[j]['chargeable_weight'];
            var  track_auto_id = singleBookingDetails[j]['id'];

            $("#package"+autoId).val(package_id);
            $("#method_packing"+autoId).val(method_packing);
            $("#nature_goods"+autoId).val(nature_goods);
            $("#net_weight"+autoId).val(net_weight);
            $("#length"+autoId).val(length);
            $("#width"+autoId).val(width);
            $("#height"+autoId).val(height);
            $("#divide"+autoId).val(divide);
            $("#chargeable_weight"+autoId).val(chargeable_weight);
            $(track_auto_id).val(track_auto_id);
            
            $(".calculate_dimension"+autoId).on("change",function(){
            var length_val = $(length).val();
            var width_val = $(width).val();
            var height_val = $(height).val();
            var divide_val = $(divide).val();
            var  higher_value = 0 ;
            if(length_val!='' && width_val!='' && divide_val!=''){
                var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val);
                $(chargeable_weight).val('');
                var multiple_package = parseFloat(package_value)*parseFloat(cal_multi);
                var net_weight_value_flot = parseFloat(net_weight_value);
               if(net_weight_value_flot > multiple_package){
                    var higher_value = net_weight_value;
                }else{
                    var higher_value = multiple_package;    
                }
                $(chargeable_weight).val(higher_value);
            }else{
                alert("Please enter value length and width and divide");
                return false;
            }
        })
        
            $(".int").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $(".int").focus();
                    return false;
                }
            });
            $(".varchar").keypress(function (e) {
                var regex = new RegExp("^[a-zA-Z- ]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
            $(".float").keypress(function (e) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    return false;
                }
            });
        }
        
        var singleBookingTrackDetails = <?php echo json_encode($singleBookingTrackDetails)?>;
        for(var j=0;j<singleBookingTrackDetails.length;j++) {
            var trk = '0_'+j;
            $("#track_div").show();
            $("#table_track").show();
            $('#table_track_add').append('<tr id="rowadd'+trk+'">'+
            '<td><input type="hidden" id="track_auto_id'+trk+'" name="track_auto_id[]" class="form-control" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveTrackRow('+trk+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
            '<td><input type="text" id="track_date'+trk+'" name="track_date[]" class="form-control width-auto" readonly/></td>'+
            '<td><select id="track_io'+trk+'" name="track_io[]" class="form-control width-auto"><option value="">-- Select --</option><option value="Inscan">Inscan</option><option value="Outscan">Outscan</option><option value="InTransit">InTransit</option><option value="Out_For_Delivery">Out For Delivery</option><option value="Delivered">Delivered</option><option value="Reason">Reason</option></select></td>'+
            '<td><input type="text" id="track_description'+trk+'" name="track_description[]" class="form-control width-auto" /></td>'+
            '</tr>');
            
            var  track_date = singleBookingTrackDetails[j]['track_date'];
            var  track_io = singleBookingTrackDetails[j]['track_io'];
            var  track_description = singleBookingTrackDetails[j]['track_description'];
            
            $("#track_date"+trk).val(track_date);
            $("#track_io"+trk).val(track_io);
            if(track_io=='Delivered'){
                $("#display_only_in_delivered").show();    
            }else{
                $("#display_only_in_delivered").hide();    
            }
            
            $("#track_description"+trk).val(track_description);
            $(track_auto_id).val(trk);
        }
    })
    
    // function RemovePackageesSingleRow(id,i) {
    //     $.post("</?php echo base_url()?>Trackaddview/deleteDetailsRow",{
    //         id:id
    //     },function(data) {
    //         $("#rowadd"+i).remove();
    //         alert("Row Deleted!");
    //     })
    // }

    function documentType(val) {
        if(val == 'doc') {
            var shipping_mode = $("#shipping_mode").val();
            if(shipping_mode == 'air') {
                $("#shipping_mode").prop("checked", true);
            }
        }
        else {
            $("#shipping_mode").prop("checked", false);
        }
    }

    var pkg=1;
    $('#add_package').on('click',function() {
        var pkg= $('#tbody_table tr').length;
        $("#table_packagees").show();
        $('#table_package_add').append('<tr id="rowadd'+pkg+'">'+
        '<td><input type="hidden" id="packagees_auto_id'+pkg+'" name="packagees_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemovePackageesRow('+pkg+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        '<td><input type="text" id="package'+pkg+'" name="package[]" class="form-control width-auto int" /></td>'+
        '<td><select id="method_packing'+pkg+'" name="method_packing[]" class="form-control width-auto"><option value="" selected="true" disabled="disabled">Select</option><option value="PVC">PVC</option><option value="Pallet">Pallet</option><option value="Wooden">Wooden</option><option value="Plastic">Plastic</option><option value="Box">Box</option><option value="Sample">Sample</option></select></td>'+
        '<td><input type="text" id="nature_goods'+pkg+'" name="nature_goods[]" class="form-control width-auto varchar" /></td>'+
        '<td><input type="text" id="net_weight'+pkg+'" name="net_weight[]" class="form-control width-auto float" /></td>'+
        '<td><input type="text" id="length'+pkg+'" name="length[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="L" /> X <input type="text" id="width'+pkg+'" name="width[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="B" /> X <input type="text" id="height'+pkg+'" name="height[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="H" /> / <input type="text" id="divide'+pkg+'" name="divide[]" class="form-control width-auto dmtnsty method_value_display" placeholder="vol." readonly="" /></td>'+
        '<td><input type="text" id="chargeable_weight'+pkg+'" name="chargeable_weight[]" class="form-control width-auto float "/></td>'+
        '</tr>');
        
        
        var package_id = "#package"+pkg;
        var net_weight = "#net_weight"+pkg;
        var length = "#length"+pkg;
        var width = "#width"+pkg;
        var height = "#height"+pkg;
        var divide = "#divide"+pkg;
        var chargeable_weight = "#chargeable_weight"+pkg;
        var calculate_dimension = ".calculate_dimension"+pkg;
        
        $(calculate_dimension).on("change",function(){
            var length_val = $(length).val();
            var width_val = $(width).val();
            var height_val = $(height).val();
            var divide_val = $(divide).val();
            var  higher_value = 0 ;
            if(length_val!='' && width_val!='' && divide_val!=''){
                var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val);
                $(chargeable_weight).val('');
                var package_value = $(package_id).val();
                var net_weight_value = $(net_weight).val();
                var multiple_package = parseFloat(package_value)*parseFloat(cal_multi);
                var net_weight_value_flot = parseFloat(net_weight_value);
               if(net_weight_value_flot > multiple_package){
                    var higher_value = net_weight_value;
                }else{
                    var higher_value = multiple_package;    
                }
                if(higher_value){
                    $(chargeable_weight).val(higher_value);
                }
            }else{
                alert("Please enter value length and width and divide");
                return false;
            }
        })
        
        var consignor = $("#consignor").val();
        var method_type = $("#method_type").val();
        
        if(consignor!='' && method_type!=''){
            $.ajax({
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   type: 'POST',
                   url: '<?php echo url('/quotation/get-type')?>',
                   data: {
                       consignor:consignor,
                       method_type:method_type
                   },success: function(response){
                      var obj = $.parseJSON(response);
                      if(obj){
                           var total =0;
                           var charges3 = obj['charges3'];
                           var surface_multi = obj['surface_multi'];
                          if(surface_multi!=null){
                              var total=parseFloat(charges3)*parseFloat(surface_multi);
                          }else{
                              var total=charges3;
                          }
                           $(".method_value_display").val(total);
                      }else{
                           alert("Data not found")
                      }
                   }
               })
        }
        
        $(".int").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $(".int").focus();
                return false;
            }
        });
        $(".varchar").keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z- ]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        $(".float").keypress(function (e) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                return false;
            }
        });
    
        pkg++;
    });
    
    function RemovePackageesRow(id) {
        $("#rowadd"+id).remove();
        alert("Row Deleted!");
    }
    
    var trk=0;

    $('#add_track').on('click',function() {
        var trk= $('#tbody_table_track tr').length;
        $("#track_div").show();
        $("#table_track").show();
        $('#table_track_add').append('<tr id="rowadd'+trk+'">'+
        '<td><input type="hidden" id="track_auto_id'+trk+'" name="track_auto_id[]" class="form-control" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveTrackRow('+trk+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        '<td><input type="date" id="track_date'+trk+'" name="track_date[]" class="form-control width-auto" /></td>'+
        '<td><select id="track_io'+trk+'" name="track_io[]" class="form-control width-auto"><option value="">-- Select --</option><option value="Inscan">Inscan</option><option value="Outscan">Outscan</option><option value="InTransit">InTransit</option><option value="Out_For_Delivery">Out For Delivery</option><option value="Delivered">Delivered</option><option value="Reason">Reason</option></select></td>'+
        '<td><input type="text" id="track_description'+trk+'" name="track_description[]" class="form-control width-auto" /></td>'+
        '</tr>');
        trk++;
    });
    
    function RemoveTrackRow(id) {
        $("#rowadd"+id).remove();
        alert("Row Deleted!");
    }
    
    $("#consignor").on("change",function(){
        var consignor = $("#consignor").val();
        var method_type ='';
        $.ajax({
               headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               type: 'POST',
               url: '<?php echo url('/quotation/get-type')?>',
               data: {
                   consignor:consignor,
                   method_type:method_type
               },success: function(response){
                  var obj = $.parseJSON(response);
                  if(obj){
                       $("#method_type").empty();
                       $("#method_type").append('<option value="">Select Method</option>');
                       for(var i=0;i<obj.length;i++){
                           $("#method_type").append('<option value="'+obj[i]['quotation_type']+'">'+obj[i]['quotation_type']+'</option>');
                       }
                  }else{
                       $("#method_type").append('<option value="">Data not found</option>');
                  }
               }
           })
    })
    
    
</script>

@endsection