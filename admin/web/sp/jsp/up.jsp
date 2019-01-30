<%@ page import="java.sql.*" %>
<%@ page import="org.apache.commons.fileupload.*"%>
<%@ page import="org.apache.commons.io.output.*"%>
<%@ page import="org.apache.commons.fileupload.servlet.*"%>
<%@ page import="org.apache.commons.fileupload.disk.*"%>
<%@ page import="java.io.*"%>
<%@ page import="java.util.*"%>
<%
   Connection conn=null;
   Class.forName("com.mysql.jdbc.Driver").newInstance();
    conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/construction","root", "");

   PreparedStatement psImageInsertDatabase=null;
   int id = Integer.parseInt(request.getParameter("num"));

   byte[] b=null;
   try{
      String sqlImageInsertDatabase="UPDATE equipments SET equipimage = ? WHERE equipId =" + id;
      psImageInsertDatabase=conn.prepareStatement(sqlImageInsertDatabase);

      DiskFileItemFactory factory = new DiskFileItemFactory();

      ServletFileUpload sfu = new ServletFileUpload(factory);
      List items = sfu.parseRequest(request);

      Iterator iter = items.iterator();

      while (iter.hasNext()) {
         FileItem item = (FileItem) iter.next();
         if (!item.isFormField()) {
              b = item.get();
          }
      }

      
      psImageInsertDatabase.setBytes(1,b);
      psImageInsertDatabase.executeUpdate();
      
      
       out.println("<script type=\"text/javascript\">");
        out.println("alert('Image Added!');");
        out.println("location='../equipments.jsp';");
        out.println("</script>");
   }
   catch(Exception e)
   {
     e.printStackTrace();
     out.println(e.toString());
   }

%>