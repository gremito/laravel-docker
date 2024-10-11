from dotenv import load_dotenv
from locust import HttpUser, task, between, TaskSet
import logging
import os

load_dotenv()

class UserBehavior(TaskSet):
    def apcCacheApi(self):
        with self.client.get("/api/sample", headers={}, catch_response=True) as response:
            if response.status_code != 200:
                response.failure()
                return
            self.count = response.json()['number']
            if self.count > 0:
                response.success()
            else:
                response.failure()

    def octaneCacheApi(self):
        with self.client.get("/api/sample/octane_cache", headers={}, catch_response=True) as response:
            if response.status_code != 200:
                response.failure()
                return
            self.count = response.json()['number']
            if self.count > 0:
                response.success()
            else:
                response.failure()

    def octaneTablesApi(self):
        with self.client.get("/api/sample/octane_tables", headers={}, catch_response=True) as response:
            if response.status_code != 200:
                response.failure()
                return
            self.count = response.json()['count']
            if self.count > 0:
                response.success()
            else:
                response.failure()

    @task
    def test_index(self):
        self.apcCacheApi()
        self.octaneCacheApi()
        # self.octaneTablesApi()

class WebApiUser(HttpUser):
    tasks = [UserBehavior]
    wait_time = between(1, 2)