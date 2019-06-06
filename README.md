[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/comquer/comquer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/comquer/comquer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/comquer/comquer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/comquer/comquer/build-status/master)

# Comquer 
Comquer is a php framework that is event sourced, emphasises command and query separation, and is built with your domain code in mind.

## Domain Integration
While writing your domain code, use the abstractions from `comquer/domain-integration` package to model things like commands, queries, events, handlers, projections, etc. Doing so will make your domain plug-and-playable with the framework.

## About the Project
Comquer is a side effect of a commercial project from [Gigabyte Software](https://gigabyte.software). Therefore, development of Comquer is strongly driven by the needs of that project. The app is yet to enter the market and the framework far from complete. In the commercial project we use Symfony Framework to support the areas that Comquer does not yet cover. Our ambition is that unlike Symfony, which is an MVC framework, Comquer would leverage an architecture of commands, queries, and events. We try to build Comquer in a way that it's compatible with the doimain without the need of making the domain depend on the framework.

## State of the Project
This project is in early phases of development (dev-master). If you wanted to use it for building an app, you would have to use some third party software to provide support for the missing gaps, as Comquer is not yet complete.

## Installation
```
composer require comquer/comquer
```
