package com.ssh.service.impl;

import com.ssh.entity.DepartmentEntity;
import com.ssh.entity.EmployeeEntity;
import com.ssh.repository.DepartmentRepository;
import com.ssh.repository.EmployeeRepository;
import com.ssh.service.DepartmentService;
import com.ssh.service.EmployeeService;
import org.springframework.stereotype.Service;

import javax.annotation.Resource;


@Service(value = "employeeService")
public class EmployeeServiceImpl implements EmployeeService {

    @Resource
    DepartmentRepository departmentRepository;

    @Resource
    private EmployeeRepository employeeRepository;


    public Long saveEmployee() {

        long id = 1;
        DepartmentEntity dep = departmentRepository.get(id);

        EmployeeEntity employeeEntity = new EmployeeEntity();
        employeeEntity.setBirth( new java.sql.Timestamp( 10000000));
        employeeEntity.setCreateTime(new java.sql.Timestamp( 10000000));
        employeeEntity.setEmail("chenDu@qq.com");
        employeeEntity.setLastName("chenDu");
        employeeEntity.setSshDepartmentByDepartmentId(dep);
        return employeeRepository.save(employeeEntity);
    }
}


