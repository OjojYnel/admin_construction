
<%@ page import="java.io.*"%>
<%@ page import="java.util.*"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
String color2 = "";
int manid = 0;
               String cname2 = "";
               String cemail2 = "";
               String cadd2 = "";
               String cnum2 = "";
               
               String equipname2 = "";
               String equipdesc2 = "";
               String engum2 = "";
               String price2 = "";
               String catid2 = "";




    try {

        session = request.getSession();

        Class.forName("com.mysql.jdbc.Driver");
        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction",
                "root", "");
        int ayd = Integer.parseInt(request.getParameter("equipId"));

        Statement st = con.createStatement();
        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");
        
        
               
        
        if (rs.next()) {
               cname2 = rs.getString("manufacturers.manufacCompany");
               cemail2 = rs.getString("manufacturers.manufacEmail");
               cadd2 = rs.getString("manufacturers.manufacAddress");
               cnum2 = rs.getString("manufacturers.manufacContactNum");
               
               equipname2 = rs.getString("equipments.equipName");
               equipdesc2 = rs.getString("equipments.equipDesc");
               engum2 = rs.getString("equipments.equipEngineNumber");
               price2 = rs.getString("equipments.equipPrice");
               color2 = rs.getString("equipments.color");
               catid2 = rs.getString("equipments.categoryId");
               
               
               manid = rs.getInt("equipments.manufacId");
               
        }
 

      
        String cname = request.getParameter("cname");
        if (cname.isEmpty()) {
            cname = cname2;
        }
        
        String cemail = request.getParameter("cemail");
        if (cemail.isEmpty()) {
            cemail = cemail2;
        }
        String cadd = request.getParameter("cadd");
        if (cadd.isEmpty()) {
            cadd = cadd2;
        }
        String cnum = request.getParameter("cnum");
        if (cnum.isEmpty()) {
            cnum = cnum2;
        }
        

        
        String equipname = request.getParameter("equipname");
        if (equipname.isEmpty()) {
            equipname = equipname2;
        }
        String equipdesc = request.getParameter("equipdesc");
        if (equipdesc.isEmpty()) {
            equipdesc = equipdesc2;
        }
        String engum = request.getParameter("enginenum");
        if (engum.isEmpty()) {
            engum = engum2;
        }
        String price = request.getParameter("price");
        if (price.isEmpty()) {
            price = price2;
        }
        String color = request.getParameter("color");
        out.println(color);
        out.println(color2);
        if (color.isEmpty()) {
            color = color2;
        }
        
        String catid = request.getParameter("catid");
        out.println(catid);
        out.println(catid2);
        if (catid.isEmpty()) {
            catid = catid2;
        }else{
            out.println("success111");
        }
        
     

        PreparedStatement ps = null;
        

        String sql = "UPDATE manufacturers SET manufacCompany = ?,manufacEmail = ?,manufacAddress = ?,manufacContactNum = ? WHERE manufacId = " + manid;
        ps = con.prepareStatement(sql);
        ps.setString(1, cname);
        ps.setString(2, cemail);
        ps.setString(3, cadd);
        ps.setString(4, cnum);
        //ps.executeUpdate();
        
        int i = ps.executeUpdate();
        if (i > 0) {
            out.println("success");
            out.println(catid);
        } else {
            out.println("stuck somewhere");
        }


        String sql2 = "UPDATE equipments SET equipName = ?,equipDesc = ?,equipEngineNumber = ?,equipPrice = ?,color = ?,categoryId = ? WHERE equipId = " + ayd;
        ps = con.prepareStatement(sql2);
        ps.setString(1, equipname);
        ps.setString(2, equipdesc);
        ps.setString(3, engum);
        ps.setString(4, price);
        ps.setString(5, color);
        ps.setString(6, catid);
        ps.executeUpdate();
        
        int ii = ps.executeUpdate();
        if (ii > 0) {
            out.println("success");
        } else {
            out.println("stuck somewhere");
        }

        out.println("<script type=\"text/javascript\">");
        out.println("alert('Successfuly Updated!');");
        out.println("location='../equipments.jsp';");
        out.println("</script>");

    } catch (Exception e) {
        e.printStackTrace();
        out.println(e.toString());
        out.println(catid2);

    }


%>