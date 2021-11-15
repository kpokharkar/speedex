<table id="datatable<?php echo $type?>" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
            <td><?php echo $i+1;?> <i class="icon_color fa"></i></td>
            <td>
                <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="/speedex/booking/add/<?php echo $booking->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a>
                <a class="btn btn-sm btn-outline-primary waves-effect waves-light" href="/speedex/booking/view/<?php echo $booking->id?>"><i class="fas fa-truck mr-1"></i> Track </a>
                <a class="btn btn-sm btn-outline-danger waves-effect waves-light" href="javascript:void(0);"><i class="fas fa-trash-alt mr-1"></i> Delete </a>
            </td>
            <td><?php echo $booking->awb_no ?></td>
            <td><?php echo $booking->name ?></td>
            <td><?php echo $booking->bookingDate ?></td>
            <td><?php echo $booking->vendor_name ?></td>
            <td><?php echo $booking->origin ?></td>
            <td><?php echo $booking->destination ?></td>
            <td><?php echo $booking->consignee ?></td>
            <td>400101</td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        var type = <?php echo json_encode($type)?>;
        $("#datatable"+type).DataTable(), 
        $("#datatable-buttons").DataTable({
            lengthChange: !1,
            buttons: ["copy", "excel", "pdf", "colvis"]
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });

    var getBookingDetails = <?php echo json_encode($getBookingDetails)?>;
    var type = <?php echo json_encode($type)?>;
    if(type=='inscan') {
        $(".icon_color").addClass("fa-truck");
        $(".icon_color").addClass("inscan-outscan-in-transit-icon");
        $("#count_inscan").text('');
        $("#count_inscan").text(getBookingDetails.length);
    }
    else if(type=='reason') {
        $(".icon_color").addClass("fa-truck");
        $(".icon_color").addClass("reason-icon");
        $("#count_reason").text('');
        $("#count_reason").text(getBookingDetails.length);
    }
    else if(type=='Out_For_Delivery') {
        $(".icon_color").addClass("fa-truck");
        $(".icon_color").addClass("out-for-delivery-icon");
        $("#count_Out_For_Delivery").text('');
        $("#count_Out_For_Delivery").text(getBookingDetails.length);
    }
    else if(type=='Delivered') {
        $(".icon_color").addClass("fa-truck");
        $(".icon_color").addClass("delivered-icon");
        $("#count_Delivery").text('');
        $("#count_Delivery").text(getBookingDetails.length);
    }
    else if(type=='new_record') {
        $(".icon_color").addClass("fa-truck");
        $(".icon_color").addClass("new-record-icon");
        $("#count_new_record").text(getBookingDetails.length);
    }
    else if(type=='pod_attached') {
        $(".icon_color").addClass("fa-image");
        $(".icon_color").addClass("pod-attached-icon");
        $("#count_pod").text(getBookingDetails.length);
    }
</script>