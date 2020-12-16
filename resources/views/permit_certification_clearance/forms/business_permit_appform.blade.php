<table  class="table table-bordered" style="font-family: Arial;" id="tbl_main_form">
						<thead>
							<tr>
								<th>
									<div class="row row-space-10">
										<div class="col-md-7"  >
											<center style="font-size: 20px;">
												Republic of the Philippines
												<br>
												Province of Rizal
												<br>
												Municipality of Tanay
												<br>
												BARANGAY {{ session('session_barangay_name')}}
												<br>
												<h2>Application for Barangay Business Permit</h2>
											</center>
										</div>
										<br>
										<br>
										<br>
										<br>
										<br>
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										&nbsp
										<div class="col-md-4" >
											<div class="form-group row m-b-10">
												<label class="col-sm-4 col-form-label">Date</label>
												<div class="col-sm-8">
													<input class="form-control" type="text"  readonly="">
												</div>
											</div>
											<div class="form-group row m-b-10">
												<label class="col-sm-4 col-form-label">Time</label>
												<div class="col-sm-8">
													<input class="form-control" type="text"  readonly="">
												</div>
											</div>
											<div class="form-group row m-b-10">
												<label class="col-sm-4 col-form-label">Time Received</label>
												<div class="col-sm-8">
													<input class="form-control" type="text"  readonly="">
												</div>
											</div>
											<div class="form-group row m-b-10">
												<label class="col-sm-4 col-form-label">Received by</label>
												<div class="col-sm-8">
													<input class="form-control" type="text"  readonly="">
												</div>
											</div>
											<div class="form-group row m-b-10">
												<label class="col-sm-4 col-form-label">Number</label>
												<div class="col-sm-8">
													<input class="form-control" type="text"  readonly="">
												</div>
											</div>
										</div>
									</div>
									
								</th>
								
							</tr>
							{{-- <tr><h6>Hello</h6></tr> --}}
						</thead>
						<tbody>
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;">I.APPLICANT SECTION</td>
							</tr>
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;"> &nbsp 1 BASIC INFORMATION</td>
							</tr>
							{{-- 1 Trasaction Type  --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Transaction Type</label>
												{{-- <input type="text" id="" class="form-control"> --}}
												<select class="form-control">
													<option selected disabled value=""></option>
													<option>New</option>
													<option>Renewal</option>
													<option>Retirement</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>TIN No</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>DTI/ SEC/CDA Registration No</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label> Date Registered</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 2 Type of Business --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Type of Business</label>
												<select class="form-control">
													<option selected disabled value=""></option>
													<option>Single</option>
													<option>Partnership</option>
													<option>Corporation</option>
													<option>Cooperative</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Amendment From</label>
												<select class="form-control">
													<option selected disabled value=""></option>
													<option>Single</option>
													<option>Partnership</option>
													<option>Corporation</option>
													<option>Cooperative</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Amendment To</label>
												<select class="form-control">
													<option selected disabled value=""></option>
													<option>Single</option>
													<option>Partnership</option>
													<option>Corporation</option>
													<option>Cooperative</option>
												</select>
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 3 Tax --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-6 col-md-9">
											<div class="stats-content">
												<label>Are you enjoying tax incentive from any Government Entity? </label>
												<br>
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio1" value="option1" checked="">
													<label for="inlineCssRadio1">Yes</label>
												</div>
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio2" value="option2">
													<label for="inlineCssRadio2">No</label>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>If yes, please specify the entity</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>First Name</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label> Middle Name</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{-- 5 Business Name, Trade Mark --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business Name</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Trade Name/Franchise</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;"> &nbsp 2 OTHER INFORMATION</td>
							</tr>
							{{-- 6 Business Info --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-9 col-md-18">
											<div class="stats-content">
												<label>Business Address</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Postal Code</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business' Mobile No</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Business' Email Address</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Postal Code</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Owner's Mobile No</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Owner's Email Address</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Telephone/Mobile No</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Email address</label>
												<input type="text" id="" class="form-control">
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
												<label>Business Area </label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Total number of employees in establishment</label>
												<input type="number" id="" class="form-control" placeholder="Female">
												<br>
												<input type="number" id="" class="form-control" placeholder="Male">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Number of employees residing within LGU</label>
												<input type="number" id="" class="form-control" placeholder="Female">
												<br>
												<input type="number" id="" class="form-control" placeholder="Male">
											</div>
										</div>
									</div>
								</td>
							</tr>
							{{--  --}}
							<tr style="background: #f9f9f9">
								<td >Note:  Fill up only if business place is rented/not owned</td>
							</tr>
							{{-- Lessor --}}
							<tr>
								<td>
									<div class="row">
										<div class="col-lg-6 col-md-12">
											<div class="stats-content">
												<label>Lessor’s Fullname</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="stats-content">
												<label>Lessor’s Full address</label>
												<input type="text" id="" class="form-control">
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
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Lessor’s email address</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
										<div class="col-lg-3 col-md-6">

											<div class="stats-content">
												<label>Monthly Rental</label>
												<input type="text" id="" class="form-control">
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;"> &nbsp 3 BUSINESS ACTIVITY</td>
							</tr>
							{{-- bUSINES ACTIVIYT --}}
							<tr>
								<td>
									<table class="table table-striped table-bordered" id="tbl_business_acitivity">
										<thead>
											<tr>
												<th>Line of Business</th>
												<th>No of units</th>
												<th>Capitalization</th>
												<th>Gross/Sales Receipts</th>
												<th>Action</th>
											</tr>
											
										</thead>
										<tbody>

											{{-- <tr>
												<td><input type="text" id="" name="lineofbusiness" class="form-control"></td>
												<td><input type="text" id="" name="noofunit" class="form-control"></td>
												<td><input type="text" id="" name="capitalization" class="form-control"></td>
												<td><input type="text" id="" name="grossreceipt" class="form-control"></td>
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
							{{--  --}}
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;">I. LGU SECTION</td>
							</tr>
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;"> &nbsp 1 VERIFICATION OF DOCUMENTS</td>
							</tr>
							{{-- Verification --}}
							<tr>
								<td>
									<table class="table table-striped table-bordered" id="tbl_document_verifications">
									<thead>
										<tr>
											<th>Description</th>
											<th>Office/Agency</th>
											<th>Yes/No</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Occupancy Permit (new)</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Business Registration</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Valid Fire Safety Inspection Certificate</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Contract of Lease</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Sworn Statement of Gross Receipt</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Proof of RPT payment</td>
											<td><input type="text" id="" class="form-control"></td>
											<td>
												<select id="sel_" class="form-control">
													<option></option>
													<option>Yes</option>
													<option>No</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
							{{--  --}}
							<tr style="background: #f9f9f9">
								{{-- <td style="font-weight: bolder;"> &nbsp LOCAL TAXES</td> --}}
							</tr>							
							{{-- Local Taxes --}}
							<tr style="background: #f9f9f9">
								<td style="font-weight: bolder;">I.APPLICANT SECTION</td>
							</tr>

							<tr>
								<td>fda fjdlka</td>
							</tr>
						</tbody>
					</table>