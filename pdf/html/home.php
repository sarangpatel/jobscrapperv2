<?php require_once($dir.'html/header.php'); ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Receipt Manager</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
				<?php require_once($dir . 'html/left-menu.php'); ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
	                  <div class="col-lg-12">
                        <h1 class="page-header">
                            List Receipt
                            <!-- <small>Subheading</small>
 -->                        </h1>
                <div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>

						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>Receipt No.</th>
											<th>Name</th>
											<th>Added on</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row = mysql_fetch_assoc($result)) { ?>
											<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo (50000 +	 $row['id']); ?></td>
												<td><?php echo $row['full_name']; ?></td>
												<td><?php echo $row['added_on'];?></td>
												<!-- <td><a href = "index.php?action=manage_questions&quiz_id=<?php echo $row['quiz_id']; ?>">Manage Questions</a> | <a href = "index.php?action=delete_quiz&quiz_id=<?php echo $row['quiz_id']; ?>">Delete</a> | <a href = "index.php?action=quiz_actdeact&quiz_id=<?php echo $row['quiz_id']; ?>&status=<?php echo $row['status']? '0' : '1'; ?>"><?php echo $row['status'] ? 'Deactivate' : 'Activate'; ?></a></td> -->
												<td><!-- <a href = "index.php?action=delete_receipt&rec_id=<?php echo $row['id']; ?>">Delete</a> |  -->	<a target = "_blank" href = "index.php?action=preview_receipt&receipt_id=<?php echo $row['id']; ?>">Preview Receipt</a> | <a  href = "index.php?action=send_receipt&receipt_id=<?php echo $row['id']; ?>">Mail Receipt</a> | <a  target = "_blank" href = "index.php?action=view_pdf&receipt_id=<?php echo $row['id']; ?>">View PDF</a> 
												</td>
											</tr>
										<?php } mysql_free_result ($result); ?>
									</tbody>
								</table>
							</div>
						</div>
                </div>
                <!-- /.row -->


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>