<?php

namespace Sixturbo\Support\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sixturbo\Support\Models\FaqCategory;
use Sixturbo\Support\Models\Faq;

class FaqCategoryController extends Controller
{
    public function index(){

    	$faq_categories = FaqCategory::withCount('faqs')->with('faqs')->get();

    	return view('faq::support.faq.index',compact('faq_categories'));

    }

    public function show(Request $request, Faq $faq){

        $current_faq = $faq;

        $faq_category = $current_faq->faq_category;

        $faqs = $faq_category->faqs()->get();

        return view('faq::support.faq.show',compact('current_faq','faq_category','faqs'));

    }

    public function category(Request $request, FaqCategory $faq_category){

        $faqs = $faq_category->faqs()->get();

    	return view('faq::support.faq.category',compact('faq_category','faqs'));

    }



}