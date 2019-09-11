Feature: SearchInHomePage
  In order to search any information on medium.com
  As a simple user
  I need to open website

  Scenario: try SearchInHomePage
    Given Login to  "https://medium.com" home page
    When Accept cookies
    Then Open text search field
    And  Fill input field with "random" text to search
    And  Click on search button
    Then Check if any results with word given on result page
