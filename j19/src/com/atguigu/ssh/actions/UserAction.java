package com.atguigu.ssh.actions;

import org.springframework.stereotype.Service;

@Service
public class UserAction {
    public String add() {
        System.out.println("UserService add..");
        return "hehe";
    }
}
