from numpy import *
def loadDataSet(fileName):
    dataMat = []
    fr = open(fileName)
    for line in fr.readlines():
        curLine = line.strip().split('\t')
        fltLine = map(float,curLine)
        dataMat.append(fltLine)
    return dataMat

def binSplitDataSet(dataSet, feature, value):
    mat0 = dataSet[nonzero(dataSet[:,feature] > value) [0],:][0]
    mat1 = dataSet[nonzero(dataSet[:,feature] <= value)[0],:][0]
    return mat0,mat1

def test():
    testMat = mat(eye(4))
    print(testMat[:, 1] )
    # a=testMat[nonzero(testMat[:, 1] > 0.5)[0], :]
    # b= nonzero(testMat[:, 1] > 0.5)[0]
    print(testMat[nonzero(testMat[:, 1] > 0.5)[0], :] )
    print(testMat[nonzero(testMat[:, 1] > 0.5)[0], :][0])

    # print(b)
    # a = arange(3 * 4 * 5).reshape(3, 4, 5)
    # print(testMat[:, 1] > 0.5)

test()