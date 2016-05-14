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
                <a class="navbar-brand" href="#">Conference</a>
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
                            Create Classroom
                            <small>(Create classroom and invite students)</small>
                        </h1>
                <div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>

                    <div class="col-lg-12">
							<?php if(!empty($success_meeting_id)){ ?>
							<div>
								<div class="form-group">
									<label>Invite Students by below url</label>
									<textarea  id= "name" class="form-control"><?php echo $front_end_url."frontend.php?action=invite&meeting_id=$success_meeting_id"; ?></textarea>
								</div>
								<div class="form-group">
									<label> Join by clicking URL </label>
									<a href = '<?php echo "index.php?action=join&meeting_id=$success_meeting_id&type=moderator&name=$admin_name" ; ?>' target = "_blank">Join Classroom</a>
								</div>
							</div>
							<?php }else{ ?>
							<form role="form" id = "quizForm" method = "POST">
								<div class="form-group">
									<label>Classroom Name</label>
									<input name = "name"  id= "name" class="form-control">
									<!-- <p class="help-block">Enter quiz name above</p>
 -->							</div>
 								<div class="form-group">
									<label>Moderator Name</label>
									<input name = "admin_name"  id= "admin_name" class="form-control">
									<!-- <p class="help-block">Enter quiz name above</p>
 -->							</div>
								<input type="hidden" name="action" value="create_classroom" />
								<button type="submit" class="btn btn-default">Create Classroom</button>
							</form>
							<?php } ?>
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
	<script type = "text/javascript" src = "js/jquery.validate.js"></script>
<script>
$().ready(function() {
		// validate the comment form when it is submitted
	$( "#quizForm" ).validate({
		rules: {
			name: {
			  required: true
			},
			admin_name: {
			  required: true
			}
		},
		messages: {
			name:  "Please enter classroom name",
			admin_name:  "Please enter moderator name"

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