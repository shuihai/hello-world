import numpy
from numpy import *
import operator

def createDataSet():
    group=array([[1.0,1.1],[1.0,1.0],[0,0],[0,0.1]])
    labels=['A','A','B','B']
    return group ,labels

group,labels=createDataSet()

# testShape,test**,testTile,testArgsort,testOnes,testTile
# testShape
print(group.shape)
# testOnes
# print(numpy.ones([3,2]))
# print(numpy.zeros([3,2]))
print(numpy.argsort())