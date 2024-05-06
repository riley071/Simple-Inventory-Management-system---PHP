<?php include('db_connect.php');?>
<!-- Include the database connection script -->

<div class="container-fluid">

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-category">
				<div class="card">
					<div class="card-header">
						    Product Category Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Category</label>
								<input type="text" class="form-control" name="name">
							</div>
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Category List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM category_list order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<?php echo $row['name'] ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" >Edit</button>
										<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	
	$('#manage-category').submit(function(e){
		e.preventDefault() // Prevent default form submission
		start_load() // Start loading animation
		$.ajax({
			url:'ajax.php?action=save_category', // URL to save category action
			data: new FormData($(this)[0]), // Data to be sent
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST', // HTTP method
		    type: 'POST', // Same as method
			success:function(resp){ // On successful response
				if(resp==1){
					alert_toast("Data successfully added",'success') // Display success message for adding category
					setTimeout(function(){
						location.reload() // Reload the page
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success') // Display success message for updating category
					setTimeout(function(){
						location.reload() // Reload the page
					},1500)

				}
			}
		})
	})
	$('.edit_cat').click(function(){
		start_load() // Start loading animation
		var cat = $('#manage-category')
		cat.get(0).reset() // Reset form fields
		cat.find("[name='id']").val($(this).attr('data-id')) // Set category ID for editing
		cat.find("[name='name']").val($(this).attr('data-name')) // Set category name for editing
		end_load() // End loading animation
	})
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this category?","delete_cat",[$(this).attr('data-id')]) // Confirm category deletion
	})
	function delete_cat($id){
		start_load() // Start loading animation
		$.ajax({
			url:'ajax.php?action=delete_category', // URL to delete category action
			method:'POST', // HTTP method
			data:{id:$id}, // Data to be sent
			success:function(resp){ // On successful response
				if(resp==1){
					alert_toast("Data successfully deleted",'success') // Display success message for deleting category
					setTimeout(function(){
						location.reload() // Reload the page
					},1500)

				}
			}
		})
	}
	$('table').dataTable() // Initialize data table
</script>