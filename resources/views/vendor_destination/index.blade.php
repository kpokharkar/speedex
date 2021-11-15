@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Vendor 2</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="/speedex/vendor-destination/add" title="Add New Vendor 2"><i class="fas fa-plus ml-1 mr-2"></i> Add New Vendor 2</a>
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
                    <h4 class="mt-0 header-title">Vendor 2 Lists</h4>
                    <p class="text-muted m-b-30">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Vendor Name</th>
                                <th>Destination</th>
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0; 
                                foreach($getVendorDetails as $vendor) {
                                if($vendor->status == 'Active') {
                                    $status = 'badge badge-success';
                                }
                                else {
                                    $status = 'badge badge-danger';
                                }
                            ?>
                            <tr>
                                <td><?php echo $i+1;?></td>
                                <td><h6><span class="<?php echo $status?>"><?php echo $vendor->status?></span></h6></td>
                                <td><a class="btn btn-sm btn-outline-info waves-effect waves-light" href="/speedex/vendor-destination/add/<?php echo $vendor->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a></td>
                                <td><?php echo $vendor->name ?></td>
                                <td><?php echo $vendor->destination ?></td>
                                <td><?php echo $vendor->mobile_no ?></td>
                                <td><?php echo $vendor->email_id ?></td>
                                <td><?php  $d=strtotime($vendor->created_at); echo date("d-m-Y", $d);?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection