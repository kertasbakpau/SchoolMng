<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:v :) :'(</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- bootstrapdashboard -->
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/vendor/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrapdashboardcustom.css');?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css');?>"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/bootstrap-datepicker3.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/animate.css');?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/vendor/font-awesome/css/font-awesome.min.css');?>">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/fontastic.css');?>">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/grasp_mobile_progress_circle-1.0.0.min.css');?>">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css');?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/style.default.css');?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/custom.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/file/component.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/file/demo.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrapdashboard/css/file/normalize.css');?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url('assets/bootstrapdashboard/img/favicon.ico');?>">

    <!-- JS -->
    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('assets/bootstrapdashboard/vendor/bootstrap/js/bootstrap.js');?>"></script>
    <script src="<?php echo base_url('assets/bootstrapdashboard/js/bootstrap-datepicker.js');?>"></script>
    <script src="<?php echo base_url('assets/bootstrapdashboard/js/bootstrap-notify.js');?>"></script>
    <script src="<?php echo base_url('assets/bootstrapdashboard/js/bootbox.min.js');?>"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body> 
    <!-- Side Navbar -->
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Bootstrap </span><strong>Dashboard</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red badge-corner">12</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification">
                          <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <!-- Messages                        -->
                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange badge-corner">10</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
                  </ul>
                </li>
                <!-- Languages dropdown    -->
                <li class="nav-item dropdown">
                <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                    <img src="<?php echo $resource['flag']?>" alt="<?php echo $_SESSION['language']['language']?>">
                    <span class="d-none d-sm-inline-block"><?php echo $_SESSION['language']['language']?></span>
                  </a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" class="dropdown-item" href ="<?php echo base_url('language/change_language');?>?language=indonesia"> 
                      <img src="<?php echo base_url('assets/bootstrapdashboard/img/flags/16/ID.png')?>" alt="Indonesia" class="mr-2">
                      <span>Indonesia</span></a>
                    </li>
                    <li><a rel="nofollow" class="dropdown-item"  href ="<?php echo base_url('language/change_language');?>?language=english"> 
                      <img src="<?php echo base_url('assets/bootstrapdashboard/img/flags/16/US.png');?>" alt="English" class="mr-2">
                      <span>English</span></a>
                    </li>
                  </ul>
                </li>
                <!-- Logout    -->
                <li class="nav-item">
                  <a class="nav-link logout" href ="<?php echo base_url('login/dologout');?>"> 
                    <span><?php echo $resource['res_logout']?></span>
                    <i class="fa fa-sign-out"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4">Mark Stephen</h1>
              <p>Web Designer</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus-->
          <span class="heading">Main</span>
            <ul class="list-unstyled">
              <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i><?php echo $resource['res_general']?></a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="<?php echo base_url('mschoolyear');?>"><i class="icon-user"></i><?php echo $resource['res_schoolyear']?></a></li>
                  <li><a href="<?php echo base_url('mkelas');?>"><i class="icon-user"></i><?php echo $resource['res_class']?></a></li>
                </ul>
              </li>
            </ul>
          <span class="heading">Users</span>
          <ul class="list-unstyled">
          <li><a href="<?php echo base_url('mgroupuser');?>"><i class="icon-user"></i><?php echo $resource['res_groupuser']?></a></li>
            <li><a href="<?php echo base_url('muser');?>"><i class="icon-user"></i><?php echo $resource['res_user']?></a></li>
          </ul>
        </nav>
        <!-- <div class="content-inner">  -->
      <script type = "text/javascript">
        $(document).ready(function(e){
          // var notify = $.notify('<strong>Saving</strong> Do not close this page...', {
          //   type: 'success',
          //   allow_dismiss: false,
          //   showProgressbar: true
          // });

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> Page Data.');
          // }, 1000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> User Data.');
          // }, 2000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Saving</strong> Profile Data.');
          // }, 3000);

          // setTimeout(function() {
          //   notify.update('message', '<strong>Checking</strong> for errors.');
          // }, 4000);
          
          // setTimeout(function() {
          //   setNotification("aaa",1, 'bottom','right');
          // }, 1000);
          
          // setTimeout(function() {
          //   setNotification("bbb",1, 'bottom','right');
          // }, 2000);
        })

        function setNotification(message, title, position, align){

          if(title == 1){
            var titlestr = "<?php echo $resource['res_warning'] ?>";
            var type = "warning";
          }
          else if(title == 2){
            var titlestr = "<?php echo $resource['res_success'] ?>";
            var type = "success";
          }
          else if(title == 3){
            var titlestr = "<?php echo $resource['res_danger'] ?>";
            var type = "danger";
          }
          else{
            var titlestr = "<?php echo $resource['res_info'] ?>";
            var type = "info";
          }

          $.notify({
            // options
            icon: 'glyphicon glyphicon-warning-sign',
            title: titlestr + " : ",//'Bootstrap notify',
            message: message //'Turning standard Bootstrap alerts into "notify" like notifications',
            //url: 'https://github.com/mouse0270/bootstrap-notify',
            //target: '_blank'
          },{
            // settings
            element: 'body',
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
              from: position,
              align: align
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: 'pause',
            animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
              '<span data-notify="icon"></span> ' +
              '<span data-notify="title"><b>{1}</b></span> ' +
              '<span data-notify="message">{2}</span>' +
              '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
              '</div>' +
              '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>' 
          });
        }

        function deleteData(name, callback){
          bootbox.confirm({
          //title: "Destroy planet?",
          message: "<?php echo $resource['res_want_delete']?> " + name + " ?",
            buttons: {
                cancel: {
                    label: "<?php echo $resource['res_cancel']?>"
                },
                confirm: {
                    label: "<?php echo $resource['res_confirm']?>"
                }
            },
            callback: function (result) {
              callback(result);
            }
          });
        }
      </script>
    
    