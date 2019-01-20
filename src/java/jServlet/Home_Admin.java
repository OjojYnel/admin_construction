package jServlet;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet(name = "Home_Admin", urlPatterns = {"/Home_Admin"})
public class Home_Admin extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        response.setHeader("Pragma", "no-cache");
        response.setDateHeader("Expires", 0);
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            HttpSession session = request.getSession(false);
            if(session != null){
                String head = "<!DOCTYPE html>\n" +
                                "<html lang=\"en\">\n" +
                                "    <head>\n" +
                                "        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n" +
                                "        \n" +
                                "        <!-- Bootstrap CSS -->\n" +
                                "        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">\n" +
                                "        \n" +
                                "        <!--- Bootstrap JS -->\n" +
                                "        <script src=\"js/bootstrap.min.js\"></script>\n" +
                                "        <script src=\"js/j-query.min.js\"></script>\n" +
                                "        <script src=\"js/popper.min.js\"></script>\n" +
                                "        \n" +
                                "        <title>Administrator: Home Page </title>\n" +
                                "        \n" +
                                "    </head>";
                String adminheader = "<nav class=\"navbar navbar-dark bg-dark fixed-top navbar-expand-lg\">\n" +
                                "        <a class=\"navbar-brand\" href=\"home_admin.html\">Construction Rental</a>\n" +
                                "        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n" +
                                "            <span class=\"navbar-toggler-icon\"></span>\n" +
                                "        </button>\n" +
                                "        \n" +
                                "        <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">\n" +
                                "            <ul class=\"navbar-nav mr-auto\">\n" +
                                "                <li class=\"nav-item active\">\n" +
                                "                    <a class=\"nav-link\" href=\"home_admin.html\">Home</a>\n" +
                                "                </li>\n" +
                                "                <li class=\"nav-item dropdown\">\n" +
                                "                    <a class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Equipment Products</a>\n" +
                                "                    <div class=\"dropdown-menu\">\n" +
                                "                        <a class=\"dropdown-item\" href=\"equipmentadd.html\">Add Equipment Product</a>\n" +
                                "                        <a class=\"dropdown-item\" href=\"equipments.html\">List of Equipments</a>\n" +
                                "                    </div>\n" +
                                "                </li>\n" +
                                "                <li class=\"nav-item\">\n" +
                                "                    <a class=\"nav-link\" href=\"transactions.html\">Transactions</a>\n" +
                                "                </li>\n" +
                                "                <li class=\"nav-item\">\n" +
                                "                    <a class=\"nav-link\" href=\"usermanagement.html\">User Management</a>\n" +
                                "                </li>\n" +
                                "            </ul>\n" +
                                "            \n" +
                                "            <ul class=\"navbar-nav\">\n" +
                                "                <li class=\"nav-item\">\n" +
                                "                    <form method=\"post\" action=\"Logout\">\n" +
                                "                        <button class=\"btn btn-outline-primary\" type=\"submit\">Logout</button>\n" +
                                "                    </form>\n" +
                                "                </li>\n" +
                                "            </ul>\n" +
                                "        </div>\n" +
                                "    </nav>";
                    String bodyC = "<div class=\"container\">\n" +
                                "            <br><br><br>\n" +
                                "            <h2 class=\"display-2\" id=\"header\" style=\"text-align: center;\">Administrator Dashboard</h2>\n" +
                                "    </div>";
                out.println(head);
                out.println(adminheader);
                out.println(bodyC);
            }else{
                response.sendRedirect("index.html");               
            }
        }
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
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
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
