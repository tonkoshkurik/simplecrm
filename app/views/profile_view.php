<div id="UpdateClientForm" action="UpdateProfile" >
<form action='<?php echo __HOST__ . '/client/'; ?>UpdateProfile' method='POST' id='Update'>

<?php
      echo "<div class='form-group'>";
      echo "<label for=''>Email</label>";
      echo '<input class="form-control" type="email" name="email" value="'.$profile["email"].'" > ' ;
      echo "</div>";

      echo "<div class='form-group'>";
      echo "<label for=''>Password</label>";
      echo '<input class="form-control" type="password" name="password" value="" > ' ;
      echo "</div>";

      echo "<div class='form-group'>";
      echo "<label for=''>Full Name</label>";
      echo '<input class="form-control" type="text" name="full_name" value="'.$profile["full_name"].'" > ' ;
      echo "</div>";
 
      echo " <button type='submit' class='btn btn-primary'>Update profile</button> ";
echo "</form>";

?>
 <div class="addsuccess bg-success"></div>
</div>
<script>
  var frm = $('#Update');
      frm.submit(function (ev) {
        $.ajax({
            method: "POST",
            data: frm.serialize(),
            url: '<?php echo __HOST__ . '/client/'; ?>UpdateProfile',
            success: function (data) {
            document.querySelector('.addsuccess').innerHTML = '<p>' + data + '</p>';
            setTimeout(function(){
                 $('.addsuccess').fadeOut(1000);
                }, 3500);
     
            }
        });
        ev.preventDefault();
    });
</script>