@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Consignee Detail</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="<?php echo url('consignee-details')?>" title="Back To Consignee Detail Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Consignee Detail Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="consignee_details" novalidate="novalidate" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Consignee Detail Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active p-3" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Select Consignor <span class="text-danger">*</span></label>
                                            <select id="consignor" name="consignor" class="form-control js-example-basic-single" required="">
                                                <option value="" selected="true" disabled="disabled">-- Select --</option>
                                                <?php foreach($getCompanyDetails as $company) { ?>
                                                <option value="<?php echo $company->id?>" {{ isset($singleData['consignor']) && $singleData['consignor'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Company Name <span class="text-danger">*</span></label>
                                            <input type="text" id="company_name" name="company_name" class="form-control first-capital" value="{{isset($singleData['company_name']) ? $singleData['company_name'] : ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr><h4 class="mt-0 header-title">Address Details</h4><br>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12 col-md-2">
                                        <button type="button" class="btn btn-outline-secondary" id="add_address" name="add_address"><i class="fa fa-plus"></i>&nbsp; Add Address</button>
                                    </div>
                                </div>
                                <div class="row form-group" id="table_address" style="display: none;">
                                    <div class="col-12 col-md-4 m-t-10 m-b-20">
                                        <div class="input-group">
                                            <input type="text" id="search_here" name="search_here" class="form-control" placeholder="Search here.">
                                            <div class="input-group-append bg-custom b-0"><span class="input-group-text icon-sty"><i class="mdi mdi-mdi mdi-table-search"></i></span></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped" id="table_address_add">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Contact Person Name</th>
                                                        <th>Contact Person Mobile No.</th>
                                                        <th>Destination</th>
                                                        <th>Address</th>
                                                        <th>Pincode</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_table"></tbody>
                                            </table>
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
        
        $( "#consignee_details" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
                consignor: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
            },messages: {
                consignor: {
                    required: "Please Select Consignor",
                },
                company_name: {
                    required: "Please Enter Company Name",
                },
            },submitHandler: function(form) {
                queryString = $('#consignee_details').serialize();
                
                $("#submit").css("display", "none");
                $("#loading").css("display", "block");
                $("#loading").prop( "disabled", true );
                
                $.post('<?php echo url('consignee-details/save')?>', queryString, function (data) {
                    commonStatusMessage(data, '<?php echo url('consignee-details')?>');
                }, "JSON");
                return false;
            }
        })
        
        let addressDetails = <?php echo json_encode($addressDetails)?>;
        if(addressDetails.length){
            $("#table_address").show();
            for(let i=0;i<addressDetails.length;i++){
                let no = '00'+'_'+i;
                $('#table_address_add').append('<tr id="rowadd'+no+'">'+
                '<td><input type="hidden" id="address_auto_id'+no+'" name="address_auto_id[]" class="form-control width-auto" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveAddressRow('+ads+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
                '<td><input type="text" id="name'+no+'" name="name[]" class="form-control width-auto varchar first-capital" /></td>'+
                '<td><input type="text" id="mobile'+no+'" name="mobile[]" class="form-control width-auto int" minlength="10" maxlength="10" /></td>'+
                '<td><input type="text" id="destination'+no+'" name="destination[]" class="form-control width-auto varchar first-capital" /></td>'+
                '<td><textarea id="address'+no+'" name="address[]" class="form-control width-auto first-capital"></textarea></td>'+
                '<td><input type="text" id="pincode'+no+'" name="pincode[]" class="form-control width-auto int" minlength="6" maxlength="6" /></td>'+
                '<td><select id="status'+no+'" name="status[]" class="form-control js-example-basic-single width-auto"><option value="" disabled="disabled">-- Select --</option><option value="0" selected>Active</option><option value="1">In-Active</option></select></td>'+
                '</tr>');      
                
                let name = addressDetails[i]['name'];
                let mobile = addressDetails[i]['mobile'];
                let destination = addressDetails[i]['destination'];
                let address = addressDetails[i]['address'];
                let pincode = addressDetails[i]['pincode'];
                let status = addressDetails[i]['status'];
                $("#name"+no).val(name);
                $("#mobile"+no).val(mobile);
                $("#destination"+no).val(destination);
                $("#address"+no).val(address);
                $("#pincode"+no).val(pincode);
                $("#status"+no).val(status);
            }
        }
    })
    
    $("#company_name").keypress(function (e) {
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
        '<td><textarea id="address'+ads+'" name="address[]" class="form-control width-auto first-capital"></textarea></td>'+
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
</script>

@endsection