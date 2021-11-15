@extends('layouts.app')
@section('content')
<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="row align-items-center">
											<div class="col-md-8">
												<h4 class="page-title m-0">Role</h4>
											</div>
											<div class="col-md-4">
												<div class="float-right d-none d-md-block">
													<div class="dropdown">
														<a href="<?php echo url('roles/add')?>" class="btn btn-primary"><i class="ti-plus mr-2"></i>Add</a>
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
											<h4 class="mt-0 header-title">Role Lists</h4>
											<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Role Name</th>
														<th>Department</th>
														<th>Role Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($types as $key => $type)
													<tr>
														<td>{{$key+1}}</td>
														
														<td>{{$type->name}}</td>
														<td>{{$type->department_name}}</td>
														<td>
															@if($type->status=='Active')
																<span class="badge-pill badge-success">Active</span>
															@else
															<span class="badge-pill badge-danger">In-Active</span>
															@endif
														</td>
														<td>
															<a href="<?php echo url('roles/add/')?>/{{$type->id}}" class="btn btn-sm btn-outline-info waves-effect waves-light"><i class="ti-pencil-alt mr-2"></i>Edit</a>
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