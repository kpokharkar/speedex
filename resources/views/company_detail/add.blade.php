@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Consignor Detail</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="<?php echo url('company-details')?>" title="Back To Consignor Detail Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Consignor Detail Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="company_details" novalidate="novalidate" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($data['id']) ? $data['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Consignor Detail Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="company_info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Company Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control first-capital" value="{{isset($data['name']) ? $data['name'] : ''}}" required />
                                        </div>
                                    </div>
                                    <!--<div class="col-lg-4">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>Company Mobile No. <span class="text-danger">*</span></label>-->
                                    <!--        <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="{{isset($data['mobile_no']) ? $data['mobile_no'] : ''}}" required minlength="10" maxlength="10" />-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Company GST No. <span class="text-danger">*</span> <span id="gst_no_error" class="text-danger"></span></label>
                                            <input type="text" id="gst_no" name="gst_no" class="form-control" value="{{isset($data['gst_no']) ? $data['gst_no'] : ''}}" minlength="15" maxlength="15" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Company Email Id</label>
                                            <input type="email" id="email_id" name="email_id" class="form-control" value="{{isset($data['email_id']) ? $data['email_id'] : ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Contact Person Name <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person" name="contact_person" class="form-control first-capital" value="{{isset($data['contact_person']) ? $data['contact_person'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Contact Person Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_person_mobile" name="contact_person_mobile" value="{{isset($data['contact_person_mobile']) ? $data['contact_person_mobile'] : ''}}" class="form-control" required minlength="10" maxlength="10" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Address <span class="text-danger">*</span></label>
                                          <textarea id="address" name="address" class="form-control first-capital">{{isset($data['address']) ? $data['address'] : ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Company Status</label>
                                            <select id="status" name="status" class="form-control js-example-basic-single">
                                                <option value="" disabled="disabled">-- Select --</option>
                                                <option value="Active" {{ isset($data['status']) && $data['status'] == 'Active' ? 'selected' : ''}}>Active</option>
                                                <option value="Inactive" {{ isset($data['status']) && $data['status'] == 'Inactive' ? 'selected' : ''}}>In-Active</option>
                                            </select>
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
        $('.js-example-basic-single').select2();
        
        $( "#company_details" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                name: {
                    required: true,
                },
                gst_no : {
                    required: true,
                },
                contact_person : {
                    required: true,
                },
                contact_person_mobile : {
                    required: true,
                },
                address : {
                    required: true,
                },
            },messages: {
                name: {
                    required: "Please Enter Company Name",
                },
                gst_no: {
                    required: "Please Enter Company GST No.",
                },
                contact_person: {
                    required: "Please Enter Contact Person Name",
                },
                contact_person_mobile: {
                    required: "Please Enter Contact Person Mobile No.",
                },
                address: {
                    required: "Please Enter Address",
                },
            },submitHandler: function(form) {
                queryString = $('#company_details').serialize();
                
                $("#submit").css("display", "none");
                $("#loading").css("display", "block");
                $("#loading").prop( "disabled", true );
                
                $.post('/speedex/company-details/save', queryString, function (data) {
                    commonStatusMessage(data, '/speedex/company-details');
                }, "JSON");
                return false;
            }
        })
    })

    $("#name").keypress(function (e) {
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
    
    $("#email_id").on('change', function() {
        var email_id =$("#email_id").val();
        var patt = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var rsemail = patt.test(email_id);
        if(rsemail == false){
            $("#email_id").focus();
            return false;
        }
    });

    $("#contact_person").keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('#contact_person_mobile').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

</script>

@endsection