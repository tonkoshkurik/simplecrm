<?php
class Model_Clients extends Model {

  public function get_data() {
    $table = "<table id='clients' class=\"display table table-condensed table-striped table-hover table-bordered clients pull-left\">";
      $table .= "<thead><tr><th>ID</th><th>Email</th><th>Level</th><th>Full Name</th><th>Actions</th></tr></thead>";
      $table .= "</table>";
      return $table;
  }

}
