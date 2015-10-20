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
				<h3>Sites</h3>
			</div>
		</header>
		<h2>Site Job Count</h2>
		<div class="container">
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Site ID</th>
						<th>Site URL</th>
						<th>Open Jobs</th>
						<th>New Jobs</th>
						<th>Closed Jobs</th>
						<th>Scraped on</th>
					</tr>
				</thead>
		 
				<tfoot>
					<tr>
						<th>Site ID</th>
						<th>Site URL</th>
						<th>Open Jobs</th>
						<th>New Jobs</th>
						<th>Closed Jobs</th>
						<th>Scraped on</th>
					</tr>
				</tfoot>
		 
				<tbody>
					<?php foreach($sites as $site) { ?>
					<tr>
						<td><?php echo $site['id']; ?></td>
						<td><a href = "index.php?site_url=<?php echo $site['site_url']; ?>"  target = "_blank"><?php echo $site['site_url']; ?></a></td>
						<td><?php echo !empty($sites_job_count[$site['id']]) ?  $sites_job_count[$site['id']]['open_jobs'] : 'NA' ;?></td>
						<td><?php echo !empty($sites_job_count[$site['id']]) ?  $sites_job_count[$site['id']]['new_jobs'] : 'NA' ;?></td>
						<td><?php echo !empty($sites_job_count[$site['id']]) ?  $sites_job_count[$site['id']]['expired_jobs'] : 'NA' ;?></td>
						<td><?php echo !empty($sites_job_count[$site['id']]) ?  $sites_job_count[$site['id']]['recorded_on'] : 'NA' ;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<script>

		$(document).ready(function(){
			$('#example').DataTable( {"iDisplayLength": 200});
		});

		</script>

	</body>
</html>