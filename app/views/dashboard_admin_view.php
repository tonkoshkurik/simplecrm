

<h1>Dashboard</h1>

<table id='clients' class="display table table-condensed table-striped table-hover table-bordered clients pull-left">
  <thead>
    <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Dead line</th>
      <th>Guest post URL</th>
      <th>Approving</th>
      <th>TF</th>
      <th>DA</th>
      <th>TTF</th>
      <th>Keywords</th>
      <th>Client URL</th>
      <th>Content</th>
      <th>Content approving</th>
      <th>Status</th>
      <th>Live URL</th>
    </tr>
  </thead>
  <tfoot>
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Dead line</th>
    <th>Guest post URL</th>
    <th>Approving</th>
    <th>TF</th>
    <th>DA</th>
    <th>TTF</th>
    <th>Keywords</th>
    <th>Client URL</th>
    <th>Content</th>
    <th>Content approving</th>
    <th>Status</th>
    <th>Live URL</th>
  </tr>
  </tfoot>
</table>

<div class="add"></div>

<script type="text/javascript">
  $(document).ready(function(){
    var table =  $('#clients').DataTable( {
      "processing": true,
      "serverSide": true,
      "ajax": "<?php echo $host . "/admin/"; ?>query",
      aaSorting:[],
      "order": [[ 0, "asc" ]],
      "aLengthMenu": [
        [100, 200, -1],
        [100, 200, "All"]
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if(nRow.querySelector('.edittf')){
          nRow.querySelector('.edittf').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            // console.log(id);

            var val_tf = $(button).text();
            var cr = document.createElement("INPUT");
            cr.classList.add("editnew");

            cr.name="tf"
            cr.value=val_tf
            var a = button.parentNode.replaceChild(cr, button);
            var val_new;
            $(cr).keydown(function(e) {
              if (e.which == 13) {
                var val_new = $(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                    // console.log(data);
                  }
                });
              }


              $(cr).blur(function() {
                // var val_new = $(".editnew").closest( "input" ).val();
                var val_new =	$(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                    // console.log(data);
                  }
                });

              });
            });
          });
        }

        if(nRow.querySelector('.datepicker')){
          var picker = nRow.querySelector('.datepicker');

            $( picker ).datepicker({
              dateFormat: 'yy-mm-dd'
            });
          
        }

        if(nRow.querySelector('.change_approved')){
          nRow.querySelector('.change_approved').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');

            $(button).on('change', function() {
              var change = this.value;

              $.ajax({
                type: "POST",
                url: '<?php echo $host . "/admin/"; ?>approving',
                data:  { id: id, val:change},
                success: function (data) {
                  table.ajax.reload();

                }
              });
            })
          });
        }
        if(nRow.querySelector('.status_change')){
          nRow.querySelector('.status_change').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            $(button).on('change', function(){
              var stat = this.value;
              $.ajax({
                type: "POST",
                url: '<?php echo $host . "/admin/"; ?>status',
                data:  { id: id, val:stat},
                success: function (data) {
                  table.ajax.reload();
                }
              });
            })
          });
        }

        if(nRow.querySelector('.deadline')){
          nRow.querySelector('.deadline').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            // console.log(id);
            $(button).on('change', function(){
              var deadline = this.value;
              $.ajax({
                type: "POST",
                url: '<?php echo $host . "/admin/"; ?>deadline',
                data:  { id: id, val:deadline},
                success: function (data) {
                  table.ajax.reload();
                }
              });
            });
          });
        }


        if(nRow.querySelector('.editda')){
          nRow.querySelector('.editda').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            var val_tf = $(button).text();
            var input = document.createElement("INPUT");
            input.classList.add("editnew");
            input.name="tf"
            input.value=val_tf
            var a = button.parentNode.replaceChild(input, button);
            var val_new;
            $(input).keydown(function(e) {
              if (e.which == 13) {
                var val_new = $(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();

                  }
                });
              }
              $(input).blur(function() {
                var val_new =	$(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_da',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                  }
                });
              });
            });
          });
        }

        if(nRow.querySelector('.editttf')){
          nRow.querySelector('.editttf').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            var val_tf = $(button).text();
            var input = document.createElement("INPUT");
            input.classList.add("editttf");
            input.name="tf"
            input.value=val_tf
            var a = button.parentNode.replaceChild(input, button);
            var val_new;
            $(input).keydown(function(e) {
              if (e.which == 13) {
                var val_new = $(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                  }
                });
              }
              $(input).blur(function() {
                var val_new =	$(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_ttf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                  }
                });

              });
            });
          });
        }

        if(nRow.querySelector('.editcont')){
          nRow.querySelector('.editcont').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            var val_tf = $(button).text();
            var input = document.createElement("INPUT");
            input.classList.add("editcont");
            input.name="tf"
            input.value=val_tf
            var a = button.parentNode.replaceChild(input, button);
            var val_new;
            $(input).keydown(function(e) {
              if (e.which == 13) {
                var val_new = $(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();

                  }
                });
              }
              $(input).blur(function() {
                var val_new =	$(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_cont',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();
                  }
                });
              });
            });
          });
        }

        if(nRow.querySelector('.editurl')){
          nRow.querySelector('.editurl').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');

            var val_tf = $(button).text();
            var input = document.createElement("INPUT");
            input.classList.add("editurl");

            input.name="tf"
            input.value=val_tf
            var a = button.parentNode.replaceChild(input, button);
            var val_new;
            $(input).keydown(function(e) {

              if (e.which == 13) {
                var val_new = $(e.currentTarget).val();
                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_tf',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();

                  }
                });
              }
              $(input).blur(function() {

                var val_new =	$(e.currentTarget).val();

                $.ajax({
                  type: "POST",
                  url: '<?php echo $host . "/admin/"; ?>update_url',
                  data:  { id: id, val:val_new},
                  success: function (data) {
                    table.ajax.reload();

                  }
                });

              });
            });
          });
        }

        if(nRow.querySelector('.check')){
          nRow.querySelector('.check').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');
            // console.log(id);
            $.ajax({
              type: "POST",
              url: '<?php echo $host . "/admin/"; ?>approving',
              data:  { id: id },
              success: function (data) {
                document.querySelector('.addsuccess').innerHTML = '<p>' + data + '</p>';
                // $('#addNewClient')[0].reset();
                table.ajax.reload();
                setTimeout(function(){
                  $('.addsuccess').fadeOut(1000);
                }, 3500);
              }
            });
          });
        }
    // отклонить
        if(nRow.querySelector('.not_appr')){
          nRow.querySelector('.not_appr').addEventListener('click', function(event) {
            var button = event.currentTarget;
            var id = button.getAttribute('attr-id');

            $.ajax({
              type: "POST",
              url: '<?php echo $host . "/admin/"; ?>not_approving',
              data:  { id: id },
              success: function (data) {
                document.querySelector('.addsuccess').innerHTML = '<p>' + data + '</p>';
                table.ajax.reload();
                setTimeout(function(){
                  $('.addsuccess').fadeOut(1000);
                }, 3500);
              }
            });
          });
        }
      },
      "initComplete": function(){
        var r = $('#clients tfoot tr');
        r.find('th').each(function(){
          $(this).css('padding', 8);
        });
        $('#clients thead').append(r);
        $('input').css('text-align', 'center');
      }
    });

    $('#clients tfoot th').each( function () {
      // console.log(this);
      var title = $('#clients thead tr:eq(0) th').eq( $(this).index() ).text();
      var html_string = '';
      var input_style = ' style="width:100%; padding:1px !important; margin-left:-2px; margin-bottom: 0px;"';
      var select_style = ' style="width:100%; padding:1px; margin-left:-2px; margin-bottom: 0px; height: 24px;"';
      if ($(this).index() == 1 || $(this).index() == 2){
        html_string = '<input type="text" ' + input_style + ' class="datepicker" placeholder="Select date">';
      }
      else if ( $(this).index() == 4 ) {
        html_string = '<select ' + select_style + '>' +
          '<option value="">Select Status...</option>' +
          '<option value="1">Request Approved</option>' +
          '<option value="0">Request Disapproved</option>' +
          '</select>';
      }
      else if ( $(this).index() < 5 ){
        html_string = '<input type="text" ' + input_style + ' placeholder="Search ' + $.trim(title) + '"/>';
      }

      $(this).html(html_string);
      // $(this).html( '<input class="searchbox" type="text" placeholder="Search '+title+'" />' );
    } );
    // Apply the search
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd'
    });
    
    table.columns().eq( 0 ).each( function ( colIdx ) {
      $( 'input, select', table.column( colIdx ).footer() ).on( 'keyup change', function () {
        table
          .column( colIdx )
          .search( this.value )
          .draw();
      } );
    } );

  });

</script>