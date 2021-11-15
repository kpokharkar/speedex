@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Booking Detail</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="./" title="Back to Company Detail Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back to Booking Detail Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="booking_details" novalidate="novalidate" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Booking Detail Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="company_info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Consignar <span class="text-danger">*</span></label>
                                            <select id="company_id" name="company_id" class="form-control" required="">
                                                <option value="">Select Consignar</option>
                                                <?php foreach($getCompanyDetails as $company) { ?>
                                                <option value="<?php echo $company->id?>" {{ isset($singleData['company_id']) && $singleData['company_id'] == $company->id ? 'selected' : ''}}><?php echo  $company->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Contact Person Name <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person" name="contact_person" class="form-control" value="{{isset($singleData['contact_person']) ? $singleData['contact_person'] : ''}}" required />
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
                                            <label>Cash Booking <span class="text-danger">*</span></label>
                                            <select id="cash_booking_status" name="cash_booking_status" onclick="cash_on()" class="form-control">
                                                <option value="">Select Cash Booking</option>
                                                <option value="Yes" {{ isset($singleData['cash_booking_status']) && $singleData['cash_booking_status'] == 'Yes' ? 'selected' : ''}}>Yes</option>
                                                <option value="No" {{ isset($singleData['cash_booking_status']) && $singleData['cash_booking_status'] == 'No' ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Booking Date <span class="text-danger">*</span></label>
                                            <input type="date" id="booking_date" name="booking_date" class="form-control" value="{{isset($singleData['booking_date']) ? $singleData['booking_date'] : ''}}" required />
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
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Airway Bill No. <span class="text-danger">*</span></label>
                                            <input type="text" id="airway_bill_no" name="airway_bill_no" class="form-control" value="{{isset($singleData['airway_bill_no']) ? $singleData['airway_bill_no'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Weight <span class="text-danger">*</span></label>
                                            <input type="text" id="weight" name="weight" class="form-control" value="{{isset($singleData['weight']) ? $singleData['weight'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                            <label>Select Type <span class="text-danger">*</span></label>
                                            <select id="type" name="type" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="grms" {{ isset($singleData['type']) && $singleData['type'] == 'grms' ? 'selected' : ''}}>Grms</option>
                                                <option value="Kg" {{ isset($singleData['type']) && $singleData['type'] == 'kg' ? 'selected' : ''}}>Kg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Vendor <span class="text-danger">*</span></label>
                                            <select id="vendor_id" name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                                <?php foreach($getVendorDetails as $vendor) { ?>
                                                <option value="<?php echo $vendor->id?>" {{ isset($singleData['vendor_id']) && $singleData['vendor_id'] == $vendor->id ? 'selected' : ''}}><?php echo $vendor->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>E-Way Bill No. <span class="text-danger">*</span></label>
                                            <input type="text" id="eway_bill_no" name="eway_bill_no" class="form-control" required value="{{isset($singleData['eway_bill_no']) ? $singleData['eway_bill_no'] : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Invoice No. <span class="text-danger">*</span></label>
                                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" required  value="{{isset($singleData['invoice_no']) ? $singleData['invoice_no'] : ''}}"/>
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
                                            if(isset($singleData['shipping_mode']) == 'air') {
                                                $shippingTypeAir = 'checked';
                                            }
                                            else if(isset($singleData['shipping_mode']) == 'cargo') {
                                                $checkedTypeCargo = 'checked';
                                            }
                                            else if(isset($singleData['shipping_mode']) == 'surface') {
                                                $checkedTypeSurface = 'checked';
                                            }
                                            ?>
                                            <br>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="air" <?php echo $shippingTypeAir?>>Air</label>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="cargo" <?php echo $checkedTypeCargo?>>Cargo</label>
                                            <label><input type="radio" class="radio-inline" name="shipping_mode" id="shipping_mode" value="surface" <?php echo $checkedTypeSurface?>>Surface</label>
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
                                                        <th>No. of Package</th>
                                                        <th>Method of Packing</th>
                                                        <th>Nature of Goods</th>
                                                        <th>New Weight</th>
                                                        <th>Dimension</th>
                                                        <th>Chargeable Weight</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_table"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $div_show ='';
                                if(isset($singleData['cash_booking_status']) == 'Yes') {
                                    $div_show = 'display: flex';
                                }
                                else {
                                    $div_show = 'display: none';
                                }
                                ?>
                                <div class="row" id="div_hr" style="<?php echo $div_show;?>">
                                    <div class="col-12">
                                        <hr><h4 class="mt-0 header-title">Cash Booking</h4><br>
                                    </div>
                                </div>
                                <div class="row" id="div_1" style="<?php echo $div_show;?>">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Freight Charge</label>
                                            <input type="text" id="freight_charge" name="freight_charge" class="form-control" value="{{isset($singleData['freight_charge']) ? $singleData['freight_charge'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Packing Charge</label>
                                            <input type="text" id="packing_charge" name="packing_charge" class="form-control" value="{{isset($singleData['packing_charge']) ? $singleData['packing_charge'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Value Surcharge</label>
                                            <input type="text" id="value_surcharge" name="value_surcharge" class="form-control" value="{{isset($singleData['value_surcharge']) ? $singleData['value_surcharge'] : ''}}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>AWB Charge / Loading Charge</label>
                                            <input type="text" id="loading_charge" name="loading_charge" class="form-control" value="{{isset($singleData['loading_charge']) ? $singleData['loading_charge'] : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="div_2" style="<?php echo $div_show;?>">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Unloading Charge</label>
                                            <input type="text" id="unloading_charge" name="unloading_charge" class="form-control" value="{{isset($singleData['unloading_charge']) ? $singleData['unloading_charge'] : ''}}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>SPL Cargo Charge</label>
                                            <input type="text" id="spl_cargo_charge" name="spl_cargo_charge" class="form-control" value="{{isset($singleData['spl_cargo_charge']) ? $singleData['spl_cargo_charge'] : ''}}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Godown Charge</label>
                                            <input type="text" id="godown_charge" name="godown_charge" class="form-control" value="{{isset($singleData['godown_charge']) ? $singleData['godown_charge'] : ''}}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Other Charge</label>
                                            <input type="text" id="other_charge" name="other_charge" class="form-control" value="{{isset($singleData['other_charge']) ? $singleData['other_charge'] : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="div_3" style="<?php echo $div_show;?>">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>TOTAL</b></label>
                                            <input type="text" id="total" name="total" class="form-control" value="{{isset($singleData['total']) ? $singleData['total'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>GST</b></label>
                                            <input type="text" id="gst" name="gst" class="form-control" value="{{isset($singleData['gst']) ? $singleData['gst'] : ''}}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>GRAND TOTAL</b></label>
                                            <input type="text" id="grand_total" name="grand_total" class="form-control" value="{{isset($singleData['grand_total']) ? $singleData['grand_total'] : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" id="submit" name="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $( "#booking_details" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                company_id: {
                    required: true,
                },
                contact_person : {
                    required: true,
                },
                consignee : {
                    required: true,
                },
                cash_booking_status : {
                    required: true,
                },
                origin : {
                    required: true,
                },
                destination: {
                    required: true,
                },
                airway_bill_no : {
                    required: true,
                },
                booking_date : {
                    required: true,
                },
                document_type : {
                    required: true,
                },
                shipping_mode : {
                    required: true,
                },
                weight : {
                    required: true,
                },
                type : {
                    required: true,
                },
                vendor_id : {
                    required: true,
                },
                e_way : {
                    required: true,
                },
                invoice : {
                    required: true,
                },
            },messages: {
                company_id: {
                    required: "Please select consignar",
                },
                contact_person: {
                    required: "Please enter contact person name",
                },
                consignee: {
                    required: "Please enter consignee name",
                },
                cash_booking_status: {
                    required: "Please select cash booking",
                },
                origin: {
                    required: "Please enter origin",
                },
                destination: {
                    required: "Please enter destination",
                },
                airway_bill_no: {
                    required: "Please enter airway bill no.",
                },
                booking_date: {
                    required: "Please enter booking date",
                },
                document_type: {
                    required: "Please select document type",
                },
                shipping_mode: {
                    required: "Please select shipping mode",
                },
                weight: {
                    required: "Please enter weight",
                },
                type: {
                    required: "Please select type",
                },
                vendor_id: {
                    required: "Please select vendor",
                },
                e_way: {
                    required: "Please enter e-way bill no.",
                },
                invoice: {
                    required: "Please enter invoice no.",
                },
            },submitHandler: function(form) {
              queryString = $('#booking_details').serialize();
                $.post('/speedex/booking/save', queryString, function (data) {
                    commonStatusMessage(data, '/speedex/booking');
                }, "JSON");
                return false;
            }
        })

        var singleBookingDetails = <?php echo json_encode($singleBookingDetails)?>;
        for(var j=0;j<singleBookingDetails.length;j++) {
            var autoId = '0_'+j;
            $("#table_packagees").show();
            $('#table_package_add').append('<tr id="rowadd'+autoId+'">'+
            '<td><input type="text" id="no_package'+autoId+'" name="no_package[]" class="form-control" /></td>'+
            '<td><select id="method_packing'+autoId+'" name="method_packing[]" class="form-control"><option value="">Select</option><option value="PVC">PVC</option></select></td>'+
            '<td><input type="text" id="nature_goods'+autoId+'" name="nature_goods[]" class="form-control" /></td>'+
            '<td><input type="text" id="net_weight'+autoId+'" name="net_weight[]" class="form-control" /></td>'+
            '<td><input type="text" id="length'+autoId+'" name="length[]" class="form-control dmtnsty" /> X <input type="text" id="width'+autoId+'" name="width[]" class="form-control dmtnsty" /> X <input type="text" id="height'+autoId+'" name="height[]" class="form-control dmtnsty" /></td>'+
            '<td><input type="text" id="chargeable_weight'+autoId+'" name="chargeable_weight[]" class="form-control" /></td>'+
            '</tr>');
            var  no_package = singleBookingDetails[j]['no_package'];
            var  method_packing = singleBookingDetails[j]['method_packing'];
            var  nature_goods = singleBookingDetails[j]['nature_goods'];
            var  net_weight = singleBookingDetails[j]['net_weight'];
            var  length = singleBookingDetails[j]['length'];
            var  width = singleBookingDetails[j]['width'];
            var  height = singleBookingDetails[j]['height'];
            var  chargeable_weight = singleBookingDetails[j]['chargeable_weight'];
            $("#no_package"+autoId).val(no_package);
            $("#method_packing"+autoId).val(method_packing);
            $("#nature_goods"+autoId).val(nature_goods);
            $("#net_weight"+autoId).val(net_weight);
            $("#length"+autoId).val(length);
            $("#width"+autoId).val(width);
            $("#height"+autoId).val(height);
            $("#chargeable_weight"+autoId).val(chargeable_weight);
        }
    })

    function cash_on() {
        var cash = $('#cash_booking_status').val();
        if (cash == 'Yes') {
			$('#div_hr').show();
			$('#div_1').show();
			$('#div_2').show();
			$('#div_3').show();
        }
        else if (cash == 'No') {
        	$('#div_hr').hide();
			$('#div_1').hide();
			$('#div_2').hide();
			$('#div_3').hide();
        }
    }

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
        '<td><input type="text" id="no_package'+pkg+'" name="no_package[]" class="form-control" /></td>'+
        '<td><select id="method_packing'+pkg+'" name="method_packing[]" class="form-control"><option value="">Select</option><option value="PVC">PVC</option></select></td>'+
        '<td><input type="text" id="nature_goods'+pkg+'" name="nature_goods[]" class="form-control" /></td>'+
        '<td><input type="text" id="net_weight'+pkg+'" name="net_weight[]" class="form-control" /></td>'+
        '<td><input type="text" id="length'+pkg+'" name="length[]" class="form-control dmtnsty" /> X <input type="text" id="width'+pkg+'" name="width[]" class="form-control dmtnsty" /> X <input type="text" id="height'+pkg+'" name="height[]" class="form-control dmtnsty" /></td>'+
        '<td><input type="text" id="chargeable_weight'+pkg+'" name="chargeable_weight[]" class="form-control" /></td>'+
        '</tr>');
        pkg++;
    });
</script>

@endsection