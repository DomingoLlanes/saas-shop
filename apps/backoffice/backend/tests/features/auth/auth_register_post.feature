Feature: User register
  In order to allow users to login into application
  I want to register an user

  Scenario: User register
    Given I send a POST request to "/auth/register" with body:
    """
    {
      "username": "user_test",
      "password": "test"
    }
    """
    Then the response status code should be 201
    And the response should contains an uuid

  Scenario: User cannot be registered because username already used
    Given I send a POST request to "/auth/register" with body:
    """
    {
      "username": "user_duplicated",
      "password": "test"
    }
    """
    When I send a POST request to "/auth/register" with body:
    """
    {
      "username": "user_duplicated",
      "password": "anotherPassword"
    }
    """
    Then the response status code should be 422
