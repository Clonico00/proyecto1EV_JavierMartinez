<?php
namespace Lib;

class Pages {
    public function render(string $pagename, array $params = null): void {
        if($params != null){
            foreach ($params as $key => $value) {
                $$key = $value;
            }
        }
        require_once "views/layout/header.php";
        require_once "views/$pagename.php";
    }
}