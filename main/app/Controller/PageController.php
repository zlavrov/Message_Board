<?php

namespace App\Controller;

use App\Service\Attribute\Route;
use App\Service\Page\PageService;

class PageController {

    #[Route(url: '/')]
    public function getHome() {

        (new PageService())->getPage('home', ["title" => " | Home"]);
        // page home
    }
}
