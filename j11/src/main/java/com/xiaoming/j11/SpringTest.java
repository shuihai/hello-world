package com.xiaoming.j11;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;
//http://blog.csdn.net/xuguoli_beyondboy/article/details/43097661
public class SpringTest {
    public static void main(String[] args)
    {
        System.out.println(22);
        ApplicationContext test=new ClassPathXmlApplicationContext("camel-context.xml");
        System.out.println("容器"+test);
        PersonService personService=test.getBean("personService",PersonService.class);
        System.out.println(personService );
        personService.info();
    }
}
