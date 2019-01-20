/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jServlet;

import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Part;

/**
 *
 * @author Albert Baterina
 */
@WebServlet(name = "AddEquipment", urlPatterns = {"/AddEquipment"})
public class AddEquipment extends HttpServlet {

    

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
        processRequest(request, response);
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
        response.setContentType("text/html;charset=UTF-8");
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        response.setHeader("Pragma", "no-cache");
        response.setDateHeader("Expires", 0);
        response.setContentType("text/html;charset=UTF-8");
        HttpSession session = request.getSession(false);
        if (session == null) {
            response.sendRedirect("index.html");
        } else {
            String equip = request.getParameter("equipname");
            String desc = request.getParameter("desc");
            String eNum = request.getParameter("enginenum");
            String price = request.getParameter("price");
            String manu = request.getParameter("manufac");
            String cat = request.getParameter("category");
            Part fU = request.getPart("fileUploaded");
            String query;
            String manufacid;
            String catId;
            int result = 0;
            try (PrintWriter out = response.getWriter()) {
                    ConnectDB db = new ConnectDB(); 
                    Connection conn = db.getConn();
                    manufacid = "SELECT manufacid from manufacturers where manufacCompany='"+manu+"' LIMIT 1;";
                    catId = "Select categoryId from categories where categoryName='"+cat+"' LIMIT 1;";
                    PreparedStatement p1 = conn.prepareStatement(manufacid);
                    ResultSet rs = p1.executeQuery();
                    String eid = "";
                    while (rs.next()) {
                        eid = rs.getString("manufacid");
                    }
                    PreparedStatement pcatid = conn.prepareStatement(catId);
                    ResultSet rs2 = pcatid.executeQuery();
                    String cid = "";
                    while (rs.next()) {
                        cid = rs.getString("categoryId");
                    }
                    query = "INSERT INTO `construction`.`equipments` (equipName, equipDesc, manufacId, equipEngineNumber, equipPrice, categoryId, equipimage) VALUES ('" + equip + "','" + desc + "','" + eid + "','" + eNum + "','" +price+ "','" +cid+ "','" +fU+"')'";
                    InputStream is = fU.getInputStream();
                    PreparedStatement p2 = conn.prepareStatement(query);
                    p2.executeUpdate();
                    conn.close();
                    response.sendRedirect("ok.html");
            }catch(SQLException ex) {
                    Logger.getLogger(AddEquipment.class.getName()).log(Level.SEVERE, null, ex);
            }
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

    private void processRequest(HttpServletRequest request, HttpServletResponse response) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

}
