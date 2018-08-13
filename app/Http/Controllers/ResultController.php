<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ResultController extends Controller
{
	protected $langs = [
		'en', 'hi'
	];

    public function __construct()
    {
        
    }

    public function getResult()
    {
    	$contents = Storage::disk('local')->get('results.json');
        return [
            'results'   =>  json_decode($contents, true)
        ];
    }
    
}
