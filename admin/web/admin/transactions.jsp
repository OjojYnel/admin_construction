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
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            Paper Dashboard 2 by Creative Tim
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/demo/demo.css" rel="stylesheet" />
    </head>

    <body class="">
        <div class="wrapper ">
            <div class="sidebar" data-color="white" data-active-color="danger">
                <!--
                  Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
                -->
                <div class="logo">
                    <a href="dashboard.jsp" class="simple-text logo-normal text-center">
                        <%= session.getAttribute("firstname")%>
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li>
                            <a href="dashboard.jsp">
                                <i class="nc-icon nc-bank"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li >
                            <a href="users.jsp">
                                <i class="nc-icon nc-single-02"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="active">
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
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">

                            <ul class="navbar-nav">

                                <li class="nav-item btn-rotate dropdown">
                                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <!-- <div class="panel-header panel-header-sm">
            
            
          </div> -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title ">Transactions</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="example" width="100%">
                                                <thead class=" text-primary">
                                                <th>
                                                    Client
                                                </th>
                                                <th>
                                                    Service Provider
                                                </th>
                                                <th>
                                                    Equipment
                                                </th>
                                                <th>
                                                    Rental Date
                                                </th>
                                                <th>
                                                    Return Date
                                                </th>
                                                <th>
                                                    Duration/Days
                                                </th>
                                                <th>
                                                    Price
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                </thead>
                                                <tbody>
                                                    <%
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Connection con1 = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        Statement st2= con1.createStatement();
                                                        Integer ayd = (Integer) session.getAttribute("ayd");
                                                        ResultSet rs = st.executeQuery("SELECT * FROM `rentals` JOIN users on rentals.userId = users.userid JOIN equipments ON rentals.equipId = equipments.equipId WHERE rentals.status !='Renting'");
                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            String sp = "";
                                                            while (rs.next()) {
                                                                
                                                                int eid = rs.getInt("rentals.equipId");
                                                                ResultSet rs2 = st2.executeQuery("SELECT * FROM equipments JOIN users on equipments.spid = users.userid WHERE equipId = '" + eid + "'");
                                                                if(rs2.next()){
                                                                    sp = rs2.getString("users.fname") + " " + rs2.getString("users.lname");
                                                                }
                                                                
                                                                
                                                                
                                                                out.println("<tr><td>" + rs.getString("users.fname") + " " + rs.getString("users.lname"));
                                                                out.println("</td><td>" + sp);
                                                                out.println("</td><td>" + rs.getString("equipments.equipName"));
                                                                out.println("</td><td>" + rs.getString("rentals.rental_date"));
                                                                out.println("</td><td>" + rs.getString("rentals.return_date"));
                                                                out.println("</td><td>" + rs.getInt("rentals.duration"));
                                                                out.println("</td><td>" + rs.getInt("duration") * rs.getInt("equipments.equipPrice") + ".00");
                                                                out.println("</td><td>" + rs.getString("rentals.status"));
                                                                
                                                                out.println("</td></tr>");

                                                            }
                                                        }
                                                    %>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <footer class="footer footer-black  footer-white ">
                    <div class="container-fluid">

                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="http://localhost/admin_construction/php/register.php" method="post">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header card-header-primary">
                                                    <h4 class="card-title text-center">Signup</h4>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">First Name</label>
                                                                <input required type="text" name="fname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Last Name</label>
                                                                <input required type="text" name="lname" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Email</label>
                                                                <input required type="email" name="eml" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Contact Number</label>
                                                                <input required type="number" name="num" min="10"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Username</label>
                                                                <input required type="text" min="8" name="username" max="22"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">User Type</label>
                                                                <select name="ty" class="form-control">
                                                                    <option value="Admin">Service Provider</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Password</label>
                                                                <input required type="password" min="8" name="pass"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="bmd-label-floating">Confirm Password</label>
                                                                <input required type="password" min="8" name="pass2"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
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
    </body>

</html>