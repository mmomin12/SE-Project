<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import ="user.UserDTO" %>
<%@ page import ="user.UserDAO" %>
<%@ page import ="util.SHA256" %>
<%@ page import = "java.io.PrintWriter"%>
<%
	request.setCharacterEncoding("UTF-8");
	String userID = null;
	String userPassword = null;
	
	if(request.getParameter("userID") != null){
		userID = request.getParameter("userID");
	}
	
	if(request.getParameter("userPassword") != null){
		userPassword = request.getParameter("userPassword");
	}
	
	if(userID == null || userPassword == null ){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('you are missing something');");
		script.println("history.back();");
		script.println("</script>");
		script.close();
		return;
	}
	
	UserDAO userDAO = new UserDAO();
	int result = userDAO.login(userID, userPassword);

		if(result == 1){
		session.setAttribute("userID", userID);
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("location.href = 'index.jsp'");
		script.println("</script>");
		script.close();
		return;
	}
	else if(result == 0){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('invalid password');");
		script.println("history.back();");
		script.println("</script>");
		script.close();
		return;	
	}
	else if(result == -1){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('invalid ID');");
		script.println("history.back();");
		script.println("</script>");
		script.close();
		return;	
	}
	else if(result == -2){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('Database ERROR');");
		script.println("history.back();");
		script.println("</script>");
		script.close();
		return;	
	}
%>