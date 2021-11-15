@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="row align-items-center">
											<div class="col-md-8">
												<h4 class="page-title m-0">Change Password</h4>
											</div>
											<div class="col-md-4">
												<div class="float-right d-none d-md-block">
													<div class="dropdown">
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
											<h4 class="mt-0 header-title">Change Password</h4>
											<hr>
											<form class="" name="user_form" id="user_form" novalidate="novalidate" method="post">
												@csrf
												<input type="hidden" id="id" name="id" value="{{isset($singleData['id']) ? $singleData['id'] : '' }}">
												<div class="row">
													<div class="col-lg-4">
														<div class="form-group">
															<label>Current Password <span class="text-danger">*</span></label>
															<input type="password" class="form-control" name="current_password" id="current_password"  required>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label>New Password <span class="text-danger">*</span></label>
															<input type="password" class="form-control" name="new_password" id="new_password"  required>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label>Verify Password <span class="text-danger">*</span></label>
															<input type="password" class="form-control" name="new_confirm_password" id="new_confirm_password"  required>
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
                current_password: "required",
                new_password: "required",
                new_confirm_password: "required",
            },
            messages: {
                current_password: "Please enter current password",
                new_password: "Please enter new password",
                new_confirm_password: "Please enter confirm password",
            },
            submitHandler: function (form) {
                queryString = $('#user_form').serialize();
                $.post('<?php echo url("users/pasword-update")?>', queryString, function (data) {
                    commonStatusMessage(data, '<?php echo url("login")?>');
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