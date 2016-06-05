<?php error_reporting(1); ini_set('display_errors',0); ob_start(); ?>
<style>
*,body{
	font-family: Arial;
}

span.htitle{
	font-size: 30px;
	text-decoration: underline;
	color: #4641D8;
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
		<table width = "100%" border = "1" align = "center" cellspacing = "0" cellpadding = "0" style = "padding:0px; margin:0px;" >
			<tr>
				<td width = "80%" align = "left" style = "border:none;">
					<table border = "0" cellspacing = "0" cellpadding = "0" width = "100%" >
						<tr style  = "text-align:center;">
						<td width = "20%" valign = "top"><img width = "70" height= "70" border = "0"  valign = "top" src = "<?php echo $site_url.'uploads/left-img.png'; ?>" ></td>
						<td width = "60%" align = "left">
							<span class = "htitle" style = "font-size:19px;" >CONCIERGE ASSOCIATION OF INDIA <br /></span>
							<div style = "font-size:18px;font-weight:bold;text-align:center" > ( Les Clefs d' Or India ) </div>
						</td>
						<td width = "20%" valign = "top"><img width = "70" height= "70" border = "0"  valign = "top" src = "<?php echo $site_url.'uploads/right-img.png'; ?>" ></td>
					</table>
				</td>
				<td width = "20%" valign = "top" style = "marign:0px;"> 
					<table cellpadding = "0"  cellspacing = "0"  width = "100%"  border= "0" style = "marign:0px;">
						<tr  ><td  colspan = "2" align = "right"  width = "100%" style = "marign:0px;"><div style = "background-color:#4641D8;color:white;padding:10px;width:114px;margin-top:-4px;"><div style = "margin-top:-4px;" >Receipt</div></div></td></tr>
						<tr><td width = "10%" align = "left"><div style = "font-weight:bold">No </div></td><td width = "90%" align = "left"><div style = "border-bottom:2px solid black;"><?php echo $data['id']; ?></div></td></tr>
						<tr><td><div style = "font-weight:bold">Date </div></td><td align = "left"><div style = "border-bottom:2px solid black;"><?php echo date('d/m/Y',strtotime($data['added_on'])); ?></div></td></tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan = "2">
					<table border = "0" align = "center" cellspacing = "0" cellpadding = "0" width = "100%">
						<tr >
							<td align = "center" colspan = "2" width = "100%"><span style ="font-weight:bold">Registered Office : </span>: The Concierge Desk, The Oberoi New Delhi,<br /> Dr Zakir Hussain Marg N. Delhi -110003</span></td>
						</tr>
						<tr><td align = "center" colspan = "2"><span style ="font-weight:bold"> Telephone No: </span> 011-24304155 / Website: cai.org.in / Regd. No. S37376 of 2000</td></tr>
					</table>
				</td>
			</tr>
			<tr><td colspan = "2" ><hr /></td></tr>
			<tr >
				<td colspan = "2" width = "100%" style = "padding:5px;">
					<table width = "100%" >
						<tr >
							<td width = "23%" ><div style = "font-weight:bold;">Received with thanks from Mr/Ms/Mrs.</div></td>
							<td width = "77%" ><div style = "border-bottom:2px solid black"><?php echo $data['full_name']; ?></div></td>
						</tr>
					</table>
					<table width = "100%" >
						<tr >
							<td width = "12%" ><div style = "font-weight:bold;">the sum of Rupees</div></td>
							<td width = "88%" ><div style = "border-bottom:2px solid black"><?php echo ucwords(convert_number_to_words($data['amount'])); ?></div></td>
						</tr>
					</table>
					<table width = "100%" >
						<tr >
							<td width = "15%" ><div style = "font-weight:bold;">by Cash/Cheque/Draft No.</div></td>
							<td width = "75%" ><div style = "border-bottom:2px solid black"><?php echo $data['payment_mode_no']; ?></div></td>
						</tr>
					</table>
					<table width = "100%" >
						<tr >
							<td width = "34%" ><div style = "font-weight:bold;">in payment of Part/Full/Advance against Bill No./ Order No.</div></td>
							<td width = "66%" ><div style = "border-bottom:2px solid black"><?php echo (5000 + $data['invoice_id']); ?></div></td>
						</tr>
					</table>
					<table width = "100%"  >
						<tr >
							<td width = "90%" valign = "top">
								<table width = "100%">
									<tr>
										<td	 width = "10%"	><div style = "font-weight:bold;">Date : </div></td>
										<td width = "90%"><div style = "border-bottom:2px solid black"><?php echo date('d/m/Y',strtotime($data['added_on'])); ?></div></td>
									</tr>
									<tr>
										<td><div style = "font-weight:bold;">Rs : </div></td>
										<td><div style = "border-bottom:2px solid black"><?php echo $data['amount']; ?></div></td>
									</tr>
									<tr>
										<td colspan = "2" ><div style = "padding:5px;" ></div></td>
									</tr>

									<tr>
										<td colspan = "2" ><div style = "font-weight:bold;"><br /><br />Payment by cheque subject to realisation</div></td>
									</tr>
								</table>
							</td>
							<td width = "10%" valign = "top" style = "border:1px solid black;"> 
								<div style = "min-width:300px;min-height:300px;max-height:300px;height:100px;">
									<img src = "/jobscraperv2/pdf/uploads/blank.png" width = "100px" height = "100px"  />
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>

	<?php
	$html = ob_get_contents();
	ob_end_clean();
	//$mpdf=new mPDF('c', 'A4-L');
	$mpdf=new mPDF();
	if($action_type == 'mail'){
			$mpdf->WriteHTML(utf8_encode($html));
			//$mpdf->Output($dir.time().'.pdf','F');exit;
			//$mpdf->Output();
			$content = $mpdf->Output('', 'S');
			$content = chunk_split(base64_encode($content));
			$mailfrom = $mail_from;
			$mailto = $mail_to; //Mailto here
			$from_name = 'admin'; //Name of sender mail
			$from_mail = $mailfrom; //Mailfrom here
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
	}else{
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
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

