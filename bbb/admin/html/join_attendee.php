<?php require_once($dir.'admin/html/header_frontend.php'); ?>
<body>
    <div id="wrapper" style = "padding-left:0px;">
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
                <a class="navbar-brand" href="#">Join Classroom</a>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Join Classroom
                        </h1>
					<div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="col-lg-12">
							<?php if(!empty($meeting_id)){ ?>
								<form role="form" id = "quizForm" method = "POST">
									<div class="form-group">
										<label>Enter full name</label>
										<input name = "name"  id= "name" class="form-control">
										<!-- <p class="help-block">Enter quiz name above</p> -->
									</div>
									<input type="hidden" name="meeting_id" value="<?php echo $meeting_id; ?>" />
									<input type="hidden" name="action" value="join" />
									<button type="submit" class="btn btn-default">Join Classroom</button>
								</form>
							<?php } ?>
						</div><!-- col-lg-12 -->
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
    <script src="admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/js/bootstrap.min.js"></script>

	<script type = "text/javascript" src = "admin/js/jquery.validate.js"></script>
	<script>
	$().ready(function() {
		// validate the comment form when it is submitted
	$( "#quizForm" ).validate({
		rules: {
			name: {
			  required: true
			}
		},
		messages: {
			name:  "Please enter full name."

		},
		submitHandler: function(form){
			if ($(form).valid()) {
				form.submit(); 
			}else{
				alert('notvaid');
				return false; // prevent normal form posting
			}
		}

	});

	});
	</script>
	<style>
	.error{
		color:red;
	}
	</style>
</body>
</html>