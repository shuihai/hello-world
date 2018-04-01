# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
from everylimitup import items
import pymysql

class EverylimitupPipeline(object):
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
        if isinstance(item, items.LimitupItem):
            d = dict(item)
            effect_row = self.cursor.executemany("insert into xiaoming_limitup(date,code,stockname,reason,first_time,last_time,consistent_day)values(%s,%s,%s,%s,%s,%s,%s)",
                                                 [(d['date'],d['code'],d['stockname'],d['reason'],d['first_time'],d['last_time'],d['consistent_day'])])
            self.client.commit()

        return item

