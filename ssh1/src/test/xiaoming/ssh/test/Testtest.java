package xiaoming.ssh.test;

import org.junit.Before;
import org.junit.Test;
import org.json.JSONObject;


public class Testtest {

    @Test
    public void test1(){
        String jsonString ="{\"name\":\"zhangsan\",\"password\":\"zhangsan123\",\"email\":{\"email\":\"10371443@qq.com\"}}";
        JSONObject json =  new JSONObject(jsonString);
        JSONObject jsonObject = json.getJSONObject("email");
        System.out.println(jsonObject);
        System.out.println(jsonObject.getString("email"));
        System.out.println(json.getString("name"));

        System.out.println("test1");
    }



    @Before
    public void test2(){
        System.out.println("before");
    }


}
