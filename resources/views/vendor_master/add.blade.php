@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Vendor 1</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="<?php echo url('vendor-master')?>" title="Back To Vendor 1 Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Vendor 1 Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="vendor_details" novalidate="novalidate" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($data['id']) ? $data['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Vendor 1 Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="company_info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Vendor Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control first-capital" value="{{isset($data['name']) ? $data['name'] : ''}}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Mobile No. <span class="text-danger">*</span></label>
                                            <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="{{isset($data['mobile_no']) ? $data['mobile_no'] : ''}}" required minlength="10" maxlength="10" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Email Id</label>
                                            <input type="email" id="email_id" name="email_id" class="form-control" value="{{isset($data['email_id']) ? $data['email_id'] : ''}}" />
                                        </div>
                                    </div>
                                      <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Status</label>
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

        $( "#vendor_details" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                name: {
                    required: true,
                },
                mobile_no : {
                    required: true,
                },
            },messages: {
                name: {
                    required: "Please Enter Vendor Name",
                },
                mobile_no: {
                    required: "Please Enter Mobile No.",
                },
            },submitHandler: function(form) {
                queryString = $('#vendor_details').serialize();
                
                $("#submit").css("display", "none");
                $("#loading").css("display", "block");
                $("#loading").prop( "disabled", true );
                
                $.post('/speedex/vendor-master/save', queryString, function (data) {
                    commonStatusMessage(data, '/speedex/vendor-master');
                }, "JSON");
                return false;
            }
        })
    })
    
    $("#name").keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z- ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    
    $('#mobile_no').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
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
</script>

@endsection