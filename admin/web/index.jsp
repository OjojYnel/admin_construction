<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    session.invalidate(); 
    response.sendRedirect("http://localhost/admin_construction");
    
System.out.println("Server Started");
%>