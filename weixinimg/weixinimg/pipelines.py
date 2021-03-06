# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
from scrapy.http import Request
from scrapy.exceptions import DropItem
from scrapy.pipelines.images import ImagesPipeline
from weixinimg.items import ImagesItem

class WeixinimgPipeline(object):
    def process_item(self, item, spider):
        return item


class MyImagesPipeline(ImagesPipeline):
    def get_media_requests(self, item, info):
        print 555
        if isinstance(item, ImagesItem):
            for image_url in item['image_urls']:
                yield Request(image_url)

    def item_completed(self, results, item, info):
        image_path = [x['path'] for ok, x in results if ok]
        print image_path
        if not image_path:
            raise DropItem('Item contains no images')
        # item['image_paths'] = image_path
        return item