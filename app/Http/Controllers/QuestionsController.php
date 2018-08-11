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

    public function getAllQuestions($lang)
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

    public function getQuestions($lang, $index)
    {
    	if(!in_array(strtolower($lang), $this->langs)) {
    		return [
    			'error'	=>	'Unknown Language!'
    		];
    	}

    	$lang = strtolower($lang);
    	$contents = Storage::disk('local')->get($lang . '/questions.json');
        $contents = json_decode($contents, true);
        $questions = isset($contents['questions']) ? $contents['questions'] : [];

        $totalQuestions = (count($questions) - 1);

        $indexes = explode(":", $index);
        $start = 0;
        $end = 0;

        if(count($indexes) == 2) {
        	$start = (int)$indexes[0];
        	if(!$start) {
        		$start = 0;
        	}
        	$end = (int)$indexes[1];
        	if(!$end) {
        		$end = 0;
        	}
        } else if(count($indexes) == 1) {
        	$start = (int)$indexes[0];
        	if(!$start) {
        		$start = 0;
        	}
        	$end = (int)$indexes[0];
			if(!$end) {
        		$end = 0;
        	}
        }

        if($start < 0) {
        	$start = 0;
        } else if($start > $totalQuestions) {
        	$start = $totalQuestions;
        }

        if($end < 0) {
        	$end = 0;
        } else if($end > $totalQuestions) {
        	$end = $totalQuestions;
        }

        $data = [];
        for($i=$start; $i<=$end; $i++) {
        	$data[] = $questions[$i];
        }

        return $data;
    }
    
}
