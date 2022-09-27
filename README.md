# Microservice Template
## Feature
* Swagger API Catalogue
* Docker Container Ready
* Cluster Ready
* Gitlab CI/CD
* CORS
* Rate Limiter
* Swoole Integration
* RabbitMQ Integration
* Self Health Check

## Requirment
* PHP >= 7.3 | PHP >= 8.0
* Composer
* PHP extension
* Docker

## Installation
* Create .env file from .env.example, configure env variable
*  ``` composer install ```
* ``` docker build . -t microservice-template ```
* ``` docker run -d --name microservice-template -p 8000:80 microservice-template ```
