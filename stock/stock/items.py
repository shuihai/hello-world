# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class StockItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    pass

class DayItem(scrapy.Item):
    # define the fields for your item here like:
    date = scrapy.Field()
    code = scrapy.Field()
    name = scrapy.Field()
    tclose = scrapy.Field()
    high = scrapy.Field()
    low = scrapy.Field()
    topen = scrapy.Field()
    lclose = scrapy.Field()
    chg = scrapy.Field()
    pchg = scrapy.Field()
    voturnover = scrapy.Field()
    vaturnover =  scrapy.Field()
