#encoding:gb2312
# import urllib.request
import  time
from svmutil import *
import random

def createdata():
    file='test.t'
    with open(file, 'a+') as f:
        for i in range(0, 99):
            a=random.randint(1, 20)
            if a<=10:
                datastr = '-1 1:'+ str(a)
            else:
                datastr = '1 1:' + str(a)
            f.write(datastr + '\n')
        #     datastr = ''
        # for dd in d:
        #     datastr = datastr + dd.lstrip("'") + ','
        # f.write(datastr + '\n')

def get_page(url):  #获取页面数据
    req=urllib.request.Request(url,headers={
        'Connection': 'Keep-Alive',
        'Accept': 'text/html, application/xhtml+xml, */*',
        'Accept-Language':'zh-CN,zh;q=0.8',
        'User-Agent': 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko'
    })
    opener=urllib.request.urlopen(req)
    page=opener.read()
    return page

def get_index_history_byNetease(index_temp):
    """
    :param index_temp: for example, 'sh000001' 上证指数
    :return:
    """
    index_type=index_temp[0:2]
    index_id=index_temp[2:]
    if index_type=='sh':
        index_id='0'+index_id
    if index_type=="sz":
        index_id='1'+index_id
    url='http://quotes.money.163.com/service/chddata.html?code=%s&start=19900101&end=%s&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER'%(index_id,time.strftime("%Y%m%d"))

    page=get_page(url).decode('gb2312') #该段获取原始数据
    page=page.split('\r\n')
    col_info=page[0].split(',')   #各列的含义
    print (col_info)

createdata()

