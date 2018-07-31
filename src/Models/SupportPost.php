<?php

namespace Sixturbo\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportPost extends Model
{
	use SoftDeletes;
	
	protected $fillable = [
		'message',
	];
	
	protected $dates = [
		'published_at',
		'deleted_at',
	];
	
	protected $hidden = [
		'support_ticket_id',
		'user_id',
		'deleted_at',
	];
	
	protected $casts = [
		'is_draft' => 'boolean',
		'is_markdown' => 'boolean',
	];
	
	public function support_ticket()
	{
		return $this->belongsTo(SupportTicket::class);
	}
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function documents()
	{
		return $this->morphToMany(Document::class, 'documentable');
	}
	
}
