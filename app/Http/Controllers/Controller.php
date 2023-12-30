<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generateKey($length) {
        // Define possible characters
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Calculate the length of the character string
        $charactersLength = strlen($characters);

        // Initialize the resulting string
        $result = '';

        // Generate the random string
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charactersLength - 1);
            $result .= $characters[$randomIndex];
        }

        return $result;
    }
}
