package com.tj;

import junit.framework.TestCase;

import java.io.IOException;
import java.io.InputStream;
import java.sql.*;
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
        String url="jdbc:mysql://127.0.0.1:3306/test";
        Properties info=new Properties();
        info.put("user","root");
        info.put("password","123456");
        Connection connection=driver.connect(url,info);
        System.out.println(connection);
    }

    public void testProperty(){
        Properties properties=new Properties();
        properties.put("user","root");
        System.out.println(properties);
    }

    public void testClassforname() throws ClassNotFoundException {
        System.out.println(Class.forName("java.lang.String"));
    }


    public Connection testDriverManager() throws IOException, ClassNotFoundException, SQLException {
        InputStream in = getClass().getClassLoader().getResourceAsStream("jdbc.properties");
        Properties properties=new Properties();
        properties.load(in);

        Properties info=new Properties();
        String driverclass = properties.getProperty("driver");

         String user=properties.getProperty("user");
        String password = properties.getProperty("password");
        String url = properties.getProperty("jdbcurl");

        info.put("user",user);
        info.put("password",password);
        Class.forName(driverclass);
        Connection connection = DriverManager.getConnection(url,info);
        System.out.println(connection);
        return connection;
    }

    public void testgetclassgetclassloadergetresourceasstream() throws IOException, ClassNotFoundException, IllegalAccessException, InstantiationException, SQLException {
        InputStream in=getClass().getClassLoader().getResourceAsStream("jdbc.properties");
        Properties properties=new Properties();
        properties.load(in);

        String driverclass = properties.getProperty("driver");
        String url = properties.getProperty("jdbcurl");
        String user = properties.getProperty("user");
        String password = properties.getProperty("password");

        Driver driver= (Driver) Class.forName(driverclass).newInstance();
        Properties info =new Properties();
        info.put("user","root");
        info.put("password","123456");
        Connection connection=driver.connect(url,info);
        System.out.println(connection);

    }


    public void testStatisblock() throws Exception{
        Class.forName("com.tj.People");
        System.out.println("teststatisblock");

    }



    public void getConnection() throws Exception{
        String driverclass="mysql";
        Driver driver = (Driver) Class.forName(driverclass).newInstance();

    }

    public void testStatement() throws SQLException, IOException, ClassNotFoundException {
        Connection connection=testDriverManager();
        Statement statement=connection.createStatement();
        String sql="INSERT INTO `zh_test`(`name`) VALUES ('hehe')";
        statement.execute(sql);
        statement.close();
    }


}