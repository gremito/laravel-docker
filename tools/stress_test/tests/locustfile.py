from dotenv import load_dotenv
from locust import HttpUser, task, between, TaskSet
import logging
import os

load_dotenv()

class UserBehavior(TaskSet):
    @task
    def test_index(self):
        headers = {"Content-Type": "application/x-www-form-urlencoded"}
        with self.client.get("/api/sample/octane_tables", headers=headers, catch_response=True) as response:
            self.count = response.json()['count']
            if self.count > 0:
                response.success()
            else:
                response.failure()

class WebApiUser(HttpUser):
    tasks = [UserBehavior]
    wait_time = between(1, 2)