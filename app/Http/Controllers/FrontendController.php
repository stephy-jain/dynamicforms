<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function show($slug)
    {
        $form = Form::with('fields')->where('slug', $slug)->first();
        $forms = Form::all();
        return view('forms', compact('form','forms'));
    }

    public function index()
    {
        $forms = Form::all();
        if ($forms) {
            return view('index', compact('forms'));
        } else {
            return view('index');
        }

    }

}
