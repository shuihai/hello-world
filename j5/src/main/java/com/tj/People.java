package com.tj;

public class People {

    protected  String name;

    public static void main(String[] args) {
        System.out.println(new People());
        System.out.println("go");
    }
    public People( ){

    }

    public People(String name){
        this.name=name;
    }
    @Override
    public String toString() {
        return "hehe";
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

}
