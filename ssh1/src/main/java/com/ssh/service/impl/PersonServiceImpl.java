package com.ssh.service.impl;

import com.ssh.entity.Classroom;
import com.ssh.entity.Person;
import com.ssh.repository.ClassroomRepository;
import com.ssh.repository.PersonRepository;
import com.ssh.repository.impl.ClassroomRepositoryImpl;
import com.ssh.service.PersonService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import javax.annotation.Resource;

/**
 * Created by XRog
 * On 2/2/2017.2:40 PM
 */
@Service(value = "personService")
public class PersonServiceImpl implements PersonService {

    @Resource
    private PersonRepository personRepository;

    @Resource
    private ClassroomRepositoryImpl classroomRepository;

    public Long savePerson() {

        long id = 2;
        Classroom classroom = classroomRepository.get(id);

        Person person = new Person();
        person.setUsername("XRog");
        person.setPhone("18381005946");
        person.setAddress("chenDu");
        person.setRemark("this is XRog");
        person.setClassroom(classroom);
        return personRepository.save(person);
    }
}