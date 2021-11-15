@extends('layouts.app')
@section('title', $title)
@section('content')
	<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="row align-items-center">
											<div class="col-md-8">
												<h4 class="page-title m-0">User</h4>
											</div>
											<div class="col-md-4">
												<div class="float-right d-none d-md-block">
													<div class="dropdown">
														<a href="<?php echo url('users/add')?>" class="btn btn-primary"><i class="ti-plus mr-2"></i>Add New User</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="card m-b-30">
										<div class="card-body">
											<h4 class="mt-0 header-title">User Lists</h4>
											<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Full Name</th>
														<th>Email</th>
														<th>Mobile Number</th>
														<th>Role - User Type</th>
														<th>User Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($userDetails as $key => $user)
													<tr>
														<td>{{$key+1}}</td>
														<td>{{$user->fullName}}</td>
														<td>{{$user->email}}</td>
														<td>{{$user->mobile_no}}</td>
														<td>{{$user->user_type}}</td>
														<td>
															@if($user->status=='Active')
															<span class="badge-pill badge-success">Active</span>
															@else
															<span class="badge-pill badge-danger">In-Active</span>
															@endif
														</td>
														<td>
															<a href="<?php echo url('users/add')?>/{{$user->id}}" class="btn btn-sm btn-outline-info waves-effect waves-light"><i class="ti-pencil-alt mr-2"></i>Edit</a>
															<!-- <a href="javascript:void(0);" id="sa-params" class="btn btn-sm btn-outline-danger waves-effect waves-light"><i class="ti-trash mr-2"></i>Delete</a> -->
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
@endsection