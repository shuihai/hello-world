# -*- coding: UTF-8 -*-
import scrapy
from scrapy.item import BaseItem
from test2.items import Test2Item
from test2.items import FileItem
from test2.items import MyItem

a = 2

urlset2 = ['http://www.itcrm.com/Home/Info/news/type_id/4/p/2.html',
           'http://www.itcrm.com/Home/Info/news/type_id/4/p/1.html']


class DmozSpider(scrapy.Spider):
    name = "dmoz"
    # allowed_domains = ["dmoztools.net"]
    start_urls = [
        "http://www.itcrm.com/Home/Info/solution.html",
        # "http://www.itcrm.com/Home/Info/news/type_id/4.html",
        # "https://www.baidu.com/",
    ]
    urlset = []

    def parse(self, response):
        a = response.body_as_unicode().split('\r\n')
        print a
        print 4
        # captcha = input("请输入你的验证>")
        # print captcha
        # str = response.css('title::text').extract()
        # print str[0]
        # print str[0].decode( "UTF-8")
        # print unicode(str[0], "UTF-8")
        # url =["http://www.itcrm.com/sitemap.txt"]
        # item = FileItem()
        # # item.file_urls  = url
        # item['file_urls'] = url
        # print 9090
        # from test2 import items
        # print isinstance(item, FileItem)
        # yield item
        #
        # url = ["http://www.itcrm.com/505.gif"]
        # item = MyItem()
        # # item.file_urls  = url
        # item['image_urls'] = url
        # print 9091
        # from test2 import items
        # print isinstance(item, MyItem)
        # yield item


        # self.urlset.extend(response.css('div[class *= page] a::attr(href)').extract())
        # titles = response.css('#demoContent a li::text').extract()
        #
        # items = []
        #
        # for title in titles:
        #     item = Test2Item()
        #     item['name'] = title
        #     yield item
        #
        # for url in self.urlset:
        #     yield scrapy.Request(url=url, callback=self.parse, dont_filter=False)

        # imageurl = response.css('img::attr(src)').extract()
        # item = MyItem()
        # item['image_urls']= imageurl
        # yield item
        # print imageurl
        # a=[[2,4],[5,6],[7,8]]
        # b =[c for c,b in a if b>5]
        # print b
        # with open('C:\wamp\hehe.txt','wb') as f:
        #     f.write('hehe')
        # filename = response.url.split("/")[-2]
        # with open(filename, 'wb') as f:
        #     f.write(response.body)
        # for url in url_pool:
        #     # urls.append(url.extract())
        #     # urls = response.urljoin(url.extract())#urljoin 帮你去重
        #
        #     # urls = url.extract()
        #     urls = response.urljoin(url.extract())  # urljoin
        #     print urls
        #     yield scrapy.Request(url=urls,callback=self.parse, dont_filter=False)


    def parse2(self, response):
        print 90909090909090
        item = Test2Item
        item.name = 'hehehehe'
        yield item
