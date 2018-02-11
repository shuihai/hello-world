from scrapy.dupefilter import RFPDupeFilter
import scrapy.contrib.pipeline.images.ImagesPipeline
import scrapy.core.scheduler.py

class UrlFilter(object):
    def __init__(self):
        print 11110000
        self.visited = set() # s

    @classmethod
    def from_settings(cls, settings):
        return cls()

    def request_seen(self, request):

        print 9999
        if request.url in self.visited:
            return True
        self.visited.add(request.url)

    def open(self):  # can return deferred
        pass

    def close(self, reason):  # can return a deferred
        pass

    def log(self, request, spider):  # log that a request has been filtered
        pass