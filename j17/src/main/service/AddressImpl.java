package service;

public class AddressImpl {
    @Qualifier("sessionFactory")
    @Autowired
    private SessionFactory sessionFactory;

    @Override
    public void add(Addresslist al) {
        Session s = sessionFactory.openSession();
        Transaction tx= s.beginTransaction();
        s.save(al);
        tx.commit();
    }

    public void setSessionFactory(SessionFactory sessionFactory) {
        this.sessionFactory = sessionFactory;
    }
}
