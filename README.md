[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/comquer/comquer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/comquer/comquer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/comquer/comquer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/build-status/master)

# Comquer 
Comquer aims to be a php application framework that is event sourced, emphasises command and query separation, and is built with your domain code in mind.

Comquer is a side effect of a commercial project from Gigabyte Software. Therefore, development of Comquer is strongly driven by the needs of the commercial part. The app is yet to enter the market and the framework far from complete. In the commercial project we use Symfony Framework for the areas that Comquer does not yet cover. Our ambition is that unlike Symfony, which is an MVC framework, Comquer will leverage an architecture of commands, queries, and events. While building Comquer we do our best making it compatible with your domain code, without polluting domain with the framework.

### State of the project 

This project is in early phases of development, so expect BC breaking all the time.

### Installation
```
composer require comquer/comquer
```
