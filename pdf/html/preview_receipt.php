<?php ob_start(); ?>
<style>

*,body{
	font-family: Arial;
}


div.invoice-container{
 border:1px solid black;
 text-align:center;
 width:<?php echo ($action_type == 'mail') ? '100%' : '50%'; ?>;
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
	min-height:60px;

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Concierge Association of India</title>
	</head>
	<body>
				<table width = "<?php echo ($action_type == 'mail') ? '100%' : '50%'; ?>" border = "0" align = "center" cellspacing = "0" cellpadding = "0">
					<tr>
						<td width = "20%"><img width = "100" height= "100" border = "0"  src = "<?php echo $site_url.'uploads/left-img.png'; ?>" ></td>
						<td width = "60%" align = "center">
							<span class = "htitle">LES CLEFS D' OR INDIA</span>
							<div>&nbsp;</div>
							<div class = "hsubtitle bold">"Registered as Concierge Association of India"</div>
						</td>
						<td width = "20%"><img width = "100" height= "100" border = "0"  src = "<?php echo $site_url.'uploads/right-img.png'; ?>" ></td>
					</tr>
				</table>
				<br />
				<table width = "<?php echo ($action_type == 'mail') ? '100%' : '50%'; ?>" border = "0" align = "center"  cellspacing = "0" cellpadding = "0">
					<tr >
						<td align = "center"><span class = "bold">Registered Office : </span>: The Concierge Desk, The Oberoi New Delhi, Dr Zakir Hussain Marg N. Delhi -110003 Telephone No: 011-24304155 / Website: cai.org.in / Regd. No. S37376 of 2000</td>
					</tr>
				</table>
			<br />
			<div class = "invoice-container">
				<div ><span class = "invoice-name">Invoice</span></div>
				<div class = "l-inv-header">
					<div class = "row-underline"><span class = "bold"><?php echo $data[0]['full_name']; ?></span></div>
					<div class = "row-underline"></div>
					<div class = "row-underline"></div>
				</div>
				<div class = "r-inv-header">
					<div class = "row-underline"><span class = "bold">REF No.  </span>&nbsp;<?php echo $data[0]['ref_no']; ?></div>
					<div class = "row-underline"><span class = "bold">REF Date. </span>&nbsp; <?php echo $data[0]['ref_date']; ?></div>
				</div>
				<div class = "clear"></div>
				<table width = "100%" border = "1" align = "center" cellspacing = "0" cellpadding = "0">
					<tr>
						<td width = "5%" valign = "top"><span class = "bold">NO.</span></td>
						<td width = "55%" valign = "top"><span class = "bold">PARTICULARS</span></td>
						<td width = "10%" valign = "top"><span class = "bold">RATE</span></td>
						<td width = "15%" valign = "top"><span class = "bold">QUANTITY</span></td>
						<td width = "15%" valign = "top"><span class = "bold">AMOUNT</span></td>
					</tr>
				</table>
				<table width = "100%" border = "1" align = "center" cellspacing = "0" cellpadding = "7">
					<?php $sum = 0 ; foreach($data as $ky => $dv) { ?>
					<tr>
						<td width = "5%"><?php echo ($ky+1); ?></td>
						<td width = "55%"><?php echo $dv['item_name']; ?></td>
						<td width = "10%"><?php echo $dv['item_price']; ?></td>
						<td width = "15%"><?php echo $dv['item_qty']; ?></td>
						<td width = "15%"><?php echo $dv['item_price'] * $dv['item_qty']; $sum +=  $dv['item_price'] * $dv['item_qty']; ?> </td>
					</tr>
					<?php } ?>

					<tr>
						<td width = "5%"></td>
						<td width = "55%" align = "left"  style = "padding:210px 0px 20px 13px" >
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
						<td width = "10%"></td>
						<td width = "15%" align = "right" valign = "bottom"   ><div style = "font-size: 20px;font-weight:bold">TOTAL&nbsp;&nbsp;</div></td>
						<td width = "15%" align = "left" valign = "bottom"><div style = "font-size: 20px;font-weight:bold;border-top:1px solid black;">&nbsp;&nbsp;<?php echo $sum; ?>&nbsp;/-</div></td>
					</tr>
					<tr >
						<td colspan = "3" ><div class = "row-underline bold" style = "letter-spacing:1px;"><?php echo ucwords(convert_number_to_words($sum)); ?>&nbsp;Rupees Only </div><br /><div style = "font-size:15px;"><?php echo $data[0]['bottom_text']; ?></div></td>
						<td colspan = "2"><br /><br /><hr /><div><img width = "60" height= "60" border = "0"  src = "<?php echo $site_url.'uploads/left-img.png'; ?>"  style = "text-align:center;margin-left:55px;" ></div>
						</td>
					</tr>
				</table>
			</div>
			<br />
			<div>This is a computer generated printout and no signature is required.</div>

	</body>
</html>

	<?php
	$html = ob_get_contents();
	ob_end_clean();
	if($action_type == 'mail'){
		$mpdf=new mPDF();
		if($view_browser == 'view_browser'){
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
		}else{
			$mpdf->WriteHTML(utf8_encode($html));
			//$mpdf->Output($dir.time().'.pdf','F');exit;
			//$mpdf->Output();
			$content = $mpdf->Output('', 'S');
			$content = chunk_split(base64_encode($content));
			$mailto = $mail_to; //Mailto here
			$from_name = 'admin'; //Name of sender mail
			$from_mail = 'admin@admin.com'; //Mailfrom here
			$subject = $mail_subject; 
			$message = $mail_content;
			$filename = "Receipt-".date("d-m-Y_H-i",time()).'.pdf'; //Your Filename with local date and time
			//Headers of PDF and e-mail
			$boundary = "XYZ-" . date("dmYis") . "-ZYX"; 
			$header = "--$boundary\r\n"; 
			$header .= "Content-Transfer-Encoding: 8bits\r\n"; 
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n\r\n"; // or utf-8
			$header .= "$message\r\n";
			$header .= "--$boundary\r\n";
			$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
			$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n";
			$header .= "Content-Transfer-Encoding: base64\r\n\r\n";
			$header .= "$content\r\n"; 
			$header .= "--$boundary--\r\n";
			$header2 = "MIME-Version: 1.0\r\n";
			$header2 .= "From: ".$from_name." \r\n"; 
			$header2 .= "Return-Path: $from_mail\r\n";
			$header2 .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
			$header2 .= "$boundary\r\n";
			mail($mailto,$subject,$header,$header2, "-r".$from_mail);
			$_SESSION['msg'] = 'Mail successfully sent.';
			header('location: index.php?action=list_receipt');
			exit;
		}
	}else{
		echo $html;
	}
	function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}
?>

