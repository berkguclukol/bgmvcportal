<?php
class Helper
{
    static function redirect($url): void
    {
        if ($url) {
            if (!headers_sent()) {
                header("Location:" . $url);
            } else {
                echo '<script>location.href="' . $url . '";</script>';
            }
        }
    }

    static function cleaner($text): string
    {
        $array = array('insert', 'update', 'union', 'select', '*');
        $text = str_replace($array, '', $text);
        $text = strip_tags($text);
        return trim($text);
    }

    static function is_flash_data(): bool
    {
        return isset($_SESSION['flashdata']);
    }

    static function show_flash_data(): void
    {
        echo $_SESSION["flashdata"];
        unset($_SESSION["flashdata"]);
    }

    static function set_flash_data($value): void
    {
        $_SESSION["flashdata"] = $value;
    }
}