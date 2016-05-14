<?php require_once($dir.'html/header.php'); ?>
<body>

    <div id="wrapper" style = "padding:0px;margin:0px;">


        <div id="page-wrapper" >
		
      <form class="form-signin" method = "POST" >
        <h2 class="form-signin-heading">Please Login</h2>
        <label for="inputEmail" class="sr-only">username</label>
        <input type="text" id="inputEmail" name = "username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name = "password" class="form-control" placeholder="Password" required>
        <input type="hidden" name = "action" value = "set_login" />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

	
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