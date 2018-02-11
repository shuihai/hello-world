# encoding:UTF-8
from pandas import Series,DataFrame
import numpy as np
# import unittest
from selenium import webdriver
import pandas_datareader.data as web


def testjsonload():
    import json
    path = 'usagov_bitly_data2012-03-16-1331923249.txt'
    records = [json.loads(line) for line in open(path)]
    print records[0]['tz']


def testforif():
    import json
    path = 'usagov_bitly_data2012-03-16-1331923249.txt'
    records = [json.loads(line) for line in open(path)]
    tz=[rec['tz'] for rec in records if 'tz' in rec]
    print tz[:10]
    print tz[0]

def testpandas():
    browser = webdriver.Firefox()
    browser.get("http://www.python.org")


def testtest():
    import os
    chromedriver = "C:\Users\Administrator\AppData\Local\\360Chrome\Chrome\Application\\360chrome.exe"
    os.environ["webdriver.chrome.driver"] = chromedriver
    driver = webdriver.Chrome(chromedriver)
    driver.get("http://baidu.com")
    print(driver.title)
    driver.quit()

def testtest2():
    # driver = webdriver.Chrome(r"D:\Python27\chromedriver.exe")
    # driver.get("http://www.itcrm.com/")
    # print(driver.title)
    a=np.random.randint(0,2,(3,20))
    b=np.where(a>0,1,-1)
    c=b.cumsum(1)
    d=(c>4).argmax()
    e=(c>4).any(1)
    print a
    print b
    print c
    print d
    print e



def testtest4():
    df = DataFrame([[1.4, np.nan], [7.1, -4.5],  [np.nan, np.nan], [0.75, -1.3]],  index = ['a', 'b', 'c', 'd'],  columns = ['one', 'two'])
    print df
    print df.sum(axis=0)
    print df.mean(axis=1, skipna=False)
    print df.mean(axis=1, skipna=True)

def testtest5():
    px = web.DataReader('F-F_Research_Data_factors', 'famafrench')
    a=px[0]
    b=a.pct_change()
    c=b.tail()
    print b
    print c
    print c.SMB
    print c.SMB.corr(c.RF)
    print c.SMB.cov(c.RF)
    all_data = {}
    # for ticker in ['AAPL', 'IBM', 'MSFT', 'GOOG']:
    #     all_data[ticker] = web.DataReader(ticker, '1/1/2000', '1/1/2010')



# class TestAddition(unittest.TestCase):
#     def setUp(self):
#         print("Setting up the test")
#     def tearDown(self):
#         print("Tearing down the test")
#     def test_twoPlusTwo(self):
#         total = 2+2
#         self.assertEqual(4, total)



def yield_test(n):
    for i in range(n):
        yield call(i)
        print("i=", i)
        # 做一些其它的事情
    print("do something.")
    print("end.")


def call(i):
    return i * 2


# 使用for循环
for i in yield_test(5):
    print(i, ",")


# testtest5()

