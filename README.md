# restpunk_api

![example workflow](https://github.com/github/docs/actions/workflows/main.yml/badge.svg)
Simple Symfony app using the Punk API for a technical interview

<h2>Instructions (Makefile)</h2>


make install

make run

app is served in localhost:8000

<h2>Tests</h2>

run unit tests with make tests-unit

run api tests with make tests-api

run all tests with make tests-all


<h2>Endpoints</h2>


/search?[key value] -> filter by fields like food and return a list of matching beers

/id/[id] -> filter by id and return matching beer
