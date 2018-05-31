package com.ssh.service;

import com.ssh.entity.Person;

import java.util.List;

/**
 * Created by XRog
 * On 2/2/2017.2:39 PM
 */
public interface PersonService {
    Long savePerson();

    Person getPerson(long id);

    List<Person> findall() ;
}