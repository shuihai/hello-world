package dao;

import dto.AppointExecution;
import org.junit.Test;
import service.BookService;

import javax.annotation.Resource;

public class BookServiceImplTest extends BaseTest {

    @Resource
    private BookService bookService;

    @Test
    public void testAppoint() throws Exception {
        long bookId = 1001;
        long studentId = 12345678910L;
        AppointExecution execution = bookService.appoint(bookId, studentId);
        System.out.println(execution);
    }

}
