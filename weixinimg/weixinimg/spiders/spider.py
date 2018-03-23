# -*- coding: UTF-8 -*-
import scrapy
from weixinimg import items
import pymysql
import time
from datetime import datetime, timedelta
from scrapy.utils.project import get_project_settings
import sys
import os
import shutil
from weixinimg.items import ImagesItem
reload(sys)
sys.setdefaultencoding('gbk')


class Weixin(scrapy.Spider):
    name = "weixinimg"

    def __init__(self):
        settings = get_project_settings()
        self.host = settings['HOST']
        self.port = settings['PORT']
        self.user = settings['USER']
        self.pwd = settings['PWD']
        self.db = settings['DB']
        self.table = settings['TABLE']

    # start_urls = [
    #     "http://quotes.money.163.com/service/chddata.html?code=0000001&start=20180301&end=20150303&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER",
    # ]


    def start_requests(self):

        url_set = self.get_url_set()
        for url in url_set:
            realurl =  'http://weixin.sogou.com/weixin?type=1&s_from=input&query='+url['gzh_name']+'&ie=utf8&_sug_=n&_sug_type_='
            yield scrapy.Request(realurl )
            # if (url['type'] == 0):
            #     realurl = self.get_need_update_url(url['type'], url['code'])
            #     if ( not realurl):
            #         print realurl + ' not equal 1'
            #         realurl = 'http://quotes.money.163.com/service/chddata.html?code=' + str(
            #             url['type']) + url['code'] + '&start=' + '19900101' + '&end=' + time.strftime('%Y%m%d',
            #                                                                                           time.localtime(
            #                                                                                               time.time())) + '&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER'
            #         yield scrapy.Request(realurl, callback=lambda response, type=0: self.parse_type(response, type))
            #     elif  not (realurl==1):
            #         yield scrapy.Request(realurl,
            #                              callback=lambda response, type=0: self.parse_type_update(response, type))




    def get_need_update_url(self, type, code):
        file = 'D:\\test\\' + str(type) + str(code) + "back.csv"
        print file

        flag = os.path.isfile(file)

        print flag

        if flag:
            with open(file, 'a+') as f:
                tempdata = f.readline()
                tempdata = tempdata.split(',')
                last_date = tempdata[0]

                if time.strftime('%Y-%m-%d', time.localtime(time.time() - 3600 * 24)) != last_date:
                    print last_date
                    print time.strftime('%Y-%m-%d', time.localtime(time.time() - 3600 * 24))
                    last_date = last_date.split('-')

                    start_time = (
                    datetime(int(last_date[0]), int(last_date[1]), int(last_date[2])) + timedelta(days=1)).strftime(
                        "%Y%m%d")
                    end_time = time.strftime('%Y%m%d', time.localtime(time.time()))
                    return 'http://quotes.money.163.com/service/chddata.html?code=' + str(
                        type) + code + '&start=' + start_time + '&end=' + end_time + '&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER'
                else:
                    return 1  #绛変簬1 璇存槑娌℃湁鏂囦欢
        else:  #  璇存槑娌℃湁鏂囦欢
            print code
            return False
            # realurl= 'http://quotes.money.163.com/service/chddata.html?code='+str(type)+code+'&start='+'19900101'+'&end='+time.strftime('%Y%m%d', time.localtime(time.time()))+'&fields=TCLOSE;HIGH;LOW;TOPEN;LCLOSE;CHG;PCHG;VOTURNOVER;VATURNOVER'
            # yield scrapy.Request(realurl, callback=lambda response, type=0: self.parse_type(response, type))

    def get_url_set(self):
        client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,
                                 charset='utf8')
        cursor = client.cursor(cursor=pymysql.cursors.DictCursor)
        cursor.execute("select * from " + self.table + " ")
        url_set = cursor.fetchall()
        return url_set



    def parse(self, response):
        name_codes = response.css('.news-list2 li')
        first_node = name_codes[0].css('li .gzh-box2 .img-box a img::attr(src)').extract()
        item = ImagesItem()
        item['image_urls'] = first_node
        yield item
        # yield scrapy.Request(first_node, callback= self.parse_detail )

    def parse_detail(self, response):
        item = ImagesItem()
