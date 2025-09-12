<?php
class controller
{
    public function __construct() {
     }
    public function render($file,$data = []): null
    {
        return view::render($file,$data);
    }
}