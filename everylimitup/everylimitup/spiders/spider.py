# -*- coding: UTF-8 -*-
import scrapy
from everylimitup.items import LimitupItem
import pymysql
import time
from datetime import datetime, timedelta
from scrapy.utils.project import get_project_settings
import sys
import os
import shutil
from selenium import webdriver
import time
from selenium.webdriver.common.keys import Keys






reload(sys)
sys.setdefaultencoding('gbk')



class Weixin(scrapy.Spider):
    name = "everylimitup"

    def __init__(self):
        settings = get_project_settings()
        self.host = settings['HOST']
        self.port = settings['PORT']
        self.user = settings['USER']
        self.pwd = settings['PWD']
        self.db = settings['DB']
        self.table = settings['TABLE']

    start_urls = [
        "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=",
        ]


    # def start_requests(self):
    #
    #     url_set = self.get_url_set()
    #     for url in url_set:
    #         realurl =  'http://weixin.sogou.com/weixin?type=1&s_from=input&query='+url['gzh_name']+'&ie=utf8&_sug_=n&_sug_type_='
    #         yield scrapy.Request(realurl )





 
    def get_url_set(self):
        client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,
                                 charset='utf8')
        cursor = client.cursor(cursor=pymysql.cursors.DictCursor)
        cursor.execute("select * from " + self.table + " ")
        url_set = cursor.fetchall()
        return url_set



    def parse(self, response):
        print 33
        from selenium import webdriver
        from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
        from selenium.webdriver.firefox.firefox_binary import FirefoxBinary

        binary = FirefoxBinary(r'C:\Program Files (x86)\Mozilla Firefox\firefox.exe')
        driver = webdriver.Firefox(firefox_binary=binary)
        driver.get('http://www.itcrm.com')
        data = driver.find_elements_by_css_selector('.sublist .zhihui')[0].get_attribute('src')
        print data
        driver.quit()
        # a = response.body_as_unicode().split('\r\n')
        # print a
        # tbody1 = response.css('.scroll_table tbody tr')
        # tbody2 = response.css('.static_table tbody tr')
        # tbody2 = response.css('.static_table')
        # print tbody2
        # # for tr in tbody2:
        # for index, tr in enumerate(tbody2):
        #     print index
        #     item = LimitupItem()
        #     item.code =tr.css('td')[1].css('div::text').extract()
        #     print item.code


    # def parse_detail(self, response):
        # item = ImagesItem()
