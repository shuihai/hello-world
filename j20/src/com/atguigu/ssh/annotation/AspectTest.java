package com.atguigu.ssh.annotation;

import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.annotation.Before;
import org.springframework.stereotype.Component;

@Aspect
@Component
public class AspectTest {

    @Before("execution(* com.atguigu.ssh.annotation.TestObject2.subtract(..)) ")
    public void beforemethod(){
        System.out.println("beforemethod");
    }

}
