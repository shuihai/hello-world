<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>

<html>
<body>
<center>
    <h2 style="color: #ff261a;">this is my test page! ${requestScope.person.username}</h2>

    <%
        System.out.println(request.person.username);


    %>
</center>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>UserName</th>

    </tr>

    <c:forEach items="${requestScope.persons }" var="emp">
        <tr>
            <td>${emp.id }</td>
            <td>${emp.username }</td>

        </tr>
    </c:forEach>
</table>

</body>
</html>