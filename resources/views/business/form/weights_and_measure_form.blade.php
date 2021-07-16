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
							
							<tr style="background: #DCDCDC">
								<td style="font-weight: bolder; color: #000000; font-size: small;"> &nbsp; Weights and Measure</td>
							</tr>
							{{-- BUSINESS ACTIVITY --}}
									<tr>
										<th><label>BUSINESS NAME: </label>&nbsp
											<select class="business_name_list" name="BUSINESS_ID[]">
												<option selected disabled>-- Select Business --</option>
											</select>
										</th>
									</tr>
							<tr>
								<td>
									<table class="table table-striped table-bordered" id="tbl_weights_and_measure_activity">
										
										<thead>
											<tr>
												<th hidden style="text-align: center;">BUSINESS NUMBER</th>
												<th style="text-align: center;">License Number</th>
												<th style="text-align: center;">License Date</th>
												<th style="text-align: center;">Sales Invoice Number</th>
												<th style="text-align: center;">SI Date</th>
												<th style="text-align: center;">Device Type</th>
												<th style="text-align: center;">Brand Name</th>
												<th style="text-align: center;">Model</th>
												<th style="text-align: center;">Capacity in kg</th>
												<th style="text-align: center;">Serial Number</th>
												
											</tr>
										</thead>
										<tbody>
										
											{{-- <tr>
												<td><input type="text" name="BUSINESS_ID" class="form-control"></td>
												<td><input type="text" name="LICENSE_NO" class="form-control"></td>
												<td><input type="date" name="LICENSE_DATE" class="form-control"></td>
												<td><input type="date" name="SALES_INVOICE" class="form-control"></td>
												<td><input type="text" name="SI_DATE" class="form-control"></td>
												<td><input type="text" name="DEVICE_TYPE" class="form-control"></td>
												<td><input type="text" name="BRAND" class="form-control"></td>
												<td><input type="text" name="MODEL" class="form-control"></td>
												<td><input type="text" name="CAPACITY" class="form-control"></td>
												<td><input type="text" name="SERIAL_NO" class="form-control"></td>
												<td></td>
											</tr> --}}

										</tbody>
									</table>
									{{-- add tbody --}}
									<div class="clearfix">
										<div class="btn-group">
											<button class="btn btn-success add btn-sm" data-toggle="modal" id="btnAddWeightsAndMeasureActivity">
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
									<button type="submit" class="btn btn-primary" id="btnSubmitWeightsAndMeasureRegistration">Submit</button>
								</td>
							</tr>
						</tbody>
					</table>
					
					