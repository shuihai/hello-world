# -*- coding: UTF-8 -*-
import scrapy
from stock import items
import pymysql
import time
from scrapy.utils.project import get_project_settings

class Stock(scrapy.Spider):
    name = "get_code"

    def __init__(self):
        settings = get_project_settings()
        self.host = settings['HOST']
        self.port = settings['PORT']
        self.user = settings['USER']
        self.pwd = settings['PWD']
        self.db = settings['DB']
        self.table = settings['TABLE2']

    start_urls = [
        "http://quote.eastmoney.com/stocklist.html",
    ]

    def parse(self, response):
        
