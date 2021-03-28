Test FDJ
============

An app create to respond to fdj's test. The purpose is to get the last draw from their api

## Installation

Installation of the project with github

Install project :
``git clone git@github.com:guillaumeprost/fdj_test.git``

## Launch Symfony server

To use the project you need to launch the symfony server 

At root of the project : 
`` symfony server:start ``

It will launch the server

## Test project 

Once the server is running you just need to go to : ``https://127.0.0.1:8000 ``

You will see the last draw 

## Unit test 

To launch the tests you can use : ``symfony php bin/phpunit tests/``