<?php

namespace Sixturbo\Support\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sixturbo\Support\Models\FaqCategory;
use Sixturbo\Support\Models\Faq;

class FaqCategoryController extends Controller
{
    public function index(){

    	$faq_categories = FaqCategory::all();

    	return view('faq::support.faq.admin.categories',compact('faq_categories'));

    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|unique:faq_categories|max:255',
        ]);

        $faq_category = new FaqCategory();

        $faq_category->title = $request->title;
        $faq_category->value = strtolower(str_replace(' ', '_', $request->title));
        $faq_category->is_show = $request->is_show == 'on' ? 1 : 0;
        $faq_category->save();

        return redirect()->route('faq.category.admin.index');

    }

    public function update(Request $request, FaqCategory $faq_category){

        $request->validate([
            'edit_title' => 'required|max:255|unique:faq_categories,title,'.$faq_category->id,
        ]);

        $faq_category->title = $request->edit_title;
        $faq_category->value = strtolower(str_replace(' ', '_', $request->edit_title));
        $faq_category->is_show = $request->is_show == 'on' ? 1 : 0;
        $faq_category->save();

        return redirect()->route('faq.category.admin.index');

    }

    public function delete(Request $request, FaqCategory $faq_category){

        $faq_category->delete();
        
        return redirect()->route('faq.category.admin.index');

    }

}