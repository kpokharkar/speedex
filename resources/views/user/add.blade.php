@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="row align-items-center">
											<div class="col-md-8">
												<h4 class="page-title m-0">Add New User</h4>
											</div>
											<div class="col-md-4">
												<div class="float-right d-none d-md-block">
													<div class="dropdown">
														<a href="index.html" class="btn btn-primary"><i class="ti-arrow-left mr-2"></i>Back to User Lists</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="card m-b-30">
										<div class="card-body">
											<h4 class="mt-0 header-title">New User Form</h4>
											<hr>
											<form class="" name="user_form" id="user_form" novalidate="novalidate" method="post">
												@csrf
												<input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : '' }}">
												<div class="row">
													
													
													<div class="col-lg-4">
														<div class="form-group">
															<label>User Type <span class="text-danger">*</span></label>
															<select class="form-control js-example-basic-single" id="user_type" name="user_type" required>
																<option value="">Select</option>
																@foreach($userTypes as $type)
																	<option value="{{$type->id}}" {{ isset($singleData['user_type']) && $singleData['user_type'] == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
																	@endforeach
															</select>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label>First Name <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo isset($singleData['first_name']) ? $singleData['first_name'] : ''?>" required>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label>Last Name <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo isset($singleData['last_name']) ? $singleData['last_name'] : ''?>" required>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label>Mobile Number <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="mobile_no" id="mobile_no" minlength="10" maxlength="10" value="<?php echo isset($singleData['mobile_no']) ? $singleData['mobile_no'] : ''?>" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label>Email Id <span class="text-danger">*</span></label>
															<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($singleData['email']) ? $singleData['email'] : ''?>" required>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label>Gender <span class="text-danger">*</span></label>
															<select class="form-control js-example-basic-single" name="gender" id="gender" required>
																<option value="">Select</option>
																<option value="1" <?php echo isset($singleData['gender']) && $singleData['gender'] == '1' ? 'selected' : ''?>>Male</option>
																<option value="2" <?php echo isset($singleData['gender']) && $singleData['gender'] == '2' ? 'selected' : ''?>>Female</option>
															</select>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label>Status</label>
															<select class="form-control js-example-basic-single" id="status" name="status">
																<option value="0" <?php echo isset($singleData['status']) && $singleData['status'] == '0' ? 'selected' : ''?>>Active</option>
																<option value="1" <?php echo isset($singleData['status']) && $singleData['status'] == '1' ? 'selected' : ''?>>In-Active</option>
															</select>
														</div>
													</div>
												</div>
												<hr>
												<div class="form-group">
													<div>
														<button type="submit" id="submitbutton" class="btn btn-success waves-effect waves-light">Submit</button>
														<!-- <button class="btn btn-success" type="button"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button> -->
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
<script type="text/javascript">
	$(document).ready(function () {
        $("#user_form").validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            errorElement: "div",
            rules: {
                company_id: "required",
                user_type: "required",
                first_name: {
					required: true,
					minlength: 3
				},
				last_name: {
					required: true,
					minlength: 3
				},
               mobile_no: {
				  required: true,
				  number: true,
				  minlength: 10,
				  maxlength: 10
				},
				email: {
				  required: true,
				  email: true
				},
				gender: "required",
            },
            messages: {
                company_id: "Please select company",
                user_type: "Please select user type",
                first_name: "Please enter first name",
                last_name: "Please enter last name",
                mobile_no: "Please enter mobile number",
                email: "Please enter email id",
                gender: "Please select gender",
            },
            submitHandler: function (form) {
                queryString = $('#user_form').serialize();
                $.post('<?php echo url("users/save")?>', queryString, function (data) {
                    commonStatusMessage(data, '<?php echo url("users")?>');
                }, "json");
                return false;
            },
            errorPlacement: function (error, element) {
                showError(error, element);
            }
        });

        $("#submitbutton").click(function () {
            $("#user_form").submit();
            return false;
        });
    });
</script>							
@endsection