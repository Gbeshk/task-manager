<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Task extends Model
{
	use HasFactory, HasTranslations;

	public array $translatable = ['title', 'description'];

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'status',
		'due_date',
	];

	protected function casts(): array
	{
		return [
			'due_date' => 'date',
		];
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
