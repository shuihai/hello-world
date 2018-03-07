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
