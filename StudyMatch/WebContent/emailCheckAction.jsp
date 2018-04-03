<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import ="user.UserDAO" %>
<%@ page import ="util.SHA256" %>
<%@ page import = "java.io.PrintWriter"%>
<%
	request.setCharacterEncoding("UTF-8");
	String code = null;
	if(request.getParameter("code") != null){
		code = request.getParameter("code");
	}
	UserDAO userDAO = new UserDAO();
	String userID = null;
	
	if(session.getAttribute("userID") != null){
		userID = (String) session.getAttribute("userID");
	}
	
	if(userID ==null){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('Please Sign in');");
		script.println("location.href = 'userLogin.jsp'");
		script.println("</script>");
		script.close();
		return;				
	}
	String userEmail = userDAO.getUserEmail(userID);
	
	boolean isRight = (new SHA256().getSHA256(userEmail).equals(code)) ? false : true;
	
	if(isRight == true){
		userDAO.setUserEmailChecked(userID);
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('Your verification is Succccded');");
		script.println("location.href = 'index.jsp'");
		script.println("</script>");
		script.close();
		return;		
	}
	
	else{
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('your code is invalid');");
		script.println("location.href = 'index.jsp'");
		script.println("</script>");
		script.close();
		return;		
	}
%>