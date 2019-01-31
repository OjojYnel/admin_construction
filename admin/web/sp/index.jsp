<%@ page import="java.sql.*" %>

<%
    Class.forName("com.mysql.jdbc.Driver");
%>

<%
    if (request.getParameter("ayd") != null) {
        if (session.getAttribute("ayd") == null) {
            try {
                Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                Statement st = con.createStatement();
                int id = Integer.parseInt(request.getParameter("ayd"));
                ResultSet rs = st.executeQuery("SELECT * FROM users WHERE userid = '" + id + "' ");
                if (!rs.next()) {
                }
                session = request.getSession();
                session.setAttribute("firstname", rs.getString("fname"));
                session.setAttribute("ayd", id);
            } catch (Exception e) {
                System.out.println("Error " + e.toString());
            }
        }
    } else if ((session.getAttribute("ayd") != null) && (request.getParameter("ayd") == null)) {
        //Do nothing
    } else {
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
            Material Dashboard by Creative Tim
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport'/>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/demo/demo.css" rel="stylesheet"/>
    </head>

    <body class="">
        <div class="wrapper ">
            <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
                <!--
                  Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
        
                  Tip 2: you can also add an image using data-image tag
                -->
                <div class="logo">
                    <a href="dashboard.jsp" class="simple-text logo-normal text-center">
                        <%= session.getAttribute("firstname")%>
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="nav-item active  ">
                            <a class="nav-link" href="index.jsp">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="equipments.jsp">
                                <i class="material-icons">content_paste</i>
                                <p>Equipments</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="requests.jsp">
                                <i class="material-icons">library_books</i>
                                <p>Rentals</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="transactions.jsp">
                                <i class="material-icons">notifications</i>
                                <p>Transactions</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end">

                            <ul class="navbar-nav">
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">person</i>
                                        <p class="d-lg-none d-md-block">
                                            Account
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                        <a class="dropdown-item" href="jsp/logout.jsp">Log out</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="equipments.jsp">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-warning card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">content_copy</i>
                                            </div>
                                            <p class="card-category">Equipments</p>
                                            <%
                                                Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                Statement st = con.createStatement();
                                                Integer id = (Integer) session.getAttribute("ayd");
                                                ResultSet rs = st.executeQuery("SELECT * FROM equipments WHERE spid = " + id);
                                                if (!rs.next()) {
                                                    out.print("<h3 class='text-primary'><strong>0</strong></h3>");
                                                } else {
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while (rs.next()) {
                                                        ct++;

                                                    }
                                                    out.print("<h3 class='text-primary'><strong>" + ct + "</strong></h3>");
                                                }
                                            %>

                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons text-danger">warning</i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="requests.jsp">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">store</i>
                                            </div>
                                            <p class="card-category">Requests</p>
                                            <%
                                                con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                st = con.createStatement();
                                                id = (Integer) session.getAttribute("ayd");
                                                rs = st.executeQuery("SELECT * FROM rentals JOIN equipments on rentals.equipId = equipments.equipId WHERE equipments.spid = " + id + " AND rentals.status != 'Finished'");
                                                if (!rs.next()) {
                                                    out.print("<h3 class='text-primary'><strong>0</strong></h3>");
                                                } else {
                                                    rs.beforeFirst();
                                                    int ct = 0;
                                                    while (rs.next()) {
                                                        ct++;

                                                    }
                                                    out.print("<h3 class='text-primary'><strong>" + ct + "</strong></h3>");
                                                }
                                            %>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">date_range</i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="transactions.jsp">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">store</i>
                                            </div>
                                            <p class="card-category">Transactions</p>
                                                                                <%
                                            con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                            st = con.createStatement();
                                            id = (Integer) session.getAttribute("ayd");
                                            rs = st.executeQuery("SELECT * FROM rentals JOIN equipments on rentals.equipId = equipments.equipId WHERE equipments.spid = " + id + " AND rentals.status != 'Renting'");
                                            if (!rs.next()) {
                                                out.print("<h3 class='text-primary'><strong>0</strong></h3>");
                                            } else {
                                                rs.beforeFirst();
                                                int ct = 0;
                                                while (rs.next()) {
                                                    ct++;

                                                }
                                                out.print("<h3 class='text-primary'><strong>" + ct + "</strong></h3>");
                                            }
                                        %>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">date_range</i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>

        
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap-material-design.min.js"></script>
        <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="assets/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="assets/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="assets/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="assets/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="assets/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="assets/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="assets/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chartist JS -->
        <script src="assets/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="assets/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="assets/demo/demo.js"></script>
        

</html>
