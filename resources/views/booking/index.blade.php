@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="spinner-border text-secondary loading_sty" role="status" id="loading" name="loading" style="display:none;"><span class="sr-only">Loading...</span></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Booking</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="booking/add" title="Add New Booking"><i class="fas fa-plus ml-1 mr-2"></i> Add New Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body scrl">
                    <h4 class="mt-0 header-title">Booking Lists</h4>
                    <p class="text-muted m-b-30">
                    <ul class="nav nav-tabs booking" role="tablist">
						<li class="nav-item"><button class="nav-link active new-record filter_data" id="new_record" name="new_record"><i class="fa fa-truck"></i> New Record <span class="badge" id="count_new_recored"><?php print_r(count($getBookingDetails))?></span></button></li>
						<li class="nav-item"><button class="nav-link filter_data inscan-outscan-in-transit" id="inscan" name="inscan"><i class="fa fa-truck"></i> Inscan / Outscan / In Transit <span class="badge" id="count_inscan"><?php print_r(count($inscanCount))?></span></button></li>
						<li class="nav-item"><button class="nav-link filter_data reason" id="reason" name="reason"><i class="fa fa-truck"></i> Reason <span class="badge" id="count_reason"><?php print_r(count($reasonCount))?></span></button></li>
						<li class="nav-item"><button class="nav-link filter_data out-for-delivery" id="Out_For_Delivery" name="Out_For_Delivery"><i class="fa fa-truck"></i> Out For Delivery <span class="badge" id="count_Out_For_Delivery"><?php print_r(count($outForDeliveryCount))?></span></button></li>
						<li class="nav-item"><button class="nav-link filter_data delivered" id="Delivered" name="Delivered"><i class="fa fa-truck"></i> Delivered <span class="badge" id="count_Delivery"><?php print_r(count($deliveredCount))?></span></button></li>
						<li class="nav-item"><button class="nav-link filter_data pod-attached" id="pod_attached" name="pod-attached"><i class="fa fa-image"></i> POD Attached <span class="badge" id="count_pod"><?php print_r(count($podCount))?></span></button></li>
					</ul>
					<div class="tab-content">
					    <div class="tab-pane active p-3" id="new-record1" role="tabpanel">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Action</th>
                                        <th>AWB No.</th>
                                        <th>Consignor Name</th>
                                        <th>Booking Date</th>
                                        <th>Vendor Name</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Consignee</th>
                                        <th>Pincode</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach($getBookingDetails as $booking) { ?>
                                    <tr>
                                        <td><?php echo $i+1;?> <i class="fa fa-truck new-record-icon"></i></td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="/speedex/booking/add/<?php echo $booking->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a>
                                            <a class="btn btn-sm btn-outline-primary waves-effect waves-light" href="/speedex/booking/view/<?php echo $booking->id?>"><i class="fas fa-truck mr-1"></i> Track </a>
                                            <a class="btn btn-sm btn-outline-danger waves-effect waves-light" href="javascript:void(0);" onclick="confirmDelete('<?php echo $booking->id?>')"><i class="fas fa-trash-alt mr-1"></i> Delete </a>
                                        </td>
                                        <td><?php echo $booking->awb_no ?></td>
                                        <td><?php echo $booking->name ?></td>
                                        <td><?php echo $booking->bookingDate ?></td>
                                        <td><?php echo $booking->vendor_name ?></td>
                                        <td><?php echo $booking->origin ?></td>
                                        <td><?php echo $booking->destination ?></td>
                                        <td><?php echo $booking->consignee ?></td>
                                        <td><?php echo $booking->pincode ?></td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane p-3" id="inscan-outscan-in-transit1" role="tabpanel">
                            Inscan / Outscan / In Transit
                        </div>
                        <div class="tab-pane p-3" id="reason1" role="tabpanel">
                            Reason
                        </div>
                        <div class="tab-pane p-3" id="out-for-delivery1" role="tabpanel">
                            Out For Delivery
                        </div>
                        <div class="tab-pane p-3" id="delivered1" role="tabpanel">
                            Delivered
                        </div>
                        <div class="tab-pane p-3" id="pod-attached1" role="tabpanel">
                            POD Attached
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".filter_data").on("click",function() {
        var filter = this.id;
        $("#loading").show().fadeOut(5000);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            url: "<?php echo url('booking/view-inscan')?>",
            data: {
                filter:filter 
            },success: function(response) {
                if(filter=='inscan') {
                    $(".inscan-outscan-in-transit").addClass("active");
                    $(".new-record").removeClass("active");
                    $(".reason").removeClass("active");
                    $(".out-for-delivery").removeClass("active");
                    $(".delivered").removeClass("active");
                    $(".pod-attached").removeClass("active");
                    $("#new-record1").hide();
                    $("#out-for-delivery1").hide();
                    $("#delivered1").hide();
                    $("#pod-attached1").hide();
                    $("#reason1").hide();
                    $("#inscan-outscan-in-transit1").show();
                    $("#inscan-outscan-in-transit1").html(response);
                }
                else if(filter=='reason') {
                    $(".reason").addClass("active");
                    $(".inscan-outscan-in-transit").removeClass("active");
                    $(".new-record").removeClass("active");
                    $(".out-for-delivery").removeClass("active");
                    $(".delivered").removeClass("active");
                    $(".pod-attached").removeClass("active");
                    $("#new-record1").hide();
                    $("#inscan-outscan-in-transit1").hide();
                    $("#out-for-delivery1").hide();
                    $("#delivered1").hide();
                    $("#pod-attached1").hide();
                    $("#reason1").show();             
                    $("#reason1").html(response);
                }
                else if(filter=='Out_For_Delivery') {
                    $(".reason").removeClass("active");
                    $(".inscan-outscan-in-transit").removeClass("active");
                    $(".new-record").removeClass("active");
                    $(".out-for-delivery").addClass("active");
                    $(".delivered").removeClass("active");
                    $(".pod-attached").removeClass("active");
                    $("#new-record1").hide();
                    $("#inscan-outscan-in-transit1").hide();
                    $("#out-for-delivery1").html(response);
                    $("#out-for-delivery1").show();
                    $("#delivered1").hide();
                    $("#pod-attached1").hide();
                    $("#reason1").hide();
                }
                else if(filter=='Delivered') {
                    $(".reason").removeClass("active");
                    $(".inscan-outscan-in-transit").removeClass("active");
                    $(".new-record").removeClass("active");
                    $(".out-for-delivery").removeClass("active");
                    $(".delivered").addClass("active");
                    $(".pod-attached").removeClass("active");
                    $("#new-record1").hide();
                    $("#inscan-outscan-in-transit1").hide();
                    $("#out-for-delivery1").hide();
                    $("#delivered1").show();
                    $("#delivered1").html(response);
                    $("#pod-attached1").hide();
                    $("#reason1").hide();
                }
                else if(filter=='new_record') {
                    $(".reason").removeClass("active");
                    $(".inscan-outscan-in-transit").removeClass("active");
                    $(".new-record").addClass("active");
                    $(".out-for-delivery").removeClass("active");
                    $(".delivered").removeClass("active");
                    $(".pod-attached").removeClass("active");
                    $("#new-record1").show();
                    $("#inscan-outscan-in-transit1").hide();
                    $("#out-for-delivery1").hide();
                    $("#delivered1").hide();
                    $("#new-record1").html(response);
                    $("#pod-attached1").hide();
                    $("#reason1").hide();
                }
                else if(filter=='pod_attached') {
                    $(".reason").removeClass("active");
                    $(".inscan-outscan-in-transit").removeClass("active");
                    $(".new-record").removeClass("active");
                    $(".out-for-delivery").removeClass("active");
                    $(".delivered").removeClass("active");
                    $(".pod-attached").addClass("active");
                    $("#new-record1").hide();
                    $("#inscan-outscan-in-transit1").hide();
                    $("#out-for-delivery1").hide();
                    $("#delivered1").hide();
                    $("#pod-attached1").show();
                    $("#pod-attached1").html(response);
                    $("#reason1").hide();
                }
            }
        })
    })
    
    function confirmDelete(id) {
      deleteUrl = '<?php echo url('booking/delete/')?>/' + id;
      indexUrl = '<?php echo url("booking")?>';
      commonConfirmDelete(deleteUrl, indexUrl);
  }
</script>

@endsection