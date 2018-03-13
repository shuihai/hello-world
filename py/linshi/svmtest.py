from svmutil import *
from datetime import datetime, timedelta

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

testtime()