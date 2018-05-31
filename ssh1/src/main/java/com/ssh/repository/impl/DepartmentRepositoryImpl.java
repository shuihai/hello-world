package com.ssh.repository.impl;
import com.ssh.entity.DepartmentEntity;
import com.ssh.repository.DepartmentRepository;
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
@Repository(value = "DepartmentRepository")
public class DepartmentRepositoryImpl implements DepartmentRepository {

    @Resource
    private SessionFactory sessionFactory;

    private Session getCurrentSession() {
        return this.sessionFactory.openSession();
    }

    public DepartmentEntity load(Long id) {
        return (DepartmentEntity)getCurrentSession().load(DepartmentEntity.class,id);
    }

    public DepartmentEntity get(Long id) {
        return (DepartmentEntity)getCurrentSession().get(DepartmentEntity.class,id);
    }

    public List<DepartmentEntity> findAll() {
        Session session = getCurrentSession();
        String  hql = "from DepartmentEntity";
        Query query = session.createQuery(hql);
        List<DepartmentEntity> list = query.list();
        return list;
    }

    public void persist(DepartmentEntity departmentEntity) {
        getCurrentSession().persist(departmentEntity);
    }

    public Long save(DepartmentEntity departmentEntity) {
        return (Long)getCurrentSession().save(departmentEntity);
    }

    public void saveOrUpdate(DepartmentEntity departmentEntity) {
        getCurrentSession().saveOrUpdate(departmentEntity);
    }

    public void delete(Long id) {
        DepartmentEntity departmentEntity = load(id);
        getCurrentSession().delete(departmentEntity);
    }

    public void flush() {
        getCurrentSession().flush();
    }
}