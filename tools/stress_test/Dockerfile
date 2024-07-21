FROM python:3.9

USER root

COPY ./locust/* ./
COPY ./.env ./

RUN pip install -r ./requirements.txt