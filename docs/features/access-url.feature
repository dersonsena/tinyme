Feature: Access an URL
  Scenario: Access a valid URL
    Given a valid URL
    When the user access
    Then it should increment the url counter
    And redirect user to original URL

  Scenario: Access an invalid URL
    Given a invalid URL
    When the user access
    Then return a message saying "URL Not found"