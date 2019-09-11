<?php

namespace Selector\Front;

/**
 * Class HomePage
 * @package Selector\Front
 */
class HomePage
{
    const PAGE_LOGO = './/*[@id = \'logo_svg__logo-lumify_xA0_Image\']';
    const SEARCH_BUTTON = './/label[@title = \'Search Medium\']';
    const SEARCH_INPUT_FIELD = './/input[@placeholder = \'Search Medium\']';
    const COOKIE_MESSAGE = 'To make Medium work, we log user data. By using Medium, you agree to our';
    const COOKIE_MESSAGE_CLOSE = './/button[@data-action = \'butter-bar-action\']';

    const SEARCH_RESULT_INPUT_FIELD = './/span[@class = \'heading-title\']';
    const STORIES_SEARCH_RESULTS_BLOCK = './/div[@class = \'u-paddingTop20 u-paddingBottom25 u-borderBottomLight js-block\']';
}