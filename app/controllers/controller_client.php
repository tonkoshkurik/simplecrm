<?php
class Controller_Client extends Controller
{
  function __construct() {
    $this->model = new Model_Client();
    $this->view = new View();
  }

  function action_index() {
    $data["body_class"] = "page-header-fixed";
    session_start();
    if ( $_SESSION['admin'] == md5('admin'))
    {
      $this->view->generate('admin_view.php', 'template_view.php', $data);
    } else if ($_SESSION['user'] == md5('user')) {
      header('Location:/client/dashboards');
      $this->view->generate('dashboard_view.php', 'template_user_view.php', $data);
    }
    else
    {
      session_destroy();
      header('Location:/login');
      $this->view->generate('danied_view.php', 'template_view.php', $data);
    }
  }

  
  function action_dashboard() {
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Dashboard";
      // $this->view->generate('dashboard_view.php', 'template_user_view.php', $data);
    if ($_SESSION['user'] == md5('user')) {
        $this->view->generate('dashboard_view.php', 'template_user_view.php', $data);
      // $this->view->generate('client_dashboard_view.php', 'client_template_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'template_view.php', $data);
    }
  }

  function action_logout()
  {
    session_start();
    session_destroy();
    header('Location:/login');
  }


  function action_profile(){
    $data["body_class"] = "page-header-fixed";
    session_start();
    $data["title"] = "Client Profile";
    $data["profile"] = $this->model->get_profile();
    if ($_SESSION['user'] == md5('user')) {
      $this->view->generate('profile_view.php', 'template_user_view.php', $data);
    } else {
      session_destroy();
      $this->view->generate('danied_view.php', 'template_view.php', $data);
    }

  }

  function action_UpdateProfile(){
    $respons = $this->model->update_profile();
    echo $respons;  
  }

  function action_addNewOrder(){

    $result = $this->model->addOrder();
    echo $result;
    if($result = "Success"){

      $admin = $this->model->getAdmin();
      foreach ($admin as $key) {
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
        
    }

  }




}
