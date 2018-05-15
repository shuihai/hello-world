package com.ssh.controller;

import com.ssh.service.ClassroomService;
import com.ssh.service.PersonService;
import com.ssh.service.TestService;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.annotation.Resource;


/**
 * Created by XRog
 * On 2/1/2017.12:36 AM
 */
@Controller
public class MainController {

    @Resource
    private TestService testService;

    @Resource
    private PersonService personService;

    @Resource
    private ClassroomService classroomService;

    @RequestMapping(value = "savePerson", method = RequestMethod.GET)
    @ResponseBody
    public String savePerson(){
        personService.savePerson();
        return "success!";
    }

    @RequestMapping(value = "saveclassroom", method = RequestMethod.GET)
    @ResponseBody
    public String saveClassroom(){
        classroomService.saveClassroom();
        return "success!";
    }


    @RequestMapping(value = "test", method = RequestMethod.GET)
    public String test(){
//        实际返回的是views/test.jsp ,spring-mvc.xml中配置过前后缀
        return "test";
    }

    @RequestMapping(value = "springtest", method = RequestMethod.GET)
    public String springTest(){
        return testService.test();
    }


}