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
                <a class="navbar-brand" href="#">Photo Quiz</a>
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
                            List Users
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
											<th>Facebook ID</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Email</th>
											<th>Added on</th>
											</tr>
									</thead>
									<tbody>
										<?php
										while ($row = mysql_fetch_assoc($result)) { ?>
											<tr>
												<td><?php echo $row['facebook_id'];?></td>
												<td><?php echo $row['name'];?></td>
												<td><?php echo $row['gender'];?></td>
												<td><?php echo $row['email'] == 'undefined' ? 'NA' : $row['email'];?></td>
												<td><?php echo $row['added_on'];?></td>
											</tr>
										<?php } mysql_free_result ($result); ?>
									</tbody>
								</table>
							</div>
						</div><!-- col-lg-6 -->
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