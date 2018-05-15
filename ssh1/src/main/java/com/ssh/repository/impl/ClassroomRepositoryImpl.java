package com.ssh.repository.impl;
import com.ssh.entity.Classroom;
import com.ssh.repository.ClassroomRepository;
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
@Repository(value = "classroomRepository")
public class ClassroomRepositoryImpl implements ClassroomRepository {

    @Resource
    private SessionFactory sessionFactory;

    private Session getCurrentSession() {
        return this.sessionFactory.openSession();
    }

    public Classroom load(Long id) {
        return (Classroom)getCurrentSession().load(Classroom.class,id);
    }

    public Classroom get(Long id) {
        return (Classroom)getCurrentSession().get(Classroom.class,id);
    }

    public List<Classroom> findAll() {
        Session session = getCurrentSession();
        String  hql = "from Classroom";
        Query query = session.createQuery(hql);
        List<Classroom> list = query.list();
        return list;
    }

    public void persist(Classroom entity) {
        getCurrentSession().persist(entity);
    }

    public Long save(Classroom entity) {
        return (Long)getCurrentSession().save(entity);
    }

    public void saveOrUpdate(Classroom entity) {
        getCurrentSession().saveOrUpdate(entity);
    }

    public void delete(Long id) {
        Classroom classroom = load(id);
        getCurrentSession().delete(classroom);
    }

    public void flush() {
        getCurrentSession().flush();
    }
}