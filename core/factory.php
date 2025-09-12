<?php

class Factory
{
    public function __construct()
    {
    }

    static function createLink($controller, $view = "index"): string
    {
        if ($view == "index") :
            return SITE_URL . $controller;
        else :
            return SITE_URL . $controller . "/" . $view;
        endif;
    }

    static function getPageTitle(): string
    {
        $base = str_replace("act=", "", explode("&", $_SERVER['QUERY_STRING'])[0]);
        $titles = [
            "" => "Ana Sayfa",
            "pages" => "Naber",
            "pages/about" => "Naber",
        ];
        return $titles[$base] . " • " . SITE_TITLE;
    }

    static function getShortDayName($day, $month, $year): string
    {
        $kg = array(
            "Mon" => "Pzt",
            "Tue" => "Sal",
            "Wed" => "Çar",
            "Thu" => "Per",
            "Fri" => "Cum",
            "Sat" => "Cmt",
            "Sun" => "Paz"
        );
        $date = date_create($year . "-" . $month . "-" . $day);
        return $kg[date_format($date, "D")];
    }

    static function getMonthName(): string
    {
        $aylar = array(
            "January" => "Ocak",
            "February" => "Şubat",
            "March" => "Mart",
            "April" => "Nisan",
            "May" => "Mayıs",
            "June" => "Haziran",
            "July" => "Temmuz",
            "August" => "Ağustos",
            "September" => "Eylül",
            "October" => "Ekim",
            "November" => "Kasım",
            "December" => "Aralık"
        );
        return $aylar[date("F")];
    }
}