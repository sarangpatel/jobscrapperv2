<?php if ( count($languages) > 1 ) { ?>
<link rel="stylesheet" type="text/css" href="extensions/smart_translator/msdropdown/css/msdropdown/dd.css" />
<script type="text/javascript" src="extensions/smart_translator/msdropdown/js/msdropdown/jquery.dd.js"></script>
<link rel="stylesheet" type="text/css" href="extensions/smart_translator/msdropdown/css/msdropdown/flags.css" /> 

<ul class="nav language pull-left notranslate">

<div style="width: 200px; height: 25px; margin-left: 8px; margin-top: 3px">

<!-- Dynamically-generated form -->


        
<script type="text/javascript">
$(document).ready(function(e) {		
	//no use
	
	try {
		var pages = $("#pages").msDropdown(
			{on:{change:function(data, ui) {
					var val = data.value;
					if(val!="")
						window.location = val;
				}}
			}).data("dd");

		var pagename = document.location.pathname.toString();
		pagename = pagename.split("/");
		pages.setIndexByValue(pagename[pagename.length-1]);
		$("#ver").html(msBeautify.version.msDropdown);
	} catch(e) {
		//console.log(e);	
	}
	
	$("#ver").html(msBeautify.version.msDropdown);
		
	//convert
	$("select").msDropdown({roundedBorder:false});
	$("#tech").data("dd");
});
function showValue(h) {
	console.log(h.name, h.value);
}
$("#tech").change(function() {
	console.log("by jquery: ", this.value);
})
//
</script>
    </div>
</ul>


<span class="nturl" href="<?php echo $scheme . '://' . $subdomain . REAL_HOST . $_SERVER['REQUEST_URI']; ?>"></span>

<?php } ?>

