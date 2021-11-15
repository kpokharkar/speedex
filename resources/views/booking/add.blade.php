@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="spinner-border text-secondary loading_sty" role="status" id="loading_sty" name="loading_sty" style="display:none;"><span class="sr-only">Loading...</span></div>
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
                <form class="" id="booking_details" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}" {{isset($singleData['id']) ? 'readonly' : ''}}>
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Booking Form</h4>
                    </div>
                    <div class="card-body">
                        <!--<div class="row form-group">-->
                        <!--    <div class="col-12 col-md-12">-->
                        <!--         <button type="button" class="btn btn-outline-info" id="add_cc" name="add_cc" data-toggle="modal" data-target=".bs-example-modal-xl"><i class="fa fa-plus"></i>&nbsp; Add New Consignor OR Consignee</button>-->
                        <!--        <hr>-->
                        <!--    </div>-->
                        <!--</div>-->
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
                                    <input type="text" id="origin" name="origin" class="form-control first-capital" value="{{isset($singleData['origin']) ? $singleData['origin'] : ''}}" required />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Consignor <span class="text-danger">*</span></label>
                                    <select id="consignor" name="consignor" class="form-control js-example-basic-single" required="">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        <?php foreach($getCompanyDetails as $company) { ?>
                                        <option value="<?php echo $company->id?>" {{ isset($singleData['consignor']) && $singleData['consignor'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Consignee</label>
                                    <!--<input type="text" id="consignee" name="consignee" class="form-control" value="{{isset($singleData['consignee']) ? $singleData['consignee'] : ''}}" required />-->
                                    <select id="consignee" name="consignee" class="form-control js-example-basic-single" required="">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        @if($singleData)
                                        @foreach($getConsignees as $consignee)
                                        <option value="{{$consignee->id}}" {{ isset($singleData['consignee']) && $singleData['consignee'] == $consignee->id ? 'selected' : ''}}>{{$consignee->company_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Destination <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select id="destination" name="destination" class="form-control js-example-basic-single">
                                                <option value="" selected="true" disabled="disabled">-- Select --</option>
                                                @if(isset($singleData['consignee']) && $singleData['consignee'])
                                                    @foreach($contactDetails as $contact)
                                                        <option value="{{$contact->destination}}" {{ isset($singleData['destination']) && $singleData['destination'] == $contact->destination ? 'selected' : ''}}>{{$contact->destination}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="new_destination" name="new_destination" class="form-control first-capital" value="{{isset($singleData['new_destination']) ? $singleData['new_destination'] : ''}}" placeholder="New Destination" {{isset($singleData['id']) ? 'readonly' : ''}}/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Contact Person Name</label>
                                    <input type="text" id="contact_person" name="contact_person" class="form-control first-capital readonly_column" value="{{isset($singleData['contact_person']) ? $singleData['contact_person'] : ''}}" {{isset($singleData['id']) ? 'readonly' : ''}}/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Contact Person Mobile No.</label>
                                    <input type="text" id="contact_no" name="contact_no" class="form-control readonly_column" value="{{isset($singleData['contact_no']) ? $singleData['contact_no'] : ''}}" minlength="10" maxlength="10" {{isset($singleData['id']) ? 'readonly' : ''}}/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" id="address" name="address" class="form-control first-capital readonly_column" value="{{isset($singleData['address']) ? $singleData['address'] : ''}}" required {{isset($singleData['id']) ? 'readonly' : ''}}/>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Pincode <span class="text-danger">*</span></label>
                                    <input type="text" id="pincode" name="pincode" class="form-control readonly_column" value="{{isset($singleData['pincode']) ? $singleData['pincode'] : ''}}" minlength="6" maxlength="6" required {{isset($singleData['id']) ? 'readonly' : ''}}/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                    <label>Select Service <span class="text-danger">*</span></label>
                                    <select id="service" name="service" class="form-control js-example-basic-single" required="">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        <option value="oda" {{ isset($singleData['service']) && $singleData['service'] == 'oda' ? 'selected' : ''}}>ODA</option>
                                        <option value="da" {{ isset($singleData['service']) && $singleData['service'] == 'da' ? 'selected' : ''}}>Delivery Area</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select Type <span class="text-danger">*</span></label>
                                    <select id="types" name="types" class="form-control js-example-basic-single" required="">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        <option value="local" {{ isset($singleData['types']) && $singleData['types'] == 'local' ? 'selected' : ''}}>Local</option>
                                        <option value="metro" {{ isset($singleData['types']) && $singleData['types'] == 'metro' ? 'selected' : ''}}>Metro</option>
        							    <option value="region" {{ isset($singleData['types']) && $singleData['types'] == 'region' ? 'selected' : ''}}>Region</option>
        							    <option value="rest_of_india" {{ isset($singleData['types']) && $singleData['types'] == 'rest_of_india' ? 'selected' : ''}}>Rest of India</option>
        							    <option value="east_north_east" {{ isset($singleData['types']) && $singleData['types'] == 'east_north_east' ? 'selected' : ''}}>East (North East)</option>
        							    <option value="jk_himachalpradesh_kerala" {{ isset($singleData['types']) && $singleData['types'] == 'jk_himachalpradesh_kerala' ? 'selected' : ''}}>J&K / HIMACHAL PRADESH / KERALA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select Vendor 1</label>
                                    <select id="vendor_id" name="vendor_id" class="form-control js-example-basic-single">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        <?php foreach($getVendorDetails as $vendor) { ?>
                                        <option value="<?php echo $vendor->id?>" {{ isset($singleData['vendor_id']) && $singleData['vendor_id'] == $vendor->id ? 'selected' : ''}}><?php echo $vendor->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select Vendor 2</label>
                                    <select id="vendor_2" name="vendor_2" class="form-control js-example-basic-single">
                                        <option value="" selected="true" disabled="disabled">-- Select --</option>
                                        <?php 
                                        if($singleData){
                                        foreach($vendorDestination as $vendor2) { ?>
                                            <option value="<?php echo $vendor2->id?>" {{ isset($singleData['vendor_2']) && $singleData['vendor_2'] == $vendor2->id ? 'selected' : ''}}><?php echo $vendor2->name?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Document Type <span class="text-danger">*</span></label>
                                    <?php 
                                        $checkedTypeDoc ='';
                                        $checkedTypeNonDoc = '';
                                        $display_type='';
                                        if(isset($singleData['shipping_mode'])){
                                            if($singleData['shipping_mode']) {
                                                $display_type='disabled';    
                                            }
                                        }
                                            if(isset($singleData['document_type'])) {
                                                if($singleData['document_type'] == 'doc') {
                                                    $checkedTypeDoc = 'checked';
                                                }else if($singleData['document_type'] == 'non_doc') {
                                                    $checkedTypeNonDoc = 'checked';
                                                }
                                            }
                                    ?>
                                    <br>
                                    <label><input type="radio" class="radio-inline" name="document_type" id="document_type" onchange="documentType('doc')" value="doc" <?php echo $checkedTypeDoc?> <?php echo $display_type?>>Doc</label>
                                    <label><input type="radio" class="radio-inline" name="document_type" id="document_type" onchange="documentType('non_doc')" value="non_doc" <?php echo $checkedTypeNonDoc?> <?php echo $display_type?>>Non Doc</label>
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
                                        if(isset($singleData['shipping_mode'])){
                                            if($singleData['shipping_mode'] == 'air') {
                                                $shippingTypeAir = 'checked';
                                            } else if($singleData['shipping_mode'] == 'cargo') {
                                                $checkedTypeCargo = 'checked';
                                            } else if($singleData['shipping_mode'] == 'surface') {
                                                $checkedTypeSurface = 'checked';
                                            } else if($singleData['shipping_mode'] == 'courier') {
                                                $checkedTypeCourier = 'checked';
                                            }
                                        }
                                        
                                    ?>
                                    <br>
                                    <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="air" <?php echo $shippingTypeAir?> <?php echo $display_type?>>Air</label>
                                    <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="cargo" <?php echo $checkedTypeCargo?> <?php echo $display_type?>>Cargo</label>
                                    <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="surface" <?php echo $checkedTypeSurface?> <?php echo $display_type?>>Surface</label>
                                    <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="courier" <?php echo $checkedTypeCourier?> <?php echo $display_type?>>Courier</label>
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
                    <div class="card-footer">
                        <input type="submit" id="submit" name="submit" class="btn btn-success" value="Submit">
                        <!--<input type="submit" id="add_submit" name="add_submit" class="btn btn-success" value="Save Address & Submit">-->
                        <button id="loading" class="btn btn-success" type="button" style="display:none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>
                    </div>
                </form>
                
       <!--         <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">-->
       <!--             <div class="modal-dialog modal-xl modal-dialog-centered">-->
       <!--                 <div class="modal-content">-->
       <!--                     <form class="" id="form_cc" name="form_cc" method="post" enctype="multipart/form-data">-->
       <!--                         <div class="modal-header">-->
       <!--                             <h5 class="modal-title mt-0" id="myLargeModalLabel">New Consignor OR Consignee</h5>-->
       <!--                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
       <!--                         </div>-->
       <!--                         <div class="modal-body">-->
       <!--                             <ul class="nav nav-tabs" role="tablist">-->
							<!--			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#consignor_tab" role="tab"><i class="dripicons-archive"></i>&nbsp; Consignor Detail</a></li>-->
							<!--			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#consignee_tab" role="tab"><i class="dripicons-archive"></i>&nbsp; Consignee Detail</a></li>-->
							<!--		</ul>-->
							<!--		<div class="tab-content">-->
							<!--		    <div class="tab-pane active p-3" id="consignor_tab" role="tabpanel">-->
							<!--		        <div class="row">-->
       <!--                                         <div class="col-lg-8">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Company Name <span class="text-danger">*</span></label>-->
       <!--                                                 <input type="text" id="name_company" name="name_company" class="form-control first-capital" value="{{isset($data['name_company']) ? $data['name_company'] : ''}}" required />-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Company GST No. <span class="text-danger">*</span> <span id="gst_no_error" class="text-danger"></span></label>-->
       <!--                                                 <input type="text" id="gst_no" name="gst_no" class="form-control" value="{{isset($data['gst_no']) ? $data['gst_no'] : ''}}" minlength="15" maxlength="15" required>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
       <!--                                     <div class="row">-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Company Email Id</label>-->
       <!--                                                 <input type="email" id="company_email_id" name="company_email_id" class="form-control" value="{{isset($data['company_email_id']) ? $data['company_email_id'] : ''}}" />-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Contact Person Name <span class="text-danger">*</span></label>-->
       <!--                                                 <input type="text" id="contact_person_name" name="contact_person_name" class="form-control first-capital" value="{{isset($data['contact_person_name']) ? $data['contact_person_name'] : ''}}" required />-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Contact Person Mobile No. <span class="text-danger">*</span></label>-->
       <!--                                                 <input type="text" id="contact_person_mobile" name="contact_person_mobile" value="{{isset($data['contact_person_mobile']) ? $data['contact_person_mobile'] : ''}}" class="form-control" required minlength="10" maxlength="10" />-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
       <!--                                     <div class="row">-->
       <!--                                         <div class="col-lg-8">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Address <span class="text-danger">*</span></label>-->
       <!--                                               <textarea id="company_address" name="company_address" class="form-control">{{isset($data['company_address']) ? $data['company_address'] : ''}}</textarea>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Company Status</label>-->
       <!--                                                 <select id="company_status" name="company_status" class="form-control js-example-basic-single" style="width: 100%;">-->
       <!--                                                     <option value="" disabled="disabled">-- Select --</option>-->
       <!--                                                     <option value="Active" {{ isset($data['company_status']) && $data['company_status'] == 'Active' ? 'selected' : ''}}>Active</option>-->
       <!--                                                     <option value="Inactive" {{ isset($data['company_status']) && $data['company_status'] == 'Inactive' ? 'selected' : ''}}>In-Active</option>-->
       <!--                                                 </select>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
							<!--		    </div>-->
							<!--		    <div class="tab-pane p-3" id="consignee_tab" role="tabpanel">-->
							<!--		        <div class="row">-->
       <!--                                         <div class="col-lg-4">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Select Consignor <span class="text-danger">*</span></label>-->
       <!--                                                 <select id="consignor_id" name="consignor_id" class="form-control js-example-basic-single" required="" style="width: 100%;">-->
       <!--                                                     <option value="" selected="true" disabled="disabled">-- Select --</option>-->
       <!--                                                     <?php foreach($getCompanyDetails as $company) { ?>-->
       <!--                                                     <option value="<?php echo $company->id?>" {{ isset($singleData['consignor']) && $singleData['consignor'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>-->
       <!--                                                     <?php } ?>-->
       <!--                                                 </select>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-lg-8">-->
       <!--                                             <div class="form-group">-->
       <!--                                                 <label>Company Name <span class="text-danger">*</span></label>-->
       <!--                                                 <input type="text" id="consignor_name" name="consignor_name" class="form-control first-capital" value="{{isset($singleData['consignor_name']) ? $singleData['consignor_name'] : ''}}" required />-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
       <!--                                     <div class="row">-->
       <!--                                         <div class="col-12">-->
       <!--                                             <hr><h4 class="mt-0 header-title">Address Details</h4><br>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
       <!--                                     <div class="row form-group">-->
       <!--                                         <div class="col-12 col-md-12">-->
       <!--                                             <button type="button" class="btn btn-outline-secondary" id="add_address" name="add_address"><i class="fa fa-plus"></i>&nbsp; Add Address</button>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
       <!--                                     <div class="row form-group" id="table_address" style="display: none;">-->
       <!--                                         <div class="col-12 col-md-6 m-t-10 m-b-20">-->
       <!--                                             <div class="input-group">-->
       <!--                                                 <input type="text" id="search_here" name="search_here" class="form-control" placeholder="Search here.">-->
       <!--                                                 <div class="input-group-append bg-custom b-0"><span class="input-group-text icon-sty"><i class="mdi mdi-mdi mdi-table-search"></i></span></div>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                         <div class="col-12 col-md-12">-->
       <!--                                             <div class="table-responsive">-->
       <!--                                                 <table class="table table-hover table-bordered table-striped" id="table_address_add">-->
       <!--                                                     <thead>-->
       <!--                                                         <tr>-->
       <!--                                                             <th></th>-->
       <!--                                                             <th>Contact Person Name</th>-->
       <!--                                                             <th>Contact Person Mobile No.</th>-->
       <!--                                                             <th>Destination</th>-->
       <!--                                                             <th>Address</th>-->
       <!--                                                             <th>Pincode</th>-->
       <!--                                                             <th>Status</th>-->
       <!--                                                         </tr>-->
       <!--                                                     </thead>-->
       <!--                                                     <tbody id="tbody_table"></tbody>-->
       <!--                                                 </table>-->
       <!--                                             </div>-->
       <!--                                         </div>-->
       <!--                                     </div>-->
							<!--		    </div>-->
							<!--	    </div>-->
       <!--                         </div>-->
       <!--                         <div class="modal-footer">-->
    			<!--					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>-->
    			<!--					<button type="button" class="btn btn-success waves-effect waves-light">Submit</button>-->
    			<!--				</div>-->
							<!--</form>-->
       <!--                 </div>-->
       <!--             </div>-->
       <!--         </div>-->
            
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('.js-example-basic-single').select2();
        
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
                consignee : {
                    required: true,
                },
                origin : {
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
                consignee: {
                    required: "Please Enter Consignee Name",
                },
                origin: {
                    required: "Please Enter Origin",
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
                queryString = $('#booking_details').serialize();
                $.post('<?php echo url("/booking/save")?>', queryString, function (data) {
                    commonStatusMessage(data, '<?php echo url("booking")?>');
                }, "json");
                return false;
                // // $("#loading_sty").css("display", "block",5000);
                // $("#loading_sty").css("display", "block");
                
                // $("#submit").css("display", "none");
                // // $("#add_submit").css("display", "none");
                // $("#loading").css("display", "block");
                // $("#loading").prop( "disabled", true );
                
                //$( "#booking_details" ).submit();
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

        $("#new_destination").keypress(function (e) {
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
        
        $('#contact_no').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });
        
        $('#pincode').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });
        
        $('#invoice').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });
        
        $('#e_way_bill_no').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });
        
        var singleBookingDetails = <?php echo json_encode($singleBookingDetails)?>;
        for(var j=0;j<singleBookingDetails.length;j++) {
            var autoId = '0_'+j;
            $("#table_packagees").show();
            $('#table_package_add').append('<tr id="rowadd'+autoId+'">'+
            '<td><input type="hidden" id="surface'+autoId+'" name="surface[]"/><input type="hidden" id="track_auto_id'+autoId+'" name="track_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemovePackageesSingleRow('+autoId+','+j+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
            '<td><input type="text" id="package'+autoId+'" name="package[]" class="form-control width-auto int calculate_dimension'+autoId+'"/></td>'+
            '<td><select id="method_packing'+autoId+'" name="method_packing[]" class="form-control js-example-basic-single width-auto"><option value="" selected="true" disabled="disabled">Select</option><option value="PVC">PVC</option><option value="Pallet">Pallet</option><option value="Wooden">Wooden</option><option value="Plastic">Plastic</option><option value="Box">Box</option><option value="Sample">Sample</option></select></td>'+
            '<td><input type="text" id="nature_goods'+autoId+'" name="nature_goods[]" class="form-control width-auto varchar first-capital" /></td>'+
            '<td><input type="text" id="net_weight'+autoId+'" name="net_weight[]" class="form-control width-auto float calculate_dimension'+autoId+'" /></td>'+
            '<td><input type="text" id="length'+autoId+'" name="length[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="L" /> X <input type="text" id="width'+autoId+'" name="width[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="B" /> X <input type="text" id="height'+autoId+'" name="height[]" class="form-control float dmtnsty calculate_dimension'+autoId+'" placeholder="H" /> / <input type="text" id="divide'+autoId+'" name="divide[]" class="form-control dmtnsty method_value_display" placeholder="vol." readonly="" /></td>'+
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
            $('.js-example-basic-single').select2();
        var consignor = $("#consignor").val();
        var shipping_mode = $("input[type='radio'][name='shipping_mode']:checked").val();
        if(consignor!='' && shipping_mode!=''){
            $.ajax({
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   type: 'POST',
                   url: '<?php echo url('/quotation/get-type')?>',
                   data: {
                       consignor:consignor,
                       shipping_mode:shipping_mode
                   },success: function(response){
                      var obj = $.parseJSON(response);
                      if(obj){
                           var total =0;
                           var surface_multi = obj['surface_multi'];
                           if(shipping_mode=='air' || shipping_mode=='cargo' || shipping_mode=='courier'){
                              var total = 5000; 
                           }else{
                               var charges3 = 27000;
                              if(surface_multi!=null){
                                  var total = parseInt(charges3);
                                  $("#surface"+autoId).val(surface_multi);
                                  //*parseFloat(surface_multi);
                              }
                           }
                           $(".method_value_display").val(total);
                      }else{
                           Swal.fire('Data not found')
                      }
                   }
               })
        }
            
            
            $(".calculate_dimension"+autoId).on("change",function(){
            var length_val = $("#length"+autoId).val();
            var width_val = $("#width"+autoId).val();
            var height_val = $("#height"+autoId).val();
            var divide_val = $("#divide"+autoId).val();
            var surface_val = $("#surface"+autoId).val();
            var  higher_value = 0 ;
            if(length_val!='' && width_val!='' && divide_val!=''){
                if(surface_val){
                    var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val)*parseInt(surface_val);
                }else{
                    var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val);
                }
                $("#chargeable_weight"+autoId).val('');
                var package_value = $("#package"+autoId).val();
                var net_weight_value = $("#net_weight"+autoId).val();
                var multiple_package = parseFloat(package_value)*parseFloat(cal_multi);
                var net_weight_value_flot = parseFloat(net_weight_value);
               if(net_weight_value_flot > multiple_package){
                    var higher_value = net_weight_value;
                }else{
                    var higher_value = multiple_package;    
                }
                if(higher_value){
                    $("#chargeable_weight"+autoId).val(Math.round(higher_value));
                }
            }else{
                // alert("Please enter value length and width and divide");
                // return false;
            }
        })
        
            $('.int').keyup(function () { 
                this.value = this.value.replace(/[^0-9\.]/g,'');
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
            $('.float').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
            });

        }
        
        // for(var j=0;j<singleBookingTrackDetails.length;j++) {
        //     var trk = '0_'+j;
        //     $("#track_div").show();
        //     $("#table_track").show();
        //     $('#table_track_add').append('<tr id="rowadd'+trk+'">'+
        //     '<td><input type="hidden" id="track_auto_id'+trk+'" name="track_auto_id[]" class="form-control" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveTrackRow('+trk+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        //     '<td><input type="text" id="track_date'+trk+'" name="track_date[]" class="form-control width-auto" readonly/></td>'+
        //     '<td><select id="track_io'+trk+'" name="track_io[]" class="form-control width-auto"><option value="">-- Select --</option><option value="Inscan">Inscan</option><option value="Outscan">Outscan</option><option value="InTransit">InTransit</option><option value="Out_For_Delivery">Out For Delivery</option><option value="Delivered">Delivered</option><option value="Reason">Reason</option></select></td>'+
        //     '<td><input type="text" id="track_description'+trk+'" name="track_description[]" class="form-control width-auto" /></td>'+
        //     '</tr>');
            
        //     var  track_date = singleBookingTrackDetails[j]['track_date'];
        //     var  track_io = singleBookingTrackDetails[j]['track_io'];
        //     var  track_description = singleBookingTrackDetails[j]['track_description'];
            
        //     $("#track_date"+trk).val(track_date);
        //     $("#track_io"+trk).val(track_io);
        //     if(track_io=='Delivered'){
        //         $("#display_only_in_delivered").show();    
        //     }else{
        //         $("#display_only_in_delivered").hide();    
        //     }
            
        //     $("#track_description"+trk).val(track_description);
        //     $(track_auto_id).val(trk);
        // }
    })
    
    // function RemovePackageesSingleRow(id,i) {
    //     $.post("</?php echo base_url()?>Trackaddview/deleteDetailsRow",{
    //         id:id
    //     },function(data) {
    //         $("#rowadd"+i).remove();
    //         Swal.fire('Row Deleted!')
    //     })
    // }

    function documentType(val) {
        if(val == 'doc') {
            var shipping_mode = $("#shipping_mode").val();
            if(shipping_mode == 'air') {
                $("#shipping_mode").prop("checked", true);
            } if(shipping_mode == 'courier') {
                $("#shipping_mode").prop("checked", true);
            }
            
            var pkg = $('#tbody_table tr').length;
            for(var i=0;i<=pkg;i++){
                $("#rowadd"+i).remove();    
            }
            $("#table_packagees").hide();
            
        }
        else {
            $("#shipping_mode").prop("checked", false);
            var pkg= $('#tbody_table tr').length;
            for(var i=0;i<=pkg;i++){
                $("#rowadd"+i).remove();    
            }
            $("#table_packagees").hide();
        }
    }

    var pkg=1;
    $('#add_package').on('click',function() {
        var pkg= $('#tbody_table tr').length;
        $("#table_packagees").show();
        $('#table_package_add').append('<tr id="rowadd'+pkg+'">'+
        '<td><input type="hidden" id="surface'+pkg+'" name="surface[]"/><input type="hidden" id="packagees_auto_id'+pkg+'" name="packagees_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemovePackageesRow('+pkg+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        '<td><input type="text" id="package'+pkg+'" name="package[]" class="form-control width-auto int calculate_dimension'+pkg+'"/></td>'+
        '<td><select id="method_packing'+pkg+'" name="method_packing[]" class="form-control js-example-basic-single width-auto"><option value="" selected="true" disabled="disabled">Select</option><option value="PVC">PVC</option><option value="Pallet">Pallet</option><option value="Wooden">Wooden</option><option value="Plastic">Plastic</option><option value="Box">Box</option><option value="Sample">Sample</option></select></td>'+
        '<td><input type="text" id="nature_goods'+pkg+'" name="nature_goods[]" class="form-control width-auto varchar first-capital" /></td>'+
        '<td><input type="text" id="net_weight'+pkg+'" name="net_weight[]" class="form-control width-auto float calculate_dimension'+pkg+'"/></td>'+
        '<td><input type="text" id="length'+pkg+'" name="length[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="L" /> X <input type="text" id="width'+pkg+'" name="width[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="B" /> X <input type="text" id="height'+pkg+'" name="height[]" class="form-control width-auto float dmtnsty calculate_dimension'+pkg+'" placeholder="H" /> / <input type="text" id="divide'+pkg+'" name="divide[]" class="form-control width-auto dmtnsty method_value_display" placeholder="vol." readonly="" /></td>'+
        '<td><input type="text" id="chargeable_weight'+pkg+'" name="chargeable_weight[]" class="form-control width-auto float "/></td>'+
        '</tr>');
        
        $('.js-example-basic-single').select2();
        
        var package_id = "#package"+pkg;
        var net_weight = "#net_weight"+pkg;
        var length = "#length"+pkg;
        var width = "#width"+pkg;
        var height = "#height"+pkg;
        var divide = "#divide"+pkg;
        var surface = "#surface"+pkg;
        var chargeable_weight = "#chargeable_weight"+pkg;
        var calculate_dimension = ".calculate_dimension"+pkg;
        
        $(calculate_dimension).on("change",function(){
            var length_val = $(length).val();
            var width_val = $(width).val();
            var height_val = $(height).val();
            var divide_val = $(divide).val();
            var surface_val = $(surface).val();
            var  higher_value = 0 ;
            if(length_val!='' && width_val!='' && divide_val!=''){
                if(surface_val){
                    var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val)*parseInt(surface_val);
                }else{
                    var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val);
                }
                //var cal_multi = parseFloat(length_val)*parseFloat(width_val)*parseFloat(height_val)/parseFloat(divide_val)*parseInt(surface_val);
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
                    $(chargeable_weight).val(Math.round(higher_value));
                }
            }else{
                // alert("Please enter value length and width and divide");
                // return false;
            }
        })
        
        var consignor = $("#consignor").val();
        var shipping_mode = $("input[type='radio'][name='shipping_mode']:checked").val();
        if(consignor!='' && shipping_mode!=''){
            $.ajax({
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   type: 'POST',
                   url: '<?php echo url('/quotation/get-type')?>',
                   data: {
                       consignor:consignor,
                       shipping_mode:shipping_mode
                   },success: function(response){
                      var obj = $.parseJSON(response);
                      if(obj){
                           var total =0;
                           var surface_multi = obj['surface_multi'];
                           if(shipping_mode=='air' || shipping_mode=='cargo' || shipping_mode=='courier'){
                              var total = 5000; 
                           }else{
                               var charges3 = 27000;
                              if(surface_multi!=null){
                                  var total=parseInt(charges3);
                                  $(surface).val(surface_multi);
                                  //*parseFloat(surface_multi);
                              }
                           }
                           $(".method_value_display").val(total);
                      }else{
                           Swal.fire('Data not found')
                      }
                   }
               })
        }
        
        $('.int').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
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
        $('.float').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });
        
        pkg++;
    });
    
    function RemovePackageesRow(id) {
        $("#rowadd"+id).remove();
        Swal.fire('Row Deleted!')
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
        Swal.fire('Row Deleted!')
    }
    
    $("#consignor").on("change",function(){
        var consignor = $("#consignor").val();
        $.ajax({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
           type: 'POST',
           url: '<?php echo url('/booking/get-consignee')?>',
           data: {
               consignor:consignor
           },success: function(response){
              var obj = $.parseJSON(response);
              if(obj){
                   $("#consignee").empty();
                   $("#destination").empty();
                   $(".readonly_column").val('');
                   $("#consignee").append('<option value="">-- Select --</option>');
                   $("#destination").append('<option value="">-- Select --</option>');
                   for(var i=0;i<obj.length;i++){
                       $("#consignee").append('<option value="'+obj[i]['id']+'">'+obj[i]['company_name']+'</option>');
                   }
              }else{
                   $("#consignee").append('<option value="">Data not found</option>');
              }
           }
       })
    })
    
    $("#consignee").on("change",function(){
        var consignee = $("#consignee").val();
        $.ajax({
               headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               type: 'POST',
               url: '<?php echo url('/booking/get-destination')?>',
               data: {
                   consignee:consignee
               },success: function(response){
                  var obj = $.parseJSON(response);
                  if(obj){
                       $("#destination").empty();
                       $(".readonly_column").val('');
                       $("#destination").append('<option value="">-- Select --</option>');
                       for(var i=0;i<obj.length;i++){
                           $("#destination").append('<option value="'+obj[i]['destination']+'">'+obj[i]['destination']+'</option>');
                       }
                  }else{
                       $("#destination").append('<option value="">Data not found</option>');
                  }
               }
           })
    })
    
    $("#destination").on("change",function(){
        var destination = $("#destination").val();
        var consignee = $("#consignee").val();
        if(destination!=''){
            $.ajax({
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   type: 'POST',
                   url: '<?php echo url('/booking/get-vendor-destination')?>',
                   data: {
                       destination:destination,
                       consignee:consignee
                   },success: function(response){
                      var obj = $.parseJSON(response);
                      var vendorDetails = obj.vendorDetails;
                      var contactDetails = obj.contactDetails;
                      if(contactDetails){
                            $("#new_destination").attr('readonly','true');
                            $(".readonly_column").attr('readonly','true');
                            $("#contact_person").val(contactDetails.name);
                            $("#contact_no").val(contactDetails.mobile);
                            $("#address").val(contactDetails.address);
                            $("#pincode").val(contactDetails.pincode);
                      }
                      if(vendorDetails){
                           $("#vendor_2").empty();
                           $("#vendor_2").append('<option value="">-- Select --</option>');
                           for(var i=0;i<vendorDetails.length;i++){
                               $("#vendor_2").append('<option value="'+vendorDetails[i]['id']+'">'+vendorDetails[i]['name']+'</option>');
                           }
                      }else{
                           $("#vendor_2").append('<option value="">Data not found</option>');
                      }
                   }
               })
        } else{
            $(".readonly_column").val('');
            $("#vendor_2").empty();
            $(".readonly_column").attr('readonly',false);
            $("#new_destination").attr('readonly',false);
        }
    })
    
    $("#new_destination").on("change",function(){
        var destination = $("#new_destination").val();
        var consignee = '';
        $.ajax({
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   type: 'POST',
                   url: '<?php echo url('/booking/get-vendor-destination')?>',
                   data: {
                       destination:destination,
                       consignee:consignee
                   },success: function(response){
                      var obj = $.parseJSON(response);
                      var vendorDetails = obj.vendorDetails;
                      if(vendorDetails){
                           $("#vendor_2").empty();
                           $("#vendor_2").append('<option value="">-- Select --</option>');
                           for(var i=0;i<vendorDetails.length;i++){
                               $("#vendor_2").append('<option value="'+vendorDetails[i]['id']+'">'+vendorDetails[i]['name']+'</option>');
                           }
                      }else{
                           $("#vendor_2").append('<option value="">Data not found</option>');
                      }
                   }
               })
    })
    
    // Consignor Start
    $("#name_company").keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- .]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $("#gst_no").on('change', function() {
        var gst_no =$("#gst_no").val();
        var patt = /^(\d{2})([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})(\d{1})([a-zA-Z]{1})(\d{1})$/;
        var rspass = patt.test(gst_no);
        if(rspass == false) {
            $("#gst_no_error").html("00XXXXX0000X0X0").show().fadeOut(15000);
            $("#gst_no").focus();
            return false;
        }
    });
    
    $("#company_email_id").on('change', function() {
        var company_email_id =$("#company_email_id").val();
        var patt = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var rsemail = patt.test(company_email_id);
        if(rsemail == false){
            $("#company_email_id").focus();
            return false;
        }
    });

    $("#contact_person_name").keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $("#contact_person_mobile").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
            $("#contact_person_mobile").focus();
            return false;
        }
    });
    // Consignor End
    
    // Consignee Start
    $("#consignor_name").keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- .]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    
    $("#search_here").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_address_add tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    var ads=1;
    $('#add_address').on('click',function() {
        var ads= $('#tbody_table tr').length;
        $("#table_address").show();
        $('#table_address_add').append('<tr id="rowadd'+ads+'">'+
        '<td><input type="hidden" id="address_auto_id'+ads+'" name="address_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveAddressRow('+ads+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        '<td><input type="text" id="name'+ads+'" name="name[]" class="form-control width-auto varchar first-capital" /></td>'+
        '<td><input type="text" id="mobile'+ads+'" name="mobile[]" class="form-control width-auto int" minlength="10" maxlength="10" /></td>'+
        '<td><input type="text" id="destination'+ads+'" name="destination[]" class="form-control width-auto varchar first-capital" /></td>'+
        '<td><textarea id="address'+ads+'" name="address[]" class="form-control width-auto"></textarea></td>'+
        '<td><input type="text" id="pincode'+ads+'" name="pincode[]" class="form-control width-auto int" minlength="6" maxlength="6" /></td>'+
        '<td><select id="status'+ads+'" name="status[]" class="form-control js-example-basic-single width-auto"><option value="" disabled="disabled">-- Select --</option><option value="0" selected>Active</option><option value="1">In-Active</option></select></td>'+
        '</tr>');
        $('.js-example-basic-single').select2();
        $('.int').keyup(function () { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
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
        
        ads++;
    });
    
    function RemoveAddressRow(id) {
        $("#rowadd"+id).remove();
        Swal.fire('Row Deleted!')
    }
    // Consignee End
    
</script>

@endsection