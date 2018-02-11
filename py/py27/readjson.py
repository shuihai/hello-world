#-*- coding: UTF-8 -*-
import xml.dom.minidom


def createXML():
    doc = xml.dom.minidom.Document()
    root = doc.createElement('Managers')
    root.setAttribute('company', 'xx科技')
    root.setAttribute('address', '科技软件园')
    doc.appendChild(root)
    managerList = [{'name': 'joy', 'age': 27, 'sex': '女'},
                   {'name': 'tom', 'age': 30, 'sex': '男'},
                   {'name': 'ruby', 'age': 29, 'sex': '女'}
                   ]

    for i in managerList:
        nodeManager = doc.createElement('Manager')
        nodeName = doc.createElement('name')
        # 给叶子节点name设置一个文本节点，用于显示文本内容
        nodeName.appendChild(doc.createTextNode(str(i['name'])))

        nodeAge = doc.createElement("age")
        nodeAge.appendChild(doc.createTextNode(str(i["age"])))

        nodeSex = doc.createElement("sex")
        nodeSex.appendChild(doc.createTextNode(str(i["sex"])))

        # 将各叶子节点添加到父节点Manager中，
        # 最后将Manager添加到根节点Managers中
        nodeManager.appendChild(nodeName)
        nodeManager.appendChild(nodeAge)
        nodeManager.appendChild(nodeSex)
        root.appendChild(nodeManager)
    # 开始写xml文档
    fp = open(r'test2.txt', 'w')
    doc.writexml(fp, indent='\t', addindent='\t', newl='\n', encoding="utf-8")

if __name__=="__main__":
    createXML()
