@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Consignor Detail</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="company-details/add" title="Add New Consignor Detail"><i class="fas fa-plus ml-1 mr-2"></i> Add New Consignor Detail</a>
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
                    <h4 class="mt-0 header-title">Consignor Detail Lists</h4>
                    <p class="text-muted m-b-30">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Company Name</th>
                                <th>Company GST No.</th>
                                <th>Contact Person Name</th>
                                <th>Contact Person Mobile No.</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0; 
                                foreach($getCompanyDetails as $company) {
                                if($company->status == 'Active') {
                                    $status = 'badge badge-success';
                                }
                                else {
                                    $status = 'badge badge-danger';
                                }
                            ?>
                            <tr>
                                <td><?php echo ($i+1) ?></td>
                                <td><h6><span class="<?php echo $status?>"><?php echo $company->status?></span></h6></td>
                                <td><a class="btn btn-sm btn-outline-info waves-effect waves-light" href="/speedex/company-details/add/<?php echo $company->id?>"><i class="fas fa-pencil-alt mr-1"></i> Edit </a></td>
                                <td><?php echo $company->name ?></td>
                                <td><?php echo $company->gst_no ?></td>
                                <td><?php echo $company->contact_person ?></td>
                                <td><?php echo $company->contact_person_mobile ?></td>
                                <td><?php $d=strtotime($company->created_at); echo date("d-m-Y", $d);?></td>
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