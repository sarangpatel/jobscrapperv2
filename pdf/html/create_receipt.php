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
						Generate Receipt
					</h1>
					<div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="col-lg-6">
							<form role="form" id = "quizForm" method = "POST">
								<div class="form-group">
									<label>Name</label>
									<input name = "full_name"  id= "full_name" class="form-control">
									<input name = "invoice_id"   class="form-control" type = "hidden" value = "<?php echo $invoice_id; ?>" >
								</div>
								<div class="form-group">
									<label>Amount</label>
									<input name = "amount"  id= "amount" class="form-control num">
									<p class="help-block"></p>
								</div>
								<div class="form-group">
									<label>by Cash/Cheque/Draft No.</label>
									<input name = "payment_mode_no"  id= "payment_mode_no" class="form-control">
									<p class="help-block"></p>
								</div>
								<input type="hidden" name="action" value="generate_receipt" />
								<button type="submit" class="btn btn-default">Submit</button>
							</form>
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

	<script type = "text/javascript" src = "js/jquery.validate.js"></script>
<script>
$().ready(function() {

 $('.num').keypress(function(event){
	   if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
		   event.preventDefault(); //stop character from entering input
	   }
 });

		// validate the comment form when it is submitted
	$( "#quizForm" ).validate({
		rules: {
			full_name: {
			  required: true
			},
			amount: {
			  required: true
			},
			payment_mode_no: {
			  required: true
			}
		},
		messages: {
			full_name:  "Please enter full name",
			amount:  "Please enter amount",
			payment_mode_no:  "Please enter payment mode",
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