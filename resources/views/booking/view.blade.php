@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Tacking for Booking</h4></div>
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
                <form class="" id="booking_details" method="post" enctype="multipart/form-data" action ="<?php echo url('/booking/track-save')?>">
                    @csrf
                    <input type="hidden" id="track_id" name="track_id" value="<?php echo $track_id?>">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Tracking Booking Form</h4>
                    </div>
                    <div class="card-body">
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

        var singleBookingTrackDetails = <?php echo json_encode($singleBookingTrackDetails)?>;
        for(var j=0;j<singleBookingTrackDetails.length;j++) {
            var trk = '0_'+j;
            $("#track_div").show();
            $("#table_track").show();
            $('#table_track_add').append('<tr id="rowadd'+trk+'">'+
            '<td><input type="hidden" id="track_auto_id'+trk+'" name="track_auto_id[]" class="form-control" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveTrackRow('+trk+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
            '<td><input type="text" id="track_date'+trk+'" name="track_date[]" class="form-control width-auto" readonly/></td>'+
            '<td><select id="track_io'+trk+'" name="track_io[]" class="form-control js-example-basic-single width-auto"><option value="">-- Select --</option><option value="Inscan">Inscan</option><option value="Outscan">Outscan</option><option value="InTransit">InTransit</option><option value="Out_For_Delivery">Out For Delivery</option><option value="Delivered">Delivered</option><option value="Reason">Reason</option></select></td>'+
            '<td><input type="text" id="track_description'+trk+'" name="track_description[]" class="form-control width-auto first-capital" /></td>'+
            '</tr>');
            
            var  track_date = singleBookingTrackDetails[j]['track_date'];
            var  track_io = singleBookingTrackDetails[j]['track_io'];
            var  track_description = singleBookingTrackDetails[j]['track_description'];
            
            $("#track_date"+trk).val(track_date);
            $("#track_io"+trk).val(track_io);
            if(track_io=='Delivered') {
                $("#display_only_in_delivered").show();    
            }
            else {
                $("#display_only_in_delivered").hide();    
            }
            
            $("#track_description"+trk).val(track_description);
            $("#track_auto_id"+trk).val(trk);
            $('.js-example-basic-single').select2();
        }
    })

    var trk=0;
    $('#add_track').on('click',function() {
        var trk= $('#tbody_table_track tr').length;
        $("#track_div").show();
        $("#table_track").show();
        $('#table_track_add').append('<tr id="rowadd'+trk+'">'+
        '<td><input type="hidden" id="track_auto_id'+trk+'" name="track_auto_id[]" class="form-control" /><a href="javascript:void(0);" class="text-danger btn" onclick="RemoveTrackRow('+trk+')"><i class="mdi mdi-delete-forever h5"></i></a></td>'+
        '<td><input type="date" id="track_date'+trk+'" name="track_date[]" class="form-control width-auto" /></td>'+
        '<td><select id="track_io'+trk+'" name="track_io[]" class="form-control js-example-basic-single width-auto"><option value="">-- Select --</option><option value="Inscan">Inscan</option><option value="Outscan">Outscan</option><option value="InTransit">InTransit</option><option value="Out_For_Delivery">Out For Delivery</option><option value="Delivered">Delivered</option><option value="Reason">Reason</option></select></td>'+
        '<td><input type="text" id="track_description'+trk+'" name="track_description[]" class="form-control width-auto first-capital" /></td>'+
        '</tr>');
        $('.js-example-basic-single').select2();
        trk++;
    });
    
    function RemoveTrackRow(id) {
        $("#rowadd"+id).remove();
        Swal.fire('Row Deleted!')
    }
    
    function attach_file_url(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#attach_file_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            var form_data = new FormData();
            form_data.append("attach_file",document.getElementById('attach_file').files[0]);
        }
    }
    
    // $("#submit").on("click",function() {
    //     $("#submit").css("display", "none");
    //     $("#loading").css("display", "block");
    //     $("#loading").prop( "disabled", true );
    // }
</script>

@endsection