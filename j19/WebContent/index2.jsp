<%@ page import="org.springframework.context.ApplicationContext" %>
<%@ page import="org.springframework.web.context.support.WebApplicationContextUtils" %>
<%@ page import="com.atguigu.ssh.annotation.TestObject2" %>
<%@ page import="com.atguigu.ssh.dao.BookShopDaoImpl" %>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
         pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
	<%
        ApplicationContext applicationContext= WebApplicationContextUtils.getWebApplicationContext(application);
//        BookShopDaoImpl bookShopDao=applicationContext.getBean(BookShopDaoImpl.class);
//        bookShopDao.findBookPriceByIsbn("aa");

	%>
index2.jsp
	
</body>
</html>