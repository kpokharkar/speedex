@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Cash Booking</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="./" title="Back To Cash Booking Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Cash Booking Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="cash_booking" novalidate="novalidate" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Cash Booking Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="company_info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Booking Date <span class="text-danger">*</span></label>
                                            <input type="date" id="booking_date" name="booking_date" class="form-control" value="{{isset($singleData['booking_date']) ? $singleData['booking_date'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Airway Bill No. <span class="text-danger">*</span></label>
                                            <input type="text" id="airway_bill_no" name="airway_bill_no" class="form-control" value="{{isset($singleData['airway_bill_no']) ? $singleData['airway_bill_no'] : ''}}" required />
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
                                            <label>Person Name <span class="text-danger">*</span></label>
                                            <input type="text" id="person_name" name="person_name" class="form-control" value="{{isset($singleData['person_name']) ? $singleData['person_name'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Aadhar Card <span class="text-danger">*</span></label>
                                            <input type="text" id="aadhar_card" name="aadhar_card" class="form-control" value="{{isset($singleData['aadhar_card']) ? $singleData['aadhar_card'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Pan Card <span class="text-danger">*</span></label>
                                            <input type="text" id="pan_card" name="pan_card" class="form-control" value="{{isset($singleData['pan_card']) ? $singleData['pan_card'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Person Pincode <span class="text-danger">*</span></label>
                                            <input type="text" id="person_pincode" name="person_pincode" class="form-control" value="{{isset($singleData['person_pincode']) ? $singleData['person_pincode'] : ''}}" minlength="6" maxlength="6" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Person Address Line 1 <span class="text-danger">*</span></label>
                                            <input type="text" id="person_address_1" name="person_address_1" class="form-control" value="{{isset($singleData['person_address_1']) ? $singleData['person_address_1'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Person Address Line 2 <span class="text-danger">*</span></label>
                                            <input type="text" id="person_address_2" name="person_address_2" class="form-control" value="{{isset($singleData['person_address_2']) ? $singleData['person_address_2'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Consignee Name <span class="text-danger">*</span></label>
                                            <input type="text" id="consignee" name="consignee" class="form-control" value="{{isset($singleData['consignee']) ? $singleData['consignee'] : ''}}" required />
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
                                            <label>Contact Person Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person_mob" name="contact_person_mob" class="form-control" value="{{isset($singleData['contact_person_mob']) ? $singleData['contact_person_mob'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address Line 1 <span class="text-danger">*</span></label>
                                            <input type="text" id="address_1" name="address_1" class="form-control" value="{{isset($singleData['address_1']) ? $singleData['address_1'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address Line 2 <span class="text-danger">*</span></label>
                                            <input type="text" id="address_2" name="address_2" class="form-control" value="{{isset($singleData['address_2']) ? $singleData['address_2'] : ''}}" required />
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
                                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" value="{{isset($singleData['invoice_no']) ? $singleData['invoice_no'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>E-Way Bill No.</label>
                                            <input type="text" id="eway_bill_no" name="eway_bill_no" class="form-control" value="{{isset($singleData['eway_bill_no']) ? $singleData['eway_bill_no'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Select Vendor <span class="text-danger">*</span></label>
                                            <select id="vendor_id" name="vendor_id" class="form-control">
                                                <option value="">Select Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                <div class="row">
                                    <div class="col-12">
                                        <hr><h4 class="mt-0 header-title">Cash Booking</h4><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Freight Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="freight_charge" name="freight_charge" class="form-control" value="{{isset($singleData['freight_charge']) ? $singleData['freight_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Packing Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="packing_charge" name="packing_charge" class="form-control" value="{{isset($singleData['packing_charge']) ? $singleData['packing_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Value Surcharge <span class="text-danger">*</span></label>
                                            <input type="text" id="value_surcharge" name="value_surcharge" class="form-control" value="{{isset($singleData['value_surcharge']) ? $singleData['value_surcharge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>AWB Charge / Loading Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="loading_charge" name="loading_charge" class="form-control" value="{{isset($singleData['loading_charge']) ? $singleData['loading_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Unloading Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="unloading_charge" name="unloading_charge" class="form-control" value="{{isset($singleData['unloading_charge']) ? $singleData['unloading_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>SPL Cargo Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="spl_cargo_charge" name="spl_cargo_charge" class="form-control" value="{{isset($singleData['spl_cargo_charge']) ? $singleData['spl_cargo_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Godown Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="godown_charge" name="godown_charge" class="form-control" value="{{isset($singleData['godown_charge']) ? $singleData['godown_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Other Charge <span class="text-danger">*</span></label>
                                            <input type="text" id="other_charge" name="other_charge" class="form-control" value="{{isset($singleData['other_charge']) ? $singleData['other_charge'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>TOTAL</b> <span class="text-danger">*</span></label>
                                            <input type="text" id="total" name="total" class="form-control" value="{{isset($singleData['total']) ? $singleData['total'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>GST</b> <span class="text-danger">*</span></label>
                                            <input type="text" id="gst" name="gst" class="form-control" value="{{isset($singleData['gst']) ? $singleData['gst'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label><b>GRAND TOTAL</b> <span class="text-danger">*</span></label>
                                            <input type="text" id="grand_total" name="grand_total" class="form-control" value="{{isset($singleData['grand_total']) ? $singleData['grand_total'] : ''}}" required />
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
        $( "#cash_booking" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                booking_date: {
                    required: true,
                },
                airway_bill_no: {
                    required: true,
                },
                origin: {
                    required: true,
                },
                destination: {
                    required: true,
                },
                person_name: {
                    required: true,
                },
                aadhar_card: {
                    required: true,
                },
                pan_card: {
                    required: true,
                },
                person_pincode: {
                    required: true,
                },
                person_address_1: {
                    required: true,
                },
                person_address_2: {
                    required: true,
                },
                consignee: {
                    required: true,
                },
                contact_person: {
                    required: true,
                },
                contact_person_mob: {
                    required: true,
                },
                address_1: {
                    required: true,
                },
                address_2: {
                    required: true,
                },
                pincode: {
                    required: true,
                },
                vendor_id: {
                    required: true,
                },
                document_type: {
                    required: true,
                },
                shipping_mode: {
                    required: true,
                },
                freight_charge: {
                    required: true,
                },
                packing_charge: {
                    required: true,
                },
                value_surcharge: {
                    required: true,
                },
                loading_charge: {
                    required: true,
                },
                unloading_charge: {
                    required: true,
                },
                spl_cargo_charge: {
                    required: true,
                },
                godown_charge: {
                    required: true,
                },
                other_charge: {
                    required: true,
                },
                total: {
                    required: true,
                },
                gst: {
                    required: true,
                },
                grand_total: {
                    required: true,
                },
            },messages: {
                booking_date: {
                    required: "Please Select Booking Date",
                },
                airway_bill_no: {
                    required: "Please Enter Airway Bill No.",
                },
                origin: {
                    required: "Please Enter Origin",
                },
                destination: {
                    required: "Please Enter Destination",
                },
                person_name: {
                    required: "Please Enter Person Name",
                },
                aadhar_card: {
                    required: "Please Enter Aadhar Card",
                },
                pan_card: {
                    required: "Please Enter Pan Card",
                },
                person_pincode: {
                    required: "Please Enter Person Pincode",
                },
                person_address_1: {
                    required: "Please Enter Person Address Line 1",
                },
                person_address_2: {
                    required: "Please Enter Person Address Line 2",
                },
                consignee: {
                    required: "Please Enter Consignee Name",
                },
                contact_person: {
                    required: "Please Enter Contact Person Name",
                },
                contact_person_mob: {
                    required: "Please Enter Contact Person Mobile No.",
                },
                address_1: {
                    required: "Please Enter Address Line 1",
                },
                address_2: {
                    required: "Please Enter Address Line 2",
                },
                pincode: {
                    required: "Please Enter Pincode",
                },
                vendor_id: {
                    required: "Please Enter Select Vendor",
                },
                document_type: {
                    required: "Please Select Document Type",
                },
                shipping_mode: {
                    required: "Please Select Shipping Mode",
                },
                freight_charge: {
                    required: "Please Enter Freight Charge",
                },
                packing_charge: {
                    required: "Please Enter Packing Charge",
                },
                value_surcharge: {
                    required: "Please Enter Value Surcharge",
                },
                loading_charge: {
                    required: "Please Enter AWB Charge / Loading Charge",
                },
                unloading_charge: {
                    required: "Please Enter Unloading Charge",
                },
                spl_cargo_charge: {
                    required: "Please Enter SPL Cargo Charge",
                },
                godown_charge: {
                    required: "Please Enter Godown Charge",
                },
                other_charge: {
                    required: "Please Enter Other Charge",
                },
                total: {
                    required: "Please Enter TOTAL",
                },
                gst: {
                    required: "Please Enter GST",
                },
                grand_total: {
                    required: "Please Enter GRAND TOTAL",
                },
            },submitHandler: function(form) {
                queryString = $('#cash_booking').serialize();
                $.post('/speedex/cash/save', queryString, function (data) {
                    commonStatusMessage(data, '/speedex/cash');
                }, "JSON");
                return false;
            }
        })
    })

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
        '<td><input type="text" id="no_package'+pkg+'" name="no_package[]" class="form-control int" /></td>'+
        '<td><select id="method_packing'+pkg+'" name="method_packing[]" class="form-control"><option value="" selected="true" disabled="disabled">Select</option><option value="PVC">PVC</option><option value="Pallet">Pallet</option><option value="Wooden">Wooden</option><option value="Plastic">Plastic</option></select></td>'+
        '<td><input type="text" id="nature_goods'+pkg+'" name="nature_goods[]" class="form-control varchar" /></td>'+
        '<td><input type="text" id="net_weight'+pkg+'" name="net_weight[]" class="form-control float" /></td>'+
        '<td><input type="text" id="length'+pkg+'" name="length[]" class="form-control float dmtnsty" placeholder="L" /> X <input type="text" id="width'+pkg+'" name="width[]" class="form-control float dmtnsty" placeholder="B" /> X <input type="text" id="height'+pkg+'" name="height[]" class="form-control float dmtnsty" placeholder="H" /> / <input type="text" id="divide'+pkg+'" name="divide[]" class="form-control dmtnsty" placeholder="vol." readonly="" /></td>'+
        '<td><input type="text" id="chargeable_weight'+pkg+'" name="chargeable_weight[]" class="form-control" readonly="" /></td>'+
        '</tr>');
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
</script>

@endsection