<ul class="nav navbar-nav side-nav">
	<!-- <li class="active">
	<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Manage Quiz <i class="fa fa-fw fa-caret-down"></i></a>
	<ul id="demo" class="collapse">
	<li>
	<a href="#">Add Quiz</a>
	</li>
	<li>
	<a href="#">List Quiz</a>
	</li>
	</ul>
	</li>
	-->
	 <li class="<?php echo $_REQUEST['action'] == 'add_receipt' ? 'active' : ''; ?>">
		<a href="index.php?action=add_receipt"><i class="fa fa-fw "></i>Add Invoice</a>
	</li>
	 <li class="<?php echo ($_REQUEST['action'] == 'list_receipt' || $_REQUEST['action'] == '' || $_REQUEST['set_login'] == '' )  ? 'active' : ''; ?>">
		<a href="index.php?action=list_receipt"><i class="fa fa-fw "></i>List Invoice</a>
	</li>
	 <li>
		<a href="index.php?action=logout"><i class="fa fa-fw "></i>Logout</a>
	</li>

</ul>