package com.ssh.repository.impl;
import com.ssh.entity.DepartmentEntity;
import com.ssh.entity.EmployeeEntity;
import com.ssh.repository.DepartmentRepository;
import com.ssh.repository.EmployeeRepository;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.stereotype.Repository;

import javax.annotation.Resource;
import java.util.List;

/**
 * Created by XRog
 * On 2/2/2017.2:30 PM
 */
@Repository(value = "EmployeeRepository")
public class EmployeeRepositoryImpl implements EmployeeRepository {

    @Resource
    private SessionFactory sessionFactory;

    private Session getCurrentSession() {
        return this.sessionFactory.openSession();
    }

    public EmployeeEntity load(Long id) {
        return (EmployeeEntity)getCurrentSession().load(EmployeeEntity.class,id);
    }

    public EmployeeEntity get(Long id) {
        return (EmployeeEntity)getCurrentSession().get(EmployeeEntity.class,id);
    }

    public List<EmployeeEntity> findAll() {
        Session session = getCurrentSession();
        String  hql = "from EmployeeEntity";
        Query query = session.createQuery(hql);
        List<EmployeeEntity> list = query.list();
        return list;
    }

    public void persist(EmployeeEntity employeeEntity) {
        getCurrentSession().persist(employeeEntity);
    }

    public Long save(EmployeeEntity employeeEntity) {
        return (Long)getCurrentSession().save(employeeEntity);
    }

    public void saveOrUpdate(EmployeeEntity employeeEntity) {
        getCurrentSession().saveOrUpdate(employeeEntity);
    }

    public void delete(Long id) {
        EmployeeEntity employeeEntity = load(id);
        getCurrentSession().delete(employeeEntity);
    }

    public void flush() {
        getCurrentSession().flush();
    }
}