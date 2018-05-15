package com.ssh.service.impl;


import com.ssh.service.TestService;
import org.springframework.stereotype.Service;

@Service(value = "testService")
public class TestServiceImpl implements TestService{

    public String test() {
        return "test";
    }
}
