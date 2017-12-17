package com.atguigu.ssh.annotation;

import org.springframework.stereotype.Service;

@Service
public class TestObject {

    public TestObject(){
        System.out.println("gouzaoqi");
    }

    public void add(){
        System.out.println("add");
    }
}
