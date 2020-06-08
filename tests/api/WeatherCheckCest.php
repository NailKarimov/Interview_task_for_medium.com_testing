<?php

class WeatherCheckCest
{
    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('http://api.openweathermap.org/data/2.5/weather?q=Riga&appid=92f56a137e71efef86a9bc9861c22304');
        $I->seeResponseIsJson();
        $I->seeResponseContains('Rīga');
        $I->seeResponseContainsJson([
            "timezone"=> "10800",
            "id" => "456173",
            "name" =>"Rīga",
            "cod" => "200"
        ]);
    }
}
