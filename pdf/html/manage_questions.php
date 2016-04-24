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
                            Manage Questions
                            <!-- <small>Subheading</small>
 -->                        </h1>
					
					<div class="row">
						<?php if(!empty($_SESSION['msg'])) { ?>
		                <div class="alert alert-success">
								<?php echo $_SESSION['msg']; ?>
				        </div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="col-lg-6">
							<form role="form" id = "questionForm" method = "POST"     enctype="multipart/form-data">
								<div class="form-group">
									<label>Question</label>
									<input name = "q_name"  id= "name" class="form-control">
								</div>
								<div class="form-group">
									<label>Upload Photo</label>
									<input type="file" name = "photo">
								</div>
 								<div class="form-group">
									<label>Add Answers</label>
								</div>
								<div class="form-group">
									<label>Answer 1</label>
									<input name = "answer1"  class="form-control answers" >
								</div>
								<div class="form-group">
									<label>Answer 2</label>
									<input name = "answer2"   class="form-control answers">
								</div>
								<div class="form-group">
									<label>Answer 3</label>
									<input name = "answer3"  class="form-control answers">
								</div>
								<div class="form-group">
									<label>Answer 4</label>
									<input name = "answer4"  class="form-control answers">
								</div>
								<div class="form-group">
									<label>Correct Answer</label>
									<select name = "correct_answer"  class="form-control">
										<option value = "">--Choose Answer--</option>
										<option value = "0">Answer 1</option>
										<option value = "1">Answer 2</option>
										<option value = "2">Answer 3</option>
										<option value = "3">Answer 4</option>
									</select>
								</div>
								<input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>" />
								<input type="hidden" name="action" value="save_questions" />
								<button type="submit" class="btn btn-default">Save Question</button>
							</form>
						</div>
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>Question Name</th>
											<th>Photo</th>
											<th>Added on</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row = mysql_fetch_assoc($result)) { ?>
											<tr>
												<td><?php echo $row['q_name'];?></td>
												<td><img src ="<?php echo $site_url.  $row['photo'] ;?>" border = 0 width = "80" height = "80" ></td>
												<td><?php echo $row['added_on'];?></td>
												<td><!-- <a href = "index.php?action=manage_questions&id=<?php echo $row['id']; ?>&quiz_id=<?php echo $quiz_id; ?>">Edit</a> | --> <a href = "index.php?action=delete_question&id=<?php echo $row['id']; ?>&quiz_id=<?php echo $quiz_id; ?>">Delete</a> </td>
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
	<script type = "text/javascript" src = "js/jquery.validate.js"></script>
<script>
$().ready(function() {
		// validate the comment form when it is submitted
	$( "#questionForm" ).validate({
		rules: {
			q_name: {
			  required: true
			},
			"photo" :{
				  required:true
			},
			"answer1": {
			  required: true
			},
			"answer2": {
			  required: true
			},
			"answer3": {
			  required: true
			},
			"answer4": {
			  required: true
			},
			correct_answer: {
			  required: true
			}
		},
		messages: {
			q_name:  "Please enter question name",
			"photo" : "Please choose photo",
			"answer1":  "Please enter answer1",
			"answer2":  "Please enter answer2",
			"answer3":  "Please enter answer3",
			"answer4":  "Please enter answer4",
			"correct_answer" : "Please choose answer"
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


$('.answers').keypress(function(e){
	//console.log(e.which)
	if(String.fromCharCode(e.which) == ';')return false;
  /*  if(e.which === 13){
        return false;
    }*/
});
</script>
<style>
.error{
	color:red;
}
</style>

</body>
</html>