<?php

namespace App\Models\Bug;

use App\Models\Model;
use App\Models\Project\Project;
use App\Models\User\User;
use App\Traits\Model\ModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bug extends Model
{
	use NodeTrait, ModelTrait, SoftDeletes;

	protected $appends = [];

	protected $hidden = ['left', 'right'];

	public function getLftName(): string
	{
		return 'left';
	}

	public function getRgtName(): string
	{
		return 'right';
	}

	public function getParentIdName(): string
	{
		return 'parent_id';
	}

	/**
	 * 关联项目
	 * @return BelongsTo
	 */
	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

	/**
	 * 关联日志
	 * @return HasMany
	 */
	public function logs(): HasMany
	{
		return $this->hasMany(BugLog::class);
	}

	/**
	 * 创建人
	 * @return BelongsTo
	 */
	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * 执行人
	 * @return BelongsTo
	 */
	public function executor(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
