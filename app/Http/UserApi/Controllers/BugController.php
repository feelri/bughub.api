<?php

namespace App\Http\UserApi\Controllers;

use App\Models\Bug\Bug;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Bug
 */
class BugController extends Controller
{
	/**
	 * 列表
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$params = $request->only(['project_id']);

		$bugs = Bug::query();
		if (!empty($params['project_id'])) {
			$bugs->where('project_id', $params['project_id']);
		}

		$bugs->with(['project', 'creator', 'executor'])
			->orderBy('id', 'desc')
			->paginate();

		return $this->response($bugs);
	}

	/**
	 * 新增
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function store(Request $request): JsonResponse
	{
		$params = $request->only([]);
		$user   = $request->user();

		$bug = DB::transaction(function () use ($user, $params) {
			$params['creator_id'] = $user->id;
			$bug = Bug::query()->create(array_filter($params));
			$bug->logs()->create([
				'content'       => '新增BUG',
				'operator_id'   => $user->id,
				'operator_name' => $user->name,
			]);

			return $bug;
		});

		return $this->response(['id'=>$bug->id]);
	}

	/**
	 * 详情
	 *
	 * @param Bug $bug
	 * @return JsonResponse
	 */
	public function show(Bug $bug): JsonResponse
	{
		return $this->response($bug);
	}

	/**
	 * 修改
	 *
	 * @param Request $request
	 * @param Bug     $bug
	 * @return JsonResponse
	 */
	public function update(Request $request, Bug $bug): JsonResponse
	{
		$params = $request->only([]);
		$user   = $request->user();

		DB::transaction(function () use ($user, $bug, $params) {
			$before = $bug->toArray();
			$bug->fill($params)->save();
			$after = $bug->toArray();
			$bug->logs()->create([
				'content'       => '更新BUG',
				'before'		=> $before,
				'after'			=> $after,
				'operator_id'   => $user->id,
				'operator_name' => $user->name,
			]);
		});

		return $this->success();
	}

	/**
	 * 删除
	 *
	 * @param Bug $bug
	 * @return Response
	 */
	public function destroy(Bug $bug): Response
	{
		DB::transaction(function () use ($bug) {
			$bug->logs()->delete();
			$bug->delete();
		});
		return $this->noContent();
	}

	/**
	 * 指派
	 *
	 * @param Request $request
	 * @param Bug     $bug
	 * @return JsonResponse
	 */
	public function assign(Request $request, Bug $bug): JsonResponse
	{
		$params = $request->only(['executor_id', 'remark']);
		$user   = $request->user();
		$executor = User::query()->findOrFail($params['executor_id']);

		DB::transaction(function () use ($user, $executor, $bug, $params) {
			$bug->fill($params)->save();
			$bug->logs()->create([
				'content'       => "{$user->name}将BUG指派给{$executor->name}",
				'remark'		=> $params['remark'] ?? '',
				'operator_id'   => $user->id,
				'operator_name' => $user->name,
			]);
		});

		return $this->success();
	}
}