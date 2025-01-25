<?php

namespace App\Http\UserApi\Controllers;

use App\Models\Bug\Bug;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
	 * 统计
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function aggregate(Request $request): JsonResponse
	{
		$today     = now()->startOfDay()->toDateTimeString();
		$tomorrow  = now()->startOfDay()->addDay()->toDateTimeString();
		$yesterday = now()->startOfDay()->subDay()->toDateTimeString();
		$thisWeek  = now()->startOfWeek()->toDateTimeString();
		$lastWeek  = now()->subWeek()->startOfWeek()->toDateTimeString();
		$thisMonth = now()->startOfMonth()->toDateTimeString();
		$nextMonth = now()->addMonth()->startOfMonth()->toDateTimeString();

	}

	protected function getAggregateData($start, $end): void
	{
		Bug::query()
			->selectRaw("
				")
			->first();
	}
}
