from dotenv import load_dotenv
from locust import HttpUser, task, between, TaskSet
import os

load_dotenv()

class UserBehavior(TaskSet):
    @task
    def test_index(self):
        with self.client.get("/sample", headers=headers, catch_response=True) as response:
            self.result = response.json()['result']
            if self.result
                response.success()
            else:
                response.failure()

class WebApiUser(HttpUser):
    tasks = [UserBehavior]
    wait_time = between(1, 2)