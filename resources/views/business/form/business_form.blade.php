<table  class="table table-bordered" style="font-family: Arial;" id="tbl_main_form">
						<thead>
							<tr>
								<th>
									{{-- <div class="row row-space-10"> --}}
										<div class="col-md-12"  >
											<center style="font-size: 20px;">
												Business Registration
												<br>
												
											</center>
										</div>
									
									{{-- </div> --}}
									
								</th>
								
							</tr>
							{{-- <tr><h6>Hello</h6></tr> --}}
						</thead>
						<tbody>
							
							<tr style="background: #DCDCDC; color: #000000; font-size: small;">
								<td style="font-weight: bolder;"> &nbsp 1 BASIC INFORMATION</td>
							</tr>
							{{--  --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business Category</label>
												<select class="form-control" id="sel_business_nature" data-parsley-required="true" >
													<option>-- Business Category --</option>
													@foreach($line_of_business as $row)

													<option id="{{$row->LINE_OF_BUSINESS_ID}}">{{$row->LINE_OF_BUSINESS_NAME}}</option>
													@endforeach

												</select>
											</div>
										</div>
										
										
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business Name</label>
												<input type="text" id="txt_business_name" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Trade Name/Franchise</label>
												<input type="text" id="txt_tradename" class="form-control">
											</div>
										</div>
										
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business Number</label>
												<input type="text" id="txt_business_number" class="form-control">
											</div>
										</div>

									</div>
								</td>
							</tr>
							{{-- 1 Trasaction Type  --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Type of Business</label>
												<select class="form-control" id="sel_business_type">
													<option selected disabled value=""> -- Type of Business --</option>
													<option>Single</option>
													<option>Partnership</option>
													<option>Corporation</option>
													<option>Cooperative</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>TIN No</label>
												<input type="text" id="txt_tin_no" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>DTI/ SEC/CDA Registration No</label>
												<input type="text" id="txt_dti_no" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label> Date Registered</label>
												<input type="date" id="txt_dti_no_date" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>

							{{-- 4 Applicant Name--}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<br>
												<label>Name of Applicant/Taxpayer</label>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Last Name</label>
												<input type="text" id="txt_lastname" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>First Name</label>
												<input type="text" id="txt_firstname" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label> Middle Name</label>
												<input type="text" id="txt_middlename" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 5 Business Name, Trade Mark --}}
							
							<tr style="background: #DCDCDC">
								<td style="font-weight: bolder; color: #000000; font-size: small;"> &nbsp 2 OTHER INFORMATION</td>
							</tr>
							{{-- 6 Business Info --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-9 col-md-18">
												<div class="stats-content">
													<label>Business Address</label>
													<input type="text" id="txt_business_address" class="form-control">
												</div>
											</div>
											<div class="col-lg-3 col-md-6">
												<div class="stats-content">
													<label>Postal Code</label>
													<input type="text" id="txt_business_postal" class="form-control" placeholder="9999">
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 7 Business Info 2 --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business' Telephone No</label>
												{{-- txt_business_telephone --}}
												<input type="text" id="txt_business_telephone" class="form-control" placeholder="999-9999">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												{{-- txt_business_mobile --}}
												<label>Business' Mobile No</label>
												<input type="text" id="txt_business_mobile" class="form-control" placeholder="0999-999-9999">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business' Email Address</label>
												<input type="text" id="txt_business_email" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 8 Owner Info --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-9 col-md-18">
											<div class="stats-content">
												<label>Owner's Address</label>
												<input type="text" id="txt_owner_address" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Postal Code</label>
												<input type="text" id="txt_owner_postal" class="form-control" placeholder="9999">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 9 Owner Info 2 --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Owner's Telephone No</label>
												<input type="text" id="txt_owner_telephone" class="form-control" placeholder="999-9999">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Owner's Mobile No</label>
												<input type="text" id="txt_owner_mobile" class="form-control" placeholder="0999-999-9999">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Owner's Email Address</label>
												<input type="text" id="txt_owner_email" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 10 Emergency --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-6 col-md-9">
											<div class="stats-content">
												<label>In case of emergency, provide name of the contact person </label>
												<input type="text" id="txt_emergency_person" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Telephone/Mobile No</label>
												<input type="text" id="txt_emergency_contact" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Email address</label>
												<input type="text" id="txt_emergency_email" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- Area, Employee --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business Area (sqm)</label>
												<input type="text" id="txt_business_area" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Total number of employees in establishment</label>
												<input type="number" id="txt_female_establishment" class="form-control" placeholder="Female">
												<br>
												<input type="number" id="txt_male_establishment" class="form-control" placeholder="Male">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Number of employees residing within LGU</label>
												<input type="number" id="txt_female_lgu" class="form-control" placeholder="Female">
												<br>
												<input type="number" id="txt_male_lgu" class="form-control" placeholder="Male">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<div class="form-check">
													<input type="radio" class="form-check-input" name="radiorequired" value="foo" id="radioBusinessWeight" data-parsley-required="true" data-parsley-multiple="radiorequired">
													<label class="form-check-label" for="radioBusinessWeight">Weight</label>
												</div>
												<div class="form-check">
													<input type="radio" class="form-check-input" name="radiorequired" id="radioPropertyBRelated" value="bar" data-parsley-multiple="radiorequired">
													<label class="form-check-label" for="radioPropertyBRelated">Building Related</label>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{--  --}}
							<tr style="background: #DCDCDC; color: #000000;font-size: small;">
								<td >Note:  Fill up only if business place is rented/not owned</td>
							</tr>
							{{-- Lessor --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-6 col-md-12">
											<div class="stats-content">
												<label>Lessor’s Fullname</label>
												<input type="text" id="txt_lessor_name" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="stats-content">
												<label>Lessor’s Full address</label>
												<input type="text" id="txt_lessor_address" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- Lessor --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Lessor's Full telephone/mobile no.</label>
												<input type="text" id="txt_lessor_telephone" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Lessor’s email address</label>
												<input type="text" id="txt_lessor_email" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">

											<div class="stats-content">
												<label>Monthly Rental</label>
												<input type="text" id="txt_monthly_rental" class="form-control">
											</div>
										</div>

										

										</div>
									</div>
								</td>
							</tr>
							
							<tr style="background: #DCDCDC">
								<td style="font-weight: bolder; color: #000000; font-size: small;"> &nbsp; 3 BUSINESS ACTIVITY</td>
							</tr>
							{{-- bUSINES ACTIVIYT --}}
							<tr>
								<td>
									<table class="table table-striped table-bordered" id="tbl_business_acitivity">
										
										<thead>
											<tr>
												<th style="text-align: center;">Line of Business</th>
												<th style="text-align: center;" width="10%">No of units</th>
												<th style="text-align: center;">Capitalization (for new business) </th>
												<th style="text-align: center;" colspan="2">Gross/Sales Receipts</th>
												<th style="text-align: center;">Action</th>
												
											</tr>
											<tr>

												<th></th>
												<th></th>
												<th></th>
												<th style="text-align: center;">ESSENTIAL</th>
												<th style="text-align: center;">NON-ESSENTIAL</th>
												<th></th>
											</tr>
										</thead>
										<tbody>

											{{-- <tr>
												<td><input type="text" name="lineofbusiness" class="form-control"></td>
												<td><input type="text" name="noofunit" class="form-control"></td>
												<td><input type="text" name="capitalization" class="form-control"></td>
												<td><input type="text" name="grossreceipt" class="form-control"></td>
												<td></td>
											</tr> --}}

										</tbody>
									</table>
									{{-- add tbody --}}
									<div class="clearfix">
										<div class="btn-group">
											<button class="btn btn-success add btn-sm" data-toggle="modal" id="btnAddBusinessActivity">
												<i class="fa fa-plus"></i>
											</button>
										</div>
									</div>
								</td>
							</tr>
							<tr style="background: #DCDCDC; color: #000000;font-size: small;">
								<td >I DECLARED UNDER PENALTY OF PERJURY that the foregoing information are true based on my personal knowledge and authentic records. I agree to comply with the regulatory requirement and other deficiencies within 30 days from release of the business permit.</td>
							</tr>
							
							<tr>
								<td align="right">
									<button type="submit" class="btn btn-primary" id="btnSubmitBusinessRegistration">Submit</button>
								</td>
							</tr>
						</tbody>
					</table>
					
					