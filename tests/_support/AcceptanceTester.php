<?php

namespace Behat\Behat\Context {
    interface Context {}
}

namespace {

    use Facebook\WebDriver\WebDriverKeys;
    use Faker\Generator;
    use Faker\Provider\Lorem;
    use PHPUnit\Framework\Exception;
    use Codeception\Actor;
    use Selector\Front\HomePage;

    /**
     * Inherited Methods
     * @method void wantToTest($text)
     * @method void wantTo($text)
     * @method void execute($callable)
     * @method void expectTo($prediction)
     * @method void expect($prediction)
     * @method void amGoingTo($argumentation)
     * @method void am($role)
     * @method void lookForwardTo($achieveValue)
     * @method void comment($description)
     * @method void pause()
     *
     * @SuppressWarnings(PHPMD)
     */
    class AcceptanceTester extends Actor implements \Behat\Behat\Context\Context
    {
        use _generated\AcceptanceTesterActions;

        public $textToSearch;
        /**
         * Define custom actions here
         */
        public function seePageHasElement($element)
        {
            try {
                $this->seeElement($element);
            } catch (Exception $f) {
                return false;
            }
            return true;
        }

        public function seeText($text)
        {
            try {
                $this->see($text);
            } catch (Exception $f) {
                return false;
            }
            return true;
        }

        /**
         * @Given Login to  :arg1 home page
         */
        public function loginToHomePage($arg1)
        {
            $I = $this;
            $I->wantTo('Dobbi want check https://medium.com searching function');
            $I->amOnUrl($arg1);
            $I->see("Home");
        }

        /**
         * @When Accept cookies
         */
        public function acceptCookies()
        {
            $I = $this;
            if ($I->seeText(HomePage::COOKIE_MESSAGE)){
                $I->click(HomePage::COOKIE_MESSAGE_CLOSE);
            }
        }

        /**
         * @Then Open text search field
         */
        public function openTextSearchField()
        {
            $I = $this;
            $I->seeElement(HomePage::SEARCH_BUTTON);
            $I->click(HomePage::SEARCH_BUTTON);
        }

        /**
         * @Then Fill input field with :arg1 text to search
         */
        public function fillInputFieldWithTextToSearch($arg1)
        {
            $faker = new Generator();
            $text = new Lorem($faker);
            $faker->addProvider($text);
            $this->textToSearch = $text->word();

            $I = $this;
            if ($arg1 == 'random') {
                $I->fillField(HomePage::SEARCH_INPUT_FIELD, $this->textToSearch);
            } else {
                $I->fillField(HomePage::SEARCH_INPUT_FIELD, $arg1);
            }
        }

        /**
         * @Then Click on search button
         */
        public function clickOnSearchButton()
        {
            $I = $this;
            $I->pressKey(HomePage::SEARCH_INPUT_FIELD, WebDriverKeys::ENTER);
        }

        /**
         * @Then Check if any results with word given on result page
         * @throws \Exception
         */
        public function checkIfAnyResultsWithWordGivenOnResultPage()
        {
            $I = $this;
            $I->waitForElement(HomePage::SEARCH_RESULT_INPUT_FIELD, 10); // secs
            $I->see($this->textToSearch, HomePage::STORIES_SEARCH_RESULTS_BLOCK);
        }

    }
}