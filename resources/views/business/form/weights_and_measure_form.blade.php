<table  class="table table-bordered" style="font-family: Arial;" id="tbl_main_form">
						<thead>
							<tr>
								<th>
									{{-- <div class="row row-space-10"> --}}
										<div class="col-md-12"  >
											<center style="font-size: 20px;">
												Weights and Measure Registration
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
												<select>
                                                    <option>-- Business Category --</option>
                                                    <option>Test</option>
                                                </select>
											</div>
										</div>

									</div>
								</td>
							</tr>
							
							<tr style="background: #DCDCDC">
								<td style="font-weight: bolder; color: #000000; font-size: small;"> &nbsp; Weights and Measure</td>
							</tr>
							{{-- BUSINESS ACTIVITY --}}
							<tr>
								<td>
									<table class="table table-striped table-bordered" id="tbl_business_acitivity">
										
										<thead>
											<tr>
												<th style="text-align: center;">LICENSE_NO</th>
												<th style="text-align: center;">LICENSE_DATE</th>
												<th style="text-align: center;">DEVICE_TYPE</th>
												<th style="text-align: center;">BRAND</th>
												<th style="text-align: center;">MODEL</th>
												<th style="text-align: center;">CAPACITY</th>
												<th style="text-align: center;">Serial No</th>
												
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
					
					