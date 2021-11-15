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
            <td><?php echo $i+1;?> <i class="fa fa-truck delivered-icon"></i></td>
            <td>
                <a class="btn btn-sm btn-outline-info waves-effect waves-light" href="/speedex/booking/add/<?php echo $booking->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a>
                <a class="btn btn-sm btn-outline-primary waves-effect waves-light" href="/speedex/booking/view/<?php echo $booking->id?>"><i class="fas fa-truck mr-1"></i> Track </a>
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