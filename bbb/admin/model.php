<?php
class Model{
	
	public function Model(){
		global $link;
		$this->dbLink = $link;
	}//end function

	public function createMeeting($meeting_name,$admin_name){
		$sql = "INSERT into meetings (name,admin_name) values('$meeting_name','$admin_name');";
		mysql_query($sql,$this->dbLink);
		return mysql_insert_id ($this->dbLink);
	}

	public function addUser($meeting_id,$type,$name){
		$join_on = time();
		$sql = "INSERT into users (meeting_id,type,name,join_on) values($meeting_id,'$type','$name',$join_on);";
		mysql_query($sql,$this->dbLink);
		return mysql_insert_id ($this->dbLink);
	}


	public function updateMeeting($meeting_id,$data){
		extract($data);
		$return_response = base64_encode($return_response);
		$sql = "UPDATE meetings set return_response =  '$return_response', created_on=$created_on,moderator_pass = '$moderator_pass',
		attendee_pass = '$attendee_pass' where id = $meeting_id;";
		mysql_query($sql,$this->dbLink);
	}

	public function getMeeting($meeting_id){
		$sql = "SELECT * from meetings where id = $meeting_id limit 1";
		$result = mysql_query($sql,$this->dbLink);
		return mysql_fetch_assoc($result);
	}

	public function getMeetings(){

		$sql = "SELECT m.id,m.name,m.created_on,(select count(1) from users u where u.meeting_id = m.id group by u.meeting_id  ) as total_users from meetings m inner join users u where u.meeting_id = m.id group by m.id order by m.id desc limit 500";
		$result = mysql_query($sql,$this->dbLink);
		$meetings = array();
		while($row = mysql_fetch_assoc($result)){
			$meetings[] = $row;
		}
		return $meetings; 

	}


}//end class

?>