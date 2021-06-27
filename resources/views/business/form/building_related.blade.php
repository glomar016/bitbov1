<table class="table table-bordered" style="font-family: Arial;" id="tbl_main_form">
	<thead>
		<tr>
			<th>
				{{-- <div class="row row-space-10"> --}}
				<div class="col-md-12">
					<center style="font-size: 20px;">
						Building Registration
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
			<td style="font-weight: bolder;"> &nbsp 1. BASIC INFORMATION</td>
		</tr>
		{{-- --}}
		<tr>
			<td>
				<div class="row">


					{{--<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Building Occupancy</label>
												<select class="form-control" id="sel_b_occupancy" data-parsley-required="true" >
													<option>-- Building Occupancy --</option>
													<option >Residential, Dwelling</option>
													<option >Residential, Hotel/Apartment</option>
													<option >Education, Recreation</option>
													<option >Institutional</option>
													<option >Business and Mercantile</option>
													<option >Industrial</option>
													<option >Industrial, Storage and Hazardous</option>
													<option >Recreational Assembly</option>
													<option >Agricultural Accessory</option>
												</select>
											</div>
										</div>--}}

					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Lot No.</label>
							<input type="text" id="txt_lot_no" class="form-control">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Building No.</label>
							<input type="text" id="txt_building_id" class="form-control">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>CAD Lot Number</label>
							<input type="text" id="txt_cad_number" class="form-control" style="text-transform: uppercase;" placeholder="">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Project Type</label>
							<input type="text" class="form-control" placeholder="2-Storey 4 classroom" id="txt_project_type" style="text-transform: capitalize;">

						</div>
					</div>


				</div>
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<br>
						<div class="stats-content">
							<label>Building Name</label>
							<input type="text" id="txt_building_name" class="form-control" placeholder="Angel Grace Apartment" style="text-transform: capitalize;">
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
							<label>Land Use</label>
							<select class="form-control" id="sel_land_use">
								<option selected disabled value=""> -- Land Use --</option>
								<option>Residential</option>
								<option>Institutional</option>
								<option>Commercial</option>
								<option>Agricultural</option>
								{{--<option>Tenanted</option>
													<option>Not Tenanted</option>
													<option>Vacant/Idle</option>--}}
							</select>
						</div>
					</div>
					{{--<div class="col-lg-3 col-md-6">
											<div class="stats-content">
												<label>Existing Land Use</label>
												
											</div>
										</div>--}}
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Scope of Work</label>
							<select class="form-control" id="sel_scopeof_work">
								<option selected disabled value=""> -- Scope of Work --</option>
								<option>Land Related</option>
								<option>New Construction</option>
								<option>Erection</option>
								<option>Addition</option>
								<option>Alteration</option>
								<option>Renovation</option>
								<option>Conversion</option>
								<option>Repair</option>
								<option>Moving</option>
								<option>Raising</option>
								<option>Demolition</option>
								<option>Accessory Building/Structure</option>\
								<option>New Installation</option>
								<option>Annual Inspection</option>
								<option>Temporary</option>
								<option>Reconnection of Service Entrance</option>
								<option>Separation of Service Entrance</option>
								<option>Upgrading of Service Entrance</option>
								<option>Relocation of Service Entrance</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Enterprise Name</label>
							<input type="text" id="txt_enterprise_name" class="form-control" style="text-transform: uppercase;" placeholder="">
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
							<label>Name of Applicant/Owner</label>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="stats-content">
							<label>Fullname</label>
							<input type="text" id="txt_applicant_fullname" class="form-control" style="text-transform: uppercase;" placeholder="Lastname/Firstname/Middlename">
							<label id="lbl_applicant_fullname" class="error"></label>
						</div>
					</div>

				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<br>
							<label>Full Address</label>
						</div>
					</div>
					<div class="col-lg-12 col-md-12">
						<div class="stats-content">

							<input type="text" id="txt_applicant_address" class="form-control" style="text-transform: uppercase;" placeholder="">
							<label id="lbl_applicant_address" class="error"></label>
						</div>
					</div>

				</div>
			</td>
		</tr>

		<tr style="background: #DCDCDC">
			<td style="font-weight: bolder; color: #000000; font-size: small;"> &nbsp 2 OTHER INFORMATION</td>
		</tr>

		{{-- Project info --}}
		<tr>
			<td>
				<div class="row">
					<div class="col-lg-9 col-md-18">
						<div class="stats-content">
							<label>Project Location</label>
							<textarea id="txt_project_location" class="form-control" style="text-transform: uppercase;"></textarea>
							<label id="lbl_project_location" class="error"></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Project Cost</label>
							<input type="text" id="txt_project_cost" class="form-control" placeholder="5,000">
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
							<label>Applicants Telephone No</label>
							<input type="text" id="txt_applicant_telephone" class="form-control" placeholder="999-9999">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Applicants Mobile No</label>
							<input type="text" id="txt_applicant_mobile" class="form-control" placeholder="0999-999-9999">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Applicants Email Address</label>
							<input type="text" id="txt_applicant_email" class="form-control">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Postal Code</label>
							<input type="text" id="txt_applicant_postal" class="form-control" placeholder="9999">
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
							<label>Project Floor Area (in SQM)</label>
							<input type="text" id="txt_floor_area" class="form-control">
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Project Lot Area (in SQM)</label>
							<input type="text" id="txt_lot_area" class="form-control">
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Form of Ownership</label>
							<select class="form-control" id="sel_form_owner">
								<option selected disabled value=""> -- Form of Ownership --</option>

								<option>Single</option>
								<option>Partnership</option>
								<option>Government Corporation</option>
								<option>Private Corporation</option>
								<option>Cooperative Corporation</option>
							</select>
						</div>
					</div>
				</div>

			</td>
		</tr>
		{{-- BUSINES ACTIVITY --}}
		<tr>
			<td>
				<table class="table table-striped table-bordered" id="tbl_business_acitivity">

					<thead>
						<tr>
							<th style="text-align: center;" width="25%">Buidling Occupancy</th>

							<th style="text-align: center;" width="20%">Storey Number</th>
							<th style="text-align: center;" width="20%">Unit Number</th>
							<th style="text-align: center;" width="20%">Unit Floor Area</th>
							<th style="text-align: center;">Action</th>

						</tr>

					</thead>
					<tbody>



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
		{{-- --}}
		<tr style="background: #DCDCDC; color: #000000;font-size: small;">
			<td>Note: Fill up only if business place is rented/not owned</td>
		</tr>
		{{-- Lessor --}}
		<tr>
			<td>
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="stats-content">
							<label>Lessor’s Fullname</label>
							<input type="text" id="txt_lessor_name" class="form-control" style="text-transform: uppercase;">
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
							<label>Lessor's Telephone/Mobile no.</label>
							<input type="text" id="txt_lessor_telephone" class="form-control">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="stats-content">
							<label>Lessor’s Email Address</label>
							<input type="email" id="txt_lessor_email" class="form-control">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">

						<div class="stats-content">
							<label>Monthly Rental</label>
							<input type="number" id="txt_monthly_rental" class="form-control">
						</div>
					</div>



				</div>
				</div>
			</td>
		</tr>


		<tr style="background: #DCDCDC; color: #000000;font-size: small;">
			<td>I DECLARED UNDER PENALTY OF PERJURY that the foregoing information are true based on my personal knowledge and authentic records. I agree to comply with the regulatory requirement and other deficiencies within 30 days from release of the business permit.</td>
		</tr>

		<tr>
			<td align="right">
				<button type="submit" class="btn btn-primary" id="btnSubmitBuildingRegistration">Submit</button>
			</td>
		</tr>
	</tbody>
</table>