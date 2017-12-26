package com.atguigu.ssh.dao;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Repository;

import com.atguigu.ssh.dao.BookShopDao;


@Repository
public class BookShopDaoImpl implements BookShopDao {
	
	@Autowired()
	@Qualifier("sessionFactory")
	public SessionFactory sessionFactory;
	

//

	private Session getSession(){
		return sessionFactory.getCurrentSession();
	}

	@Override
	public int findBookPriceByIsbn(String isbn) {
		System.out.println(2);
		System.out.println(getSession());
//		String hql = "SELECT b.price FROM Book b WHERE b.isbn = ?";
//		Query query = getSession().createQuery(hql).setString(0, isbn);
//		return (Integer)query.uniqueResult();
//		System.out.println("findbook");
		System.out.println(3);
		return 1;
	}

//	@Override
//	public void updateBookStock(String isbn) {
//		//��֤��Ŀ���Ƿ����.
//		String hql2 = "SELECT b.stock FROM Book b WHERE b.isbn = ?";
//		int stock = (int) getSession().createQuery(hql2).setString(0, isbn).uniqueResult();
//		if(stock == 0){
//			throw new BookStockException("��治��!");
//		}
//
//		String hql = "UPDATE Book b SET b.stock = b.stock - 1 WHERE b.isbn = ?";
//		getSession().createQuery(hql).setString(0, isbn).executeUpdate();
//	}
//
//	@Override
//	public void updateUserAccount(String username, int price) {
//		//��֤����Ƿ��㹻
//		String hql2 = "SELECT a.balance FROM Account a WHERE a.username = ?";
//		int balance = (int) getSession().createQuery(hql2).setString(0, username).uniqueResult();
//		if(balance < price){
//			throw new UserAccountException("����!");
//		}
//
//		String hql = "UPDATE Account a SET a.balance = a.balance - ? WHERE a.username = ?";
//		getSession().createQuery(hql).setInteger(0, price).setString(1, username).executeUpdate();
//	}

}
