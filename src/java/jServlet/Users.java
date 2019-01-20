package jServlet;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

@WebServlet(name = "Users", urlPatterns = {"/Users"})
public class Users extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException, SQLException {
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        response.setHeader("Pragma", "no-cache");
        response.setDateHeader("Expires", 0);
        response.setContentType("text/html;charset=UTF-8");
        String selected = request.getParameter("slcted");
        try (PrintWriter out = response.getWriter()) {
            HttpSession session = request.getSession(false);
            if(session == null){
                response.sendRedirect("index.html");  
            }else {
            ConnectDB db = new ConnectDB();
            Connection conn = db.getConn();
            String query;
            Date todaysDate = new Date();
            DateFormat df2 = new SimpleDateFormat("dd-MM-yyyy HH:mm:ss");
                switch (selected) {
                    case "ClientAccounts":
                        {
                            query = "Select userid, username, fname, lname, contactnum, date_created from users where user_type='Client' and account_status='Active';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>User ID</th>\n"
                                    + " <th>Username</th>\n"
                                    + " <th>First Name</th>\n"
                                    + " <th>Last Name</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " <th>Date Registered</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("userid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("fname")+"</td>");
                                out.println("<td>"+rs.getString("lname")+"</td>");
                                out.println("<td>"+rs.getString("contactnum")+"</td>");
                                out.println("<td>"+rs.getDate("date_created")+"</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }   
                                out.println("   </table>");
                                break;
                        }
                        //Exclusively for Super_Admin Display
                        case "All Accounts":
                        {
                            query = "Select userid, username, fname, lname, contactnum, date_created from users where account_status='Active';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>User ID</th>\n"
                                    + " <th>Username</th>\n"
                                    + " <th>First Name</th>\n"
                                    + " <th>Last Name</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " <th>Date Registered</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("userid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("fname")+"</td>");
                                out.println("<td>"+rs.getString("lname")+"</td>");
                                out.println("<td>"+rs.getString("contactnum")+"</td>");
                                out.println("<td>"+rs.getDate("date_created")+"</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }   
                                out.println("   </table>");
                                break;
                        }
                    case "Pending Accounts":
                        {
                            query = "Select userid, username, fname, lname, contactnum, email, date_created from users where user_type='Client' and account_status='Pending' ORDER BY date_created DESC;";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>User ID</th>\n"
                                    + " <th>Username</th>\n"
                                    + " <th>First Name</th>\n"
                                    + " <th>Last Name</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " <th>Email</th>\n"
                                    + " <th>Date Registered</th>\n"
                                    + " <th>Action</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("userid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("fname")+"</td>");
                                out.println("<td>"+rs.getString("lname")+"</td>");
                                out.println("<td>"+rs.getString("contactnum")+"</td>");
                                out.println("<td>"+rs.getString("email")+"</td>");
                                out.println("<td>"+rs.getDate("date_created")+"</td>");
                                out.println("<td>"
                                        + "<form method=\"post\" action=\"ActivateAccount\">"
                                        + "<input type=\"submit\" name=\"activate status\"" +rs.getString("userid")+" class=\"btn btn-success\">Activate</input>"
                                        + "</form>"
                                        + "<form method=\"post\" action=\"DenyAccount\">"
                                        + "<input type=\"submit\" name=\"deny_status\""+rs.getString("useris")+" class=\"btn btn-danger\">Deny</input>"
                                        + "</form>"
                                        + "</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                        //Exclusively for Super Admin Action
                    case "Enable Accounts":
                        {
                            query = "Select userid, username, fname, lname, contactnum, email, date_created from users \n" +
                                    "where account_status='Active' AND (user_type='Client' OR  user_type='Admin');";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>User ID</th>\n"
                                    + " <th>Username</th>\n"
                                    + " <th>First Name</th>\n"
                                    + " <th>Last Name</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " <th>Email</th>\n"
                                    + " <th>Date Registered</th>\n"
                                    + " <th>Activate Account</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("userid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("fname")+"</td>");
                                out.println("<td>"+rs.getString("lname")+"</td>");
                                out.println("<td>"+rs.getString("contactnum")+"</td>");
                                out.println("<td>"+rs.getString("email")+"</td>");
                                out.println("<td>"+rs.getDate("date_created")+"</td>");
                                out.println("<td>"
                                        + "<form method=\"post\" action=\"ActivateAccount\">"
                                        + "<input type=\"submit\" name=\"activate\"" +rs.getString("userid")+" class=\"btn btn-success\"></input>"
                                        + "</form>"
                                        + "</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                        //Exclusively for Super Admin Action
                    case "Disable Accounts":
                        {
                            query = "Select userid, username, fname, lname, contactnum, email, date_created from users \n" +
                                    "where account_status='Active' AND (user_type='Client' OR  user_type='Admin');";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>User ID</th>\n"
                                    + " <th>Username</th>\n"
                                    + " <th>First Name</th>\n"
                                    + " <th>Last Name</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " <th>Email</th>\n"
                                    + " <th>Date Registered</th>\n"
                                    + " <th>Disable Account</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("userid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("fname")+"</td>");
                                out.println("<td>"+rs.getString("lname")+"</td>");
                                out.println("<td>"+rs.getString("contactnum")+"</td>");
                                out.println("<td>"+rs.getString("email")+"</td>");
                                out.println("<td>"+rs.getDate("date_created")+"</td>");
                                out.println("<td>"
                                        + "<form method=\"post\" action=\"DisableAccount\">"
                                        + "<input type=\'submit\' name=\'disable\' " +rs.getString("userid")+" class=\'btn btn-success\'></input>"
                                        + "</form>"
                                        + "</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                    default:
                        break;
                }
            RequestDispatcher rd = request.getRequestDispatcher("/pagefragments/a_footer.html");
            rd.include(request, response);
            conn.close();
            }
        } catch (SQLException ex) {
            Logger.getLogger(Users.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (SQLException ex) {
            Logger.getLogger(Users.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (SQLException ex) {
            Logger.getLogger(Users.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
