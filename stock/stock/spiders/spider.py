# -*- coding: UTF-8 -*-
import scrapy
from scrapy.item import BaseItem
from stock import items


class Stock(scrapy.Spider):
    name = "stock"
    # allowed_domains = ["dmoztools.net"]

    start_urls = [
        "http://quotes.money.163.com/service/chddata.html?code=0000001&start=20150811&end=20150911&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER",
    ]
    urlset = []

    def parse(self, response):
        a = response.body_as_unicode().split('\r\n')
        b=a[1:2]
        c=b[0]
        c=c.encode('utf-8')
        print c

        # str=u'\xc8'
        # b=str.encode('ISO 8859-1')
        # print b

        # for day in a[1:-1]:
        #     day_arr = day.split(',')
        #     item =  items.DayItem()
        #     item['name'] = day_arr[2]
        #     item['date'] = day_arr[0]
        #     yield item
