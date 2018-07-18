<?php

namespace Sixturbo\Support\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sixturbo\Support\Models\FaqCategory;
use Sixturbo\Support\Models\Faq;

class FaqController extends Controller
{
    public function index(Request $request, FaqCategory $faq_category){

        $faqs = $faq_category->faqs()->get();

    	return view('faq::support.faq.admin.index',compact('faqs','faq_category'));

    }

    public function create(Request $request, FaqCategory $faq_category){

        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = new Faq();

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq_category->faqs()->save($faq);

        return redirect()->route('faq.admin.index',compact('faq_category'));

    }

    public function update(Request $request, FaqCategory $faq_category, Faq $faq){

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faq.admin.index',['faq_category' => $faq_category]);

    }

    public function edit(Request $request, FaqCategory $faq_category, Faq $faq){

        return view('faq::support.faq.admin.edit', compact('faq','faq_category'));

    }

    public function delete(Request $request, FaqCategory $faq_category, Faq $faq){

        $faq->delete();
        
        return redirect()->route('faq.admin.index',compact('faq_category'));

    }

}