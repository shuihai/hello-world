package com.ssh.service.impl;

import com.ssh.entity.Classroom;
import com.ssh.repository.ClassroomRepository;
import com.ssh.service.ClassroomService;
import org.springframework.stereotype.Service;

import javax.annotation.Resource;


@Service(value = "classroomService")
public class ClassroomServiceImpl implements ClassroomService {

    @Resource
    ClassroomRepository classroomRepository;

    public Long saveClassroom() {
        Classroom classroom = new Classroom();
        classroom.setName("XRog");
        return classroomRepository.save(classroom);
    }



}


