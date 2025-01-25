<?php

namespace App\Models\Project;

use App\Models\Model;
use App\Models\User\User;
use App\Traits\Model\ModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use ModelTrait, SoftDeletes;

	/**
	 * 用户
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
