package com.tj;

import java.util.Scanner;

public class People {

    static {
        System.out.println("静态代码块");
    }
    protected  String name;

    public static void main(String[] args) {
        Scanner scanner=new Scanner(System.in);

        People people=new People();
        System.out.println("name:");
        people.setName(scanner.next());
//        System.out.println(scanner.nextInt());
        System.out.println(people.getName());
    }
    public People( ){

        System.out.println("构造方法");
    }

    public People(String name){
        this.name=name;
    }
//    @Override
//    public String toString() {
//        return "hehe";
//    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }


    public void  test1(){
        System.out.println("test1T");
    }
}
