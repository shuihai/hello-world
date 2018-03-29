# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class EverylimitupItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    pass


class LimitupItem(scrapy.Item):
    date = scrapy.Field()
    code = scrapy.Field()
    stockname = scrapy.Field()
    reason = scrapy.Field()
    first_time = scrapy.Field()
    last_time = scrapy.Field()
    consistent_day = scrapy.Field()
