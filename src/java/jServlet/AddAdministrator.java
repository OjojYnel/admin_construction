package jServlet;

import java.io.IOException;
import java.io.PrintWriter;
import static java.lang.System.out;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


@WebServlet(name = "AddAdministrator", urlPatterns = {"/AddAdministrator"})
public class AddAdministrator extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException, SQLException, NoSuchAlgorithmException {
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate"); // HTTP 1.1.
        response.setHeader("Pragma", "no-cache"); // HTTP 1.0.
        response.setDateHeader("Expires", 0); // Proxies.
        response.setContentType("text/html;charset=UTF-8");
        HttpSession session = request.getSession(false);
        if (session == null) {
            response.sendRedirect("index.html");
        } else {
            String uname = request.getParameter("username");
            String fName = request.getParameter("fname");
            String lName = request.getParameter("lname");
            String cNum = request.getParameter("cnum");
            String email = request.getParameter("email");
            String pwd = request.getParameter("password");
            //String cpass = request.getParameter("cpass");
            String uType = "Admin";
            String acct_stat = "Active";
            response.setContentType("text/html");
            String query;
            try (PrintWriter out = response.getWriter()) {
                    ConnectDB db = new ConnectDB(); 
                    Connection conn = db.getConn();
                    pwd = sha1(pwd);
                    //java.util.Date date = new java.util.Date();
                    //java.sql.Date sqlDate = new java.sql.Date(date.getTime());
                    //java.sql.Timestamp sqlTime = new java.sql.Timestamp(date.getTime());
                    query = "INSERT INTO `construction`.`users` (username, fname, lname, contactnum, email, password, user_type, account_status) VALUES ('" + uname + "','" + fName + "','" + lName + "','" + cNum + "','" +email+ "','" + pwd + "','" + uType + "', 'Active')'";
                    PreparedStatement p1 = conn.prepareStatement(query);
                    p1.executeUpdate();
                    conn.close();
                    response.sendRedirect("ok.html");
                } catch (SQLException ex) {
                    Logger.getLogger(AddAdministrator.class.getName()).log(Level.SEVERE, null, ex);
                }
            /*}else{
                    
                    
                    out.println("<script type=\"text/javascript\">");
                    out.println("alert('Password do not match.');");
                    out.println("</script>");
            }*/
            
            RequestDispatcher rd = request.getRequestDispatcher("addadmin.html");
            rd.include(request, response);
        
        
    }

    }
    
    public String sha1(String input) throws NoSuchAlgorithmException {
        MessageDigest mDigest;
        mDigest = MessageDigest.getInstance("SHA1");
        byte[] result = mDigest.digest(input.getBytes());
        StringBuilder sb = new StringBuilder();
        for (int i = 0; i < result.length; i++) {
            sb.append(Integer.toString((result[i] & 0xff) + 0x100, 16).substring(1));
        }

        return sb.toString();
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
        } catch (SQLException | NoSuchAlgorithmException ex) {
            Logger.getLogger(AddAdministrator.class.getName()).log(Level.SEVERE, null, ex);
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
        } catch (SQLException | NoSuchAlgorithmException ex) {
            Logger.getLogger(AddAdministrator.class.getName()).log(Level.SEVERE, null, ex);
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
