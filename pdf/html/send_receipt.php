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
                            Send Receipt 
                            <!-- <small>Subheading</small>
 -->                        </h1>
					<div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="col-lg-6">
							<form role="form" id = "quizForm" method = "POST">
								<div class="form-group">
									<label>Send receipt From</label>
									<input name = "from"  id= "from" class="form-control">
									<p class="help-block">abc@xyz.com</p>
								</div>
								<div class="form-group">
									<label>Send receipt To</label>
									<input name = "email"  id= "email" class="form-control">
									<p class="help-block">abc@xyz.com</p>
								</div>
								<div class="form-group">
									<label>Mail Subject</label>
									<input name = "subject"  id= "subject" class="form-control">
								</div>
								<div class="form-group">
									<label>Mail Description</label>
									<textarea name = "description"  id= "description" class="form-control"></textarea>
								</div>
								<input type="hidden" name="receipt_id" value="<?php echo $receipt_id; ?>" />
								<input type="hidden" name="action" value="mail_receipt" />
								<button type="submit" class="btn btn-default">Send Mail</button>
							</form>
						</div>
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

//$(".date-picker").datetimepicker();


 $('.num').keypress(function(event){
	   if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
		   event.preventDefault(); //stop character from entering input
	   }
 });

		// validate the comment form when it is submitted
	$( "#quizForm" ).validate({
		rules: {
			from:{
			  required: true
			},
			email: {
			  required: true
			},
			subject: {
			  required: true
			},
			description: {
			  required: true
			}
		},
		messages: {
			from:  "Please enter from.",
			email:  "Please enter email.",
			subject:  "Please enter subject.",
			description:  "Please enter mail content",
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