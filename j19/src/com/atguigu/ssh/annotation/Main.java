package com.atguigu.ssh.annotation;

import com.atguigu.ssh.annotation.service.UserService;
import com.atguigu.ssh.dao.BookShopDao;
import com.atguigu.ssh.dao.BookShopDaoImpl;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

public class Main {
    public static void main(String[] args) {
        System.out.println("33");
        ApplicationContext ctx= new ClassPathXmlApplicationContext("applicationContext.xml");
//
        System.out.println(22);
        BookShopDaoImpl bookShopDao = ctx.getBean(BookShopDaoImpl.class);
        System.out.println(11);
//        System.out.println(userService);
    }
}
