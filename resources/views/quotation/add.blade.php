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
                                <select id="company_id" name="company_id" class="form-control js-example-basic-single" <?php echo $disabled?> required="">
                                    <option value="" selected="true" disabled="disabled">-- Select --</option>
                                    <?php foreach($getCompanyDetails as $company) { ?>
                                    <option value="<?php echo $company->id?>"  {{ isset($getSingleData['company_id']) && $getSingleData['company_id'] == $company->id ? 'selected' : ''}}><?php echo $company->name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <span id="company_error"></span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th class="trthmain" colspan="2">BY CARGO SERVICE</th>
                                        </tr>
                                        <tr>
                                            <td>MAHARASTRA / GUJRAT / GOA</td>
                                            <td>Per Kg. Rs. <input type="text" id="column_1" name="column_1" class="form-control dispay-width width-auto" value="{{isset($getCargoService->column_1) ? $getCargoService->column_1 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>DELHI / BANGALORE / HYDERABAD / CHENNAI</td>
                                            <td>Per Kg. Rs. <input type="text" id="column_2" name="column_2" class="form-control dispay-width width-auto" value="{{isset($getCargoService->column_2) ? $getCargoService->column_2 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>REST OF INDIA</td>
                                            <td>Per Kg. Rs. <input type="text" id="column_3" name="column_3" class="form-control dispay-width width-auto" value="{{isset($getCargoService->column_3) ? $getCargoService->column_3 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>EAST (NORTH EAST)</td>
                                            <td>Per Kg. Rs. <input type="text" id="column_4" name="column_4" class="form-control dispay-width width-auto" value="{{isset($getCargoService->column_4) ? $getCargoService->column_4 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>J&K / HIMACHAL PRADESH / KERALA</td>
                                            <td>Per Kg. Rs. <input type="text" id="column_5" name="column_5" class="form-control dispay-width width-auto" value="{{isset($getCargoService->column_5) ? $getCargoService->column_5 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <th class="trthmain" colspan="2">BY SFC SERVICE *</th>
                                        </tr>
                                        <tr>
                                            <td>MAHARASTRA / GUJRAT / GOA</td>
                                            <td>Per Kg. Rs. <input type="text" id="s_column_1" name="s_column_1" class="form-control dispay-width width-auto" value="{{isset($getSfcService->s_column_1) ? $getSfcService->s_column_1 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>DELHI / BANGALORE / HYDERABAD / CHENNAI</td>
                                            <td>Per Kg. Rs. <input type="text" id="s_column_2" name="s_column_2" class="form-control dispay-width width-auto" value="{{isset($getSfcService->s_column_2) ? $getSfcService->s_column_2 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>REST OF INDIA</td>
                                            <td>Per Kg. Rs. <input type="text" id="s_column_3" name="s_column_3" class="form-control dispay-width width-auto" value="{{isset($getSfcService->s_column_3) ? $getSfcService->s_column_3 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>EAST (NORTH EAST)</td>
                                            <td>Per Kg. Rs. <input type="text" id="s_column_4" name="s_column_4" class="form-control dispay-width width-auto" value="{{isset($getSfcService->s_column_4) ? $getSfcService->s_column_4 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>J&K / HIMACHAL PRADESH / KERALA</td>
                                            <td>Per Kg. Rs. <input type="text" id="s_column_5" name="s_column_5" class="form-control dispay-width width-auto" value="{{isset($getSfcService->s_column_5) ? $getSfcService->s_column_5 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <th class="trthmain" colspan="2">BY AIR SERVICE *</th>
                                        </tr>
                                        <tr>
                                            <td>MAHARASTRA / GUJRAT / GOA</td>
                                            <td>Per Kg. Rs. <input type="text" id="a_column_1" name="a_column_1" class="form-control dispay-width width-auto" value="{{isset($getAirService->a_column_1) ? $getAirService->a_column_2 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>DELHI / BANGALORE / HYDERABAD / CHENNAI</td>
                                            <td>Per Kg. Rs. <input type="text" id="a_column_2" name="a_column_2" class="form-control dispay-width width-auto" value="{{isset($getAirService->a_column_2) ? $getAirService->a_column_2 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>REST OF INDIA</td>
                                            <td>Per Kg. Rs. <input type="text" id="a_column_3" name="a_column_3" class="form-control dispay-width width-auto" value="{{isset($getAirService->a_column_3) ? $getAirService->a_column_3 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>EAST (NORTH EAST)</td>
                                            <td>Per Kg. Rs. <input type="text" id="a_column_4" name="a_column_4" class="form-control dispay-width width-auto" value="{{isset($getAirService->a_column_4) ? $getAirService->a_column_4 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <td>J&K / HIMACHAL PRADESH / KERALA</td>
                                            <td>Per Kg. Rs. <input type="text" id="a_column_5" name="a_column_5" class="form-control dispay-width width-auto" value="{{isset($getAirService->a_column_5) ? $getAirService->a_column_5 : ''}}" required /></td>
                                        </tr>
                                    </table>
                                    <h5 class="text-center">COURIER MODE</h5>
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th class="trthmain">PER KG.</th>
                                            <th>LOCAL</th>
                                            <th>MAHARASTRA</th>
                                            <th>GUJRAT / GOA</th>
                                            <th>METRO</th>
                                            <th>REST OF INDIA</th>
                                            <th>EAST (NORTH EAST)</th>
                                            <th>J&K / HIMACHAL PRADESH / KERALA</th>
                                        </tr>
                                        <tr>
                                            <th class="trthmain">AIR</th>
                                            <td><input type="text" id="c_column_1" name="c_column_1" class="form-control width-auto" value="NA" disabled /></td>
                                            <td><input type="text" id="c_column_2" name="c_column_2" class="form-control width-auto" value="{{isset($getCourier->c_column_2) ? $getCourier->c_column_2 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_3" name="c_column_3" class="form-control width-auto" value="{{isset($getCourier->c_column_3) ? $getCourier->c_column_3 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_4" name="c_column_4" class="form-control width-auto" value="{{isset($getCourier->c_column_4) ? $getCourier->c_column_4 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_5" name="c_column_5" class="form-control width-auto" value="{{isset($getCourier->c_column_5) ? $getCourier->c_column_5 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_6" name="c_column_6" class="form-control width-auto" value="{{isset($getCourier->c_column_6) ? $getCourier->c_column_6 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_7" name="c_column_7" class="form-control width-auto" value="{{isset($getCourier->c_column_7) ? $getCourier->c_column_7 : ''}}" required /></td>
                                        </tr>
                                        <tr>
                                            <th class="trthmain">SFC</th>
                                            <td><input type="text" id="c_column_8" name="c_column_8" class="form-control width-auto" value="{{isset($getCourier->c_column_8) ? $getCourier->c_column_8 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_9" name="c_column_9" class="form-control width-auto" value="{{isset($getCourier->c_column_9) ? $getCourier->c_column_9 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_10" name="c_column_10" class="form-control width-auto" value="{{isset($getCourier->c_column_10) ? $getCourier->c_column_10 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_11" name="c_column_11" class="form-control width-auto" value="{{isset($getCourier->c_column_11) ? $getCourier->c_column_11 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_12" name="c_column_12" class="form-control width-auto" value="{{isset($getCourier->c_column_12) ? $getCourier->c_column_12 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_13" name="c_column_13" class="form-control width-auto" value="{{isset($getCourier->c_column_13) ? $getCourier->c_column_13 : ''}}" required /></td>
                                            <td><input type="text" id="c_column_14" name="c_column_14" class="form-control width-auto" value="{{isset($getCourier->c_column_14) ? $getCourier->c_column_14 : ''}}" required /></td>
                                        </tr>
                                    </table>
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
                                    <span class="d-md-block d-block"><i class="mdi mdi-format-list-numbered h5"></i> Terms & Conditions</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="profile" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>DEAR SIR / MADAM,</p>
                                        <p>We would like to propose <b>SPEEDEX FAST CARGO</b> as Multiband Courier Mall for all of your requirements related to dispatch of <b>DOCUMENT</b>&<b>SAMPLE</b> and <b>CARGO</b> Consignments <b>WORLDWIDE</b>.</p>
                                        <p>We strive for growth while benefit you with COMFORT of SINGAL AGENCY handling and SAVINGS in cost for you as we have volume discount rates of all the leading service providers. This enables us to offer you to choose the SERVICE BRAND of your choice at much discounted rates in case you & your Supplier/Buyer insist to use any particular brand of service and still you can track & trace all of your Consignment on <b>www.speedexfastcargo.com SPEEDEX</b> is your ONE-STOP total transportation services provider which is uniquely designed with speed flexibility, Responsiveness and economy as our highest priority. Whatever you need to transport, whenever, wherever, however it needs to get there on time and in budget. <b>SPEEDEX</b> teamwork /technology, and industry EXPERIENCE combine to make the Seemingly impossible an everyday achievement by making sure that your Documents, Parcels and Fright are delivered safely and on time every- time using our intergraded network. <b>SPEEDEX</b> provides the best value of your money spend on COURIERS CARGO & LOGISTICS with the help of its committed, experienced and Professional workforce. </p>
                                        <p>Today we are providing our services to corporate, Traders, Household and students with the tailor - made solution for their need of sending Documents, samples Parcels, Export Consignments and Emotion Filled Gifts to loved ones all over the world. TO fulfill the Herculean task of balancing the cost, speed, safety, Reliability and Traceability as per different priority of sender and receiver, our team possible alternative service to you, <b>SPEEDEX</b> is having its own Network and Associates to delivers yours Consignments, but to fulfill your requirements we at <b>SPEEDEX</b> don’t hesitate to offer the services of our competitors as well at Much discounted rates we have highly discounted rates of all the major EXPRESS companies.</p>
                                        <p>
                                            <b><u>OUR SERVICE</u></b><br>
                                            <b>
                                            ► CARGO – Commercial and Non Commercial.<br>
                                            ► MODE - Air, Cargo, Surface,<br>
                                            ► SPEEDEX FAST CARGO</b>
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
                                            <li class="m-b-10">Bill shall be submitted on a 15 days basis payable within 7days from its submission.</li>
                                            <li class="m-b-10"><input type="text" id="charges1" name="charges1" value="{{isset($getSingleData['charges1']) ? $getSingleData['charges1'] : ''}}" minlength="2" maxlength="2" /> % Fuel surcharge applicable on above rates.</li>
                                            <li class="m-b-10">Minimum chargeable weight for Cargo /Sfc /Air will be charge 10kg.</li>
                                            <li class="m-b-10">Minimum docket charges will be 1200/- for Air /- for SFC 750/- for Cargo 1000 + GST</li>
                                            <li class="m-b-10 text-danger">
                                                Insurance: - A – Owner Risk 3% will be charged on invoice value, B – Carrier risk 0.05% or Rs. <input type="text" id="charges2" name="charges2" value="{{isset($getSingleData['charges2']) ? $getSingleData['charges2'] : ''}}"/> whichever is higher will be charged.
                                                <br>
                                                Insurance: - A – Owner Risk 3% will be charged on invoice value, or Rs. 100/- whichever is higher will be charged B – Carrier risk 0.05% or Rs. 100.00 whichever is higher will be charged.
                                            </li>
                                            <li class="m-b-10">All delivery status will be provided online.</li>
                                            <li class="m-b-10">Bills not to be withheld on account of POD’s</li>
                                            <li class="m-b-10">All the payments shall be made in favor of <b>SPEEDEX FAST CARGO</b>.</li>
                                            <li class="m-b-10">Volumetric / Liquid / Packing / Diplomatic / such cases shall be charged extra as actual.</li>
                                            <li class="m-b-10">All over size & Less weighted parcel will be forwarded through volumetric calculation By Air/Cargo (L*B*H/5000) vol. or Surface (L*B*H/27000  * <select id="surface_multi" name="surface_multi"><option value="" selected="true" disabled="disabled">Select</option><option value="7" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '7' ? 'selected' : ''}}>7</option><option value="8" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '8' ? 'selected' : ''}}>8</option><option value="9" {{ isset($getSingleData['surface_multi']) && $getSingleData['surface_multi'] == '9' ? 'selected' : ''}}>9</option></select>) actual weight whichever is higher will be calculated for billing.</li>
                                            <li class="m-b-10"><b>SPEEDEX</b> Will not be responsible for any consignment held up by govt. authorities in absence of valid document not provided.</li>
                                            <li class="m-b-10">ODA Location delivery charges will be extra as actual.</li>
                                            <li class="m-b-10">Shipment non delivered / late delivery due to natural calamities / riots / bandh / airlines failures & etc. can’t be consider <b>SPEEDEX</b> failure.</li>
                                            <li class="m-b-10">All RTO shipment will charge as per tariff.</li>
                                            <li class="m-b-10">The rates given are for Mumbai to <b>PAN INDIA</b>.</li>
                                            <li class="m-b-10">All transshipment for Assam will be charge in Air only.</li>
                                            <li class="m-b-10">Special rates for heavy Cargo.</li>
                                        </ol>
                                        <br><br><br><br><br>
                                        <p style="float:right; text-align:left;">Thanking You,<br>SPEEDEX FAST CARGO,<br>L. A. Cruz 842503507</p>
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
        $('.js-example-basic-single').select2();
        
        $( "#quotation_form" ).validate({
            onkeydown: false,
            onkeyup: false,
            onfocusin: false,
            onfocusout: false,
            rules: {
            },messages: {    
            },submitHandler: function(form) {
                queryString = $('#quotation_form').serialize();
                
                $("#submit").css("display", "none");
                $("#loading").css("display", "block");
                $("#loading").prop( "disabled", true );
                
                $.post("<?php echo url('/quotation/save')?>", queryString, function (data) {
                    commonStatusMessage(data, "<?php echo url('/quotation')?>");
                }, "JSON");
                return false;
            }
        })
    })

    // Quotation Start
    $('#column_1').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#column_2').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#column_3').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#column_4').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#column_5').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#s_column_1').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#s_column_2').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#s_column_3').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#s_column_4').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#s_column_5').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#a_column_1').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#a_column_2').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#a_column_3').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#a_column_4').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#a_column_5').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    // Quotation End
    
    // Courier Mode Start
    $('#c_column_2').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_3').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_4').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_5').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_6').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_7').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_8').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_9').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_10').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_11').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_12').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_13').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#c_column_14').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    // Courier Mode End
    
    // Terms & Conditions Start
    $('#charges1').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    $('#charges2').on('input', function() { this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); });
    // Terms & Conditions End
    
    $("#company_id").on("change",function(){
         var company_id = $("#company_id").val();
        $.ajax({
               headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               type: 'POST',
               url: '<?php echo url('/already-exists')?>',
               data: {
                   company_id:company_id,
               },success: function(response){
                  var obj = $.parseJSON(response);
                  if(obj.status=='exist'){
                      swal(obj.message, "warning");
                      $("#company_id").val("").trigger('change');
                  }
               }
           })
    })
</script>
@endsection