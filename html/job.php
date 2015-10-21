<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Job Details</title>
		<link rel="stylesheet" href="./job-data_files/styles.css">
		<script src="./job-data_files/jquery-1.11.3.min.js"></script>
		<script src="./job-data_files/highcharts.js"></script>
		<script src="./job-data_files/exporting.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
		<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>




		
	</head>
	<body>
		<header>
			<div class="max-width-container">
				<h3>Jobs</h3>
			</div>
		</header>
		<h2>Jobs</h2>


		
		
		<div class="container">
			<!-- <div style = "text-align:right">
				Select Company : <select name = "site_id"  onchange = "window.location.href = this.value">
					<?php $sel = ''; $found = 0 ; foreach($sites as $sitedata){ ?>
						<?php if($_GET['site_id'] == $sitedata['id'] && !$found){$sel = 'selected'; $found = 1; } ?>
						<option <?php echo $sel; $sel= ''; ?> value = "index.php?action=job&site_id=<?php echo $sitedata['id']; ?>"><?php echo $sitedata['site_url']; ?></option>
					<?php } ?>
				</select>
			</div>
			 -->
			 <br />
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Opening</th>
						<th>Company URL</th>
						<th>Duration</th>
					</tr>
				</thead>
		 
				<tfoot>
					<tr>
						<th>Opening</th>
						<th>Company URL</th>
						<th>Duration</th>
					</tr>
				</tfoot>
		 
			</table>
		</div>
		<script>

			$(document).ready(function() {
				$('#example').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "index.php?action=ajax_table",
						"data": function ( d ) {
							//d.myKey = "myValue";
							// d.custom = $('#myInput').val();
							// etc
						}
					}
				} );
			});

		</script>

		</script>

	</body>
</html>