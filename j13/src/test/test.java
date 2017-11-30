package test;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.FileSystemXmlApplicationContext;

public class test {
    public static void main(String[] args) {
        ApplicationContext applicationContext=new FileSystemXmlApplicationContext("web/WEB-INF/applicationContext.xml");
        TestService testService= (TestService) applicationContext.getBean("testService");
        testService.hello();

    }
}
