<?php

function openForm(){
	$html = '<!-- form aberto -->
				<div class="bd-callout bd-callout-warning">
					<!-- form -->
					<form id="myForm">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Name</label>
							<input type="text" name="Name" class="form-control" placeholder="Name">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Position</label>
							<input type="text" name="Position" class="form-control" placeholder="Position">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Office</label>
							<input type="text" name="Office" class="form-control" placeholder="Office">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Extn</label>
							<input type="text" name="Extn" class="form-control" placeholder="Age">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Start Date</label>
							<input type="text" name="startDate" class="form-control" placeholder="Start Date">
						</div>

						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Salary</label>
							<input type="text" name="Salary" class="form-control" placeholder="Salary">
						</div>

						<input type="submit" class="btn btn-success" value="Submit Button">
					</form>
					<!-- form -->
				</div>
			<!-- /form aberto -->';
			
	return $html;
}