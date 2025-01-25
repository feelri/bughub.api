<?php

namespace App\Models\Bug;

use App\Models\Model;
use App\Models\User\User;
use App\Traits\Model\ModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BugLog extends Model
{
	use ModelTrait;

	public function casts(): array
	{
		return [
			...parent::casts(),
			'before' => 'array',
			'after'  => 'array',
		];
	}

	/**
	 * 操作人
	 * @return BelongsTo
	 */
	public function operator(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
