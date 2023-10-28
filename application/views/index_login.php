<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title?> </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
   <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url()?>assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/themify-icons/themify-icons.css">
       <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/icon/feather/css/feather.css">

    <!-- chart js -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/chartist/css/chartist.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/jquery.steps/css/jquery.steps.css">
    <!-- datepicker css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap-datepicker3.css">

    <!-- tree css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/jstree/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/treeview/treeview.css">
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/j-pro/css/demo.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/j-pro/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/j-pro/css/j-pro-modern.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/pcoded-horizontal.min.css">
    

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
      <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/pages/notification/notification.css">
    <!-- Required Jquery -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery/js/jquery.min.js"></script>
<!-- <script src="<?php echo base_url()?>assets/js/app.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div> 
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header" header-theme="theme5">
            <div class="navbar-wrapper">

                <div class="navbar-logo" logo-theme="theme5">
                    <a href="<?php echo base_url()?>dashboard">
                        <h5><?= $title ?></h5>
                        <!-- <img class="img-fluid" src="<?php echo base_url()?>assets/images/dijawa.jpeg" alt="Dijawa Logo" height="30" width="150"> -->
                    </a>
                </div>
            </div>
        </nav>

        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper" style="padding:0;">
                            	<?php echo $content?>
                            </div>
                        </div>
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="<?php echo base_url()?>assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="<?php echo base_url()?>assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="<?php echo base_url()?>assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="<?php echo base_url()?>assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="<?php echo base_url()?>assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/modernizr/js/css-scrollbars.js"></script>

<!-- chart js -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/chart.js/js/Chart.js"></script>

<!-- jstree .js  -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jstree/js/jstree.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/pages/treeview/jquery.tree.js"></script>

<!-- data-table js -->
<script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>assets/pages/data-table/js/jszip.min.js"></script>
<script src="<?php echo base_url()?>assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url()?>assets/pages/data-table/js/data-table-custom.js"></script>

 <!-- notification js -->
<!--     <script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/pages/notification/notification.js"></script> -->

<script src="<?php echo base_url()?>assets/pages/form-validation/validate.js"></script>
<script src="<?php echo base_url()?>assets/pages/forms-wizard-validation/form-wizard.js"></script>


<script src="<?php echo base_url()?>assets/js/pcoded.min.js"></script>
<script src="<?php echo base_url()?>assets/js/menu/menu-hori-fixed.js"></script>
<script src="<?php echo base_url()?>assets/js/select2.full.min.js"></script>
<!-- <script src="<?php echo base_url()?>assets/js/vartical-layout.min.js"></script> -->
<script src="<?php echo base_url()?>assets/bower_components/multiselect/js/jquery.multi-select.js"></script>

<script src="<?php echo base_url()?>assets/bower_components/jquery.steps/js/jquery.steps.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/jquery-validation/js/jquery.validate.js"></script>

<script src="<?php echo base_url()?>assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

<script src="<?php echo base_url()?>assets/pages/advance-elements/select2-custom.js"></script>

<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/pages/j-pro/js/custom/login-form.js"></script>
<script>
    
</script>
</body>

</html>
