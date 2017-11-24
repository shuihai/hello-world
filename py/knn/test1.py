import numpy as ny
from numpy import *


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

teststarstar();
