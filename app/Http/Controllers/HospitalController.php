<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HospitalController extends Controller
{
    public function __construct()
    {
        
    }

    public function getHospitals($lang = 'en')
    {
        $contents = Storage::disk('local')->get($lang . '/centers_data.json');
        return $contents;
    }

}
