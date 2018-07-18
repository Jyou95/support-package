<?php

namespace Sixturbo\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Sixturbo\Support\Models\Faq;

class FaqCategory extends Model
{
	protected $fillable = [
		'title','value', 'is_display'
	];

	public function faqs(){
    	
    	return $this->hasMany(Faq::class);
    	
    }
    
}
