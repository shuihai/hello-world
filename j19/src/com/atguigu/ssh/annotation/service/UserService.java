package com.atguigu.ssh.annotation.service;

import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;
import org.springframework.stereotype.Service;

@Service
public class UserService {
    public void add() {
        ApplicationContext acx= new ClassPathXmlApplicationContext("applicationContext.xml");
        UserService userService= (UserService) acx.getBean("userService");
        System.out.println("UserService add..");
    }
}
