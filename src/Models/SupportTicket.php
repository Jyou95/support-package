<?php

namespace Sixturbo\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
	use SoftDeletes;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'type',
	];
	
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'last_reply_at',
		'read_at',
		'deleted_at',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden =[
		'user_id',
		'deleted_at',
	];
	
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_flagged' => 'boolean',
		'is_ignored' => 'boolean',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function support_posts()
	{
		return $this->hasMany(SupportPost::class);
	}
	
}


