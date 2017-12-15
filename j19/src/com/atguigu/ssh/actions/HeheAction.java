package com.atguigu.ssh.actions;


import org.springframework.stereotype.Service;

@Service
public class HeheAction {
    public String add() {
        System.out.println("Heheaction add..");
        return "hehe";
    }
}
