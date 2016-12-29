<?php
class Model_Admin extends Model {

  public function get_data() {
    $loginUser = array(
      "login_status" => 1
    );
    return $loginUser;
  }


  public function getOrder()
  {
  	$sql = 'SELECT * FROM `applications`';
  	$sql.= 'WHERE approving = "no"';

	$con = $this->db();
	$res = $con->query($sql);

	$all_order = array();
	while ($all = $res->fetch_assoc()) {
		$all_order[] = $all;
	}
	return $all_order;
  }

  public function update_approve()
  {
    $id = $_POST['id'];
    $approving = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET approving='$approving'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function status()
  {
    $id = $_POST['id'];
    $stat = $_POST['val'];
    $sql = "UPDATE `applications`";
    $sql.= " SET status='$stat'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function update_tf()
  {

    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET tf='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function update_da()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET da='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

   public function update_ttf()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET ttf='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function update_cont()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET content='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function update_url()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET live_url='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }
 
   public function update_date()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];

    $sql = "UPDATE `applications`";
    $sql.= " SET deadline='$val'";
    $sql.= " WHERE id='$id'";

    $con = $this->db();
    $res = $con->query($sql);
    if($res){
        return 'Success';
    }else{
        return "Db error";
        }
  }

  public function getUser()
  {

    $id = $_POST['id'];

    $sql = "SELECT * FROM `applications`";
    $sql.= "WHERE id='$id'";
    var_dump($sql);

    $con = $this->db();
    $res = $con->query($sql);
    $email = $res->fetch_assoc();
    var_dump($email);
  }



}
