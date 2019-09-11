# Autotets for www.medium.com testing

Simple project for testing www.medium.com website
Scripts are using several extension libraries, such as "fzaninotto" Faker library, to generate some random data.

For Javascript testing was used "Codeception" library, with acceptance suite 
See table for more details: (https://codeception.com/docs/01-Introduction)

# Table of Contents

- [Installation](#installation)
- [Basic Usage](#basic-usage)
	- [Client data generator](#client-data-generator)
- [Gherkin BDD commands](#gherkin-commands)	
    - [Basic Gherkin commands](#basic-gherkin-commands)

## Installation

```sh
- git clone https://github.com/NailKarimov/medium-testing.git
- cd medium-testing
- composer install
- ./vendor/bin/codecept bootstrap
- ./vendor/bin/codecept build
```

If you will use Selenium, you need to download it and run (for Mac can use "https://brew.sh/index_ru""):

```sh
- /usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
- brew install selenium-server-standalone
- selenium-server -port 4444
```

## Basic Usage

### `Home page text search`

Search on website results for random text searching 

To check, run script:
```sh 
./vendor/bin/codecept run acceptance tests/acceptance/FrontPageTests/HomePageTextSearchCest.php --steps --html --xml
```
Output result:
 
    Acceptance Tests (1) --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ⏺ Recording ⏺ step-by-step screenshots will be saved to /Users/Nail/PhpstormProjects/medium-testing/tests/_output/
    Directory Format: record_5d78f36859f0d_{filename}_{testname} ----
    HomePageTextSearchCest: Dobbi want check' . $example['url'] . 'preprod links form dashboard | "https://medium.com","medium.com"
    Signature: Tests\Acceptance\FrontPageTests\HomePageTextSearchCest:errorFindOnErp
    Test: tests/acceptance/FrontPageTests/HomePageTextSearchCest.php:errorFindOnErp
    Scenario --
        I am on url "https://medium.com"
        I see "Home"
        I see text "To make Medium work, we log user data. By using Medium, you agree to our"
        I see "To make Medium work, we log user data. By using Medium, you agree to our"
        I click ".//button[@data-action = 'butter-bar-action']"
        I click ".//label[@title = 'Search Medium']"
        I fill field ".//input[@placeholder = 'Search Medium']","doloribus"
        I press key ".//input[@placeholder = 'Search Medium']",""
    PASSED 
     

## Gherkin BDD commands

Read article: "https://habr.com/ru/post/427031/" for more detailes

To see that there are steps in the test, we run our script in the terminal:
```
./vendor/bin/codecept dry-run acceptance tests/acceptance/SearchInHomePage.feature
```
Then we run a command that will automatically generate templates for implementing our methods:

```
./vendor/bin/codecept gherkin:snippets acceptance
```
Let's see what happened. We launch a team that will show us which methods (step) we now have an implementation.
       
```
./vendor/bin/codecept gherkin:steps acceptance
```
Output result:

    admins-MacBook-Pro-6:medium-testing1 Nail$ vendor/bin/codecept gherkin:steps acceptance

    ==== Redirecting to Composer-installed version in vendor/codeception. You can skip this using --no-redirect ====
    Steps from default context:
    +-----------------------------------------------------+--------------------------------------------------------------+
    | Step                                                | Implementation                                               |
    +-----------------------------------------------------+--------------------------------------------------------------+
    | Login to  :arg1 home page                           | AcceptanceTester::loginToHomePage                            |
    | Accept cookies                                      | AcceptanceTester::acceptCookies                              |
    | Open text search field                              | AcceptanceTester::openTextSearchField                        |
    | Fill input field with :arg1 text to search          | AcceptanceTester::fillInputFieldWithTextToSearch             |
    | Click on search button                              | AcceptanceTester::clickOnSearchButton                        |
    | Check if any results with word given on result page | AcceptanceTester::checkIfAnyResultsWithWordGivenOnResultPage |
    +-----------------------------------------------------+--------------------------------------------------------------+
   
### `Try to run scenario via gherkin`
We have simple scenario:

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
        
Let us try to run this scenario: 
### `Search text`

```sh 
./vendor/bin/codecept run tests/acceptance/SearchInHomePage.feature --steps --html --xml
```

    Acceptance Tests (1) --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     ⏺ Recording ⏺ step-by-step screenshots will be saved to /Users/Nail/PhpstormProjects/medium-testing/tests/_output/
    Directory Format: record_5d7958f6bebaf_{filename}_{testname} ----
    SearchInHomePage: try SearchInHomePage
    Signature: SearchInHomePage:try SearchInHomePage
    Test: tests/acceptance/SearchInHomePage.feature:try SearchInHomePage
    Scenario --
        In order to search any information on medium.com
        As a simple user
        I need to open website
      Given login to  "https://medium.com" home page 
            I am on url "https://medium.com"
            I see "Home"
      When accept cookies 
            I see "To make Medium work, we log user data. By using Medium, you agree to our"
            I click ".//button[@data-action = 'butter-bar-action']"
      Then open text search field 
            I see element ".//label[@title = 'Search Medium']"
            I click ".//label[@title = 'Search Medium']"
      And fill input field with "random" text to search 
            I fill field ".//input[@placeholder = 'Search Medium']","nam"
      And click on search button 
            I press key ".//input[@placeholder = 'Search Medium']",""
      Then check if any results with word given on result page 
            I wait for element ".//span[@class = 'heading-title']",10
            I see "nam",".//div[@class = 'u-paddingTop20 u-paddingBottom25 u-borderBottomLight js-block']"
      PASSED 

     -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     ⏺ Records saved into: file:///Users/Nail/PhpstormProjects/medium-testing/tests/_output/records.html

    Time: 10.93 seconds, Memory: 16.00 MB   

    OK (1 test, 4 assertions)
    admins-MacBook-Pro-6:medium-testing1 Nail$ 