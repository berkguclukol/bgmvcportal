<?php

class SessionManager
{
    static function createSession($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    static function deleteSession($key): void
    {
        unset($_SESSION[$key]);
    }

    static function allSessionDelete(): void
    {
        session_destroy();
    }

    static function getSession($key): string
    {
        return $_SESSION[$key];
    }


    static function isLogged(): bool
    {
        if (isset($_SESSION[AUTH_KEY])) {
            return true;
        } else {
            return false;
        }
    }
}