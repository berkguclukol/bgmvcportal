<?php

class Encryption
{

    static function encrypt($plaintext): string
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, PRIVATE_KEY, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, PRIVATE_KEY, $as_binary = true);
        return base64_encode($iv . $hmac . $ciphertext_raw);
    }

    static function decrypt($ciphertext): false|string|null
    {
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $plaintext = openssl_decrypt($ciphertext_raw, $cipher, PRIVATE_KEY, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, PRIVATE_KEY, $as_binary = true);
        if (!hash_equals($hmac, $calcmac)) {
            return null;
        }
        return $plaintext;
    }
}
