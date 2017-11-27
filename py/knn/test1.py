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
    a=array([[1,2],[3,4]])
    c=array([1,2])
    d=tile(c,(2,1))
    b=a**2
    print(b)
    print(d**0.5)

def testsum():
    a=array([[1,2,3],[4,5,6]])
    print(a.sum(axis=0))
    print(a.sum(axis=1))

def testsorted():
    a={'a':1,'c':2,'b':3}
    print(sorted(a.items(),key=operator.itemgetter(0),reverse=True))
    print(type(sorted(a.items(),key=operator.itemgetter(0),reverse=True)))
    print(type(a))

def testmaohao():
    a=array([[1,2,3],[1,2,6],[1,2,4],[1,2,5]])
    print(a[0:3,:])

def testprint():
    print("Name:%10s Age:%8d Height:%8.2f"%("Aviad",25,1.83))
testprint()
