<?php
class pages extends Controller
{
    public function index(): void
    {
        $this->render("layout/header");
        $this->render("demo");
        $this->render("layout/footer");
    }

    public function about(): void
    {
        $this->render("layout/header");
        $this->render("about");
        $this->render("layout/footer");
    }
}