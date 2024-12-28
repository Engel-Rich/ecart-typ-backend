<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // clear all session data
        // add in session locale

        session()->put('local', $locale);

        return redirect()->back();
    }
}
