package com.xiaoming.h1;

import com.xiaoming.h1.demo.Dbuser;
import org.hibernate.Session;

import com.xiaoming.h1.HibernateUtil;

import java.util.Date;

public class App {
    public static void main(String[] args) {
        System.out.println("Maven3 + Hibernate + Oracle10g");

        Session session = HibernateUtil.getSessionFactory().openSession();
//
//
        session.beginTransaction();
        Dbuser user = new Dbuser();

        user.setUserId(100);
        user.setUsername("leioolei");
        user.setCreatedBy("system");
        user.setCreatedDate(new Date());

        session.save(user);
        session.getTransaction().commit();
    }
}
