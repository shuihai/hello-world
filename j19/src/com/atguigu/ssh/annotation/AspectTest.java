package com.atguigu.ssh.annotation;

import org.aopalliance.intercept.Joinpoint;
import org.aspectj.lang.JoinPoint;
import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.annotation.Before;
import org.springframework.stereotype.Component;

@Aspect
@Component
public class AspectTest {

    @Before("execution(* com.atguigu.ssh.annotation.TestObject2.subtract(..)) ")
    public void beforemethod(JoinPoint joinPoint) {
        String methodname=joinPoint.getSignature().getName();
        System.out.println("beforemethod"+methodname);
    }

}
