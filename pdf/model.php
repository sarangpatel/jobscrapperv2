<?php
class Model{
	
	public function Model(){
	
	}//end function



	function addReceipt(){
		global $link;
		$full_name = addslashes($_POST['full_name']);
		$ref_no = addslashes($_POST['ref_no']);
		$ref_date = addslashes($_POST['ref_date']);
		$bottom_text = addslashes($_POST['bottom_text']);

		$added_on = date('Y-m-d H:i:s');
		$sql = "INSERT INTO receipts(full_name,ref_no,ref_date,bottom_text,added_on)  VALUES('$full_name','$ref_no','$ref_date','$bottom_text','$added_on');";
		mysql_query($sql,$link);
		$last_id = mysql_insert_id();
		foreach($_POST['item_name'] as $ky => $i_v){
			$i_name = addslashes($_POST['item_name'][$ky]);
			$i_q = addslashes($_POST['item_qty'][$ky]);
			$i_p = addslashes($_POST['item_price'][$ky]);
			$sql = "INSERT INTO receipt_particulars(receipt_id,item_name,item_qty,item_price)  VALUES($last_id,'$i_name','$i_q','$i_p');";
			mysql_query($sql,$link);
		}
	}

	function updateReceipt($invoice_id){
		global $link;
		$full_name = addslashes($_POST['full_name']);
		$ref_no = addslashes($_POST['ref_no']);
		$ref_date = addslashes($_POST['ref_date']);
		$bottom_text = addslashes($_POST['bottom_text']);
		$added_on = date('Y-m-d H:i:s');
		$sql = "UPDATE receipts SET full_name = '$full_name',ref_date = '$ref_date',bottom_text = '$bottom_text', added_on = '$added_on' where id = $invoice_id;";
		mysql_query($sql,$link);
		$last_id = mysql_insert_id();
		foreach($_POST['item_name'] as $ky => $i_v){
			$i_name = addslashes($_POST['item_name'][$ky]);
			$i_q = addslashes($_POST['item_qty'][$ky]);
			$i_p = addslashes($_POST['item_price'][$ky]);
			$sql = "UPDATE receipt_particulars SET item_name = '$i_name', item_qty = '$i_q',item_price = '$i_p' WHERE receipt_id = $invoice_id ;";  
			mysql_query($sql,$link);
		}
	}



	function generateReceipt($invoice_id){
		global $link;
		$full_name = addslashes($_POST['full_name']);
		$amount = addslashes($_POST['amount']);
		$payment_mode_no = addslashes($_POST['payment_mode_no']);
		$invoice_id = addslashes($invoice_id);
		$added_on = date('Y-m-d H:i:s');
		$sql = "INSERT INTO receipt_generated(invoice_id,full_name,amount,payment_mode_no,added_on)  VALUES($invoice_id,'$full_name','$amount','$payment_mode_no','$added_on');";
		mysql_query($sql,$link);
		$last_id = mysql_insert_id();
		return $last_id;
	}


	function listRecp($invoice_id,$id = ''){
		if($id != ''){
			$param .= " and id = $id ";
		}
		global $link;
		$sql = "SELECT * from receipt_generated where invoice_id = $invoice_id $param order by id desc limit 500;";
		$result = mysql_query($sql,$link);
		return $result;
	}


	function listRecpData($invoice_id,$id = ''){
		if($id != ''){
			$param .= " and id = $id ";
		}
		global $link;
		$sql = "SELECT * from receipt_generated where invoice_id = $invoice_id $param order by id desc limit 1;";
		$result = mysql_query($sql,$link);
		$data = array();
		$row = mysql_fetch_assoc($result);
		$data= $row;
		return $data;
	}




	
	/*function listReceipt(){
		global $link;
		$sql = "SELECT r.id,r.full_name,r.ref_no,r.ref_date,rp.item_name,rp.item_qty,rp.item_price,r.added_on from receipts r INNER JOIN receipt_particulars	rp on r.id = rp.receipt_id order by r.id desc limit 400;";
		$result = mysql_query($sql,$link);
		return $result;
	}*/

	function listReceipt(){
		global $link;
		$sql = "SELECT r.id,r.full_name,r.ref_no,r.ref_date,r.added_on from receipts r  order by r.id desc limit 400;";
		$result = mysql_query($sql,$link);
		return $result;
	}

	function previewReceipt($receipt_id){
		global $link;
		$sql = "SELECT r.id,r.bottom_text,r.full_name,r.ref_no,r.ref_date,rp.item_name,rp.item_qty,rp.item_price,r.added_on from receipts r INNER JOIN receipt_particulars	rp on r.id = rp.receipt_id WHERE r.id = $receipt_id order by r.id desc limit 100;";
		$result = mysql_query($sql,$link);
		$data = array();
		while ($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;

	}


	function getData(){
		global $link;

		$sql = "SELECT r.id,r.full_name,r.ref_date,sum((rp.item_qty* rp.item_price)) as total FROM `receipts` r inner join receipt_particulars rp on r.id = rp.receipt_id group by r.id order by r.id desc limit 300";
		$result = mysql_query($sql,$link);
		$data = array();
		while ($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;
	}

	
	function activeDeactivateQuiz($data){
		$sql = "UPDATE quiz set status = 0 ;";
		mysql_query($sql);
		$sql = "UPDATE quiz set status = 1 where  quiz_id={$data['quiz_id']};";
		return mysql_query($sql);
	}//end function


}//end class

?>