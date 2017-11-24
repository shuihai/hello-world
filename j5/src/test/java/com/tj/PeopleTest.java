package com.tj;

import junit.framework.TestCase;
import org.apache.commons.dbcp.BasicDataSource;
import org.apache.commons.dbcp.BasicDataSourceFactory;

import javax.sql.DataSource;
import java.io.IOException;
import java.io.InputStream;
import java.sql.*;
import java.util.Properties;
import java.util.Scanner;

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
        String sql="INSERT INTO `zh_test`(`name`) VALUES ('haha')";
        statement.execute(sql);
        statement.close();
    }

    public void testResultset() throws SQLException, IOException, ClassNotFoundException {
        ResultSet rs=null;
        Connection connection = testDriverManager();
        Statement statement=connection.createStatement();
        String sql = "select * from zh_test  ";
        rs=statement.executeQuery(sql);
        while (rs.next()){
            int id=rs.getInt(1);
            String name=rs.getString("name");
            System.out.println(id);
            System.out.println(name);
        }
    }


    public void testScanner(){
        Scanner scanner=new Scanner(System.in);

        People people=new People();
        System.out.println("name:");
        people.setName(scanner.next());

        System.out.println(people.getName());
    }

    public void testdbcp() throws SQLException {
        BasicDataSource dataSource=null;
        dataSource=new BasicDataSource();
        dataSource.setUsername("root");
        dataSource.setPassword("123456");
        dataSource.setUrl("jdbc:mysql://127.0.0.1:3306/test");
        dataSource.setDriverClassName("com.mysql.jdbc.Driver");

        dataSource.setInitialSize(10);
        dataSource.setMaxActive(50);
        dataSource.setMinIdle(5);
        Connection connection=dataSource.getConnection();
        System.out.println(connection);

    }

    public  void testdatasourcefactory() throws Exception {
        Properties properties = new Properties();
        InputStream inputStream=getClass().getClassLoader().getResourceAsStream("jdbc2.properties");
        properties.load(inputStream);

        DataSource dataSource= BasicDataSourceFactory.createDataSource(properties);
        System.out.println(dataSource.getConnection());

    }
}