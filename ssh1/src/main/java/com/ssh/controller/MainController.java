package com.ssh.controller;

import com.ssh.entity.Classroom;
import com.ssh.entity.Person;
import com.ssh.service.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import javax.annotation.Resource;
import java.util.List;
import java.util.Map;


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

    @Resource
    private EmployeeService employeeService;

    @Resource
    private DepartmentService departmentService;


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


    @RequestMapping(value = "savedepartment", method = RequestMethod.GET)
    @ResponseBody
    public String saveDepartment(){
        departmentService.saveDepartment();
        return "success!";
    }


    @ModelAttribute
    public void getPerson(@RequestParam(name = "id",required = false,defaultValue = "0") String id, Map<String,Object> map){
        Person person = personService.getPerson( Long.parseLong(id));
        map.put("person",person);
        System.out.println(person.getUsername());
        System.out.println(person.getAddress());
    }


    @RequestMapping(value = "test", method = RequestMethod.POST)
    public String test(@RequestParam(name = "id",required = false,defaultValue = "0") String id, Person person, Map<String,Object> map){
        List<Person> persons = personService.findall();
        map.put("persons",persons);
        System.out.println(person.getUsername());
        System.out.println(person.getAddress());

//        实际返回的是views/test.jsp ,spring-mvc.xml中配置过前后缀
        return "test";
    }

    @RequestMapping(value = "springtest", method = RequestMethod.GET)
    public String springTest(){
        return testService.test();
    }

}