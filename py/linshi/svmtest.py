# -*- coding: UTF-8 -*-
from svmutil import *
from datetime import datetime, timedelta
import matplotlib.pyplot as plt
import numpy as np
from numpy.random import randn
from scipy import interpolate
import pymysql

def testsvm():
    y, x = svm_read_problem('test.t')
    m = svm_train(y[:50], x[:50], '-c 4 -t 0 -s 2' )
    # p_label, p_acc, p_val = svm_predict(y[50:], x[50:], m)
    p_label, p_acc, p_val = svm_predict(y[50:], x[50:], m)
    print p_label

def testtime():
    # a = time.mktime('1991/1/2')
    print (datetime(1991, 1, 2 )+  timedelta(days=1)).strftime("%Y%m%d")
    a = '\\'
    print a
    # '\'.replace(r'\', r'\\')

def testr():
    s = r'$2x+1=%s$' % 111
    print s

def testplot():
    fig = plt.figure()
    ax1 = fig.add_subplot(2, 1, 1)
    ax2 = fig.add_subplot(2, 1, 2)
    # plt.plot(randn(50).cumsum(), 'k--')
    x = np.linspace(-np.pi, np.pi, 10)
    data1 = [0,25,50,75,100]
    x= np.array(data1)
    y = np.array([0,40,70,90,100])
    ax1.plot(x,y)
    f = interpolate.interp1d(x, y, kind='cubic')
    c= np.array([0,15,30,45,60,75,90,100])
    ny = f(c)
    ax2.plot(c, ny,color='#054E9F', linewidth = '2',linestyle='--', marker='o')
    ax2.annotate(s='你好', xy=(100, 100), xytext=(-80, -80), xycoords='data', textcoords='offset points',
                 fontsize=16, arrowprops=dict(arrowstyle='<->', connectionstyle="arc3,rad=.2"))
    plt.show()

def testreg():
    client = pymysql.connect(host="127.0.0.1", port=3306, user="root", password="123456", db="test",
                                  charset='utf8')
    cursor = client.cursor()



    file = 'test2.txt'
    with open(file, 'a+') as f:
        str = f.read()
        import re

        # key = r"<html><body><h1>hello world<h1></body></html>"  # 这段是你要匹配的文本
        # p1 = r"(?<=<h1>).+?(?=<h1>)"  # 这是我们写的正则表达式规则，你现在可以不理解啥意思
        p1 = r'(?<=<div class="item-title">).+?(?=</div>)'
        pattern1 = re.compile(p1)  # 我们在编译这段正则表达式
        matcher1 = re.findall(pattern1, str)  # 在源文本中搜索符合正则表达式的部分
        for str2 in matcher1:
            p2 = r'<a href="#/MBiz/Detail/.*" class="">(.*?)</a>'
            pattern2 = re.compile(p2)
            matcher2 = re.findall(pattern2, str2)
            print matcher2[0]   # 打印出来
            sql = "select * from " + "xiaoming_gzh" + " where gzh_name='" + matcher2[0]+"'"
            print sql
            cursor.execute("select * from " + "xiaoming_gzh" + " where gzh_name='" + matcher2[0]+"'"  )
            data = cursor.fetchone()
            if not data:
                effect_row = cursor.executemany(
                    "INSERT INTO `xiaoming_gzh`( `gzh_name`, `status` ) VALUES (%s,%s )",
                    [(matcher2[0], 1)])
                client.commit()

testreg()

