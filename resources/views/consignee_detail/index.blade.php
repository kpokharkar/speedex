@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Consignee Detail</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="consignee-details/add" title="Add New Consignee Detail"><i class="fas fa-plus ml-1 mr-2"></i> Add New Consignee Detail</a>
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
                    <h4 class="mt-0 header-title">Consignee Detail Lists</h4>
                    <p class="text-muted m-b-30">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Action</th>
                                <th>Consignor Name</th>
                                <th>Company Name</th>
                                <th>Destination</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($details as $key => $detail){
                            ?>
                            <tr>
                                <td><?php echo $key+1?></td>
                                <td><a class="btn btn-sm btn-outline-info waves-effect waves-light" href="<?php echo url('consignee-details/add/')?>/<?php echo $detail->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a></td>
                                <td><?php echo $detail->name?></td>
                                <td><?php echo $detail->company_name?></td>
                                <td><?php echo $detail->company_name?></td>
                                <td><?php $d=strtotime($detail->created_at); echo date("d-m-Y", $d);?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection