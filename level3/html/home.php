<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Job Scraper</title>
</head>
<style>
div.title{
	font-size:20px;
	font-weight:bold;
}
div.acenter{
	margin:10% auto;
	width:33%;
	border:1px solid gray;
	padding:41px;
	background-color:#F8FDFD;
}

input[type="text"]{
	padding:6px;
	width:97%;
	border:1px solid #c1c1c1;
}

input[type="submit"],input[type="button"]{
	padding:6px;
	width:30%;
	cursor:pointer;
}

.err_msg{
	color:red;
	font-size:20px;
	padding:2px;
}
.small{
	font-size:12px;
}
</style>

<body>
	<div id="content" class = "acenter">
		<div class = "title">Job Scraper</div>
		<div>&nbsp;</div>
		<div>
			<form method = "POST" id = "form-scraper">
				<div>Enter URL :</div>
				<!-- <div><input type = "text"  name = "url" value = "https://www.dropbox.com/jobs/all" /></div>
 -->				<div><input type = "text" id = "url" name = "url" value = "https://www.airbnb.com/careers/" /></div>
				<div class = "err_msg" style = "display:none"></div>
				<!-- <div>&nbsp;</div>
				<div>Select Level:	<span class = "small"></span></div>
				<div>
					<select name = "level_deep">
						<option value = "1">1 level deep</option>
						<option value = "2">2 level deep</option>
						<option value = "3">3 level deep</option>
						<option value = "4">4 level deep</option>
						<option value = "5">5 level deep</option>
					</select>
				</div> -->
				<div>&nbsp;</div>
				<div><input type = "submit" value = "Scrape" name = "submit" /> &nbsp; <input type = "button" value = "Reset" name = "reload_page" onclick = "location.reload(true)" /></div>
				<input type = "hidden" value = "scrape" name = "action" />
				<div>&nbsp;</div>
				<div id = "scrap_urls"></div>
			</form>
		</div>
	</div>
</body>
</html>

<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script>
$( "#form-scraper" ).submit(function( event ) {

	if($.trim($('input[name="url"]').val()) != ''){
		$('input[name="submit"]').val('Please wait...');
		$('input[name="submit"]').attr('disabled',true);
		if($('input[name="action"]').val() == 'scrape'){
			$('#scrap_urls').html('');
			var urlVal = $('#url').val();
			var posting = $.post( 'basic_depth.php', { action: 'scrape' , url : urlVal} );
			// Put the results in a div
			posting.done(function( data ) {
				$( "#scrap_urls" ).empty().append( data);
				$('input[name="action"]').val('proceed');
				$('input[name="submit"]').val('Proceed');
				$('input[name="submit"]').attr('disabled',false);
			});
			return false;
		}
	}else{
		$('.err_msg').html('Please enter URL.');
		$('.err_msg').show();
		return false;
	}
});
</script>