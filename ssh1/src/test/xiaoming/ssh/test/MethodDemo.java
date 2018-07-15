package ssh.test;

import java.lang.reflect.Method;

import java.lang.reflect.Method;

public class MethodDemo {

    static {
        System.out.println("static");
    }

    public static void init() {
        System.out.println("init");
    }

    public static void main(String[] args) {
        Method[] methods = SampleClass.class.getDeclaredMethods();
        System.out.println(methods.length);
        System.out.println(SampleClass.class.getName());
        for (Method method:methods){
            System.out.println(method.getName());
        }

        Class[] parameterTypes = methods[1].getParameterTypes();

        for(Class parameterType: parameterTypes){
            System.out.println(parameterType.getName());

        }
    }
}

class SampleClass {
    private String sampleField;

    public String getSampleField() {
        return sampleField;
    }

    public void setSampleField(String sampleField,int hehe) {
        this.sampleField = sampleField;
    }
}