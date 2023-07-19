<?php

namespace App\Service\Page;

class PageService {

    public function getPart($parts, $data = []) {

        foreach($parts as $part) {
            require_once "app/View/Component/part/" . $part . ".php";
        }
    }

    public function getPage($page, $data = []) {

        require_once "app/View/Page/" . $page . ".php";
    }
}
