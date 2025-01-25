<?php

namespace App\Models\Project;

use App\Models\Dictionary\Dictionary;
use App\Models\Model;
use App\Traits\Model\ModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectSetting extends Model
{
	use ModelTrait, SoftDeletes;

	/**
	 * BUG状态字典
	 * @return BelongsTo
	 */
	public function bug_status_dictionary(): BelongsTo
	{
		return $this->belongsTo(Dictionary::class);
	}
}
