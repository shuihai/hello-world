package com.atguigu.ssh.actions;


import com.opensymphony.xwork2.ActionContext;
import javafx.application.Application;
import org.apache.struts2.ServletActionContext;
import org.apache.struts2.interceptor.ApplicationAware;
import org.apache.struts2.interceptor.RequestAware;
import org.apache.struts2.interceptor.SessionAware;
import org.springframework.context.ApplicationContext;
import org.springframework.stereotype.Service;
import org.springframework.web.context.support.WebApplicationContextUtils;

import javax.servlet.ServletContext;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import java.util.Map;

@Service
public class HeheAction implements ApplicationAware,SessionAware,RequestAware{

    public Map<String,Object> application;
    public Map<String,Object> session;
    private Map<String, Object> request;

    public String hehe() {
        System.out.println("Heheaction hehe..");
        System.out.println("lala");
//        ApplicationContext applicationContext= WebApplicationContextUtils.getWebApplicationContext(ServletContext sc);

//        ActionContext actionContext=ActionContext.getContext();
//        System.out.println(actionContext);
//        Map<String,Object> applicationMap = actionContext.getApplication();
//        applicationMap.put("applicationKey","applicationValue");
//
//        Object date = applicationMap.get("date");
//        System.out.println("date:"+date);
//
//        Map<String,Object> sessionMap = actionContext.getSession();
//        sessionMap.put("sessionkey","sessionvalue");
//
//        Map<String,Object> requestmap = (Map<String, Object>) actionContext.get("request");
//        requestmap.put("requestkey","requestval");
//
//        Map<String,Object> paramsmap = actionContext.getParameters();
//        System.out.println(((String[])paramsmap.get("name"))[0]);

        HttpServletRequest request = ServletActionContext.getRequest();

        HttpSession session = ServletActionContext.getRequest().getSession();

        ServletContext context = ServletActionContext.getServletContext();

//        application.put("hehe","12345");
//        session.put("sessionkey","sessionval");
//        request.put("requestkey","requestval");
        return "hehe";
    }

    @Override
    public void setApplication(Map<String, Object> map) {
        this.application=  map;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.session=  map;
    }

    @Override
    public void setRequest(Map<String, Object> map) {
        this.request=  map;
    }
}
