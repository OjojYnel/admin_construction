package jServlet;

import java.io.IOException;
import java.io.PrintWriter;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
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

@WebServlet(name = "updatePassword", urlPatterns = {"/updatePassword"})
public class updatePassword extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, SQLException, NoSuchAlgorithmException {
        response.setContentType("text/html;charset=UTF-8");
        response.setContentType("text/html");
        String alertSuccess = "<script type=\"text/javascript\">"
                + "alert('Password hav been successfully changed.');"
                + "</script>"; 
        String alertFailed = "<script type=\"text/javascript\">"
                + "alert('Failed to change password.');"
                + "</script>"; 
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            String conNum = request.getParameter("cnum");
            String oldpass = request.getParameter("password");
            String newpass = request.getParameter("cpass");
            //uPass = sha1(uPass);
            ConnectDB db = new ConnectDB();
            Connection conn = db.getConn();
            String stmt = "select * from users where user_type='Admin' or user_type='Super_Admin' AND contactnum='"+conNum+"';";
            PreparedStatement ps = conn.prepareStatement(stmt);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                if (conNum.equals(rs.getString("contactnum")) && oldpass.equals(rs.getString("password"))) {
                    //newpass = sha1(newpass);
                    String update = "UPDATE users SET `password`='"+newpass+"' WHERE userid='"+rs.getString("userid")+";";
                    PreparedStatement ps1 = conn.prepareStatement(update);
                    ps1.executeUpdate(update);
                    out.println(alertSuccess);
                    RequestDispatcher rd = request.getRequestDispatcher("forgotpassword.html");
                    rd.include(request, response);
                } else {
                    out.println(alertFailed);
                    RequestDispatcher rd = request.getRequestDispatcher("forgotpassword.html");
                    rd.include(request, response);
                }
            }
            
            conn.close();
        } catch (SQLException ex) {
            Logger.getLogger(updatePassword.class.getName()).log(Level.SEVERE, null, ex);
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
            try {
                processRequest(request, response);
            } catch (NoSuchAlgorithmException ex) {
                Logger.getLogger(updatePassword.class.getName()).log(Level.SEVERE, null, ex);
            }
        } catch (SQLException ex) {
            Logger.getLogger(updatePassword.class.getName()).log(Level.SEVERE, null, ex);
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
            try {
                processRequest(request, response);
            } catch (NoSuchAlgorithmException ex) {
                Logger.getLogger(updatePassword.class.getName()).log(Level.SEVERE, null, ex);
            }
        } catch (SQLException ex) {
            Logger.getLogger(updatePassword.class.getName()).log(Level.SEVERE, null, ex);
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
