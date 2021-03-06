import numpy as ny
from numpy import *
import knn
import matplotlib
import matplotlib.pyplot as plt
import operator


def createDataSet():
    group = array([[1.0, 1.1], [1.0, 1.0], [0, 0], [0, 0.1]])
    labels = ['A', 'A', 'B', 'B']
    return group, labels


# group,labels=createDataSet()

# testShape,test**,testTile,testArgsort,testOnes
# testShape
# print(group.shape)
# testOnes
# print(numpy.ones([3,2]))
# print(numpy.zeros([3,2]))
# print(numpy.argsort())

def testArgsort():
    a = ny.array([1, 3, 2])
    print(a.argsort())


def testTile():
    print(tile([1, 2], 2))
    print(tile([1, 2], (2, 3)))
    print(tile([1, 2], (2, 2, 3)))


def teststarstar():
    print(array([1, 2]))
    print(array([1, 2]) ** 0.5)


def testZeros():
    a = zeros((2, 3))
    print(a)


def testreadline():
    file = open("../d2.txt")
    lens = len(file.readlines())
    print(lens)


def testreadin():
    file = open("../d2.txt")
    # lens = len(file.readlines())
    for line in file.readlines():
        a = line.split('\t')
        print(a[0:1])
        print(a[0:])
        print(a[0])


def testkuohao():
    a = [1, 2, 3]
    print(a[0:])
    print(a[0:2])
    print(a[0:1])


def testappend():
    a = []
    a.append([1])
    a.append([2])
    print(a)


def testkuohaodouhao():
    a = array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
    print(a[:, 1])
    print(type(a[:, 1]))


def testknn():
    a, b = knn.file2matrix('../datingTestSet.txt')
    print(a[:, 1])


def testmatplotlib():
    fig = plt.figure()
    ax = fig.add_subplot(111)
    a = array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
    print(a[:, 1])
    print([2, 1])
    print(type(a[:, 1]))
    print(type([1, 2]))
    # ax.scatter(a[:,1],a[:,2])
    ax.scatter([2, 3, 4], [1, 2, 3])
    plt.show()


def testknn_matplotlib():
    a, b = knn.file2matrix('../datingTestSet.txt')
    fig = plt.figure()
    ax = fig.add_subplot(111)
    ax.scatter(a[:, 1], a[:, 2], 15 * array(b), 15 * array(b))
    #  ax.scatter(a[:, 1], a[:, 2],b,b)
    plt.show()


def testmin():
    a = array([[1, 2, 3], [4, 5, 1], [0, 7, 8]])
    b = a.min(0)
    print(b)


def testdivision():
    a = array([[2, 2], [2, 2]])
    b = array([[2, 2], [2, 2]])
    print(a / b)
    # print(linalg.solve(a, b))


def teststarstar():
    a = array([[1, 2], [3, 4]])
    c = array([1, 2])
    d = tile(c, (2, 1))
    b = a ** 2
    print(b)
    print(d ** 0.5)


def testsum():
    a = array([[1, 2, 3], [4, 5, 6]])
    print(a.sum(axis=0))
    print(a.sum(axis=1))


def testsorted():
    a = {'a': 1, 'c': 2, 'b': 3}
    print(sorted(a.items(), key=operator.itemgetter(0), reverse=True))
    print(type(sorted(a.items(), key=operator.itemgetter(0), reverse=True)))
    print(type(a))


def testmaohao():
    a = array([[1, 2, 3], [1, 2, 6], [1, 2, 4], [1, 2, 5]])
    print(a[0:3, :])


def testprint():
    print("Name:%10s Age:%8d Height:%8.2f" % ("Aviad", 25, 1.83))


def testraw_input():
    a = float(input("hehe"))
    print(a)


def testnotin():
    a = "c"
    b = [1, 2, 3]
    c = {'c': 3, "d": 4}
    d = c.keys()
    print(c.keys())
    if a not in d:
        print("notin")
    else:
        print("in")


def testappendtestextend():
    a = [1, 2, 3]
    b = [4, 5, 6]
    a.extend(b)
    print(a)
    a.append(b)
    print(a)


def testfor():
    c = [[1, 2], [3, 4]]
    a = [b[1] for b in c]
    print(a)


def testset():
    a = [2, 2, 4, 3]
    b = set(a)
    print(b)


def testdict():
    decisionNode = dict(boxstyle="sawtooth", fc="0.8")
    a = {'a': 1, 'b': 2}
    print(decisionNode)
    print(a)


def test__name__():
    d = dict(boxstyle="sawtooth", fc="0.8")
    a = {'a': 1}
    b = [1, 2]
    c = (3, 4)
    print(type(d))
    print(type(d).__name__)
    # print(type(a))
    # print(d.__name__)
    # print(b.__name__)
    # print(c.__name__)


def testif():
    a = 2
    if a == 1:
        print(1)
    else:
        print(2)


def testkeys():
    a = {'a': 1, 'b': 1}
    b = list(a.keys())[0]
    print(b)


def testfigure():
    fig = plt.figure(4, facecolor='white')
    fig.clf()
    # a=dict(xticks=[0,2], yticks=[1,2])
    # ax1=plt.subplot(111,frameon=True,**a)
    ax1 = plt.subplot(111, frameon=True)
    ax1.text(0.2, 0.3, 's', fontsize=12)  # (x, y, s, fontsize=12)
    plt.show()


def testpickle():
    import pickle
    fw = open('a.txt', 'wb+')
    pickle.dump('aaab', fw)
    fw.close()
    fr = open('a.txt', 'rb+')
    a = pickle.load(fr)
    print(a)
    fr.close()


def testkuohaoxing():
    a = [0] * 3
    print(a)
    b = [1, 2, 3] * 2
    print(b)
    c = array([1, 2, 3]) * 2
    print(c)


def testunionset():
    c = [1, 2, 3, 3]
    a = set(c)
    b = set([2, 4])
    d = b | a
    print(d)


def testsum():
    a = [0, 1, 0, 1, 0]
    b = sum(a)
    print(b)


def testuniform():
    print(random.uniform(1, 10))


def testre():
    import re
    a = mySent = 'This book is the best  book on Python'
    mySent = 'This book is the best  book on Python'
    c = re.compile('\\W*')
    e = c.split(mySent)
    b = re.split(r'\W*', a)
    print(e)
    print(b)


def testlowerupper():
    a = 'TttTaAAa'
    b = a.lower()
    print(b)
    b = a.upper()
    print(b)


def testmaohao():
    # errArr = mat(ones((3, 1)))
    # errArr[predictedVals == labelMat] = 0
    datMat = matrix([[1., 2.1],
                     [2., 1.1],
                     [1.3, 1.],
                     [1., 1.],
                     [2., 1.]])
    # print(type(datMat))
    # datMat=mat(datMat)
    # print(type(datMat))
    classLabels = [1.0, 1.0, -1.0, -1.0, 1.0]
    classLabels = mat(classLabels).T
    retArray = ones((shape(datMat)[0], 1))
    # print(datMat[:, 0])
    print(retArray)
    # retArray[datMat[:, 1] <= classLabels] = -1.0
    retArray[mat([1,1,1,1,1]).T <= classLabels] = -1.0
    print(retArray)
    # print(retArray)

def testa0():
    a=mat([[1,2],[3,4]])
    print(a)
    print(a.A[0])

def testmean():
    a=mat([[1,2],[4,4]])
    print(mean(a,0))
    print(1)


def testjsonload():
    import json
    path='usagov_bitly_data2012-03-16-1331923249.txt'
    records = [json.load(line) for line in open(path)]
    print(records)


def testmap():
    a=[1,2]
    b=map(float,a)
    print(a)


testmap()
