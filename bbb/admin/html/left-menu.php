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
	 <li class="<?php echo ($_REQUEST['action'] == 'create_classroom' || $_REQUEST['action'] == '') ? 'active' : ''; ?>">
		<a href="index.php"><i class="fa fa-fw "></i>Create classroom</a>
	</li>
	 <li class="<?php echo ($_REQUEST['action'] == 'list_classrooms' )  ? 'active' : ''; ?>">
		<a href="index.php?action=list_classrooms"><i class="fa fa-fw "></i>List classrooms</a>
	</li>
</ul>