/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package web.servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import web.beans.Product;

/**
 *
 * @author Earl
 */
@WebServlet(name = "Homes", urlPatterns = {"/Homes"})
public class Homes extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            RequestDispatcher rd = request.getRequestDispatcher("/WEB-INF/header.html");
            rd.include(request, response);
            rd = request.getRequestDispatcher("/WEB-INF/footer.html");
            rd.include(request, response);
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
        String category = request.getParameter("cat");
        String view = request.getParameter("view");
        
        ServletContext context = this.getServletContext();
        Connection dbConn = (Connection) context.getAttribute("dbconn");
        
        String query = "SELECT prodid, description, price " +
                       "FROM products " +
                       "WHERE category = ? " +
                       "ORDER BY description";
        
        try {
            PreparedStatement ps = dbConn.prepareStatement(query);
            ps.setString(1, category);
            
            ResultSet rs = ps.executeQuery();
            
            ArrayList<Product> products = new ArrayList<>();
            
            if (rs.first()) {
                do {
                    String prodid = rs.getString("prodid");
                    String description = rs.getString("description");
                    BigDecimal price = rs.getBigDecimal("price");
                    
                    Product product = new Product(prodid, category, description, price);
                    products.add(product);
                } while (rs.next());
            }
            
            rs.close();
            ps.close();
            
            request.setAttribute("products", products);
            
            RequestDispatcher rd = null;
            
            if (view.equalsIgnoreCase("html")) {
                rd = request.getRequestDispatcher("ShowHTML");
            } else if (view.equalsIgnoreCase("json")) {
                rd = request.getRequestDispatcher("ShowJSON");
            }
            
            if (rd == null) {
                response.sendError(400);
            } else {
                rd.forward(request, response);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(Homes.class.getName()).log(Level.SEVERE, null, ex);
            
            response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
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