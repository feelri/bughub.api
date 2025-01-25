<?php

namespace App\Http\UserApi\Controllers;

use App\Models\Bug\Bug;
use App\Models\Project\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * 项目
 */
class ProjectController extends Controller
{
	/**
	 * 列表
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$params = $request->only([]);
		$projects = Project::query()
			->with(['user'])
			->orderBy('id', 'desc')
			->paginate();

		return $this->response($projects);
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

		$params['user_id'] = $user->id;
		$project = Project::query()->create(array_filter($params));

		return $this->response(['id'=>$project->id]);
	}

	/**
	 * 详情
	 *
	 * @param Project $project
	 * @return JsonResponse
	 */
	public function show(Project $project): JsonResponse
	{
		return $this->response($project);
	}

	/**
	 * 修改
	 *
	 * @param Request $request
	 * @param Project     $project
	 * @return JsonResponse
	 */
	public function update(Request $request, Project $project): JsonResponse
	{
		$params = $request->only([]);
		$project->fill($params)->save();
		return $this->success();
	}

	/**
	 * 删除
	 *
	 * @param Project $project
	 * @return Response
	 */
	public function destroy(Project $project): Response
	{
		DB::transaction(function () use ($project) {
			Bug::query()->where('project_id', $project->id)->delete();
			$project->delete();
		});
		return $this->noContent();
	}
}