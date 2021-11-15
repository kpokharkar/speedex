@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8"><h4 class="page-title m-0">Add Quotation</h4></div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a class="btn btn-outline-primary waves-effect waves-light" href="<?php echo url('quotation')?>" title="Back To Quotation Lists"><i class="fas fa-arrow-left ml-1 mr-2"></i> Back To Quotation Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <form class="" id="quotation_form" novalidate="novalidate" method="post">
                    @csrf
                    <input hidden type="text" id="id" name="id" value="{{isset($getSingleData['id']) ? $getSingleData['id'] : ''}}">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Quotation Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <?php
                                if(isset($getSingleData['company_id']) && $getSingleData['company_id']!='') {
                                    $disabled = 'disabled';
                                }
                                else {
                                    $disabled = '';
                                }
                            ?>
                            <label class="col-sm-2 col-form-label">Select Company <span class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <select id="company_id" name="company_id" class="form-control" <?php echo $disabled?> required="">
                                    <option value="">Select Company</option>
                                    <?php foreach($getCompanyDetails as $company) { ?>
                                    <option value="<?php echo $company->id?>"  {{ isset($getSingleData['company_id']) && $getSingleData['company_id'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Select Mode <span class="text-danger">*</span></label>
                            <div class="col-lg-4">
                                <select id="mode_id" name="mode_id" class="form-control" onclick="mode_on()" <?php echo $disabled?> required="">
                                    <option value="">Select Mode</option>
                                    <option value="Self_Network" {{ isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Self_Network' ? 'selected' : ''}}>Self Network</option>
                                    <option value="Surface_Mode" {{ isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Surface_Mode' ? 'selected' : ''}}>Surface Mode</option>
                                    <option value="Courier_Mode" {{ isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Courier_Mode' ? 'selected' : ''}}>Courier Mode</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <?php
                            if(isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Self_Network') {
                                $displayMode ='display:block';
                                $self_networks = 'Self_Network';
                            }
                            else {
                                $displayMode ='display:none';
                                $self_networks = '';
                            }
                        ?>
                        <div id="self_network" style="<?php echo $displayMode?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-center">Self Network</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <input hidden type="text"  name="mode_self" id="mode_self" value="{{$self_networks}}"/>
                                            <tr>
                                                <th class="trthmain" colspan="2">BY CARGO SERVICES 48 Hrs. ( Excluding Pickup Day)  *</th>
                                            </tr>
                                            <tr>
                                                <td>MAHARASTRA/GUJRAT/GOA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_1" name="column_value_1" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_1) ? $getSelfNetworks->column_value_1 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>DELHI/BANGALORE/HYDERABAD/CHENNAI</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_2" name="column_value_2" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_2) ? $getSelfNetworks->column_value_2 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>REST OF INDIA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_3" name="column_value_3" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_3) ? $getSelfNetworks->column_value_3 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>SPECIAL LOCATION - EAST NORTH EAST - J &  K - KERALA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_4" name="column_value_4" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_4) ? $getSelfNetworks->column_value_4 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="2">BY SFC SERVICES  *</th>
                                            </tr>
                                            <tr>
                                                <td>MAHARASTRA/GUJRAT/GOA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_5" name="column_value_5" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_5) ? $getSelfNetworks->column_value_5 : ''}}"required /></td>
                                            </tr>
                                            <tr>
                                                <td>DELHI/BANGALORE/HYDERABAD/CHENNAI</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_6" name="column_value_6" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_6) ? $getSelfNetworks->column_value_6 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>REST OF INDIA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_7" name="column_value_7" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_7) ? $getSelfNetworks->column_value_7 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>SPECIAL LOCATION - EAST NORTH EAST - J &  K - KERALA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_8" name="column_value_8" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_8) ? $getSelfNetworks->column_value_8 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="2">BY AIR SERVICES NEXT DAY</th>
                                            </tr>
                                            <tr>
                                                <td>MAHARASTRA/GUJRAT/GOA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_9" name="column_value_9"  class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_9) ? $getSelfNetworks->column_value_9 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>DELHI/BANGALORE/HYDERABAD/CHENNAI</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_10" name="column_value_10"  class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_10) ? $getSelfNetworks->column_value_10 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>REST OF INDIA *</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_11" name="column_value_11"  class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_11) ? $getSelfNetworks->column_value_11 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <td>SPECIAL LOCATION - EAST NORTH EAST - J &  K - KERALA</td>
                                                <td>Per Kg. Rs. <input type="text" id="column_value_12" name="column_value_12" class="form-control width-auto" value="{{isset($getSelfNetworks->column_value_12) ? $getSelfNetworks->column_value_12 : ''}}" required /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="2">ASK FOR FAST TRACK SERVICES</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Surface_Mode') {
                                $displayMode ='display:block';
                                $mode_surface = 'Surface_Mode';
                            }
                            else {
                                $displayMode ='display:none';
                                $mode_surface = '';
                            }
                        ?>
                        <div id="surface_mode" style="<?php echo $displayMode;?>">
                            <input hidden type="text" id="mode_surface" name="mode_surface" value="<?php echo $mode_surface?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-center">Surface Mode</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <th class="trthmain">Weight Slab</th>
                                                <th>Maharashtra</th>
                                                <th>DEL-BLR-MGRO-CHEN</th>
                                                <th>Rest of India</th>
                                                <th>EASO / (North East)</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="5">AIR MODE</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">By Air Per Kg.<br>(Mini Chg. 5 Kg.)</th>
                                                <td><input type="text" id="s_column_value_1" name="s_column_value_1" class="form-control width-auto" value="{{isset($getSurfaceMode->s_column_value_1) ? $getSurfaceMode->s_column_value_1 : ''}}" required /></td>
                                                <td><input type="text" id="s_column_value_2" name="s_column_value_2" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_2) ? $getSurfaceMode->s_column_value_2 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_3" name="s_column_value_3" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_3) ? $getSurfaceMode->s_column_value_3 : ''}}"/></td>
                                                <td><input type="text" id="s_column_value_4" name="s_column_value_4" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_4) ? $getSurfaceMode->s_column_value_4 : ''}}" /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="5">CARGO MODE</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Per KG.</th>
                                                <td><input type="text" id="s_column_value_5" name="s_column_value_5" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_5) ? $getSurfaceMode->s_column_value_5 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_6" name="s_column_value_6" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_6) ? $getSurfaceMode->s_column_value_6 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_7" name="s_column_value_7" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_7) ? $getSurfaceMode->s_column_value_7 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_8" name="s_column_value_8" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_8) ? $getSurfaceMode->s_column_value_8 : ''}}" /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="5">SURFACE MODE</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">By Surface Per Kg.<br>(Min Charge. Wt. 5 Kg.)</th>
                                                <td><input type="text" id="s_column_value_9" name="s_column_value_9" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_9) ? $getSurfaceMode->s_column_value_9 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_10" name="s_column_value_10" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_10) ? $getSurfaceMode->s_column_value_10 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_11" name="s_column_value_11" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_11) ? $getSurfaceMode->s_column_value_11 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_12" name="s_column_value_12" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_12) ? $getSurfaceMode->s_column_value_12 : ''}}" /></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="6">Fast Track - Non Dox - Minimum 5 KG</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain"></th>
                                                <td><input type="text" id="s_column_value_13" name="s_column_value_13" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_13) ? $getSurfaceMode->s_column_value_13 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_14" name="s_column_value_14" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_14) ? $getSurfaceMode->s_column_value_14 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_15" name="s_column_value_15" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_15) ? $getSurfaceMode->s_column_value_15 : ''}}" /></td>
                                                <td><input type="text" id="s_column_value_16" name="s_column_value_16" class="form-control width-auto" required value="{{isset($getSurfaceMode->s_column_value_16) ? $getSurfaceMode->s_column_value_16 : ''}}" /></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($getSingleData['quotation_type']) && $getSingleData['quotation_type'] == 'Courier_Mode') {
                                $displayMode ='display:block';
                            }
                            else {
                                $displayMode ='display:none';
                            }
                        ?>
                        <div id="courier_mode" style="<?php echo $displayMode?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-center">Courier Mode</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <th class="trthmain">Weight Slab</th>
                                                <th>Local</th>
                                                <th>Within State</th>
                                                <th>Zone</th>
                                                <th>Metro</th>
                                                <th>Rest of India</th>
                                                <th>Special Location, North East, J & K, Kerla</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="7">Standard - Dox - Air Mode Rate For Documents & Samples Up To 3kg.</th>
                                            </tr>
                                            <tr>
                                                <?php
                                                    if($getQuotationDetails) {
                                                        foreach($getQuotationDetails as $details) {
                                                            $mode_courier='Courier_Mode';
                                                            $weight_slab = $details->weight_slab;
                                                            if($weight_slab == 'Up to 100 Gms') {
                                                                $local_100 = $details->local;
                                                                $within_state_100 = $details->within_state;
                                                                $zone_100 = $details->zone;
                                                                $metro_100 = $details->metro;
                                                                $rest_of_india_100 = $details->rest_of_india;
                                                                $special_location_100 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Up to 250 Gms') {
                                                                $local_250 = $details->local;
                                                                $within_state_250 = $details->within_state;
                                                                $zone_250 = $details->zone;
                                                                $metro_250 = $details->metro;
                                                                $rest_of_india_250 = $details->rest_of_india;
                                                                $special_location_250 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Up to 500 Gms') {
                                                                $local_500 = $details->local;
                                                                $within_state_500 = $details->within_state;
                                                                $zone_500 = $details->zone;
                                                                $metro_500 = $details->metro;
                                                                $rest_of_india_500 = $details->rest_of_india;
                                                                $special_location_500 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Addl 500 Gms') {
                                                                $local_add_500 = $details->local;
                                                                $within_state_add_500 = $details->within_state;
                                                                $zone_add_500 = $details->zone;
                                                                $metro_add_500 = $details->metro;
                                                                $rest_of_india_add_500 = $details->rest_of_india;
                                                                $special_location_add_500 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Standard Dox Per Kg') {
                                                                $local_per_kg_1 = $details->local;
                                                                $within_state_per_kg_1 = $details->within_state;
                                                                $zone_per_kg_1 = $details->zone;
                                                                $metro_per_kg_1 = $details->metro;
                                                                $rest_of_india_per_kg_1 = $details->rest_of_india;
                                                                $special_location_per_kg_1 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Surface Per Kg') {
                                                                $local_surface = $details->local;
                                                                $within_state_surface = $details->within_state;
                                                                $zone_surface = $details->zone;
                                                                $metro_surface = $details->metro;
                                                                $rest_of_india_surface = $details->rest_of_india;
                                                                $special_location_surface = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Air Per Kg') {
                                                                $local_air = $details->local;
                                                                $within_state_air = $details->within_state;
                                                                $zone_air = $details->zone;
                                                                $metro_air = $details->metro;
                                                                $rest_of_india_air = $details->rest_of_india;
                                                                $special_location_air = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Standard Non Dox Per Kg') {
                                                                $local_per_kg_2 = $details->local;
                                                                $within_state_per_kg_2 = $details->within_state;
                                                                $zone_per_kg_2 = $details->zone;
                                                                $metro_per_kg_2 = $details->metro;
                                                                $rest_of_india_per_kg_2 = $details->rest_of_india;
                                                                $special_location_per_kg_2 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Fast Track Doc 500 Gms') {
                                                                $local_fast_doc_air = $details->local;
                                                                $within_state_fast_doc_air = $details->within_state;
                                                                $zone_fast_doc_air = $details->zone;
                                                                $metro_fast_doc_air = $details->metro;
                                                                $rest_of_india_fast_doc_air = $details->rest_of_india;
                                                                $special_location_fast_doc_air = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Addl Fast Track Doc 500 Gms') {
                                                                $local_Addl_fast_doc_air = $details->local;
                                                                $within_Addl_state_fast_doc_air = $details->within_state;
                                                                $zone_Addl_fast_doc_air = $details->zone;
                                                                $metro_Addl_fast_doc_air = $details->metro;
                                                                $rest_of_india_Addl_fast_doc_air = $details->rest_of_india;
                                                                $special_location_Addl_fast_doc_air = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Express Per Kg') {
                                                                $local_per_kg_3 = $details->local;
                                                                $within_state_per_kg_3 = $details->within_state;
                                                                $zone_per_kg_3 = $details->zone;
                                                                $metro_per_kg_3 = $details->metro;
                                                                $rest_of_india_per_kg_3 = $details->rest_of_india;
                                                                $special_location_per_kg_3 = $details->special_location;
                                                            }
                                                            if($weight_slab == 'Fast Track Non Doc 500 Gms') {
                                                                $local_fast_nondoc_air = $details->local;
                                                                $within_state_fast_nondoc_air = $details->within_state;
                                                                $zone_fast_nondoc_air = $details->zone;
                                                                $metro_fast_nondoc_air = $details->metro;
                                                                $rest_of_india_fast_nondoc_air = $details->rest_of_india;
                                                                $special_location_fast_nondoc_air = $details->special_location;
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <th class="trthmain">Up to 100 Gms.</th>
                                                <td>
                                                    <input hidden type="text" name="mode_courier" id="mode_courier" value="{{isset($mode_courier) ? $mode_courier : ''}}">
                                                    <input hidden type="text" id="weight_slab_100" name="weight_slab_100" value="Up to 100 Gms" />
                                                    <input type="text" id="local_100" name="local_100" class="form-control width-auto" required  value="{{isset($local_100) ? $local_100 : ''}}"/>
                                                </td>
                                                <td><input type="text" id="within_state_100" name="within_state_100" value="{{isset($within_state_100) ? $within_state_100 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_100" name="zone_100" value="{{isset($zone_100) ? $zone_100 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_100" name="metro_100" value="{{isset($metro_100) ? $metro_100 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_100" name="rest_of_india_100" value="{{isset($rest_of_india_100) ? $rest_of_india_100 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_100" name="special_location_100" value="{{isset($special_location_100) ? $special_location_100 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Up to 250 Gms.</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_250" name="weight_slab_250" value="Up to 250 Gms" />
                                                    <input type="text" id="local_250" name="local_250" class="form-control width-auto" value="{{isset($local_500) ? $local_500 : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_250" name="within_state_250" value="{{isset($within_state_100) ? $within_state_250 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_250" name="zone_250" class="form-control width-auto" value="{{isset($zone_250) ? $zone_250 : ''}}" required/></td>
                                                <td><input type="text" id="metro_250" name="metro_250" class="form-control width-auto" value="{{isset($metro_250) ? $metro_250 : ''}}" required/></td>
                                                <td><input type="text" id="rest_of_india_250" name="rest_of_india_250" value="{{isset($rest_of_india_250) ? $rest_of_india_250 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_250" name="special_location_250" value="{{isset($special_location_250) ? $special_location_250 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Up to 500 Gms.</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_500" name="weight_slab_500" value="Up to 500 Gms" />
                                                    <input type="text" id="local_500" name="local_500" class="form-control width-auto" value="{{isset($local_500) ? $local_500 : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_500" name="within_state_500" value="{{isset($within_state_500) ? $within_state_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_500" name="zone_500" class="form-control width-auto" value="{{isset($zone_500) ? $zone_500 : ''}}" required/></td>
                                                <td><input type="text" id="metro_500" name="metro_500" class="form-control width-auto" value="{{isset($metro_500) ? $metro_500 : ''}}" required/></td>
                                                <td><input type="text" id="rest_of_india_500" name="rest_of_india_500" value="{{isset($rest_of_india_500) ? $rest_of_india_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_500" name="special_location_500" value="{{isset($special_location_500) ? $special_location_500 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Addl. 500 Gms.</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_add_500" name="weight_slab_add_500" value="Addl 500 Gms" />
                                                    <input type="text" id="local_add_500" name="local_add_500" value="{{isset($local_add_500) ? $local_add_500 : ''}}" class="form-control width-auto" required/>
                                                </td>
                                                <td><input type="text" id="within_state_add_500" name="within_state_add_500" value="{{isset($within_state_add_500) ? $within_state_add_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_add_500" name="zone_add_500" value="{{isset($zone_add_500) ? $zone_add_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_add_500" name="metro_add_500" value="{{isset($metro_add_500) ? $metro_add_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_add_500" name="rest_of_india_add_500" value="{{isset($rest_of_india_add_500) ? $rest_of_india_add_500 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_add_500" name="special_location_add_500" value="{{isset($special_location_add_500) ? $special_location_add_500 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Per Kg</th>
                                                <td>
                                                    <input hidden type="text" id="standard_dox_per_kg" name="standard_dox_per_kg" value="Standard Dox Per Kg" />
                                                    <input type="text" id="local_per_kg_1" name="local_per_kg_1" class="form-control width-auto" value="{{isset($local_per_kg_1) ? $local_per_kg_1 : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_per_kg_1" name="within_state_per_kg_1" value="{{isset($within_state_per_kg_1) ? $within_state_per_kg_1 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_per_kg_1" name="zone_per_kg_1" value="{{isset($zone_per_kg_1) ? $zone_per_kg_1 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_per_kg_1" name="metro_per_kg_1" value="{{isset($metro_per_kg_1) ? $metro_per_kg_1 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_per_kg_1" name="rest_of_india_per_kg_1" value="{{isset($rest_of_india_per_kg_1) ? $rest_of_india_per_kg_1 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_per_kg_1" name="special_location_per_kg_1" value="{{isset($special_location_per_kg_1) ? $special_location_per_kg_1 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="7">Staandard - Non Dox rate above 3kg.</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">By Surface Per Kg.<br>(Min Charge. Wt. 5 Kg.)</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_surface" name="weight_slab_surface" value="Surface Per Kg" />
                                                    <input type="text" id="local_surface" name="local_surface" value="{{isset($local_surface) ? $local_surface : ''}}" class="form-control width-auto" required/>
                                                </td>
                                                <td><input type="text" id="within_state_surface" name="within_state_surface" value="{{isset($within_state_surface) ? $within_state_surface : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_surface" name="zone_surface" class="form-control width-auto" value="{{isset($zone_surface) ? $zone_surface : ''}}" required/></td>
                                                <td><input type="text" id="metro_surface" name="metro_surface" class="form-control width-auto" value="{{isset($metro_surface) ? $metro_surface : ''}}" required/></td>
                                                <td><input type="text" id="rest_of_india_surface" name="rest_of_india_surface" value="{{isset($rest_of_india_surface) ? $rest_of_india_surface : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_surface" name="special_location_surface" value="{{isset($special_location_surface) ? $special_location_surface : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">By Air Per Kg.<br>(Mini Chg. 3 Kg.)</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_air" name="weight_slab_air" value="Air Per Kg" />
                                                    <input type="text" id="local_air" name="local_air" value="{{isset($local_air) ? $local_air : ''}}" class="form-control width-auto" required/>
                                                </td>
                                                <td><input type="text" id="within_state_air" name="within_state_air" value="{{isset($within_state_air) ? $within_state_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_air" name="zone_air" class="form-control width-auto" value="{{isset($zone_air) ? $zone_air : ''}}" required/></td>
                                                <td><input type="text" id="metro_air" name="metro_air" class="form-control width-auto" value="{{isset($metro_air) ? $metro_air : ''}}" required/></td>
                                                <td><input type="text" id="rest_of_india_air" name="rest_of_india_air" value="{{isset($rest_of_india_air) ? $rest_of_india_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_air" name="special_location_air" value="{{isset($special_location_air) ? $special_location_air : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Per Kg</th>
                                                <td>
                                                    <input hidden type="text" id="standard_non_dox_per_kg" name="standard_non_dox_per_kg" value="Standard Non Dox Per Kg" />
                                                    <input type="text" id="local_per_kg_2" name="local_per_kg_2" class="form-control width-auto" value="{{isset($local_per_kg_2) ? $local_per_kg_2 : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_per_kg_2" name="within_state_per_kg_2" value="{{isset($within_state_per_kg_2) ? $within_state_per_kg_2 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_per_kg_2" name="zone_per_kg_2" value="{{isset($zone_per_kg_2) ? $zone_per_kg_2 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_per_kg_2" name="metro_per_kg_2" value="{{isset($metro_per_kg_2) ? $metro_per_kg_2 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_per_kg_2" name="rest_of_india_per_kg_2" value="{{isset($rest_of_india_per_kg_2) ? $rest_of_india_per_kg_2 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_per_kg_2" name="special_location_per_kg_2" value="{{isset($special_location_per_kg_2) ? $special_location_per_kg_2 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="7">Express Next Day Non Dox - Air Mode</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Up To. 500 Gms.</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_fast_doc_500_air" name="weight_slab_fast_doc_500_air" value="Fast Track Doc 500 Gms" />
                                                    <input type="text" id="local_fast_doc_air" name="local_fast_doc_air" value="{{isset($local_fast_doc_air) ? $local_fast_doc_air : ''}}" class="form-control width-auto" required/>
                                                </td>
                                                <td><input type="text" id="within_state_fast_doc_air" name="within_state_fast_doc_air" value="{{isset($within_state_fast_doc_air) ? $within_state_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_fast_doc_air" name="zone_fast_doc_air" class="form-control width-auto" value="{{isset($zone_fast_doc_air) ? $zone_fast_doc_air : ''}}" required/></td>
                                                <td><input type="text" id="metro_fast_doc_air" name="metro_fast_doc_air" class="form-control width-auto" value="{{isset($metro_fast_doc_air) ? $metro_fast_doc_air : ''}}" required/></td>
                                                <td><input type="text" id="rest_of_india_fast_doc_air" name="rest_of_india_fast_doc_air" value="{{isset($rest_of_india_fast_doc_air) ? $rest_of_india_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_fast_doc_air" name="special_location_fast_doc_air" value="{{isset($special_location_fast_doc_air) ? $special_location_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Addl. 500 Gms and additional part there of</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_fast_doc_air" name="weight_slab_fast_doc_air" value="Addl Fast Track Doc 500 Gms" />
                                                    <input type="text" id="local_Addl_fast_doc_air" name="local_Addl_fast_doc_air" value="{{isset($local_fast_nondoc_air) ? $local_fast_nondoc_air : ''}}" class="form-control width-auto" required/>
                                                </td>
                                                <td><input type="text" id="within_state_Addl_fast_doc_air" name="within_Addl_state_fast_doc_air" value="{{isset($within_Addl_state_fast_doc_air) ? $within_Addl_state_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_Addl_fast_doc_air" name="zone_Addl_fast_doc_air" value="{{isset($zone_Addl_fast_doc_air) ? $zone_Addl_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_Addl_fast_doc_air" name="metro_Addl_fast_doc_air" value="{{isset($metro_Addl_fast_doc_air) ? $metro_Addl_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_Addl_fast_doc_air" name="rest_of_india_Addl_fast_doc_air" value="{{isset($rest_of_india_Addl_fast_doc_air) ? $rest_of_india_Addl_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_Addl_fast_doc_air" name="special_location_Addl_fast_doc_air" value="{{isset($special_location_Addl_fast_doc_air) ? $special_location_Addl_fast_doc_air : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Per Kg</th>
                                                <td>
                                                    <input hidden type="text" id="express_per_kg" name="express_per_kg" value="Express Per Kg" />
                                                    <input type="text" id="local_per_kg_3" name="local_per_kg_3" class="form-control width-auto" value="{{isset($local_per_kg_3) ? $local_per_kg_3 : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_per_kg_3" name="within_state_per_kg_3" value="{{isset($within_state_per_kg_3) ? $within_state_per_kg_3 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_per_kg_3" name="zone_per_kg_3" value="{{isset($zone_per_kg_3) ? $zone_per_kg_3 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_per_kg_3" name="metro_per_kg_3" value="{{isset($metro_per_kg_3) ? $metro_per_kg_3 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_per_kg_3" name="rest_of_india_per_kg_3" value="{{isset($rest_of_india_per_kg_3) ? $rest_of_india_per_kg_3 : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_per_kg_3" name="special_location_per_kg_3" value="{{isset($special_location_per_kg_3) ? $special_location_per_kg_3 : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <th class="trthmain" colspan="7">Fast Track - Non Dox</th>
                                            </tr>
                                            <tr>
                                                <th class="trthmain">Per Kg</th>
                                                <td>
                                                    <input hidden type="text" id="weight_slab_nondoc_air" name="weight_slab_nondoc_air" value="Fast Track Non Doc 500 Gms" />
                                                    <input type="text" id="local_fast_nondoc_air" name="local_fast_nondoc_air" class="form-control width-auto" value="{{isset($local_fast_nondoc_air) ? $local_fast_nondoc_air : ''}}" required/>
                                                </td>
                                                <td><input type="text" id="within_state_fast_nondoc_air" name="within_state_fast_nondoc_air" value="{{isset($within_state_fast_nondoc_air) ? $within_state_fast_nondoc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="zone_fast_nondoc_air" name="zone_fast_nondoc_air" value="{{isset($zone_fast_nondoc_air) ? $zone_fast_nondoc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="metro_fast_nondoc_air" name="metro_fast_nondoc_air" value="{{isset($metro_fast_nondoc_air) ? $metro_fast_nondoc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="rest_of_india_fast_nondoc_air" name="rest_of_india_fast_nondoc_air" value="{{isset($rest_of_india_fast_nondoc_air) ? $rest_of_india_fast_nondoc_air : ''}}" class="form-control width-auto" required/></td>
                                                <td><input type="text" id="special_location_fast_nondoc_air" name="special_location_fast_nondoc_air" value="{{isset($special_location_fast_nondoc_air) ? $special_location_fast_nondoc_air : ''}}" class="form-control width-auto" required/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    FAST TRACK Non. Dox segment to be used for Credit Card, Laptop, Mobile Phone, Semi Liquid Contents, Tenders, Passports, Visa Papers, Air/Railway Tickets and Original Papers. Assured Next Working Day Delivery with SMS Confirmation.<br>
                                                    <b>Within State:</b> &nbsp;&nbsp;&nbsp; Maharashtra State<br>
                                                    <b>Metro:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Chennai, Bangalore, Hyderabad, Delhi<br>
                                                    <b>Zone:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gujarat, M. P., Goa<br>
                                                    <b>Rest of India:</b> &nbsp;&nbsp; All other destination<br>
                                                    <h6 class="text-center">“Quality Service is Our Motto”</h6>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">
                                    <span class="d-md-block d-block"><i class="mdi mdi-face-profile h5"></i> Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#terms_conditions" role="tab">
                                    <span class="d-md-block d-block"><i class="mdi mdi-format-list-numbered h5"></i> Terms& Conditions</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="profile" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-center"><u>Kind. Attn. Mr.</u></p>
                                        <p>DEAR SIR / MADAM,</p>
                                        <p>We would like to propose <b>SPEEDEX FAST CARGO</b> as Multibrand Courier Mall for all of your requirements related to dispatch of <b>DOCUMENT</b>&<b>SAMPLE</b> and <b>CARGO</b> Consignments <b>WORLDWIDE</b>.</p>
                                        <p>We strive for growth while benefit you with COMFORT of SINGAL AGENCY handling and SAVINGS in cost for you as we have volume discount rates of all the leading service providers. This enables us to offer you to choose the SERVICE BRAND of your choice at much discounted rates in case you & your Supplier/Buyer insist to use any particular brand of service and still you can track & trace all of your Consignment on <b>www.speedexfastcargo.com SPEEDEX</b> is your ONE-STOP total transportation services provider which is uniquely designed with speed flexibility, Responsiveness and economy as our highest priority. Whatever you need to transport, whenever, wherever, however it needs to get there on time and in budget. <b>SPEEDEX</b> teamwork /technology, and industry EXPERIENCE combine to make the Seemingly impossible an everyday achievement by making sure that your Documents, Parcels and Fright are delivered safely and on time every- time using our intergraded network. <b>SPEEDEX</b> provides the best value of your money spend on COURIERS CARGO & LOGISTICS with the help of its committed, experienced and Professional workforce. </p>
                                        <p>Today we are providing our services to corporate, Traders, Household and students with the tailor - made solution for their need of sending Documents, samples Parcels, Export Consignments and Emotion Filled Gifts to loved ones all over the world. TO fulfill the Herculean task of balancing the cost, speed, safety, Reliability and Traceability as per different priority of sender and receiver, our team possible alternative service to you, <b>SPEEDEX</b> is having its own Network and Associates to delivers yours Consignments, but to fulfill your requirements we at <b>SPEEDEX</b> don’t hesitate to offer the services of our competitors as well at Much discounted rates we have highly discounted rates of all the major EXPRESS companies.</p>
                                        <p>
                                            <b><u>OUR SERVICE</u></b><br>
                                            <b>
                                            ► COURIER :- Documents & Samples.<br>
                                            ► CARGO :- Commercial and Non Commercial.<br>
                                            ► MODE :- Air, Cargo, Train, Road.<br>
                                            ► SERVICE OFFERED THROUGHT<br>
                                            ► SPEEDEX FAST CARGO<br>
                                            ► SHREE MARUTI, BLUE DART,<br>
                                            ►SPOTON, & DELHIVERY
                                            </b>
                                        </p>
                                        <p>
                                            <b>Our Valuable Customers.</b><br>
                                            ► Anglo Eastern Ship Management.<br>
                                            ► Wartsila India Pvt. Ltd.<br>
                                            ► Talwalkar’s Better Value Fitness.<br>
                                            ► Capricorn Logistics.<br>
                                            ► Nuk Healthcare<br>
                                            ► Balaji Healthcare<br>
                                            ► Bright Elevators Technologies<br>
                                            …….And many more……….
                                        </p>
                                        <p>For your ready reference our SPECIAL rates are enclosed…<br>Thanking in anticipation with regards</p>
                                        <p><b>For, SPEEDEX FAST CARGO</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="terms_conditions" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                            if(isset($getSingleData['surface_multi']) && $getSingleData['surface_multi']!='') {
                                                $display_nr ='display:revert';
                                            }
                                            else {
                                                $display_nr = 'display:none';
                                            }
                                        ?>
                                        <ol>
                                            <li class="m-b-10">GST @ 18% Will be applicable on net amount.</li>
                                            <li class="m-b-10">Bill shall be submitted on a 15days basis payable within 7days from its submission.</li>
                                            <li class="m-b-10"><input type="text" id="charges1" name="charges1" value="{{isset($getSingleData['charges1']) ? $getSingleData['charges1'] : ''}}"/> % Fuel surcharge applicable on above rates.</li>
                                            <li class="m-b-10">Minimum chargeable weight for Cargo / Sfc / Air will be charge 10kg.</li>
                                            <li class="m-b-10">Insurance: - A – Owner Risk 3% will be charged on invoice value, B – Carrier risk 0.05% or Rs. <input type="text" id="charges2" name="charges2" value="{{isset($getSingleData['charges2']) ? $getSingleData['charges2'] : ''}}"/> whichever is higher will be charged.</li>
                                            <li class="m-b-10">All delivery status will be provided online.</li>
                                            <li class="m-b-10">Bills not to be withheld on account of POD’s</li>
                                            <li class="m-b-10">All the payments shall be made in favor of <b>SPEEDEX FAST CARGO</b>.</li>
                                            <li class="m-b-10">Volumetric / Liquid / Packing / Diplomatic / such cases shall be charged extra as actual.
                                            <li class="m-b-10">All over size & Less weighted parcel will be forwarded through volumetric calculation (L * B * H / <input type="text" id="charges3" name="charges3" value="{{isset($getSingleData['charges3']) ? $getSingleData['charges3'] : ''}}" readonly /><span id="select_surface_mode" style="<?php echo $display_nr?>"> * <select id="surface_multi" name="surface_multi"><option value="" selected="true" disabled="disabled">Select</option><option value="7" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '7' ? 'selected' : ''}}>7</option><option value="8" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '8' ? 'selected' : ''}}>8</option><option value="9" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '9' ? 'selected' : ''}}>9</option></select></span>) vol. or actual weight whichever is higher will be calculated for billing.
                                            <li class="m-b-10"><b>SPEEDEX</b> Will not be responsible for any consignment held up by govt. authorities in absence of valid document not provided.
                                            <li class="m-b-10">ODA Location delivery charges will be extra as actual.
                                            <li class="m-b-10">Shipment non delivered / late delivery due to natural calamities / riots / bandh / airlines failures & etc. can’t be consider <b>SPEEDEX</b> failure.
                                            <li class="m-b-10">All RTO shipment will charged as per tariff.
                                            <li class="m-b-10">The rates given are for Mumbai to PAN INDIA.
                                            <li class="m-b-10">All revise pick up from any sector will be charged as per tariff given & minimum chargeable weight will be 50kg.
                                            <li class="m-b-10">All transshipment for Assam will be change in Air Only.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" id="submit" name="submit" class="btn btn-success">
                        <button id="loading" class="btn btn-success" type="button" style="display:none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $( "#quotation_form" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
            },messages: {    
            },submitHandler: function(form) {
                queryString = $('#quotation_form').serialize();
                // $("#submit").css("display", "none");
                // $("#loading").css("display", "block");
                // $("#loading").prop( "disabled", true );
                $.post("<?php echo url('/quotation/save')?>", queryString, function (data) {
                    commonStatusMessage(data, "<?php echo url('/quotation')?>");
                }, "JSON");
                return false;
            }
        })
    })
    
    function mode_on() {
        var mdoe = $('#mode_id').val();
        if (mdoe == 'Self_Network') {
			$('#self_network').show();
			$('#surface_mode').hide();
			$('#courier_mode').hide();
            $("#mode_self").val('Self_Network');
            $("#charges3").val('5000');
            $('#select_surface_mode').css("display", "none");
			
        }
        else if (mdoe == 'Surface_Mode') {
            $('#self_network').hide();
			$('#surface_mode').show();
			$('#courier_mode').hide();
            $("#mode_surface").val('Surface_Mode');
            $("#charges3").val('27000');
            $('#select_surface_mode').css("display", "revert");
        }
        else if (mdoe == 'Courier_Mode') {
            $('#self_network').hide();
			$('#surface_mode').hide();
			$('#courier_mode').show();
            $("#mode_courier").val('Courier_Mode');
            $("#charges3").val('5000');
            $('#select_surface_mode').css("display", "none");
        }
        else {
            $('#self_network').hide();
			$('#surface_mode').hide();
			$('#courier_mode').hide();
            $("#mode_self").val('');
            $("#mode_surface").val('');
            $("#mode_courier").val('');
            $("#charges3").val('');
            $('#select_surface_mode').css("display", "none");
        }
    }
    
    // Self Network Start
    $("#column_value_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_4").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_5").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_6").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_7").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_8").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_9").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_10").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_11").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#column_value_12").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    // Self Network End
    
    // Surface Mode Start
    $("#s_column_value_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_4").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_5").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_6").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_7").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_8").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_9").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_10").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_11").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_12").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_13").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_14").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_15").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#s_column_value_16").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    // Surface Mode End
    
    // Courier Mode Start
    $("#local_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_100").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_250").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_add_500").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_per_kg_1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_surface").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_per_kg_2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_Addl_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_Addl_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_Addl_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_Addl_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_Addl_fast_doc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_per_kg_3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#local_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#within_state_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#zone_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#metro_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#rest_of_india_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#special_location_fast_nondoc_air").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    // Courier Mode End
    
    $("#charges1").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#charges2").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
    $("#charges3").keypress(function (e) { if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) { return false; } });
</script>

@endsection