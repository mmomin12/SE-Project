<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.io.PrintWriter" %>
<%@ page import="user.UserDAO" %>
<%@ page import="evaluation.EvaluationDTO"%>
<%@ page import="evaluation.EvaluationDAO"%>
<%@ page import="java.util.ArrayList"%>
<%@ page import="java.net.URLEncoder"%>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Study Match</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/custom.css">
</head>
<body>
<%
	request.setCharacterEncoding("UTF-8");
	String lectureDivide ="All";
	String searchType = "latest";
	String search = "";
	int pageNumber = 0;
	
	if(request.getParameter("lectureDivide") != null){
		lectureDivide = request.getParameter("lectureDivide");
	}
	if(request.getParameter("searchType") != null){
		searchType = request.getParameter("searchType");
	}
	if(request.getParameter("search") != null){
		search = request.getParameter("search");
	}
	if(request.getParameter("pageNumber") != null){
		try{
			pageNumber = Integer.parseInt(request.getParameter("pageNumber"));
		}
		catch(Exception e){
			System.out.println("error");
		}
	}
	
			
	String userID = null;

	if(session.getAttribute("userID") != null){
		userID = (String) session.getAttribute("userID");
	}
	
	if(userID == null){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('you need login');");
		script.println("location.href='userLogin.jsp';");
		script.println("</script>");
		script.close();
		return;	
	}
	
	boolean emailChecked = new UserDAO().getUserEmailChecked(userID);
	
	if(emailChecked == false){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("location.href = 'emailSendConfirm.jsp';");
		script.println("</script>");
		script.close();
		return;	
	}
%>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.jsp">STUDY MATCH</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.jsp">Main</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown"> User Control</a>
					<div class="dropdown-menu" aria-labelledby="dropdown">
<%
	if(userID == null){
%>
						<a class="dropdown-item" href="userLogin.jsp">Log in</a>
						<a class="dropdown-item" href="userJoin.jsp">Join</a>
<% 
	} else{
%>
						<a class="dropdown-item" href="userLogout.jsp">Log out</a>
<%
	}
%>
					</div>
				</li>
			</ul>
			<form action="./index.jsp" method="get" class="form-inline my-2 my-lg-0">
				<input type="text" name="search" class="form-control mr-sm-2" type="search" placeholder="SEARCH" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">search</button>
			</form>
		</div>
	</nav>
	
	<section class="container">
		<form method="get" action="./index.jsp" class="form-inline mt-3">
			<select name="lectureDivide" class="form-control mx-1 mt-2">
				<option value="All">All</option>
				<option value="Major"<% if(lectureDivide.equals("Major")) out.println("selected"); %>>Major</option>
				<option value="Option"<% if(lectureDivide.equals("Option")) out.println("selected"); %>>Option</option>
				<option value="etc"<% if(lectureDivide.equals("etc")) out.println("selected"); %>>etc</option>
			</select>
			<select name="searchType" class="form-control mx-1 mt-2">
				<option value="latest">latest</option>
				<option value="recommendation"<% if(searchType.equals("recommendation")) out.println("selected"); %>>recommendation</option>
			</select>			
			<input type="text" name="search" class="form-control mx-1 mt-2" placeholder="input your">
			<button type="submit" class="btn btn-primary mx-1 mt-2">Search</button>
			<a class="btn btn-primary mx-1 mt-2" data-toggle="modal" href="#registerModal">register</a>
			<a class="btn btn-danger mx-1 mt-2" data-toggle="modal" href="#reportModal">report</a>
		</form>
<%
	ArrayList<EvaluationDTO> evaluationList = new ArrayList<EvaluationDTO>();
	evaluationList = new EvaluationDAO().getList(lectureDivide, searchType, search, pageNumber);
	if(evaluationList != null)
		for(int i =0; i<evaluationList.size(); i++){
			if(i==5) break;
			EvaluationDTO evaluation = evaluationList.get(i);
%>
		<div class="card bg-light mt-3">
			<div class="card-header bg-light">
				<div class="row">
					<div class="col-8 text-left"><%=evaluation.getLectureName() %>&nbsp;<small><%= evaluation.getProfessorName() %></small></div>
					<div class="col-4 text-right">
						Total <span style="color: red;"><%= evaluation.getTotalScore() %></span>
					</div> 
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title">
					<%= evaluation.getEvaluationTitle() %>&nbsp;<small>(<%= evaluation.getLectureYear()%> year <%= evaluation.getSemesterDivide() %>)</small>
				</h5>
				<p class="card-text"><%= evaluation.getEvaluationContent() %></p>
				<div class="row">
					<div class="col-9 text-left">
						Study Score<span style="color: red;"><%= evaluation.getCreditScore() %></span>
						User Score<span style="color: red;"><%= evaluation.getComfortableScore() %></span>
						Help Score<span style="color: red;"><%= evaluation.getLectureScore() %></span>
						<span style="color: green;">(Recommend: <%= evaluation.getLikeCount() %>)</span>
					</div>
					<div class="col-3 text-right">
						<a onclick="return confirm('do you want to recommend?')" href="./likeAction.jsp?evaluationID=<%= evaluation.getEvaluationID()%>">recommend</a>
						<a onclick="return confirm('do you want to delete?')" href="./deleteAction.jsp?evaluationID= <%= evaluation.getEvaluationID()%>">delete</a>
					</div>
				</div>
			</div>
		</div>		
		
<%
		}
%>		
	</section>
	<ul class="pagination justify-content-center mt-3">
		<li class = "page-item">
<%
	if(pageNumber <= 0){
%>
	<a class="page-link disabled">back</a>
<%
	} else {
%>

	<a class="page-link" href="./index.jsp?lectureDivide= <%= URLEncoder.encode(lectureDivide, "UTF-8")%> &searchType=
	<%=URLEncoder.encode(searchType, "UTF-8")%> &search=<%= URLEncoder.encode(search, "UTF-8")%> &pageNumber=
	<%= pageNumber -1 %>">back</a>
<%
	}
%>
		</li>
		
		<li>
<%
	if(evaluationList.size() < 6){
%>
	<a class="page-link disabled">next</a>
<%
	} else {
%>

	<a class="page-link" href="./index.jsp?lectureDivide=<%= URLEncoder.encode(lectureDivide, "UTF-8")%> &searchType=
	<%=URLEncoder.encode(searchType, "UTF-8")%> &search=<%= URLEncoder.encode(search, "UTF-8")%> &pageNumber=
	<%= pageNumber + 1 %>">next</a>
<%
	}
%>
		</li>
	</ul>
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h5 class="modal-title" id="modal"> Evaluation Register</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<form action="./evaluationRegisterAction.jsp" method="post">
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label>Class Name</label>
								<input type="text" name="lectureName" class="form-control" maxlength="20">
							</div>
							
							<div class="form-group col-sm-6">
								<label>Professor Name</label>
								<input type="text" name="professorName" class="form-control" maxlength="20">
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<label>date</label>
								<select name="lectureYear" class="form-control">
									<option value="2011">2011</option>
									<option value="2012">2012</option>
									<option value="2013">2013</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018" selected>2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
								</select>
							</div>
							
							<div class="form-group col-sm-4">
								<label>semester</label>
								<select name="semesterDivide"class="form-control">
									<option value="Spring">Spring</option>
									<option value="Summer">Summer</option>
									<option value="Fall">Fall</option>
								</select>
							</div>
							
							<div class="form-group col-sm-4">
								<label>Class Area</label>
								<select name="lectureDivide"class="form-control">
									<option value="Major">Major</option>
									<option value="Option">Option</option>
									<option value="Etc">Etc</option>
								</select>
							</div>

						</div>
						
						<div class="form-group">
							<label>Subject</label>
							<input type="text" name="evaluationTitle" class="form-control" maxlength="30">
						</div>
						<div class="form-group">
							<label>your opinion</label>
							<textarea name="evaluationContent" class="form-control" maxlength="2048" style="height: 180px;"></textarea>
						</div>
						
						<div class="form-row">
							<div class="form-group col-sm-3">
								<label>score</label>
								<select name="totalScore" class="form-control">
									<option value="A" selected>A</option>
									<option value="B" >B</option>
									<option value="C" >C</option>
									<option value="D" >D</option>
									<option value="F" >F</option>
								</select>
							</div>
							
							<div class="form-group col-sm-3">
								<label>score</label>
								<select name="creditScore" class="form-control">
									<option value="A" selected>A</option>
									<option value="B" >B</option>
									<option value="C" >C</option>
									<option value="D" >D</option>
									<option value="F" >F</option>
								</select>
							</div>
							
							<div class="form-group col-sm-3">
								<label>score</label>
								<select name="comfortableScore" class="form-control">
									<option value="A" selected>A</option>
									<option value="B" >B</option>
									<option value="C" >C</option>
									<option value="D" >D</option>
									<option value="F" >F</option>
								</select>
							</div>
							
							<div class="form-group col-sm-3">
								<label>score</label>
								<select name="lectureScore" class="form-control">
									<option value="A" selected>A</option>
									<option value="B" >B</option>
									<option value="C" >C</option>
									<option value="D" >D</option>
									<option value="F" >F</option>
								</select>
							</div>
							
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismss="modal">cancel</button>
							<button type="submit" class="btn btn-primary">register</button>
						</div>
						
						
					</form>
				</div>
			</div>
		</div>
	
	
	</div>
	
	<!-- report -->
	
	<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
	
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h5 class="modal-title" id="modal"> Report</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<form action="./reportAction.jsp" method="post">
						
						<div class="form-group">
							<label>Report Subject</label>
							<input type="text" name="reportTitle" class="form-control" maxlength="30">
						</div>
						<div class="form-group">
							<label>Report opinion</label>
							<textarea name="reportContent" class="form-control" maxlength="2048" style="height: 180px;"></textarea>
						</div>			
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismss="modal">cancel</button>
							<button type="submit" class="btn btn-danger">register</button>
						</div>
						
						
					</form>
				</div>
			</div>
		</div>
	
	</div>	
	
	<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
		Copyright &copy; 2018 Panther Coders All Rights Reserved.
	</footer>

	<script src="./js/jquery.min.js"></script>
	<script src="./js/popper.js"></script>
	<script src="./js/bootstrap.min.js"></script>
</body>
</html>