<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Sales List</b>
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_sales"><i class="fa fa-plus"></i> New Sales</button>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<th class="text-center">#</th>
								<th class="text-center">Date</th>
								<th class="text-center">Reference #</th>
								<th class="text-center">Customer</th>
								<th class="text-center">Email</th>
								<th class="text-center">Action</th>
								<th class="text-center">Send</th>
							</thead>
							<tbody>
													<?php 
							$customer = $conn->query("SELECT id, name, contact FROM customer_list ORDER BY name ASC");
							while($row = $customer->fetch_assoc()):
								$cus_arr[$row['id']] = array(
									'name' => $row['name'],
									'contact' => $row['contact']
								);
							endwhile;
							$cus_arr[0] = array(
								'name' => 'GUEST',
								'contact' => 'N/A'
							);

							$i = 1;
							$sales = $conn->query("SELECT * FROM sales_list ORDER BY date(date_updated) DESC");
							while($row = $sales->fetch_assoc()):
						?>

								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class=""><?php echo date("M d, Y",strtotime($row['date_updated'])) ?></td>
									<td class=""><?php echo $row['ref_no'] ?></td>
																		<td class="">
										<?php 
											// Check if 'customer_id' exists in $cus_arr
											if(isset($cus_arr[$row['customer_id']])) {
												// If 'customer_id' exists, retrieve the corresponding customer information
												$customer_info = $cus_arr[$row['customer_id']];
												// Output the customer name
												echo $customer_info['name'];
											} else {
												// If 'customer_id' doesn't exist, display 'N/A'
												echo 'N/A';
											}
										?>
									</td>
									<td class="">
										<?php 
											// Check if 'customer_id' exists in $cus_arr
											if(isset($cus_arr[$row['customer_id']])) {
												// If 'customer_id' exists, retrieve the corresponding customer information
												$customer_info = $cus_arr[$row['customer_id']];
												// Output the customer contact
												echo $customer_info['contact'];
											} else {
												// If 'customer_id' doesn't exist, display 'N/A'
												echo 'N/A';
											}
										?>
									</td>

							<td class="text-center">
										<a class="btn btn-sm btn-primary" href="index.php?page=pos&id=<?php echo $row['id'] ?>">Edit</a>
										<a class="btn btn-sm btn-danger delete_sales" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
									</td>
									<td class="text-right">
										<button class="btn btn-success notify-btn" data-contact="<?php 
											// Check if 'customer_id' exists in $cus_arr
											if(isset($cus_arr[$row['customer_id']])) {
												// If 'customer_id' exists, retrieve the corresponding customer information
												$customer_info = $cus_arr[$row['customer_id']];
												// Output the customer contact
												echo $customer_info['contact'];
											} else {
												// If 'customer_id' doesn't exist, display 'N/A'
												echo 'N/A';
											}
										?>">
											<i class=""></i> Mail Invoice
										</button>
									</td>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
// Display information about the uploaded file for debugging
echo "File Name: " . $_FILES["invoice"]["name"] . "<br>";
echo "Temporary Name: " . $_FILES["invoice"]["tmp_name"] . "<br>";
echo "Error Code: " . $_FILES["invoice"]["error"] . "<br>";
echo "File Size: " . $_FILES["invoice"]["size"] . "<br>";
echo "File Type: " . $_FILES["invoice"]["type"] . "<br>";
?>

<div id="notifyModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Send Invoice to Email</h2>
	<form id="notifyForm" method="post" action="email.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="email">Recipient Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
	  <div class="form-group">
    <label for="invoice">Invoice File</label>
    <input type="file" class="form-control-file" id="invoice" name="invoice" required accept=".pdf, .doc, .docx">
</div>



      <button type="submit" class="btn btn-primary" name="updatestatus">Send Email</button>
    </form>
  </div>
</div>
    </div>
  </div>
</div>

<script>
  // Get the modal
  var modal = document.getElementById('notifyModal');

  // Get all Notify buttons
  var notifyBtns = document.querySelectorAll('.notify-btn');

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Add click event listener to all Notify buttons
  notifyBtns.forEach(function(btn) {
    btn.onclick = function() {
      var contact = this.getAttribute('data-contact');
      openNotifyModal(contact);
    }
  });

  function openNotifyModal(contact) {
    // Set the recipient email value in the form
    document.getElementById("email").value = contact;
    // Display the modal
    modal.style.display = "block";
  }
</script>
<script>
	$('table').dataTable()
	$('#new_sales').click(function(){
		location.href = "index.php?page=pos"
	})
	$('.delete_sales').click(function(){
		_conf("Are you sure to delete this data?","delete_sales",[$(this).attr('data-id')])
	})
	function delete_sales($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_sales',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>