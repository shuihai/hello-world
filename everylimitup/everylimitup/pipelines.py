# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
from everylimitup import items

class EverylimitupPipeline(object):
    def process_item(self, item, spider):
        if isinstance(item, items.LimitupItem):
            d = dict(item)
            effect_row = self.cursor.executemany("insert into zh_test(name)values(%s,%s,%s,%s,%s,%s)",
                                                 [(d['name'])])
            self.client.commit()

        return item
