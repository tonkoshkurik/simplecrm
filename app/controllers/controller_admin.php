<?php

class Controller_Admin extends Controller
{
  function __construct()
  {
    $this->model = new Model_Admin();
    $this->view = new View();
  }
  function action_index() {
    $data["body_class"] = "page-header-fixed";
    $data["title"] = "Dashboard";
    session_start();
    if ( $_SESSION['admin'] == md5('admin'))
    {
      header('Location:/admin/dashboard');
      $this->view->generate('admin_view.php', 'template_view.php', $data);
    } else if ($_SESSION['user'] == md5('user')) {
      $data["user_id"] = $_SESSION["id"];
      header('Location:/client/dashboards');
      $this->view->generate('main_view.php', 'client_template_view.php', $data);
    } else {
      session_destroy();
      header('Location:/login');
      $this->view->generate('danied_view.php', 'template_view.php', $data);
    }
  }

  function action_dashboard()
  {

    session_start();
     // var_dump($_SESSION);
     //  exit();
    if ($_SESSION['admin'] == md5('admin')) {

      $data["title"] = "Dashboard";
      $data["body_class"] = "page-header-fixed";
      $data['all'] = $this->model->getOrder();

      $this->view->generate('dashboard_admin_view.php', 'template_view.php', $data);

    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'template_view.php', '');
    }
  }
  
  function action_changemails() {
    $con = $this->db();
    $sql = "SELECT id from `users`";
    if($res = $con->query($sql)){
      foreach ($res as $r){
        $result[] = $r;
      }
    }
    foreach ($result as $r) {
      $id = $r["id"];
      $sql = "UPDATE `clients` SET `email` = 'reasonbeatmaker@gmail.com' WHERE `clients`.`id` =".$id;
      $res = $con->query($sql);
      if($res) echo "clients.true";
    }

//    print_r( $result );
  }
  function action_logout()
  {
    session_start();
    session_destroy();
    header('Location:/login');
  }

  public function action_query()
  {
     $table = 'applications';
      $primaryKey = 'id';
      $columns = array(
      array( 'db' => '`a`.`id`', 'dt' => 0 , 'field'=>'id'),
      array( 'db' => '`a`.`date`', 'dt' => 1 , 'field'=>'date'),
      array( 'db' => '`a`.`deadline`', 'dt' => 2 , 'field'=>'deadline', 'formatter' => function($d, $row) {
        $string = '<input name="deadline" class="deadline datepicker" attr-id="'. $row[0] .'" title="Deadline" value="'.$d.'" class="edit-button" data-target="#edittf">';
        return $string;
      }),
      array( 'db' => '`a`.`guest_post_url`', 'dt' => 3 , 'field'=>'guest_post_url'),
      array( 'db' => '`a`.`approving`', 'dt' => 4 , 'field'=>'approving', 'formatter' => function($d, $row) {
        $approving = '';
        $not_approving = '';
        if($d == 1){
          $approving = 'selected';
        }else{
          $not_approving = 'selected';
        }
        $string = '<select class="change_approved" style="width:100%;" attr-id="'. $row[0] .'" name="select_approving">
            <option value="1" '. $approving .' >Approved</option>
            <option value="0"'. $not_approving .'>Is not approved</option>
        </select>';
        return $string;
      }),
      array( 'db' => '`a`.`tf`', 'dt' => 5 , 'field'=>'tf', 'formatter' => function($d, $row) {
        $string = '<a href="#" id="edittf" class="edittf" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="Check"  class="edit-button" data-target="#edittf"> '.$d.' </a>';
        return $string;
      }),
      array( 'db' => '`a`.`da`', 'dt' => 6 , 'field'=>'da', 'formatter' => function($d, $row) {
        $string = '<a href="#" id="edittf" class="editda" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="da"  class="edit-button" data-target="#editda"> '.$d.' </a>';
        return $string;
      }),
      array( 'db' => '`a`.`ttf`', 'dt' => 7 , 'field'=>'ttf', 'formatter' => function($d, $row) {
        $string = '<a href="#" id="editttf" class="editttf" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="ttf"  class="edit-button" data-target="#editttf"> '.$d.' </a>';
        return $string;
      }),
      array( 'db' => '`a`.`keywords`', 'dt' => 8 , 'field'=>'keywords'),
      array( 'db' => '`a`.`client_url`', 'dt' => 9, 'field'=>'client_url'),
      array('db'  => '`a`.`content`', 'dt'=>10, 'field'=>'content', 'formatter' => function($d, $row) {
        $string = '<a href="#" id="editcont" class="editcont" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="content"  class="edit-button" data-target="#editcont"> '.$d.' </a>';
        return $string;
      }),
      array('db'  => '`a`.`content_approving`', 'dt'=> 11, 'field'=>'content_approving'),
      array('db'  => '`a`.`status`', 'dt'=> 12, 'field'=>'status', 'formatter' => function($d, $row) {
        $progr = '';
        $proc = '';
        $live = '';
        if($d == 0){
          $progr = 'selected';
        }elseif($d == 1){
          $proc = 'selected';
        }else{
          $live = 'selected';
        }
        $string = '<select class="status_change" attr-id="'. $row[0] .'" style="width:100%;" name="select_st">
            <option value="0" '.$progr.'>In progress</option>
            <option value="1" '.$proc.'>Process content</option>
            <option value="2" '.$live.'>Live</option>
        </select>';
        return $string;
      }),
      array('db'  => '`a`.`live_url`', 'dt'=> 13, 'field'=>'live_url', 'formatter' => function($d, $row) {
        $string = '<a href="#" id="editurl" class="editurl" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="live url" class="edit-button" data-target="#editurl"> '.$d.' </a>';
        return $string;
      }),
      // array('db'=> '`a`.`id`', 'dt'=>14, 'formatter' => function($d, $row) {
      

      //   $string = '<a href="#" id="check" class="check" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="Check" data-toggle="modal" class="edit-button" data-target="#editClient"><i style="color:#24e22d;" id="check" class="fa fa-check" aria-hidden="true"></i> </a>';
      //   $string .= ' <a href="#" id="not_appr" class="not_appr" attr-id="'. $row[0] .'" attr-name="'. $row[1] .'" title="Reject"><i style="color:#bf2424;" class="fa fa-times" aria-hidden="true"></i></a>';
      //   return $string;
      // // }
      // }, 'field'=> 'id')
      );
    $joinQuery = "FROM {$table} as `a`";

    $sql_details = array(
      'user' => DB_USER,
      'pass' => DB_PASS,
      'db'   => DB_NAME,
      'host' => DB_HOST
    );
    ob_clean();

    echo json_encode(
      SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
    );
    exit;
  }

  public function action_approving()
  {
    $res = $this->model->update_approve();
    // var_dump($res);
    // exit();
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }
  }

  public function action_status()
  {
    $res = $this->model->status();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }

  }

  // public function action_edittf()
  // {
  //   $res = $this->model->get_tf();
  //  // var_dump($res);
  // }

  public function action_update_tf()
  {
    $res = $this->model->update_tf();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }

  }

  public function action_update_da()
  {
    $res = $this->model->update_da();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }
  }

  public function action_update_ttf()
  {
    $res = $this->model->update_ttf();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }
  }

   public function action_update_cont()
  {
    $res = $this->model->update_cont();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }
  }

  public function action_update_url()
  {
    $res = $this->model->update_url();
    
    if($res){
      echo "Success";
    }else{
      echo "Error";
    }
  }

  public function action_deadline()
  {
    $res = $this->model->update_date();
    
    if($res){
      echo "Success";

      $user = $this->model->getUser();
      var_dump($user);
      exit();
      foreach ($user as $key) {
  
      $to.=$key['email'].", "; 
      }
      /* тема/subject */
      $subject = "New order";
      /* сообщение */
      $message = '
          <html>
          <head>
           <title>Entered a new order</title>
          </head>
            <body>
              <p>You received a new order on the site!</p>
            </body>
          </html>
      ';

      $headers= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $headers .= "From: Alert service \r\n";
      // $headers .= "Cc: birthdayarchive@example.com\r\n";
      // $headers .= "Bcc: birthdaycheck@example.com\r\n";
      /* и теперь отправим из */
      mail($to, $subject, $message, $headers);

    }else{
      echo "Error";
    }
  }



}
