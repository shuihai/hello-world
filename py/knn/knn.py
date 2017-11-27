from numpy import *
def file2matrix(filename):
    fr=open(filename)
    numberOfLines = len(fr.readlines())
    returnMat = zeros((numberOfLines,3))
    classLabelVector =[]
    fr=open(filename)
    index = 0
    for line in fr.readlines():
        line=line.strip()
        listFromLine= line.split('\t')
        returnMat[index,:]=listFromLine[0:3]
        if listFromLine[-1] == 'largeDoses':
            classLabelVector.append(3)
        elif listFromLine[-1] == 'smallDoses':
            classLabelVector.append(2)
        elif listFromLine[-1] == 'didntLike':
            classLabelVector.append(1)
        index+=1
    return returnMat,classLabelVector
