<?php

class customers extends Controller
{
    public function index(): void
    {
        $this->render("layout/header");
        $this->render("customers");
        $this->render("layout/footer");
    }
}