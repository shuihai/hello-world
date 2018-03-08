# -*- coding: UTF-8 -*-
import scrapy
from stock import items
import pymysql
import time
from scrapy.utils.project import get_project_settings

class Stock(scrapy.Spider):
    name = "stock"
    def __init__(self):
        settings = get_project_settings()
        self.host = settings['HOST']
        self.port = settings['PORT']
        self.user = settings['USER']
        self.pwd = settings['PWD']
        self.db = settings['DB']
        self.table = settings['TABLE2']

    def start_requests(self):
        url_set = self.get_url()
        start_time = time.strftime('%Y%m%d', time.localtime(time.time()-3600*24*365*10))
        end_time = time.strftime('%Y%m%d', time.localtime(time.time()))
        print start_time


        for url in url_set:
            if(url['type']==0):
                yield scrapy.Request(
                    'http://quotes.money.163.com/service/chddata.html?code='+str(url['type'])+url['code']+'&start='+start_time+'&end='+end_time+'&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER')
            elif(url['type']==1):
                yield scrapy.Request(
                    'http://quotes.money.163.com/service/chddata.html?code='+str(url['type'])+url['code']+'&start='+start_time+'&end='+end_time+'&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER')

    def get_url(self):
        client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,charset='utf8' )
        cursor =  client.cursor(cursor=pymysql.cursors.DictCursor)
        cursor.execute("select * from "+self.table+" ")
        url_set = cursor.fetchall()
        return url_set

    def parse(self, response):
        a = response.body_as_unicode().split('\r\n')
        b = a[1:-1]
        for day in a[1:-1]:
            day_arr = day.split(',')
            item =  items.DayItem()
            item['date'] = day_arr[0]
            item['code'] = day_arr[1][1::]
            item['name'] = day_arr[2]
            item['tclose'] = day_arr[3]
            item['high'] = day_arr[4]
            item['low'] = day_arr[5]
            item['topen'] = day_arr[6]
            item['lclose'] = day_arr[7]
            item['chg'] = day_arr[8]
            item['pchg'] = day_arr[9]
            item['voturnover'] = day_arr[10]
            item['vaturnover'] = day_arr[11]
            yield item
