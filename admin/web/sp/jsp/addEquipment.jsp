
<%@ page import="java.io.*"%>
<%@ page import="java.util.*"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
  

    try {
        
        

        
        session = request.getSession();
        Integer aydd = (Integer) session.getAttribute("ayd");

        Class.forName("com.mysql.jdbc.Driver");
        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction",
                "root", "");

        String cname = request.getParameter("cname");
        String cemail = request.getParameter("cemail");
        String cadd = request.getParameter("cadd");
        String cnum = request.getParameter("cnum");

        String spid = request.getParameter("spid");
        String equipname = request.getParameter("equipname");
        String equipdesc = request.getParameter("equipdesc");
        String engum = request.getParameter("enginenum");
        
        String queryString = "SELECT * FROM equipments WHERE equipEngineNumber = '" + engum +"'";
        Statement st = con.createStatement();
        ResultSet rs = st.executeQuery(queryString);
        if (rs.next()) {
            out.println("<script type=\"text/javascript\">");
            out.println("alert('Engine Number already exist!');");
            out.println("location='../equipments.jsp';");
            out.println("</script>");
        }
        
        
        String price = request.getParameter("price");
        String color = request.getParameter("color");
        String catid = request.getParameter("catid");
        String es = request.getParameter("es");
        String eimage = request.getParameter("eimage");

        PreparedStatement ps = null;

        String sql = "INSERT INTO manufacturers(manufacCompany,manufacEmail,manufacAddress,manufacContactNum) VALUES(?,?,?,?)";
        ps = con.prepareStatement(sql);
        ps.setString(1, cname);
        ps.setString(2, cemail);
        ps.setString(3, cadd);
        ps.setString(4, cnum);
        ps.executeUpdate();

        queryString = "SELECT * FROM manufacturers ORDER BY manufacId DESC LIMIT 1";
        st = con.createStatement();
        rs = st.executeQuery(queryString);
        int ayd = 0;
        if (rs.next()) {
            ayd = rs.getInt("manufacId");
        }

        String sql2 = "INSERT INTO equipments(spid,equipName,equipDesc,manufacId,equipEngineNumber,equipPrice,categoryId,equipStatus,color) VALUES(?,?,?,?,?,?,?,?,?)";
        ps = con.prepareStatement(sql2);
        ps.setInt(1, aydd);
        ps.setString(2, equipname);
        ps.setString(3, equipdesc);
        ps.setInt(4, ayd);
        ps.setString(5, engum);
        ps.setString(6, price);
        ps.setString(7, catid);
        ps.setString(8, "Available");
        ps.setString(9, color);
        ps.executeUpdate();

        out.println("<script type=\"text/javascript\">");
        out.println("alert('Successfuly Added!');");
        out.println("location='../equipments.jsp';");
        out.println("</script>");

    } catch (Exception e) {
        e.printStackTrace();
        out.println(e.toString());
        
    
    }


%>