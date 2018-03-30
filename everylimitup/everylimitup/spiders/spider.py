# -*- coding: UTF-8 -*-
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
    # start_urls = [
    #     "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=",
    #     ]


    def start_requests(self):
        self.driver.get(
            "http://www.iwencai.com/stockpick/search?typed=1&preParams=&ts=1&f=1&qs=result_rewrite&selfsectsn=&querytype=stock&searchfilter=&tid=stockpick&w=%E4%BB%8A%E6%97%A5%E6%B6%A8%E5%81%9C%E8%A1%A8&queryarea=")
        # data = self.driver.find_elements_by_css_selector('.sublist .zhihui')[0].get_attribute('src')
        WebDriverWait(self.driver, 8).until(EC.presence_of_element_located((By.CLASS_NAME, "static_tbody_table")))


        flag = self.get_element_number()
        if flag:
            self.get_current_element()

            for index in range(2,flag+1):
                print index
                num_elements = self.get_num_elements()
                self.click_element(num_elements[index-1])
                time.sleep(5)
                self.get_current_element()

            # elements = self.driver.find_elements_by_css_selector('.pagination .num,.pagination .current')
            # print len(elements)
            # elements = self.driver.find_elements_by_css_selector('.pagination .num')
            # print len(elements)

        # try:
        #     #
        #     WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, "current")))
        #     num_elements = self.driver.find_elements_by_css_selector('.pagination > num')
        #     current_element = self.driver.find_elements_by_css_selector('.pagination num, .pagination current')
        #     for index in range(2,len(elements)+1):
        #         print index
        #         # a = element.text
        #         # print a
        #         # print 2222222
        #         # last_height = self.driver.execute_script("return document.body.scrollHeight")
        #         # self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        #         # ActionChains(self.driver).move_to_element(element).click(element).perform()
        #         # time.sleep(7)
        #         # data = self.driver.find_element_by_css_selector('.static_tbody_table').text
        #         # print data

        # finally:
        #     time.sleep(15)
        #     self.driver.quit()


        realurl = 'http://www.itcrm.com'
        yield scrapy.Request(realurl)


    def click_element(self,element):
        last_height = self.driver.execute_script("return document.body.scrollHeight")
        self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
        ActionChains(self.driver).move_to_element(element).click(element).perform()


    def get_current_element(self):
        data = self.driver.find_elements_by_css_selector('.static_tbody_table tbody tr')

        print data
        return data

    def process_data(self,data):
        # for each_data in data:
        #     LimitupItem.code=

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
        print 33


        a = response.body_as_unicode().split('\r\n')
        print a
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
