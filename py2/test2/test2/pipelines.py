# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html

import pymysql
from test2 import items
from scrapy.pipelines.images import ImagesPipeline
from scrapy.pipelines.files import FilesPipeline
from scrapy.exceptions import DropItem
from scrapy.http import Request
from twisted.enterprise import adbapi
import MySQLdb.cursors

import json
import codecs

from test2.items import FileItem


class MyFilesPipeline(FilesPipeline):
    def file_path(self, request, response=None, info=None):
        image_guid = request.url.split('/')[-1]
        return 'full/%s' % (image_guid)


    def get_media_requests(self, item, info):
        print 999
        print item
        print isinstance(item, FileItem)
        if isinstance(item,FileItem):
            print item['file_urls']
            for file_url in item['file_urls']:
                print file_url
                print 8888
            yield Request(file_url)

    def item_completed(self, results, item, info):
        file_paths = [x['path'] for ok, x in results if ok]
        if not file_paths:
            raise DropItem("Item contains no files")
        # item['file_paths'] = file_paths
        return item


# 以Json的形式存储
class JsonWithEncodingCnblogsPipeline(object):
    def __init__(self):
        self.file = codecs.open('douban.json', 'w', encoding='utf-8')

    def process_item(self, item, spider):
        if isinstance(item, items.Test2Item):
            line = json.dumps(dict(item), ensure_ascii=False) + "\n"
            self.file.write(line)
        return item

    def spider_closed(self, spider):
        self.file.close()


class MyImagesPipeline(ImagesPipeline):
    def get_media_requests(self, item, info):
        print 555
        if isinstance(item,MyImagesPipeline):
            for image_url in item['image_urls']:
                yield Request(image_url)

    def item_completed(self, results, item, info):
        image_path = [x['path'] for ok, x in results if ok]
        if not image_path:
            raise DropItem('Item contains no images')
        # item['image_paths'] = image_path
        return item


class Test2Pipeline(object):
    def __init__(self, host, port, user, pwd, db, table):
        self.host = host
        self.port = port
        self.user = user
        self.pwd = pwd
        self.db = db
        self.table = table

    @classmethod
    def from_crawler(cls, crawler):
        """
        Scrapy会先通过getattr判断我们是否自定义了from_crawler,有则调它来完
        成实例化
        """
        HOST = crawler.settings.get('HOST')
        PORT = crawler.settings.get('PORT')
        USER = crawler.settings.get('USER')
        PWD = crawler.settings.get('PWD')
        DB = crawler.settings.get('DB')
        TABLE = crawler.settings.get('TABLE')
        return cls(HOST, PORT, USER, PWD, DB, TABLE)

    def open_spider(self, spider):
        """
        爬虫刚启动时执行一次
        """
        self.client = pymysql.connect(host=self.host, port=self.port, user=self.user, password=self.pwd, db=self.db,
                                      charset='utf8')
        self.cursor = self.client.cursor()

    def close_spider(self, spider):
        """
        爬虫关闭时执行一次
        """
        self.client.close()

    def process_item(self, item, spider):
        print 33333
        if isinstance(item, items.Test2Item):
            d = dict(item)
            effect_row = self.cursor.executemany("insert into zh_test(name)values(%s)",
                                                 [(d['name'])])
            self.client.commit()



        return item


# class MysqlPipeline(object):
#     def __init__(self, dbpoll):
#         self.dbpoll = dbpoll
#         self.file = open('mysql_error.json', 'w')
#
#     @classmethod
#     def from_crawler(cls, crawler):
#         """
#         Scrapy会先通过getattr判断我们是否自定义了from_crawler,有则调它来完
#         成实例化
#         """
#         # HOST = crawler.settings.get('HOST')
#         # PORT = crawler.settings.get('PORT')
#         # USER = crawler.settings.get('USER')
#         # PWD = crawler.settings.get('PWD')
#         # DB = crawler.settings.get('DB')
#         # TABLE = crawler.settings.get('TABLE')
#         dbparams = dict(host=crawler.settings['HOST'],
#                         db=crawler.settings['DB'],
#                         port=crawler.settings['PORT'],
#                         user=crawler.settings['USER'],
#                         passwd=crawler.settings['PWD'],
#                         charset='utf8',
#                         use_unicode=True,
#                         cursorclass=MySQLdb.cursors.DictCursor
#                         )
#         # 第一个参数,操作的数据库,利用反射原理,第二个参数MySQL初始化的一些参数,格式固定
#         dbpoll = adbapi.ConnectionPool('MySQLdb', **dbparams)
#         # 返货一个MysqlTwistedPipeline的实例对象
#         return cls(dbpoll)
#
#
#
#     def process_item(self, item, spider):
#         print 7777
#         insert_sql = """
#                           insert into zh_test(name)VALUES (%s)
#                       """
#         if isinstance(item, items.Test2Item):
#             query = self.dbpoll.runInteraction(self.do_insert, item)
#             query.addErrback(self.handle_error, item, spider)
#         return item
#
#     def do_insert(self, cursor, item):
#         #执行MySQL语句
#         insert_sql = """
#                   insert into zh_test(name)VALUES (%s)
#               """
#         d=dict(item)
#         cursor.execute(insert_sql, (d.name))
#
#     def close_spider(self, spider):
#         self.file.close()
#         print '完成mysql_error写入'