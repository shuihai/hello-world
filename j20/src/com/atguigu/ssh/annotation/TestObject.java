package com.atguigu.ssh.annotation;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

@Service
public class TestObject {

    @Autowired
    @Qualifier("hehe")
    public TestObject2 testObject2;
    public TestObject(){
        System.out.println("gouzaoqi");
    }

    public void add(){
        System.out.println("add");
    }
}