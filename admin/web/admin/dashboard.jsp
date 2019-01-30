<%@ page import="java.sql.*" %>

<%
Class.forName("com.mysql.jdbc.Driver");
%>

<%

if(request.getParameter("ayd") != null){
    if(session.getAttribute("ayd") == null){
        try{
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root","");
            Statement st = con.createStatement();
            int id = Integer.parseInt(request.getParameter("ayd"));
            ResultSet rs = st.executeQuery("SELECT * FROM users WHERE userid = '" + id + "' ");
            if(!rs.next()){
            }
            session = request.getSession();
            session.setAttribute("firstname", rs.getString("fname"));
            session.setAttribute("ayd", id);
        }catch(Exception e){
            System.out.println("Error " + e.toString());
        }
    }
}else if((session.getAttribute("ayd") != null) && (request.getParameter("ayd") == null)){
    //Do nothing
}else{
    response.sendRedirect("http://localhost/admin_construction/index.php");
}

%>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>
            Paper Dashboard 2 by Creative Tim
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport'/>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/demo/demo.css" rel="stylesheet"/>
    </head>

    <body class="">
        <div class="wrapper ">
            <div class="sidebar" data-color="white" data-active-color="danger">
                <!--
                  Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
                -->
                <div class="logo">
                    <a href="dashboard.jsp" class="simple-text logo-normal text-center">
                        <%= session.getAttribute("firstname") %>
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="active ">
                            <a href="dashboard.jsp">
                                <i class="nc-icon nc-bank"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="users.jsp">
                                <i class="nc-icon nc-single-02"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li>
                            <a href="transactions.jsp">
                                <i class="nc-icon nc-tile-56"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div class="navbar-toggle">
                                <button type="button" class="navbar-toggler">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </button>
                            </div>

                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">

                            <ul class="navbar-nav">

                                <li class="nav-item btn-rotate dropdown">
                                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nc-icon nc-single-02"></i>
                                        <p>
                                            <span class="d-lg-none d-md-block">Some Actions</span>
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="jsp/logout.jsp">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <!-- <div class="panel-header panel-header-lg">
        
            <canvas id="bigDashboardChart"></canvas>
        
        
          </div> -->
                <div class="content">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-globe text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="numbers">
                                                <p class="card-category">Users</p>
                                                 <%
                                                Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root","");
                                                Statement st = con.createStatement();
                                                Integer id =(Integer) session.getAttribute("ayd");
                                                ResultSet rs = st.executeQuery("SELECT * FROM users WHERE user_type != 'Super_Admin'");
                                                if(!rs.next()){
                                                    out.print("0");
                                                }else{
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while(rs.next()){
                                                        ct++;
                                                        
                                                    }
                                                    out.print(ct);
                                                }
                                            %>
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-money-coins text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="numbers">
                                                <p class="card-category">Service Provider</p>
                                                 <%
                                                con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root","");
                                                st = con.createStatement();
                                                rs = st.executeQuery("SELECT * FROM users WHERE user_type = 'Admin'");
                                                if(!rs.next()){
                                                    out.print("0");
                                                }else{
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while(rs.next()){
                                                        ct++;
                                                        
                                                    }
                                                    out.print(ct);
                                                }
                                            %>
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-vector text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="numbers">
                                                <p class="card-category">Clients</p>
                                                 <%
                                                con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root","");
                                                st = con.createStatement();
                                                rs = st.executeQuery("SELECT * FROM users WHERE user_type = 'Client'");
                                                if(!rs.next()){
                                                    out.print("0");
                                                }else{
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while(rs.next()){
                                                        ct++;
                                                        
                                                    }
                                                    out.print(ct);
                                                }
                                            %>
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-favourite-28 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="numbers">
                                                <p class="card-category">Transactions</p>
                                                 <%
                                                con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root","");
                                                st = con.createStatement();
                                                rs = st.executeQuery("SELECT * FROM transactions");
                                                if(!rs.next()){
                                                    out.print("0");
                                                }else{
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while(rs.next()){
                                                        ct++;
                                                        
                                                    }
                                                    out.print(ct);
                                                }
                                            %>
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h5 class="card-title">Users Behavior</h5>
                                    <p class="card-category">24 Hours performance</p>
                                </div>
                                <div class="card-body ">
                                    <canvas id=chartHours width="400" height="100"></canvas>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header ">
                                    <h5 class="card-title">Email Statistics</h5>
                                    <p class="card-category">Last Campaign Performance</p>
                                </div>
                                <div class="card-body ">
                                    <canvas id="chartEmail"></canvas>
                                </div>
                                <div class="card-footer ">
                                    <div class="legend">
                                        <i class="fa fa-circle text-primary"></i> Opened
                                        <i class="fa fa-circle text-warning"></i> Read
                                        <i class="fa fa-circle text-danger"></i> Deleted
                                        <i class="fa fa-circle text-gray"></i> Unopened
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-calendar"></i> Number of emails sent
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-title">NASDAQ: AAPL</h5>
                                    <p class="card-category">Line Chart with Points</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="speedChart" width="400" height="100"></canvas>
                                </div>
                                <div class="card-footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                    </div>
                                    <hr/>
                                    <div class="card-stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer footer-black  footer-white ">
                    <div class="container-fluid">
                        <div class="row">
                            <nav class="footer-nav">
                                <ul>
                                    <li>
                                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                                    </li>
                                    <li>
                                        <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                                    </li>
                                    <li>
                                        <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="credits ml-auto">
                                <span class="copyright">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                                </span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chart JS -->
        <script src="assets/js/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="assets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
        <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
        <script src="assets/demo/demo.js"></script>
        <script>
                                        $(document).ready(function () {
                                            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
                                            demo.initChartsPages();
                                        });
        </script>
    </body>

</html>