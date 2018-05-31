package com.ssh.service.impl;

import com.ssh.entity.DepartmentEntity;

import com.ssh.repository.DepartmentRepository;
import com.ssh.service.ClassroomService;
import com.ssh.service.DepartmentService;
import org.springframework.stereotype.Service;

import javax.annotation.Resource;


@Service(value = "departmentService")
public class DepartmentServiceImpl implements DepartmentService {

    @Resource
    DepartmentRepository departmentRepository;

    public Long saveDepartment() {
        DepartmentEntity departmentEntity = new DepartmentEntity();
        departmentEntity.setDepartmentName("XRog");
        return departmentRepository.save(departmentEntity);
    }
}


