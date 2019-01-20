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

@WebServlet(name = "Transactions", urlPatterns = {"/Transactions"})
public class Transactions extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException, SQLException {
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        response.setHeader("Pragma", "no-cache");
        response.setDateHeader("Expires", 0);
        response.setContentType("text/html;charset=UTF-8");
        response.setContentType("text/html");
        String selected = request.getParameter("slcted");
        try (PrintWriter out = response.getWriter()) {
            HttpSession session = request.getSession(false);
            if(session == null){
                response.sendRedirect("index.html");  
            }else {
            ConnectDB db = new ConnectDB();
            Connection conn = db.getConn();
            String query;
                switch (selected) {
                    case "Pending Rentals":
                        {
                            query = "Select rentalid, username, equipName, rental_date, duration from rentals\n" +
                                    "INNER JOIN users using (userid) INNER JOIN equipments using (equipid) where status='Pending';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Rental ID</th>\n"
                                    + " <th>Client Username</th>\n"
                                    + " <th>Equipment</th>\n"
                                    + " <th>Date of Rental</th>\n"
                                    + " <th>Rental Duration (Days)</th>\n"
                                    + " <th>Accept | Decline</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("rentalid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("equipName")+"</td>");
                                out.println("<td>"+rs.getString("rental_date")+"</td>");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("duration")+"</td>");
                                out.println("<td>"
                                        + "<form method=\"post\" action=\"RentalAccept\">"
                                        + "Accept<input type=\'Submit\' name=\'disable\' " +rs.getString("rentalid")+" class=\'btn btn-success\'></input>"
                                        + "</form>"
                                        + "<form method=\"post\" action=\"DeclineRental\">"
                                        + "Decline<input type=\'Submit\' name=\'disable\' " +rs.getString("rentalid")+" class=\'btn btn-danger\'></input>"
                                        + "</form>"
                                        + "</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }   
                                out.println("   </table>");
                                break;
                        }
                    case "Ongoing Rentals":
                        {
                            query = "Select rentalid, username, equipName, rental_date, duration from rentals INNER JOIN users using (userid) INNER JOIN equipments using (equipid) where status='Renting';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Rental Id</th>\n"
                                    + " <th>Client Username</th>\n"
                                    + " <th>Equipment Rented</th>\n"
                                    + " <th>Rental Date</th>\n"
                                    + " <th>Rental Duration (Days)</th>\n"
                                    + " <th>Update Rental (to Finished)</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("rentalid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("equipName")+"</td>");
                                out.println("<td>"+rs.getString("rental_date")+"</td>");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("duration")+"</td>");
                                out.println("<td>"
                                        + "<form method=\"post\" action=\"RentalFinish\">"
                                        + "<input type=\'Submit\' name=\'disable\' " +rs.getString("rentalid")+" class=\'btn btn-success\'></input>"
                                        + "</form>"
                                        + "</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                    case "Finished Rentals":
                        {
                            query = "Select rentalid, username, equipName, rental_date, return_date, duration from rentals "
                                    + "INNER JOIN users using (userid) INNER JOIN equipments using (equipid) where status='Finished';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Transaction Id</th>\n"
                                    + " <th>Client Username</th>\n"
                                    + " <th>Equipment Rented</th>\n"
                                    + " <th>Date Rented</th>\n"
                                    + " <th>Date Returned</th>\n"
                                    + " <th>Days Rented</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("rentalid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("equipName")+"</td>");
                                out.println("<td>"+rs.getString("rental_date")+"</td>");
                                out.println("<td>"+rs.getString("return_date")+"</td>");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("duration")+"</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                    case "Cancelled Rentals":
                        {
                            query = "Select rentalid, username, equipName, rental_date, duration from rentals "
                                  + "INNER JOIN users using (userid) INNER JOIN equipments using (equipid) where status='Cancelled';";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Rental Id</th>\n"
                                    + " <th>Client Username</th>\n"
                                    + " <th>Equipment</th>\n"
                                    + " <th>Proposed Date of Rental</th>\n"
                                    + " <th>Proposed Days of Rental</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("rentalid")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td>"+rs.getString("equipName")+"</td>");
                                out.println("<td>"+rs.getString("rental_date")+"</td>");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("duration")+"</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }       
                                out.println("   </table>");
                                break;
                        }
                        case "Transact Records":
                        {
                            query = "select rental_id, username, totalPayment from transaction inner join users using (userid);";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Rental ID</th>\n"
                                    + " <th>User Client</th>\n"
                                    + " <th>Payment Made</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("rental_id")+"</td>");
                                out.println("<td>"+rs.getString("username")+"</td>");
                                out.println("<td style=\'text-align: right;\'>"+rs.getString("totalPayment")+"</td>");
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
            }
        } catch (SQLException ex) {
            Logger.getLogger(Transactions.class.getName()).log(Level.SEVERE, null, ex);
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
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (SQLException ex) {
            Logger.getLogger(Transactions.class.getName()).log(Level.SEVERE, null, ex);
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
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        try {
            processRequest(request, response);
        } catch (SQLException ex) {
            Logger.getLogger(Transactions.class.getName()).log(Level.SEVERE, null, ex);
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
