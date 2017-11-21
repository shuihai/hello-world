package com.tj;

import junit.framework.TestCase;

import java.sql.Connection;
import java.sql.Driver;
import java.util.Properties;

public class PeopleTest extends TestCase {
    public void setUp() throws Exception {
        super.setUp();
    }

    public void tearDown() throws Exception {
//        System.out.println("go");
    }

    public void testMain() throws Exception {
    }

    public void testToString() throws Exception {
    }

    public void testGetName() throws Exception {
        People people =new People("dd");

        System.out.println(people);
    }

    public void testSetName() throws Exception {
        Driver driver =new  com.mysql.jdbc.Driver();
        String url="jdbc:mysql://localhost:3306/test";
        Properties info=new Properties();
        info.put("user","root");
        info.put("password","");
        Connection connection=driver.connect(url,info);
        System.out.println(connection);
    }

    public void testTest1(){
        System.out.println("test11");
    }
}