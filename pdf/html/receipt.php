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
                <a class="navbar-brand" href="#">Invoice Manager</a>
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
						Receipts | <a href = "index.php?action=create_receipt&invoice_id=<?php echo $invoice_id; ?>" >Generate receipt</a>
					</h1>
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
											<th>Invoice No.</th>
											<th>Name</th>
											<th>Amount</th>
											<th>Added on</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$rw = 0;
										while ($row = mysql_fetch_assoc($result)) { $rw += 1; ?>
											<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo (5000 +	 $row['invoice_id']); ?></td>
												<td><?php echo $row['full_name']; ?></td>
												<td><?php echo $row['amount']; ?></td>
												<td><?php echo $row['added_on'];?></td>
												<td><a target = "_blank" href = "index.php?action=generate_pdf_receipt&invoice_id=<?php echo $row['invoice_id']; ?>&id=<?php echo $row['id']; ?>">Generate PDF</a> | <a  href = "index.php?action=mail_pdf_receipt&invoice_id=<?php echo $row['invoice_id']; ?>&id=<?php echo $row['id']; ?>">Mail PDF</a></td>
											</tr>
										<?php } mysql_free_result ($result); ?>
									</tbody>
								</table>
								<?php if($rw < 1)echo 'No Records found.';   ?>

							</div>
						</div>
					</div><!--- row -->
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