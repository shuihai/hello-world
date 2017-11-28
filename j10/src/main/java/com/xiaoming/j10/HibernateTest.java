package com.xiaoming.j10;

import com.xiaoming.j10.bean.User;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

/**
 * Created by Administrator on 2016/12/15.
 */
public class HibernateTest {

    public static void main(String[] args) {
        // 加载Hibernate默认配置文件
        Configuration configuration = new Configuration().configure();
        // 用Configuration创建SessionFactory
        SessionFactory factory = configuration.buildSessionFactory();
        // 创建Session
        Session session = factory.openSession();
        // 开启事务
        Transaction transaction = session.beginTransaction();
        // 实例化持久化类
        User user = new User();
        user.setId("2");
        user.setUsername("hehe");
        user.setPassword(1234567);
        // 保存
        session.save(user);
        // 提交事务
        transaction.commit();
        // 关闭Session，释放资源
        session.close();
        factory.close();
    }
}