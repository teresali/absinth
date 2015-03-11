<?php 
session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Absinth | Peer Review</title>
    <!-- Bootstrap Styles-->
    <link href="dashboard/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="dashboard/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="dashboard/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="dashboard/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<!--                <a class="navbar-brand" href="index.html">ABSINTH</a>-->
                <img id="logo" src="img/logo-in.png" alt="Absinth">
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        Teresa  
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard"></i> Projects</a>
                    </li>
                    <li>
                        <a href="chart.html"><i class="fa fa-edit"></i> My Assessments</a>
                    </li>
                    <li>
                        <a href="tab-panel.html"><i class="fa fa-bar-chart-o"></i> Group Info</a>
                    </li>
                    
                    <li>
                        <a href="table.html"><i class="fa fa-table"></i> Forum</a>
                    </li>
                    <li>
                        <a href="form.html"><i class="fa fa-edit"></i> Forms</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Projects
                        </h1>
                    </div>
                </div>
 

                <!-- <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>8,457</h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Daily Visits

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                                <h3>52,160 </h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Sales

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa fa-comments fa-5x"></i>
                                <h3>15,823 </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Comments

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                                <h3>36,752 </h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                No. of Visits

                            </div>
                        </div>
                    </div>
                </div> -->



                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
<!--
                        <div class="panel-heading">
                             Projects
                        </div>
-->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Name</th>
                                            <th class="col-md-3">Due Date</th>
                                            <th class="col-md-1">Score</th>
                                            <th class="col-md-1">Mean</th>
                                            <th class="col-md-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td>Project 1</td>
                                            <td>January 1, 2015 23:59pm</td>
                                            <td class="center">78</td>
                                            <td>82</td>
                                            <td>Graded</td>
                                        </tr>
                                        <tr class="even">
                                            <td>Project 2</td>
                                            <td>January 1, 2015 23:59pm</td>
                                            <td class="center">78</td>
                                            <td>82</td>
                                            <td>Graded</td>
                                        </tr>
                                        <tr class="odd">
                                            <td>Project 3</td>
                                            <td>January 1, 2015 23:59pm</td>
                                            <td class="center">78</td>
                                            <td>82</td>
                                            <td>Graded</td>
                                        </tr>
                                        <tr class="even">
                                            <td>Project 4</td>
                                            <td>January 1, 2015 23:59pm</td>
                                            <td class="center">78</td>
                                            <td>82</td>
                                            <td>Graded</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->

                </div>
                <!-- /. ROW  -->

                
                <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="dashboard/assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="dashboard/assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="dashboard/assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="dashboard/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="dashboard/assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="dashboard/assets/js/custom-scripts.js"></script>


</body>

</html>