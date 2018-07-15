package ssh.test;

import org.junit.Before;
import org.junit.Test;
import org.json.JSONObject;

import javax.sound.midi.Soundbank;
import java.lang.annotation.Target;
import java.lang.reflect.InvocationHandler;
import java.lang.reflect.Method;
import java.lang.reflect.Proxy;
import java.util.*;
import java.util.Map.Entry;


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
    }///s蛮难的，只会一些


    public static int partition(int[] array,int lo,int hi){
        int key=array[lo];
        while (lo<hi){
            while (array[hi]>=key && hi>lo){
                hi--;
            }
            array[lo]=array[hi];

            while(array[lo]<=key&&hi>lo){
                lo++;
            }
            array[hi]=array[lo];
        }

        array[hi]=key;
        return hi;
    }


    public static void quicksort(int[] array,int lo,int hi){
        if(lo>=hi){
            return;
        }

        int index=partition(array,lo,hi);
        quicksort(array,lo,index-1);
        quicksort(array,index+1,hi);
    }

    @Test
    public  void test3(){
        int[] arr = {1,9,3,12,7,8,3,4,65,22};

        quicksort(arr,0,arr.length-1);

        for(int i:arr){
            System.out.println(i+"");
        }

    }

    @Test
    public void  test5(){
        List<String> list=new ArrayList<String>();
        list.add("hello");
        list.add("world");

        for (String str:list){
            System.out.println(str);
        }

        String[] strArray = new String[list.size()];
        list.toArray(strArray);

        for (int i=0;i<strArray.length;i++){
            System.out.println(strArray[i]);
        }

        Iterator<String> iterator=list.iterator();
        while (iterator.hasNext()){
            System.out.println(iterator.next());
        }

        Map<String,String> map = new HashMap<String, String>();
        map.put("1","value1");
        map.put("2","value2");
        map.put("3","value3");

        for (String key:map.keySet()){
            System.out.println(key+map.get(key));
        }
        Iterator<Map.Entry<String, String>> it = map.entrySet().iterator();

        while (it.hasNext()){
            Map.Entry<String,String> entry = it.next();
            System.out.println(entry.getKey()+entry.getValue());
        }

        for (Map.Entry<String,String> entry:map.entrySet()){
            System.out.println(entry.getKey());
        }

        for (String v:map.values()){
            System.out.println(v);
        }




    }




    @Before
    public void test2(){
        System.out.println("before");
    }



    @Test
    public void  test6(){

        Singer singer = new Singer();
//        Singerinter object = (Singerinter)new Proxytest().getinstance(singer);
        Singerinter object = (Singerinter)new Proxytest().getinstance2(singer);
          object.sing();


    }


}

    class Proxytest  {

        public Object target;

        public Proxytest(Object target) {
            this.target=target;
        }

        public Proxytest() {

        }

//        public Object getinstance(Object target){
//            return Proxy.newProxyInstance(new Proxytest().getClass().getClassLoader(),target.getClass().getInterfaces(),new Proxytest(target));
//        }


        public Object getinstance2(Object target){
            return Proxy.newProxyInstance(new Proxytest().getClass().getClassLoader(),target.getClass().getInterfaces(),new Handler());
        }


        public Object invoke(Object proxy, Method method, Object[] args) throws Throwable {
            System.out.println("invoke");
            Object returnValue= method.invoke(target,args);
            return null;
        }

    }

class Handler implements InvocationHandler {

    public Object invoke(Object proxy, Method method, Object[] args) throws Throwable {
        System.out.println("handle");
        Object returnValue= method.invoke(new Singer(),args);
        return returnValue;
    }
}

class Singer implements Singerinter{
    public void  sing(){
        System.out.println("sing");
    }
}

interface  Singerinter{
    public void  sing();
}