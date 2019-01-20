package jServlet;

import java.awt.image.BufferedImage;
import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Blob;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet(name = "Equipments", urlPatterns = {"/Equipments"})
public class Equipments extends HttpServlet {

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
            }else{
            ConnectDB db = new ConnectDB();
            Connection conn = db.getConn();
            String query;
                switch (selected) {
                    case "Manufacturers":
                        {
                            query = "Select manufacId, manufacCompany, manufacEmail, manufacAddress, manufacContactNum from manufacturers;";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Manufacturer ID</th>\n"
                                    + " <th>Manufac Company</th>\n"
                                    + " <th>Email</th>\n"
                                    + " <th>Address</th>\n"
                                    + " <th>Contact Number</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("manufacId")+"</td>");
                                out.println("<td>"+rs.getString("manufacCompany")+"</td>");
                                out.println("<td>"+rs.getString("manufacEmail")+"</td>");
                                out.println("<td>"+rs.getString("manufacAddress")+"</td>");
                                out.println("<td>"+rs.getString("manufacContactNum")+"</td>");
                                out.println("</tr>");
                                out.println("</tbody>");
                            }   
                                out.println("   </table>");
                                break;
                        }
                    case "Equip":
                        {
                            query = "Select equipId, equipName, equipDesc, equipEngineNumber, equipPrice, categoryName, manufacCompany, equipStatus, equipImage from equipments INNER JOIN manufacturers using (manufacId) INNER JOIN categories using (categoryId) ORDER BY 1, 2";
                            PreparedStatement ps = conn.prepareStatement(query);
                            ResultSet rs = ps.executeQuery();
                            Blob imageBlob = null;
                            
                            
                            String table = "<table class=\"table table-striped table-bordered table-hover\">"
                                    +   " <thead>\n"
                                    + " <tr>\n"
                                    + " <th>Equipment ID</th>\n"
                                    + " <th>Equipment</th>\n"
                                    + " <th>Description</th>\n"
                                    + " <th>Engine Number</th>\n"
                                    + " <th>Price</th>\n"
                                    + " <th>Category</th>\n"
                                    + " <th>Manufacturer</th>\n"
                                    + " <th>Status</th>\n"
                                    + " <th>Image</th>\n"
                                    + " </tr>\n"
                                    + " </thead>";
                            out.println(table);
                            
                            while(rs.next()){
                                out.println("<tbody>");
                                out.println("<tr class=\"odd gradeX\">");
                                out.println("<td>"+rs.getString("equipId")+"</td>");
                                out.println("<td>"+rs.getString("equipName")+"</td>");
                                out.println("<td>"+rs.getString("equipDesc")+"</td>");
                                out.println("<td>"+rs.getString("equipEngineNumber")+"</td>");
                                out.println("<td>"+rs.getString("equipPrice")+"</td>");
                                out.println("<td>"+rs.getString("categoryName")+"</td>");
                                out.println("<td>"+rs.getString("manufacCompany")+"</td>");
                                out.println("<td>"+rs.getString("equipStatus")+"</td>");
                                
                                out.println("<td><img src="+rs.getBlob("equipimage")+" style=\"height: 80px; width: 80px\"></td>");
                                InputStream in = rs.getBinaryStream("equipimage");  
                                BufferedImage image = ImageIO.read(in);
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
