<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class QuestionsController extends Controller
{
	protected $langs = [
		'en', 'hi'
	];

    public function __construct()
    {
        
    }

    public function getQuestions($lang = 'en')
    {
    	if(!in_array(strtolower($lang), $this->langs)) {
    		return [
    			'error'	=>	'Unknown Language!'
    		];
    	}

    	$lang = strtolower($lang);
    	$contents = Storage::disk('local')->get($lang . '/questions.json');
        return $contents;
    }

    public function getExtraQuestions($lang = 'en')
    {
    	if(!in_array(strtolower($lang), $this->langs)) {
    		return [
    			'error'	=>	'Unknown Language!'
    		];
    	}

    	$lang = strtolower($lang);
    	$contents = Storage::disk('local')->get($lang . '/extra_questions.json');
        return $contents;
    }
    
}
