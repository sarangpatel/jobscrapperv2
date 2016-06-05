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
                            Edit Invoice
                            <!-- <small>Subheading</small>
 -->                       </h1>
					<div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="col-lg-6">
							<?php //echo '<PRE>';print_r($data); ?>
							<form role="form" id = "quizForm" method = "POST">
								<div class="form-group">
									<label>Full Name</label>
									<input name = "full_name"  id= "full_name" class="form-control " value = "<?php echo $data[0]['full_name']; ?>" >
									<p class="help-block">Enter full name and address( Mr. XXX XXXXX and address)</p>
								</div>
								<!-- <div class="form-group">
									<label>Ref No.</label>
									<input name = "ref_no"  id= "ref_no" class="form-control">
								</div> -->
								<div class="form-group">
									<label>Ref Date.</label>
									<input name = "ref_date"  id= "ref_date" class="form-control date-picker" value = "<?php echo $data[0]['ref_date']; ?>">
									<p class="help-block">Ex : 2016-02-12 ( YYYY-MM-DD )</p>
								</div>
								<div class="form-group">
									<label>Bottom Text</label>
									<input name = "bottom_text"  id= "bottom_text" class="form-control date-picker validate-field" value = "<?php echo $data[0]['bottom_text']; ?>" >
									<p class="help-block"></p>
								</div>
								<input type="hidden" name="action" value="save_receipt" />
								<input type="hidden" name="invoice_id" value="<?php echo $data[0]['id']; ?>" />

								<div class="form-group">
									<label style = "font-size:20px;">Particulars <!-- | <a href="#" id="addScnt" >Add more</a> --></label>
								</div>
								<div  id = "p_scents">
									<?php foreach($data as $ky => $d){ ?>
										<div class = "rw">
											<div class="form-group">
												<label>Item Name <?php echo $ky+ 1 ; ?></label>
												<input name = "item_name[]"  id= "item_name" class="form-control" value = "<?php echo $d['item_name']; ?>" >
											</div>
											<div class="form-group">
												<label>Item Quantity <?php echo $ky+ 1 ; ?></label>
												<input name = "item_qty[]"  id= "item_qty" class="form-control num" value = "<?php echo $d['item_qty']; ?>" >
											</div>
											<div class="form-group">
												<label>Item Price <?php echo $ky+ 1 ; ?></label>
												<input name = "item_price[]"  id= "item_price" class="form-control num" value = "<?php echo $d['item_price']; ?>" >
											</div>
										</div>
									<?php }  ?>
								</div>
								<button type="submit" class="btn btn-default">Submit Button</button>
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
			full_name: {
			  required: true
			},
			/*ref_no: {
			  required: true
			},*/
			ref_date: {
			  required: true
			}
		},
		messages: {
			full_name:  "Please enter full name",
			ref_no:  "Please enter ref no.",
			ref_date:  "Please enter ref date",
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
	$(".validate-field").rules("add",{
		required:true,
		messages: {
			required: "Please enter text",
		}
	});


});


$(function() {
		var scntDiv = $('#p_scents');
		$('#addScnt').on('click', function(evt) {
				evt.preventDefault();
				var i = $('div.rw').length;
				console.log(i);
				$('<div class = "rw remove' + i  +  '"><div class="form-group"><label>Item Name | <a href="#" id="remScnt" class = "anc-' + i + '" >Remove</a></label><input name = "item_name[]"  id= "item_name" class="form-control validate-field"></div><div class="form-group"><label>Item Quantity</label><input name = "item_qty[]"  id= "item_qty" class="form-control validate-field"></div><div class="form-group"><label>Item Price</label><input name = "item_price[]"  id= "item_price" class="form-control validate-field"></div></div>').appendTo(scntDiv);
				return false;
		});
		
		$(document).on('click','#remScnt' , function(evt) {
				evt.preventDefault();
				console.log($(this).parent().parent().parent());
				$(this).parent().parent().parent().remove();

				return false;
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