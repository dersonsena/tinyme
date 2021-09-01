Feature: Create an URL
  Scenario: Create a random URL
    Given a long URL
    And a valid URL
    And a URL's type is random
    When the user clicks on the button
    Then it should generate an unique URL with random path

  Scenario: Create a custom URL
    Given a long URL
    And a valid URL
    And a URL's type is random
    And a custom text to URL
    When the user clicks the button
    Then it should generate an unique URL the custom text in path

  Scenario: Create an existing custom URL
    Given a long URL
    And a valid URL
    And a URL's type is random
    And a custom a existing URL text
    When the user clicks the button
    Then it shouldn't create the URL
    And return a message saying "Custom URL already exists"

  Scenario: Create an URL with domain/prefix tinyme.cc
    Given a valid URL
    And a domain/prefix "tinyme.cc"
    When the user clicks the button
    Then it shouldn't create the URL
    And return a message saying "You cannot create a URL with domain tinyme.cc"

  Scenario: Create an URL with invalid URL
    Given an invalid URL
    When the user clicks the button
    Then it shouldn't create the URL
    And return a message saying "Invalid URL"

  Scenario: Create an URL with a invalid URL type
    Given a valid URL
    And a invalid URL type
    When the user clicks the button
    Then it shouldn't create the URL
    And return a message saying "Invalid URL Type"