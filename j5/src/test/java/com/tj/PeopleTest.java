package com.tj;

import junit.framework.TestCase;

public class PeopleTest extends TestCase {
    public void setUp() throws Exception {
        super.setUp();
    }

    public void tearDown() throws Exception {
        System.out.println("go");
    }

    public void testMain() throws Exception {
    }

    public void testToString() throws Exception {
    }

    public void testGetName() throws Exception {
        People people =new People("dd");

        System.out.println(people);
    }

    public void testSetName() throws Exception {
    }

}