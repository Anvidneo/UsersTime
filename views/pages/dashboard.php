<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/login.css">
  <link rel="stylesheet" href="../components/styles/styles.css">
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"rel="stylesheet"/>
</head>
<body>
	<main class="d-flex align-items-center py-12 py-md-0">
		<?php include("../components/sidebar.php") ?>

		<div class="card text-white bg-dark col-md-12 content">
			<div>
				<div class="container-xl"><br>
					<div class="table" style="color:#fff;">
						<div class="table-wrapper">
							<div class="table-title">
								<div class="row">
									<div class="col-sm-8">
										<h2>Activities <b>User Times</b></h2>
									</div>
									<div class="col-sm-4">
										<a href="#addActivityModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Activity</span></a>
									</div>
								</div>
							</div>
							<table id= 'table_content' class="table table-hover" style="display:none; color:#fff;"><br>
								<thead>
									<tr>
										<th>Id</th>
										<th>Description</th>
										<th>Times</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody id='content_activities'>
								</tbody>
							</table>
							<div id = 'msg' style="display:none;"></div>
						</div>
					</div>
					<br><br>
					<div id="times_activity" style="display:none;">
						<div class="table" style="color:#fff;">
							<div class="table-wrapper">
								<div class="table-title">
									<div class="row">
										<div class="col-sm-8">
											<h2>Activities / <b>Times</b></h2>
										</div>
										<div class="col-sm-4">
											<a href="#addTimeModal" class="btn btn-success" data-toggle="modal" value=""><i class="material-icons"></i> <span>Add New Time</span></a>
										</div>
									</div>
								</div>
								<table id= 'table_content_times' class="table table-hover" style="display:none; color:#fff;"><br>
									<thead>
										<tr>
											<th>Id</th>
											<th>Date</th>
											<th>Time</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody id='content_times'>
									</tbody>
								</table>
								<div id = 'msg_times' style="display:none;"></div>
							</div>
						</div>        
					</div>
				</div>
			</div>
		</div>
	</main>
	<br><br>
	<!-- MODALS FOR ACTIVITIES-->
	<!-- New Modal HTML -->
	<div id="addActivityModal" class="modal fade" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Activity</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Description</label>
							<textarea id="description_activity" class="form-control"></textarea>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input id="new_activity" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editActivityModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Activity</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Description</label>
							<input id="edit_description"type="text" class="form-control" value="" required="">
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<a style="color:white;" type="button" id="edit_activity" class="btn btn-info" value="">Save</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteActivityModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Activity</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<a style="color:white;" type="button" id="id_delete" class="btn btn-danger" value="">Delete</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODALS FOR TIMES  -->
	<!-- New Modal HTML -->
	<div id="addTimeModal" class="modal fade" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Activity</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Time</label>
							<input id="time"type="number" class="form-control" required="">
						</div>				
						<div class="form-group">
							<label>Date</label>
							<input id="date" type="date" class="form-control" required="">
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input id="new_time" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteTimeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Time</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<a style="color:white;" type="button" id="id_delete_time" class="btn btn-danger" value="">Delete</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="../../scripts/scripts.js"></script>
	<script>
		$(document).ready(function() {
			check_user();
			create_table_activities();
		});
	</script>
</body>
</html>
