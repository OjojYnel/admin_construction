<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
   int id = Integer.parseInt(request.getParameter("rid"));
   int eid = Integer.parseInt(request.getParameter("eid"));
   session = request.getSession();
     Integer ayd =(Integer) session.getAttribute("ayd");
   
    Class.forName("com.mysql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction",
            "root", "");
    
     
     PreparedStatement ps = null;
     String queryString1 = "UPDATE rentals SET status = 'Finished' WHERE rentalid = '" + id + "'";
     ps = con.prepareStatement(queryString1);
     ps.executeUpdate();
     
     String queryString2 = "UPDATE equipments SET equipStatus = 'Available' WHERE equipId = '" + eid + "'";
     ps = con.prepareStatement(queryString2);
     ps.executeUpdate();
     
    String sql = "INSERT INTO transactions(userId,equipId,rentalid) VALUES(?,?,?)";
    ps = con.prepareStatement(sql);
    ps.setInt(1, ayd);
    ps.setInt(2, eid);
    ps.setInt(3, id);
    ps.executeUpdate();
     
    
     out.println("<script type=\"text/javascript\">");
     out.println("alert('Finished!!');");
     out.println("location='../requests.jsp';");
     out.println("</script>");
   
    
        
    
    
%>