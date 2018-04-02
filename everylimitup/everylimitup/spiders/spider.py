# -*- coding: UTF-8 -*-
import re
import scrapy
from selenium.common.exceptions import NoSuchElementException

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
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from selenium.webdriver.firefox.firefox_binary import FirefoxBinary
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver import ActionChains

reload(sys)
sys.setdefaultencoding('gbk')


class Limitup(scrapy.Spider):
    name = "everylimitup"

    def __init__(self):
        settings = get_project_settings()
        self.host = settings['HOST']
        self.port = settings['PORT']
        self.user = settings['USER']
        self.pwd = settings['PWD']
        self.db = settings['DB']
        self.table = settings['TABLE']
        self.firefox_path = settings['FIREFOX_PATH']
        self.binary = FirefoxBinary(self.firefox_path)
        self.driver = webdriver.Firefox(firefox_binary=self.binary)
        self.driver.set_window_size(1366, 768)
        self.up=[]

    start_urls = [
        "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=",
        ]


    # def start_requests(self):
    #     self.driver.get(
    #         "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=")
    #     # data = self.driver.find_elements_by_css_selector('.sublist .zhihui')[0].get_attribute('src')
    #     WebDriverWait(self.driver, 8).until(EC.presence_of_element_located((By.CLASS_NAME, "static_tbody_table")))
    #
    #     flag = self.get_element_number()
    #     if flag:
    #         self.process_data()
    #
    #         for index in range(2, flag + 1):
    #             print index
    #             num_elements = self.get_num_elements()
    #             self.click_element(num_elements[index - 1])
    #             time.sleep(5)
    #             items = self.process_data()
    #             for item in items:
    #                 yield item
                    # print item


    def click_element(self, element):
        last_height = self.driver.execute_script("return document.body.scrollHeight")
        self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        ActionChains(self.driver).move_to_element(element).click(element).perform()

    def get_current_element_static_tbody_table(self):
        data = self.driver.find_elements_by_css_selector(
            '.static_tbody_table tbody tr')  # [0].find_element_by_css_selector('td')
        print data
        return data

    def get_current_element_scroll_tbody_table(self):
        data = self.driver.find_elements_by_css_selector(
            '.scroll_tbody_table tbody tr')  # [0].find_element_by_css_selector('td')
        print data
        return data

    def process_data(self):
        data_static_tbody_table = self.get_current_element_static_tbody_table()
        data_scroll_tbody_table = self.get_current_element_scroll_tbody_table()
        date = self.get_date()
        items = []
        for index in range(0, len(data_static_tbody_table) - 1):
            tds_values = data_static_tbody_table[index].find_elements_by_css_selector('td')
            item = LimitupItem()
            item['stockname']  = tds_values[3].text
            item['code'] = tds_values[2].text

            tds_values = data_scroll_tbody_table[index].find_elements_by_css_selector('td')
            item['first_time'] = tds_values[3].text
            item['last_time'] = tds_values[4].text
            item['reason'] = tds_values[7].text
            item['consistent_day'] = tds_values[6].text
            item['date'] = date
            items.append(item)
        return items

    def get_date(self):
        date = self.driver.find_element_by_css_selector('span[explain="当前时刻涨停的股票，首次涨停的时间。"]').text
        pattern = '\d+\.\d+\.\d+'
        processed_date = re.search(pattern, date, flags=0).group()
        print processed_date
        return processed_date

    def get_num_elements(self):
        num_elements = self.driver.find_elements_by_css_selector('.pagination > .num')
        return num_elements

    def get_element_number(self):
        try:
            WebDriverWait(self.driver, 8).until(EC.presence_of_element_located((By.CLASS_NAME, "num")))
        except Exception:
            return 0
        elements = self.driver.find_elements_by_css_selector('.pagination .num,.pagination .current')
        return len(elements)

    def parse(self, response):
        self.driver.get(
            "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=")
        # data = self.driver.find_elements_by_css_selector('.sublist .zhihui')[0].get_attribute('src')
        WebDriverWait(self.driver, 8).until(EC.presence_of_element_located((By.CLASS_NAME, "static_tbody_table")))

        flag = self.get_element_number()
        if flag:
            self.process_data()

            for index in range(2, flag + 1):
                print index
                num_elements = self.get_num_elements()
                self.click_element(num_elements[index - 1])
                time.sleep(5)
                itemss = self.process_data()
                for item in itemss:
                    yield item

        # 接下来请求每个stoke今天的营业部信息
        url_set = self.get_url_set()
        for url in url_set:
            if not url['up_decimal'] :
                realurl = self.get_need_url( url['code'])
                yield scrapy.Request(realurl, callback=lambda response, code=url['code']: self.parse_yyb(response, code))



    def parse_yyb(self,response,code):
        trs = response.css('#tab-2 tbody tr')
        for tr in trs:
            href = self.get_yyb_url(tr)
            if href:
                yield scrapy.Request(href, callback=lambda response, code=code: self.parse_yyb_solo(response, code)) #获得当个营业部信息



    def get_yyb_url(self,tr):
        href = tr.css('.sc-name a')[1].css('::attr(href)').extract()[0]
        pattern = '(\d+\d+)\.'
        yyb = re.search(pattern, href, flags=0)
        if yyb:
            return 'http://data.eastmoney.com/Stock/lhb/yyb/' + yyb.group(1) + '.html'


    def get_need_url(self,code):
        return 'http://data.eastmoney.com/stock/lhb/'+code+'.html'


    def get_url_set(self):
        client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,
                                 charset='utf8')
        cursor = client.cursor(cursor=pymysql.cursors.DictCursor)
        cursor.execute("select * from " + self.table + " ")
        url_set = cursor.fetchall()
        return url_set


    def parse_yyb_solo(self,response,code):
        tds = response.css('#tab-1 tbody tr')[0].css('td')
        yyb_info = []
        yyb_info['cishu']=tds[4]
        yyb_info['firstday_up'] = tds[4]
        yyb_info['secondday_up'] = tds[4]
        yyb_info['thirdday_up'] = tds[4]
