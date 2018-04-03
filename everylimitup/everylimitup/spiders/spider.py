# -*- coding: UTF-8 -*-
import re
import scrapy
from selenium.common.exceptions import NoSuchElementException

from everylimitup.items import LimitupItem
from everylimitup.items import LonghuItem
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
import json

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
        self.date=''
        self.up={}

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
    #             num_elements = self.get_num_elements()
    #             self.click_element(num_elements[index - 1])
    #             time.sleep(5)
    #             items = self.process_data()
    #             for item in items:
    #                 yield item


    def click_element(self, element):
        last_height = self.driver.execute_script("return document.body.scrollHeight")
        self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        ActionChains(self.driver).move_to_element(element).click(element).perform()

    def get_current_element_static_tbody_table(self):
        data = self.driver.find_elements_by_css_selector(
            '.static_tbody_table tbody tr')  # [0].find_element_by_css_selector('td')
        return data

    def get_current_element_scroll_tbody_table(self):
        data = self.driver.find_elements_by_css_selector(
            '.scroll_tbody_table tbody tr')  # [0].find_element_by_css_selector('td')
        return data

    def process_data(self):
        data_static_tbody_table = self.get_current_element_static_tbody_table()
        data_scroll_tbody_table = self.get_current_element_scroll_tbody_table()
        date = self.get_date()
        self.date = date
        items = []
        print len(data_static_tbody_table)
        for index in range(0, len(data_static_tbody_table) - 1):
            tds_values = data_static_tbody_table[index].find_elements_by_css_selector('td')
            item = LimitupItem()
            print  tds_values[3].text
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
            firstpage_items = self.process_data()
            for item in firstpage_items:
                yield item


            for index in range(2, flag + 1):
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
                yield scrapy.Request(realurl, callback=lambda response, code=url['code']: self.parse_yyb(response, code) )

        yield scrapy.Request("http://www.itcrm.com", callback=lambda response: self.parse_temp(response)  )



    def parse_temp(self, response):
        print self.up
        print 1000000

    def parse_yyb(self,response,code):
        trs = response.css('#tab-2 tbody tr')
        for tr in trs:
            href = self.get_yyb_url(tr)
            yyb_code = self.get_yyb_code(tr)
            if href:
                yield scrapy.Request(href, callback=lambda response, code=code, yyb_code=yyb_code: self.parse_yyb_solo(response, code,yyb_code)  ) #获得当个营业部信息



    def get_yyb_code(self,tr):
        href = tr.css('.sc-name a')[1].css('::attr(href)').extract()[0]
        pattern = '(\d+\d+)\.'
        yyb = re.search(pattern, href, flags=0)
        if yyb:
            return yyb.group(1)

    def get_yyb_url(self,tr):
        href = tr.css('.sc-name a')[1].css('::attr(href)').extract()[0]
        pattern = '(\d+\d+)\.'
        yyb = re.search(pattern, href, flags=0)
        if yyb:
            return 'http://data.eastmoney.com/DataCenter_V3/stock2016/jymx.ashx?pagesize=50&page=1&js=var%hehe&param=&sortRule=-1&sortType=&gpfw=0&code=' + yyb.group(1)


    def get_need_url(self,code):
        return 'http://data.eastmoney.com/stock/lhb/'+code+'.html'


    def get_url_set(self):
        client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,
                                 charset='utf8')
        cursor = client.cursor(cursor=pymysql.cursors.DictCursor)
        cursor.execute("select * from " + self.table + " ")
        url_set = cursor.fetchall()
        return url_set


    def parse_yyb_solo(self,response,code,yyb_code):
        # print 99999
        str = response.body_as_unicode()
        # print str
        str = str[9:]
        str = str.replace("'", '"')
        str = json.loads(str)
        for data in str['data']:
            if data['ActBuyNum']>0:
                longhu = LonghuItem()
                longhu['longhu_stock_code'] = code
                longhu['yyb_code'] = yyb_code
                longhu['stock_yyb_code'] = data['SCode']
                longhu['yyb_name'] =data['SalesName']
                longhu['date'] = data['TDate']
                longhu['longhu_date'] = self.date
                longhu['up1'] = data['RChange1DC']
                longhu['up2'] =data['RChange2DC']
                longhu['up3'] = data['RChange3DC']
                yield longhu


        # tds = response.css('#tab-3 tbody tr')[1].css('td')


        # trs = response.css('#tab-3')

        # trs =  response.css('#tab-3 tbody tr')

        # for tr in trs:
        #     tds = tr.css('td::text').extract()
        #     for td in tds:
        #         print tds
        #     longhu =LonghuItem()
        #     longhu['longhu_stock_code'] = code
        #     longhu['yyb_code'] = yyb_code
        #     longhu['stock_yyb_code'] = tds[1]
        #     longhu['yyb_name'] =response.css('.main-title .tit::attr(title)').extract()
        #     longhu['up1'] = tds[9]
        #     longhu['up2'] = tds[10]
        #     longhu['up3'] = tds[11]
        #     yield longhu




        # yyb_info = []
        # yyb_info.append({'cishu':tds[4].css('::text').extract()})
        # yyb_info.append({'firstday_up': tds[2].css('::text').extract()})
        # yyb_info.append({'secondday_up': tds[5].css('::text').extract()})
        # yyb_info.append({'thirdday_up': tds[8].css('::text').extract()})
        # if not self.up.get(code) :
        #     self.up.__setitem__(code,yyb_info)
        # else:
        #     self.up[code].append(yyb_info)


