<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'vi'])) {
            dd(1);
            session(['locale' => $locale]);
        }
        dd(2);
        return redirect()->back();
    }
}
