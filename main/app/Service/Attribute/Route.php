<?php

namespace App\Service\Attribute;

/**
 * Summary of Route
 */
class Route {

    /**
     * Summary of url
     * @var 
     */
    public $url;

    /**
     * Summary of method
     * @var 
     */
    public $method;

    /**
     * Summary of __construct
     * @param |\null $url
     * @param |\null $method
     */
    public function __construct(string|null $url = null, string|null $method = null) {
        
        $this->url = $url;
        $this->method = $method;
    }
}
