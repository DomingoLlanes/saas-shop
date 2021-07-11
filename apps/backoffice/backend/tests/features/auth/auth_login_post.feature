Feature: User login
  In order to allow users use the application
  I want to allow to

  Scenario: User login
    Given I send a POST request to "/auth/register" with body:
    """
    {
      "username": "user_test",
      "password": "test"
    }
    """
    When I send a POST request to "/auth/login" with body:
    """
    {
      "username": "user_test",
      "password": "test"
    }
    """
    Then the response status code should be 200
    And the response should contains a JWT token

  Scenario: User cannot login because user doesn't exists
    Given I send a POST request to "/auth/login" with body:
    """
    {
      "username": "user_not_exists",
      "password": "test"
    }
    """
    Then the response status code should be 401

  Scenario: User cannot login because password mismatch
    Given I send a POST request to "/auth/register" with body:
    """
    {
      "username": "user_test",
      "password": "test"
    }
    """
    When I send a POST request to "/auth/login" with body:
    """
    {
      "username": "user_test",
      "password": "testing"
    }
    """
    Then the response status code should be 401
