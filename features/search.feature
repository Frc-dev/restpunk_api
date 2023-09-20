Feature:
    In order to prove that the RestPunk Api works
    As a user
    I want to run integration tests on my endpoints
    I expect certain responses and status codes

    Scenario:
        Given the query parameter "food" is "meat"
        When I request "/search" using HTTP GET
        Then the response code is 200
        And the response body is a JSON array with a length of at least 1

    Scenario:
        Given the query parameter "food" is "dddd"
        When I request "/search" using HTTP GET
        Then the response code is 200
        And the response body is an empty JSON array

    Scenario:
        Given the query parameter "food" is null
        When I request "/search" using HTTP GET
        Then the response code is 200
        And the response body is an empty JSON array

    Scenario:
        Given the query parameter "food" is "<?php echo>"
        When I request "/search" using HTTP GET
        Then the response code is 500

    Scenario:
        When I request "/id/129" using HTTP GET
        Then the response code is 200
        And the response body is a JSON array of length 1

    Scenario:
        When I request "/id/notanumber" using HTTP GET
        Then the response code is 500

    Scenario:
        When I request "/id/<?php echo>" using HTTP GET
        Then the response code is 500

    Scenario:
        When I request "/id/0" using HTTP GET
        Then the response code is 500

    Scenario:
        When I request "/id/99999999999999" using HTTP GET
        Then the response code is 500