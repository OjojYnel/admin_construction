<%@ page import="java.sql.*" %>
<%@page import="java.sql.ResultSet"%>
<% Class.forName("com.mysql.jdbc.Driver"); %>
<div class="modal-body">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-center">New Equipment</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Company Name</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input type='text' name='cname' class='form-control' placeholder='" + rs.getString("manufacturers.manufacCompany") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Company Email</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='text' name='cemail' class='form-control' placeholder='" + rs.getString("manufacturers.manufacEmail") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Company Address</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='text' name='cadd' class='form-control' placeholder='" + rs.getString("manufacturers.manufacAddress") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Company Number</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='text' name='cnum' class='form-control' placeholder='" + rs.getString("manufacturers.manufacContactNum") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">Equipment Name</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='text' name='equipname' class='form-control' placeholder='" + rs.getString("equipments.equipName") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="">Description</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<textarea  type='text' name='equipdesc' class='form-control' placeholder='" + rs.getString("equipments.equipDesc") +"'></textarea>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Engine Number</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='text' name='enginenum' class='form-control' placeholder='" + rs.getString("equipments.equipEngineNumber") +"'>");

                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select required name="catid" class="form-control">
                                              <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM categories");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                                            out.print("<option selected disabled>Category</option>");
                                                                            while (rs.next()) {
                                                                                out.println("<option value='" + rs.getString("categoryId") + "'>" + rs.getString("categoryName") + "</option>");

                                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="">Price</label>
                                            <%
                                                
                                                try{
                                                        Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction", "root", "");
                                                        Statement st = con.createStatement();
                                                        int ayd = Integer.parseInt(request.getParameter("num"));
                                                        ResultSet rs = st.executeQuery("SELECT * FROM equipments JOIN manufacturers ON equipments.manufacId=manufacturers.manufacId WHERE equipments.equipId = '" + ayd + "'");

                                                        if (!rs.next()) {
                                                            out.print("<tr><td>No records</td></tr>");
                                                        } else {
                                                            rs.beforeFirst();
                                                            if(rs.next()) {
                                                                out.println("<input  type='number' name='price' class='form-control' placeholder='" + rs.getString("equipments.equipPrice") +"'>");
                                                                out.println("<input  type='hidden' name='equipId' class='form-control' value='" + ayd +"'>");
                                                               
                                                            }
                                                        }
                                                }catch(Exception e){
                                                    out.println(e.toString());
                                                }
                                                
                                                    %>
                                                    
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
