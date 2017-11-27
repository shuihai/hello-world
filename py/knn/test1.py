import numpy as ny
from numpy import *
import knn
import matplotlib
import matplotlib.pyplot as plt
def createDataSet():
    group=array([[1.0,1.1],[1.0,1.0],[0,0],[0,0.1]])
    labels=['A','A','B','B']
    return group ,labels

# group,labels=createDataSet()

# testShape,test**,testTile,testArgsort,testOnes
# testShape
# print(group.shape)
# testOnes
# print(numpy.ones([3,2]))
# print(numpy.zeros([3,2]))
# print(numpy.argsort())

def testArgsort():
    a = ny.array([1,3,2])
    print(a.argsort())

def testTile():
    print(tile([1,2],2))
    print(tile([1,2],(2,3)))
    print(tile([1,2],(2,2,3)))

def teststarstar():
    print(array([1,2]))
    print(array([1,2])**0.5)

def testZeros():
    a=zeros((2,3))
    print(a)

def testreadline():
    file=open("../d2.txt")
    lens = len(file.readlines())
    print(lens)

def testreadin():
    file=open("../d2.txt")
    # lens = len(file.readlines())
    for line in file.readlines():
        a=line.split('\t')
        print(a[0:1])
        print(a[0:])
        print(a[0])

def testkuohao():
    a=[1,2,3]
    print(a[0:])
    print(a[0:2])
    print(a[0:1])

def testappend():
    a=[]
    a.append([1])
    a.append([2])
    print(a)

def testkuohaodouhao():
    a=array([[1,2,3],[4,5,6],[7,8,9]])
    print(a[:,1])
    print(type(a[:,1]))

def testknn():
    a,b=knn.file2matrix('../datingTestSet.txt')
    print(a[:,1])

def testmatplotlib():
    fig=plt.figure()
    ax=fig.add_subplot(111)
    a = array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
    print(a[:, 1])
    print([2, 1])
    print(type(a[:, 1]))
    print(type([1,2]))
    # ax.scatter(a[:,1],a[:,2])
    ax.scatter([2,3,4], [1,2,3])
    plt.show()

def testknn_matplotlib():
    a,b=knn.file2matrix('../datingTestSet.txt')
    fig=plt.figure()
    ax=fig.add_subplot(111)
    ax.scatter(a[:,1],a[:,2],15*array(b),15*array(b))
    #  ax.scatter(a[:, 1], a[:, 2],b,b)
    plt.show()

def testmin():
    a=array([[1,2,3],[4,5,1],[0,7,8]])

    b=a.min(0)
    print(b)
testmin()
