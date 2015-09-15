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

	</head>
	<body>
		<header>
			<div class="max-width-container">
				<h3>Job Detail</h3>
			</div>
		</header>
		<?php $category = ''; $data = ''; foreach($site_jobs['site_data']['activity_data'] as $day => $aV){ 
			$category.= "'" . $day."',";
			$data.= $aV.",";
		 }
		 $category = rtrim($category,',');
 		 $data = rtrim($data,',');
		 ?>
		<div class="max-width-container">
			<div class="container">
				<h1>Company</h1>
				<ul id="small-details">
					<li><a href="<?php  echo $site_jobs['site_data']['site_url']; ?>" target="_blank"><?php echo $site_jobs['site_data']['site_url']; ?></a></li>
					<!-- <li>Mountain View, CA</li>
					<li>Founded 2000</li>
					<li>1000-5000 employees</li>
 -->				</ul>
			</div>
			<h2>JOBS</h2>
			<div class="details-container">
				<!-- ***** CHART ***** -->
				<div class="ind-details-container whole">
					<div class="actual-details-container">
						<div class="box-heading">Recent Jobs Activity</div>

						<div id="tabs">
							  <ul>
								<li><a href="#tabs-1">Open Jobs Graph</a></li>
								<li><a href="#tabs-2">Closed Jobs Graph</a></li>
							  </ul>
							  <div id="tabs-1">
								<div id = "open-jobs"></div>
							  </div>
							  <div id="tabs-2">
								<div id = "closed-jobs"></div>
							  </div>
						</div>

						<div id=  "container"></div>
					</div>
				</div>
			</div>
			<table>
				<tbody>
					<tr class="table-heading">
						<th>Opening</th>
						<th>Location</th>
						<th>Duration</th>
					</tr>
					<?php foreach($site_jobs['site_data']['job_data'] as $job){ ?>
					<tr>
						<?php
							$url_cmp = parse_url($job['job_url']);
							if(empty($url_cmp['host'])){
								$job_url_cmp = parse_url($site_jobs['site_data']['job_url']);
								$job['job_url'] = '//' . $job_url_cmp['host'].'/'. $url_cmp['path']. '?' . $url_cmp['query'];
							}
						?>
						<td><a href="<?php echo $job['job_url']; ?>" target="blank"><?php echo $job['job_title']; ?></a></td>
						<td>--</td>
						<td><?php echo $job['job_duration']; ?></td>
					</tr>
					<?php }  ?>
				</tbody>
			</table>
			<div class="details-container">
				<!-- ***** # OF OPENINGS ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading"># of Openings</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** CAREERS URL ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Careers URL</div>
						<div class="box-content"><a href="<?php echo $site_jobs['site_data']['job_url']; ?>" target="blank"><?php echo $site_jobs['site_data']['job_url']; ?></a></div>
					</div>
				</div>
				<!-- ***** ATS ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">ATS</div>
						<div class="box-content">none</div>
					</div>
				</div>
				<!-- ***** RECRUITING EMAIL ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Recruiting Email</div>
						<div class="box-content"><?php echo empty($site_jobs['site_data']['job_email']) ? '' : $site_jobs['site_data']['job_email']; ?></div>
					</div>
				</div>
			</div>
			<h2>COMPANY</h2>
			<div class="details-container">
				<!-- ***** Description ***** -->
				<div class="ind-details-container whole">
					<div class="actual-details-container">
						<div class="box-heading">Company Description</div>
						<div class="box-content">lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum lorem epsum </div>
					</div>
				</div>	
				<!-- ***** WEBSITE ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Website</div>
						<div class="box-content"><a href="<?php echo $site_jobs['site_data']['site_url']; ?>" target="blank"><?php echo $site_jobs['site_data']['site_url']; ?></a></div>
					</div>
				</div>
				<!-- ***** HEADQUARTERS ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Headquarters</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** YEAR FOUNDED ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Year Founded</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** SIZE ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading"># of Employees</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** EMAILS ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Email(s)</div>
						<div class="box-content"><?php echo empty($site_jobs['site_data']['contact_email']) ? '' : $site_jobs['site_data']['contact_email']; ?></div>
					</div>
				</div>
				<!-- ***** PHONE NUMBER ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Phone</div>
						<div class="box-content">NA</div>
					</div>
				</div>
			</div>
			<h2>SOCIAL</h2>
			<div class="details-container">
				<!-- ***** LINKEDIN ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Linkedin</div>
						<div class="box-content">
						<?php if(!empty($site_jobs['site_data']['linkedin'])) { ?>
						<a href="<?php echo empty($site_jobs['site_data']['linkedin']) ? '#' : $site_jobs['site_data']['linkedin']; ?>" target="blank"><?php echo empty($site_jobs['site_data']['linkedin'])? 'NA': $site_jobs['site_data']['linkedin']; ?></a>
						<?php }else {echo 'NA';} ?>
						</div>
					</div>
				</div>
				<!-- ***** FACEBOOK ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Facebook</div>
						<div class="box-content">
							<?php if(!empty($site_jobs['site_data']['facebook'])) { ?>
							<a href="<?php echo empty($site_jobs['site_data']['facebook'])? '#' : $site_jobs['site_data']['facebook']; ?>" target="blank"><?php echo empty($site_jobs['site_data']['facebook']) ? 'NA' : $site_jobs['site_data']['facebook']; ?></a>
						<?php }else {echo 'NA';} ?>
						</div>
					</div>
				</div>
				<!-- ***** TWITTER ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Twitter</div>
						<div class="box-content">
						<?php if(!empty($site_jobs['site_data']['twiiter'])) { ?>
						<a href="<?php echo empty($site_jobs['site_data']['twitter'])? '#' : $site_jobs['site_data']['twitter']; ?>" target="blank"><?php echo empty($site_jobs['site_data']['twitter'])? 'NA' : $site_jobs['site_data']['twitter']; ?></a>
						<?php }else {echo 'NA';} ?>
						</div>
					</div>
				</div>
				<!-- ***** YELP ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Yelp</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** GLASSDOOR ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">Glassdoor</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** AngelList ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">AngelList</div>
						<div class="box-content">NA</div>
					</div>
				</div>
				<!-- ***** Crunchbase ***** -->
				<div class="ind-details-container">
					<div class="actual-details-container">
						<div class="box-heading">CrunchBase</div>
						<div class="box-content">NA</div>
					</div>
				</div>
			</div>
		</div>
		<script>

		$(document).ready(function(){
		$(function() {
			$( "#tabs" ).tabs();
		});




		$(function () {
			  $('#open-jobs').highcharts({
				  chart: {
					  type: 'area'
				  },
				  exporting: { enabled: false },
				  legend: {
				  enabled: false
			  },
				  colors: ['#D65110', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6'],
				  title: {
					  text: ''
				  },
				  xAxis: {
					allowDecimals:false,
						  min: .5,
						  max: 5.5,
					categories: [<?php echo $category; ?>],
					},
				  yAxis: {
				  gridLineWidth: 0,
				  minorGridLineWidth: 0,
				  title: {text: ''},
					
				  labels: {
					  enabled: false
				  }
			  },
				  credits: {
					  enabled: false
				  },
				  plotOptions: {
					  series: {
						  stacking: 'normal'
					  }
				  },
				  series: [{
					  name: '',
					  data: [<?php echo $data; ?>]
				  }]
			  });
		});


		$(function () {
			  $('#closed-jobs').highcharts({
				  chart: {
					  type: 'area'
				  },
				  exporting: { enabled: false },
				  legend: {
				  enabled: false
			  },
				  colors: ['#D65110', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6'],
				  title: {
					  text: ''
				  },
				  xAxis: {
					allowDecimals:false,
						  min: .5,
						  max: 5.5,
					categories: [<?php echo $category; ?>],
					},
				  yAxis: {
				  gridLineWidth: 0,
				  minorGridLineWidth: 0,
				  title: {text: ''},
					
				  labels: {
					  enabled: false
				  }
			  },
				  credits: {
					  enabled: false
				  },
				  plotOptions: {
					  series: {
						  stacking: 'normal'
					  }
				  },
				  series: [{
					  name: '',
					  data: [<?php echo $data; ?>]
				  }]
			  });
		});







			$(function () {
			      $('#container').highcharts({
			          chart: {
			              type: 'area'
			          },
			          exporting: { enabled: false },
			          legend: {
			          enabled: false
			      },
			          colors: ['#D65110', '#AF7F24', '#263249', '#5F7F90', '#D9CDB6'],
			          title: {
			              text: ''
			          },
			          xAxis: {
			            allowDecimals:false,
			                  min: .5,
			                  max: 5.5,
			            categories: [<?php echo $category; ?>],
			            },
			          yAxis: {
			          gridLineWidth: 0,
			          minorGridLineWidth: 0,
			          title: {text: ''},
			            
			          labels: {
			              enabled: false
			          }
			      },
			          credits: {
			              enabled: false
			          },
			          plotOptions: {
			              series: {
			                  stacking: 'normal'
			              }
			          },
			          series: [{
			              name: '',
			              data: [<?php echo $data; ?>]
			          }]
			      });
			  });
		});
			  
		</script>
	</body>
</html>