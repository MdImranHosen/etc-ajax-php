<?php
session_start();


   require_once('../dbconnect.php');



     $ADMIN_ID = $_SESSION['ADMIN_ID'];
	 if($ADMIN_ID!=1){
	 
	  echo "<script>window.open('index.php','_self')</script>";
	 }
	 
	 //start phpmailer use
	   require("/home/root1/public_html/admin/phpmailer/PHPMailer-5.2.0/class.phpmailer.php");

       $mail = new PHPMailer();



//customise
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	     $subject_msg = $_POST['subject'];
	     $body_msg    = $_POST['user_message'];
	     if(empty($subject_msg) || empty($body_msg)){
	         $msg = '<div class="alert alert-danger">Field must not be Empty!</div>';
	         
	     }else{
	         
	     
	     
	     $sqlcheck = "SELECT * FROM USER";
	     $resultcheck = $con->query($sqlcheck);
	     
	     if(!empty($resultcheck)){
	            $result = $resultcheck->fetch_assoc();
				$all_email_u     =	$result["USER_EMAIL"];
				
				//Only For Checking Add this array ...
				//$mail_arr = array("imranhossen5912@gmail.com","imran@mailinator.com","jahidul282@gmail.com");
				
				foreach($all_email_u as $USER_EMAIL){
				if (!filter_var($USER_EMAIL, FILTER_VALIDATE_EMAIL) !== true) {
			        if(!empty($USER_EMAIL)){
                     
                    $mail->IsSMTP();                                      // set mailer to use SMTP
                    $mail->Host = "localhost";  // specify main and backup server
                    $mail->SMTPAuth = true;     // turn on SMTP authentication
                    $mail->Username = "newsletters@peepschannel.com";  // SMTP username
                    $mail->Password = "peepschannel.com"; // SMTP password
                    
                    $mail->From = "newsletters@peepschannel.com";
                    $mail->FromName = "Peepschannel";
                    $mail->AddAddress($USER_EMAIL);
                    
                    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
                    $mail->IsHTML(true);                                  // set email format to HTML
                    
                    $mail->Subject = $subject_msg;
                                     include 'mail.php';
                    $mail->Body    = $mail_body_html;
                    
                    if(!$mail->Send())
                    {
                       $msg = '<div class="alert alert-danger">Message could not be sent. <br>
                       Mailer Error: '. $mail->ErrorInfo.'</div>';
                       
                       exit;
                    }else{
                    
                    $msg = '<div class="alert alert-success">Message has been sent</div>';
                    
                    	 //end phpmailer use
	 
                    }
                     
                     
		        	}
				}
			}
	      }
	     }
	   
	   // mail("imranhossen5912@gmail.com,jahidul282@gmail.com", $subject_msg, $body_msg,"newsletters@peepschannel.com"); 
     }


?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Newsletter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="personal.php" class="logo">
	<span class="logo-mini">Admin</span>
      <span class="logo-lg">Admin</span>
    </a>
	<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    <!-- Header Navbar: style can be found in header.less -->
	 <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

    </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
			<li><a href="personal.php"><i class="fa fa-fw fa-bookmark-o"></i> <span>All User Account</span></a></li>
			<li><a href="support.php"><i class="fa fa-fw fa-support"></i> <span>All support Information</span></a></li>
			<li><a href="export_all_users.php"><i class="fa fa-fw fa-file"></i> <span>Export all user Information</span></a></li>
			<li><a href="newsletter.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Newsletter</span></a></li>
		<li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">





		   <div class="row">


        <div class="col-lg-9 col-md-12 col-sm-12">
        <?php
           if(isset($msg)){
               echo $msg;
           }
        ?>

		<div class="box box-primary">
            <form action="" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Newsletter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <input class="form-control" name="subject" placeholder="Subject:" required>
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" name="user_message" class="form-control" style="height: 150px">
                    </textarea>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            </form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->

          </div>




		  </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
<!-- FLOT CHARTS -->
<script src="bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Page script -->
<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [], totalPoints = 100

    function getRandomData() {

      if (data.length > 0)
        data = data.slice(1)

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_plot = $.plot('#interactive', [getRandomData()], {
      grid  : {
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#3c8dbc'
      },
      lines : {
        fill : true, //Converts the line chart to area chart
        color: '#3c8dbc'
      },
      yaxis : {
        min : 0,
        max : 100,
        show: true
      },
      xaxis : {
        show: true
      }
    })

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

      interactive_plot.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot.draw()
      if (realtime === 'on')
        setTimeout(update, updateInterval)
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
      update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtime = 'on'
      }
      else {
        realtime = 'off'
      }
      update()
    })
    /*
     * END INTERACTIVE CHART
     */

    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [], cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({ top: item.pageY + 5, left: item.pageX + 5 })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
      [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
      [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
    $.plot('#area-chart', [areaData], {
      grid  : {
        borderWidth: 0
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#00c0ef'
      },
      lines : {
        fill: true //Converts the line chart to area chart
      },
      yaxis : {
        show: false
      },
      xaxis : {
        show: false
      }
    })

    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [['January', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */

    /*
     * DONUT CHART
     * -----------
     */


	 var d = "<?php echo $total_debt;?>";
	 var c = "<?php echo $total_credit;?>";
	 //alert(d);

    var donutData = [
      { label: 'Debtor', data: d, color: '#3c8dbc' },
      { label: 'Creditor', data: c, color: '#0073b7' },

    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>


<!---Login Script-->
	<script>
function submit_login_action(mail,pass){


var type = '2';


	email= mail;
	password=pass;


	email_bool=true;

	if(!validateEmail(email)){
		$( "#email_class").last().addClass("has-error" );
		email_bool=false;

	}

	pass_bool=true;
if(password==""){
	$("#password_class").last().addClass( "has-error" );
		pass_bool=false;


}

	final_boolean=pass_bool*email_bool;


	if(final_boolean){



	//document.getElementById("progress1").style.display= "block";



		$.ajax({


	//alert("ajax");
    url:"login_operation_ajax.php",
   method:"POST",
   data:{email:email,password:password,type:type},


  //alert("ajax in");
  success:function(data)
   {


	if(data!="faild"){


		//document.getElementById("progress1").style.display= "none";

		window.open('../','_self');

	   }else{

		alert("4444");
		 document.getElementById("progress1").style.display= "none";

		   		alert_error("Wrong email or password  !!!! !!!","error");



	   }
	   // alert(data);


   }


  });


	}

	}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
</script>


</body>
</html>
