<%@ page import="java.util.Date" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
		 pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
	
	<a href="emp-list">List All Employees</a>
	
	<br><br>
	
	<a href="emp-input">Add New Employee</a>
	<a href="hehe">Add New Employee</a>
	<%
		System.out.println(application);
		application.setAttribute("date",new Date());

	%>

</body>
</html>