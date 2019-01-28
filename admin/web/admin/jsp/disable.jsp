<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
   int id = Integer.parseInt(request.getParameter("rid"));
   session = request.getSession();
     Integer ayd =(Integer) session.getAttribute("ayd");
   
    Class.forName("com.mysql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction",
            "root", "");
    
     String queryString = "UPDATE users SET account_status = 'Denied' WHERE userid = '" + id + "'";
    
     
     PreparedStatement ps = null;
     ps = con.prepareStatement(queryString);
     ps.executeUpdate();
     
    
     out.println("<script type=\"text/javascript\">");
     out.println("alert('Disabled!!');");
     out.println("location='../users.jsp';");
     out.println("</script>");
   
    
        
    
    
%>