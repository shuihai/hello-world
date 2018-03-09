# -*- coding: UTF-8 -*-
import scrapy
import pymysql
import time
from scrapy.utils.project import get_project_settings
from get_stock_code import items

class Stock(scrapy.Spider):
    name = "get_code"

    def __init__(self):
        settings = get_project_settings()


    start_urls = [
        "http://quote.eastmoney.com/stocklist.html",
    ]

    def parse(self, response):
        a = response.body_as_unicode().split('\r\n')
        name_codes = response.css('#quotesearch ul li a::text').extract()
        for name_code in name_codes:
            name = name_code[:name_code.find('(')]
            code = name_code[name_code.find('(')+1:-1]
            if code[0]=='6':
                codeitem =items.CodeItem()
                codeitem['name'] = name
                codeitem['code'] = code
                codeitem['type'] = 0
                yield codeitem

            elif code[0]=='0' or code[0]=='3':
                codeitem = items.CodeItem()
                codeitem['name'] = name
                codeitem['code'] = code
                codeitem['type'] = 1
                yield codeitem