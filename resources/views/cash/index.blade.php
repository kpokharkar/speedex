@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Cash Booking</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="cash/add" title="Add New Cash Booking"><i class="fas fa-plus ml-1 mr-2"></i> Add New Cash Booking</a>
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
                    <h4 class="mt-0 header-title">Cash Booking Lists</h4>
                    <p class="text-muted m-b-30">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Action</th>
                                <th>Person Name</th>
                                <th>Contact Person</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a class="btn btn-outline-info waves-effect waves-light" href="/speedex/cash/add/"><i class="fas fa-pencil-alt mr-1"></i> Edit </a></td>
                                <td>Person Name</td>
                                <td>Contact Person</td>
                                <td>Origin</td>
                                <td>Destination</td>
                                <td>Booking Date</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection