@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="row align-items-center">
											<div class="col-md-8">
												<h4 class="page-title m-0">Add New Role</h4>
											</div>
											<div class="col-md-4">
												<div class="float-right d-none d-md-block">
													<div class="dropdown">
														<a href="<?php echo url('roles')?>" class="btn btn-primary"><i class="ti-arrow-left mr-2"></i>Back to Role Lists</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" id="role_form" name="role_form" novalidate="novalidate">
								@csrf
							<div class="row">
								<div class="col-lg-6">
									<div class="card m-b-30">
										<div class="card-body">
											<h4 class="mt-0 header-title">New Role Form</h4>
											<hr>
											
											<input name="id" type="hidden" value="{{isset($singleData['id']) ? $singleData['id'] : ''}}"/>
												<div class="form-group">
													<label>Role Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="name" name="name" value="<?php echo isset($singleData['name']) ? $singleData['name'] : ''?>"required>
												</div>
												<div class="form-group">
													<label>Department <span class="text-danger">*</span></label>
													<select class="form-control js-example-basic-single" id="department_id" name="department_id" required>
														<option value="">-- Select --</option>
														@foreach($departments as $department)
														<option value="{{$department->id}}" {{ isset($singleData['department_id']) && $singleData['department_id'] == $department->id ? 'selected' : ''}}>{{$department->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Role Status</label>
													<select class="form-control js-example-basic-single" id="status" name="status">
														<option value="">-- Select --</option>
														<option value="0" <?php echo isset($singleData['status']) && $singleData['status'] == '0' ? 'selected' : ''?>>Active</option>
														<option value="1" <?php echo isset($singleData['flag']) && $singleData['status'] == '0' ? 'selected' : ''?>>In-Active</option>
													</select>
												</div>
												<hr>
												<div class="form-group">
													<div>
														<button type="submit" id="submitbutton" class="btn btn-success waves-effect waves-light">Submit</button>
														<!-- <button class="btn btn-success" type="button"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button> -->
													</div>
												</div>
											
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="card m-b-30">
										<div class="card-body">
											<h4 class="mt-0 header-title">Role Access</h4>
											<hr>
											<div>
                                                <div id="MyTree" class="tree tree-plus-minus">
                                                    <ul id="MyTree">
                                                        <?php 
			                                            	$k=0;
											    			foreach($menus as $menu){ ?>
                                                        <li id="main_menu_val<?php echo $k; ?>" class="m-b-10">
                                                            <span class="caretn main_chek_all" id="main_chek_all<?php echo $k; ?>"><?php echo $menu['module_name']; ?></span>
                                                            <ul class="nestedn">
                                                            	<?php
		                                                         foreach($menu['subMenu'] as $key =>$sub) { 
		                                                        ?>
                                                                <li>
                                                                	<div class="custom-control custom-checkbox cursorpointer">
                                                                		<input type="checkbox" id="menu_codes" name="menu_codes[]" class="custom-control-input<?php echo $key;?> <?php //echo $k;?>"  value="<?php echo $key; ?>">   <?php echo $sub['sub_module_name']; ?>
                                                                		<!-- <label class="custom-control-label line-height" for="menu_codes"><?php// echo $sub['sub_module_name']; ?></label> -->
																	</div>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </li>
                                                        <?php 
		                                                $k++;
		                                                } ?>
                                                    </ul>
                                                </div>
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</form>
				<script>

		$(document).ready(function () {
        $("#role_form").validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            errorElement: "div",
            rules: {
                name: "required",
                department_id: "required",
            },
            messages: {
                name: "Please enter role name",
                department_id: "Please select department",
            },
            submitHandler: function (form) {
                queryString = $('#role_form').serialize();
                $.post("<?php echo url('roles/save')?>", queryString, function (data) {
                    commonStatusMessage(data, '<?php echo url('roles')?>');
                }, "json");
                return false;
            },
            errorPlacement: function (error, element) {
                showError(error, element);
            }
        });

        $("#submitbutton").click(function () {
            $("#role_form").submit();
            return false;
        });
        });


		var toggler = document.getElementsByClassName("caretn");
        var i;
        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nestedn").classList.toggle("activen");
                this.classList.toggle("caretn-down");
            });
        }

        let getMenus =<?php echo json_encode($getMenus)?>;
        if(getMenus.length > 0) {
            $("#name").attr('readonly',true);
                var menus_codes = document.getElementsByName("menu_codes[]");
                for(let i=0;i<=menus_codes['length']-1;i++) {
                    let ids = '#'+menus_codes[i].id;
                    $(ids).removeAttr('Checked');
                }
                let y = getMenus;
                for(let i=0;i<y.length;i++) {
                	let menu_list = y[i]['sub_module_id'];
                	let split_value = menu_list.split(',');
                	for(let j=0;j<split_value.length;j++){
                		let get_all_manu = split_value[j];
                		let menu_value = '.custom-control-input'+get_all_manu;
                		$(menu_value).attr('checked',true);	
                	}
                } 
        }
</script>
@endsection