<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Concierge Association of India</title>
	</head>
	<body>
		<div class = "page">
			<div class = "header">
				<table width = "70%" border = "0" align = "center" cellspacing = "0" cellpadding = "0">
					<tr>
						<td width = "20%">left image</td>
						<td width = "60%" align = "center">
							<span class = "htitle">LES CLEFS D' OR INDIA</span>
							<div>&nbsp;</div>
							<div class = "hsubtitle bold">"Registered as Concierge Association of India"</div>
						</td>
						<td width = "20%">right image</td>
					</tr>
				</table>
				<br />
				<table width = "70%" border = "0" align = "center"  cellspacing = "0" cellpadding = "0">
					<tr >
						<td align = "center"><span class = "bold">Registered Office : </span>: The Concierge Desk, The Oberoi New Delhi, Dr Zakir Hussain Marg N. Delhi -110003 Telephone No: 011-24304155 / Website: cai.org.in / Regd. No. S37376 of 2000</td>
					</tr>
				</table>
			</div>
			<br />
			<div class = "invoice-container">
					<div ><span class = "invoice-name">Invoice</span></div>
					<div class = "l-inv-header">
						<div class = "row-underline"><span class = "bold"><?php echo $data[0]['full_name']; ?></span></div>
						<div class = "row-underline"></div>
						<div class = "row-underline"></div>
					</div>
					<div class = "r-inv-header">
						<div class = "row-underline"><span class = "bold">REF No. : </span><?php echo $data[0]['ref_no']; ?></div>
						<div class = "row-underline"><span class = "bold">REF Date.</span><?php echo $data[0]['ref_date']; ?></div>
					</div>
					<div class = "clear"></div>
					<table width = "100%" border = "1" align = "center" cellspacing = "0" cellpadding = "0">
						<tr>
							<td width = "10%" valign = "top"><span class = "bold">NO.</span></td>
							<td width = "45%" valign = "top"><span class = "bold">PARTICULARS</span></td>
							<td width = "15%" valign = "top"><span class = "bold">RATE</span></td>
							<td width = "15%" valign = "top"><span class = "bold">QUANTITY</span></td>
							<td width = "15%" valign = "top"><span class = "bold">AMOUNT</span></td>
						</tr>
						<?php $sum = 0 ; foreach($data as $ky => $dv) { ?>
						<tr>
							<td width = "10%"><?php echo ($ky+1); ?></td>
							<td width = "45%"><?php echo $dv['item_name']; ?></td>
							<td width = "15%"><?php echo $dv['item_price']; ?></td>
							<td width = "15%"><?php echo $dv['item_qty']; ?></td>
							<td width = "15%"><?php echo $dv['item_price'] * $dv['item_qty']; $sum +=  $dv['item_price'] * $dv['item_qty']; ?> </td>
						</tr>
						<?php } ?>
						<tr>
							<td width = "10%"></td>
							<td width = "45%" align = "left"  style = "padding:5px;" >
								<span class = "bank-details" style = "font-size : 13px;font-weight:bold;">
									<span style = "text-decoration:underline;">Bank details: </span><br />
									Account Name : Les Clefs d' Or India <br />
									Bank Name : State Bank of India <br />
									A/C	No. : 00032674066401 <br />
									CIF No. : 86524514332 / Swift Code : SBININBB364 <br />
									IFS Code : SBIN0006945 / MICR Code : 400002062 <br />
								</span>
								<div style = "font-size: 10px;color:blue;">Note:Cheque / Draft / Pay Order  to be drawn in favor of  "Les Clefs d' or India" </div>
								<div style = "font-size: 13px;font-weight:bold">Pan No. AAAAL6492N </div>
							</td>
							<td width = "15%"></td>
							<td width = "15%" align = "right" valign = "bottom"   ><div style = "font-size: 20px;font-weight:bold">TOTAL&nbsp;&nbsp;</div></td>
							<td width = "15%" align = "left" valign = "bottom"><div style = "font-size: 20px;font-weight:bold;border-top:1px solid black;">&nbsp;&nbsp;<?php echo $sum; ?>/-</div></td>
						</tr>
						<tr >
							<td colspan = "3" ><div class = "row-underline">Rs.</div></td>
							<td colspan = "2"><br /><br /><br /> <hr /><div class = "bold" >Authoried Signatory</div></td>
						</tr>
					</table>
				</div>


		</div><!-- page -->
	</body>
</html>

<style>

*,body{
	font-family: Arial;
}




div.invoice-container{
 border:1px solid black;
 text-align:center;
 width:70%;
 border:2px solid black;
 margin: 0 auto;
 min-height: 120px;
}

div.l-inv-header{
	width:49%;
	border-right:2px solid black;
	/*border-bottom:2px solid black; */
	float:left;
	text-align:left;
	min-height:50px;

}

div.r-inv-header{
	width:49%;
	float:right;
	text-align:left;
}


div.row-underline{
	text-decoration:underline;
	padding: 5px 0px 5px 15px;
}


span.invoice-name {
	color: #ffffff;
	font-size: 22px;
	background-color:#4641D8;
}

span.htitle{
	font-size: 30px;
	text-decoration: underline;
	color: #4641D8;
}
div.hsubtitle{
}

.bold{
font-weight:bold;
}

.clear{
 clear:both;
}

</style>