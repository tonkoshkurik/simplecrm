<!-- <link rel="stylesheet" href="http://leadpoint.energysmart.com.au/template/charts/morris.css">
<script src="http://leadpoint.energysmart.com.au/template/charts/morris.js"></script>
<script src="http://leadpoint.energysmart.com.au/template/charts/raphael-min.js"></script> -->
<!-- Flot charts -->
<!--<script src="http://leadpoint.energysmart.com.au/template/js/flot/jquery.flot.js"></script>-->
<!--<script src="http://leadpoint.energysmart.com.au/template/js/flot/jquery.flot.resize.min.js"></script>-->
<h1 class="text-center"><?php echo $title; ?></h1>

<div id="area-chart"></div>
<hr>

<hr>
<input type="button" class="btn btn-primary" style="background-color:#0fa008;" value="PLACE ORDER" onclick="addnew();">
<hr>
<div class="row" id="insertdiv" style="display:none">
  <div class="col-sm-12">
    <div class="widget">
      <div class="widget-header">
        <div class="title">
          <h3>Place New Order</h3>
        </div>
      </div>
      <!-- "<?php echo __HOST__; ?>/client/dashboard" -->
        <form action="<?php echo $host . "/client/"; ?>addNewOrder" id="addNewOrder" class="signin-wrapper" method="post">
            <div class="widget-body">
          <div class="form-group">
              <input class="form-control" placeholder="Enter Your URL - www.YourDomainName.com " type="text" name="client_url" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Niche" type="text" name="keywords" required>
            </div>
            <hr>
            <!--div class="form-group">
              <input class="form-control" placeholder="Campaing Name" type="text" name="campaign_name" required>
            </div-->
            <div class="form-group">
              <input class="form-control" placeholder="Topical Trustflow" type="text" name="ttf" >
            </div>
            
            <input type="hidden" value="'<?php echo $_COOKIE['user_id']; ?>'" name="id_user" >
          </div>
          <div class="actions">
            <input class="btn btn-info pull-left" style="background-color:#edc115;" type="submit" value="Save">
            <input class="btn btn-info pull-left" style="background-color:#edc115; margin-left: 2px;" type="reset" class="btn btn-default" value="Clear">
            <div class="clearfix"></div>
          </div>
        </form>
        <div class="addsuccess bg-success"></div>
      </div>
    </div>
  </div>



<div class="panel panel-white ">
    <div class="row shop-tracking-status">

        <div class="col-md-12">
            <div class="well">

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputOrderTrackingID" class="col-sm-2 control-label">Order id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputOrderTrackingID" value="" placeholder="# put your order id here">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="shopGetOrderStatusID" class="btn btn-success">Get status</button>
                        </div>
                    </div>
                </div>

                <h4>Your order status:</h4>

                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="prefix">Date created:</span>
                        <span class="label label-success">12.12.2013</span>
                    </li>
                    <li class="list-group-item">
                        <span class="prefix">Last update:</span>
                        <span class="label label-success">12.15.2013</span>
                    </li>
                    <li class="list-group-item">
                        <span class="prefix">Comment:</span>
                        <span class="label label-success">customer's comment goes here</span>
                    </li>
                    <li class="list-group-item">You can find out latest status of your order with the following link:</li>
                    <li class="list-group-item"><a href="//tracking/link/goes/here">//tracking/link/goes/here</a></li>
                </ul>

                <div class="order-status">
                    <div class="order-status-timeline">
                        <!-- class names: c0 c1 c2 c3 and c4 -->
                        <div class="order-status-timeline-completion c3"></div>
                    </div>
                    <div class="image-order-status image-order-status-new active img-circle">
                        <span class="status">Accepted</span>
                        <div class="icon"></div>
                    </div>
                    <div class="image-order-status image-order-status-active active img-circle">
                        <span class="status">In progress</span>
                        <div class="icon"></div>
                    </div>
                    <div class="image-order-status image-order-status-intransit active img-circle">
                        <span class="status">Shipped</span>
                        <div class="icon"></div>
                    </div>
                    <div class="image-order-status image-order-status-delivered active img-circle">
                        <span class="status">Delivered</span>
                        <div class="icon"></div>
                    </div>
                    <div class="image-order-status image-order-status-completed active img-circle">
                        <span class="status">Completed</span>
                        <div class="icon"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
 function addnew(){
    $('#insertdiv').toggle("slow");
  }

   var addfrm = $('#addNewOrder');
    addfrm.submit(function (ev) {
         // $("#img").attr("display", "block");
        $.ajax({
            type: addfrm.attr('method'),
            url: '<?php echo $host . "/client/"; ?>addNewOrder',
            data:  addfrm.serialize(),
            success: function (data) {
            	console.log(data);
         // $("#img").attr("display", "none");
              document.querySelector('.addsuccess').innerHTML = '<p>' + data + '</p>';
              // $('#addNewClient')[0].reset();
              // table.ajax.reload();
              setTimeout(function(){
                 $('.addsuccess').fadeOut(1000);
                }, 3500);
             
            }
        });
        ev.preventDefault();
    });

</script>
