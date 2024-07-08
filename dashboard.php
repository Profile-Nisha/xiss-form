<?php

include "config.php"; 

// Fetch data from the 'form' table
$sql = "SELECT * FROM form";
$result = $conn->query($sql);

?>


<?php include "header.php" ?>
<!--wrapper-->
<div class="wrapper">
	<!--sidebar wrapper -->
	<?php include "sidebar.php" ?>
	<!--end sidebar wrapper -->
	<!--start header -->
	<?php include "top-header.php" ?>
	<!--end header -->
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
            <div class="card radius-10">
				<div class="card-header">
					<div class="d-flex align-items-center">
						<div>
							<h6 class="mb-0">Dashboard</h6>
						</div>
						<div class="dropdown ms-auto">

							<a href="Dashboard.php" class="btn btn-primary text-end">View</a>

						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table align-middle mb-0">
							<thead class="table-light">
								<tr>
									<th>id</th>
									<th>fpm</th>
									<th>fullName</th>
									<th>dob</th>
									<th>gender</th>
									<th>category</th>
									<th>gender</th>
									<th>religion</th>
									<th>pwd</th>
									<th>disability</th>
									<th>Nationality</th>
									<th>martial</th>
									<th>father_name</th>
									<th>mother_name</th>
									<th>permanent_add</th>
									<th>permanent post_office</th>
									<th>permanent_police_station</th>
									<th>permanent_pin</th>
									<th>communication_address</th>
									<th>communication_police_address</th>
									<th>communication__police_station</th>
									<th>communication_pin</th>
									<th>mobile</th>
									<th>phone</th>
									<th>email</th>
									<th>publications</th>
									<th>additional_information</th>
									<th>declaration</th>
									<th>photo_path</th>
                                    <th>signature_path</th>

								</tr>
							</thead>

							<tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['fpm'] . "</td>";
                                        echo "<td>" . $row['fullname'] . "</td>";
                                        echo "<td>" . $row['dob'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['religion'] . "</td>";
                                        echo "<td>" . $row['pwd'] . "</td>";
                                        echo "<td>" . $row['disability_percentage'] . "</td>";
                                        echo "<td>" . $row['nationality'] . "</td>";
                                        echo "<td>" . $row['marital_status'] . "</td>";
                                        echo "<td>" . $row['father_name'] . "</td>";
                                        echo "<td>" . $row['mother_name'] . "</td>";
                                        echo "<td>" . $row['permanent_address'] . "</td>";
                                        echo "<td>" . $row['permanent_post_office'] . "</td>";
										echo "<td>" . $row['permanent_police_station'] . "</td>";
										echo "<td>" . $row['permanent_pin'] . "</td>";
										echo "<td>" . $row['communication_address'] . "</td>";
										echo "<td>" . $row['communication_post_office'] . "</td>";
										echo "<td>" . $row['communication_police_station'] . "</td>";
										echo "<td>" . $row['communication_pin'] . "</td>";
										echo "<td>" . $row['mobile'] . "</td>";
										echo "<td>" . $row['phone'] . "</td>";
										echo "<td>" . $row['email'] . "</td>";
									    echo "<td>" . $row['publications_path'] . "</td>";
										echo "<td>" . $row['additional_information'] . "</td>";
										echo "<td>" . $row['declaration'] . "</td>";
										echo "<td>" . $row['photo_path'] . "</td>";
										echo "<td>" . $row['signature_path'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='16'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

	</div>
	<!--end wrapper-->


	<!-- search modal -->

	<!-- end search modal -->

	


	<!--start switcher-->

	<!--end switcher-->


	<?php include "footer.php" ?>