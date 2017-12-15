package com.atguigu.ssh.annotation;

import com.atguigu.ssh.annotation.service.UserService;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class Main {
    public static void main(String[] args) {
        System.out.println("1111");
        ApplicationContext ctx= new ClassPathXmlApplicationContext("applicationContext.xml");
        UserService userService= (UserService) ctx.getBean("userService");
        userService.add();
        System.out.println("222");
//        System.out.println(userService);
    }
}
