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
     String queryString1 = "UPDATE rentals SET status = 'Canceled' WHERE rentalid = '" + id + "'";
     ps = con.prepareStatement(queryString1);
     ps.executeUpdate();
     
     String queryString = "UPDATE equipments SET equipStatus = 'Available' WHERE equipId = '" + eid + "'";
     ps = con.prepareStatement(queryString);
     ps.executeUpdate();
     
   
     
    
     out.println("<script type=\"text/javascript\">");
     out.println("alert(Rejected!!');");
     out.println("location='../users.jsp';");
     out.println("</script>");
   
    
        
    
    
%>