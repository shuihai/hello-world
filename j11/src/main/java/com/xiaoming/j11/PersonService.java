package com.xiaoming.j11;

public class PersonService {
    private String name;
    public PersonService()
    {

    }
    public void setName(String name)
    {
        this.name = name;
    }
    public String getName()
    {
        return name;
    }
    public void info()
    {
        System.out.println("此人名为：" + name);
    }
}
