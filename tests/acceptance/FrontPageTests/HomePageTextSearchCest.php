<?php

namespace Tests\Acceptance\FrontPageTests;

use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;
use Faker\Generator;
use Faker\Provider\Lorem;
use Selector\Front\HomePage;

/**
 * Class HomePageTextSearchCest
 * @package Tests\Acceptance\FrontPageTests
 */
class HomePageTextSearchCest
{

    /**
     * @return array
     */
    protected function pageProvider()
    {
        return [
            ['url' => "https://medium.com", 'title' => "medium.com"],
        ];
    }

    /**
     * @dataProvider pageProvider
     * @param Example $example
     * @param \AcceptanceTester $I
     * @throws \Exception
     */
    public function searchText(\AcceptanceTester $I, Example $example)
    {
        $faker = new Generator();
        $text = new Lorem($faker);
        $faker->addProvider($text);
        $textToSearch = $text->word();

        $I->wantTo('Dobbi want check https://medium.com searching function');
        $I->amOnUrl($example['url']);
        $I->see("Home");

        if ($I->seeText(HomePage::COOKIE_MESSAGE)){
            $I->click(HomePage::COOKIE_MESSAGE_CLOSE);
        }

        $I->seeElement(HomePage::SEARCH_BUTTON);
        $I->click(HomePage::SEARCH_BUTTON);
        $I->fillField(HomePage::SEARCH_INPUT_FIELD, $textToSearch);
        $I->pressKey(HomePage::SEARCH_INPUT_FIELD, WebDriverKeys::ENTER);

        $I->waitForElement(HomePage::SEARCH_RESULT_INPUT_FIELD, 10); // secs
        $I->see($textToSearch, HomePage::STORIES_SEARCH_RESULTS_BLOCK);

        $I->lookForwardTo('Owner gave Dobbi the positive result, now Dobbi is free )))');
    }
}

