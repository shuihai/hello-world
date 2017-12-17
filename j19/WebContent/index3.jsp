<%@ page import="org.springframework.context.ApplicationContext" %>
<%@ page import="org.springframework.web.context.WebApplicationContext" %>
<%@ page import="org.springframework.web.context.support.WebApplicationContextUtils" %>
<%@ page import="com.atguigu.ssh.annotation.TestObject" %>
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
        TestObject testObject= (TestObject) applicationContext.getBean("testObject");
        TestObject testObject2=applicationContext.getBean(TestObject.class);
        testObject.add();
        testObject2.add();

    %>
index3.jsp
	
</body>
</html>