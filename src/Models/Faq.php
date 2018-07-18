<?php

namespace Sixturbo\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Sixturbo\Support\Models\FaqCategory;

class Faq extends Model
{
	protected $fillable = [
		'question','answer'
	];

    public function faq_category()
    {
        return $this->belongsTo(FaqCategory::class);
    }
}
