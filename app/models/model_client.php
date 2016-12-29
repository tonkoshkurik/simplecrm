<?php
class Model_Client extends Model {

	public function get_profile(){
		$sql = ' SELECT `email`, `password`, `level`, `full_name`';
		$sql.= ' FROM `users`';
		$sql.= ' WHERE id = '.$_COOKIE['user_id'];
		$con = $this->db();
		$res = $con->query($sql);
		if($res){
			return $res->fetch_assoc();
		} else {
			return FALSE;
		}

	}

	public function update_profile(){
		$p  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if(empty($p['password'])){
			$id = $_COOKIE['user_id'];
			$email = $p["email"];
			$full_name = $p["full_name"];
		      // $_COOKIE['user_name'] = $full_name;

			$sql = "UPDATE `users`";
			$sql.= " SET email='$email',full_name='$full_name'";
			$sql.= " WHERE id='$id'";
			$con = $this->db();
			$res = $con->query($sql);
			if($res){
				return 'Success';
			}else{
				return "Db error";
			}

		}else{

			$id = $_COOKIE['user_id'];
			$email = $p["email"];
			$password = md5($p["password"]);
			$full_name = $p["full_name"];
		      	// $_COOKIE['user_name'] = $full_name;

			$sql = "UPDATE `users`";
			$sql.= " SET email='$email', password='$password', full_name='$full_name'";
			$sql.= " WHERE id='$id'";
			$con = $this->db();
			$res = $con->query($sql);
			if($res){
				return 'Success';
			}else{
				return "Db error";
			}
		}
	}


	public function addOrder()
	{
		$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$client_url = $_POST["client_url"];
		$keywords = $_POST["keywords"];
		$ttf = $_POST["ttf"];
		$id_user = (int)$_COOKIE['user_id'];
      	// $date_today = date("m.d.y");
// var_dump($date_today);

		$sql = 'INSERT INTO `applications`';
		$sql.= '(client_url, keywords, ttf, id_user )';
		$sql.= " VALUES ('$client_url', '$keywords', '$ttf', '$id_user')";

		$con = $this->db();
		$res = $con->query($sql);
		if($res){
			return 'Success';
		}else{
			return "Db error";
		}

	}


	public function getAdmin()
	{
		$sql = 'SELECT * FROM `users`';
		$sql.= 'WHERE level = 1';
		// var_dump($sql);
		
		$con = $this->db();
		$res = $con->query($sql);
	    // var_dump($res);
		$admin_inf=array();
		while($row = $res->fetch_assoc()) {
			$admin_inf[] = $row; 
		}
		return $admin_inf;
	}
	
}