FROM nginx:alpine-slim

ENV TZ Asia/Tokyo

COPY ./nginx.conf /etc/nginx/nginx.conf

CMD ["nginx", "-g", "daemon off;"]
