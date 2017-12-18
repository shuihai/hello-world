package com.atguigu.ssh.annotation;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service("hehe")
public class TestObject2 {

    public TestObject2(){
        System.out.println("gouzaoqi");
    }


    public void subtract(){
        System.out.println("subtract");
    }
}
