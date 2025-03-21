<?php

namespace App\Rewrite;

use Illuminate\Pagination\LengthAwarePaginator as LaravelLengthAwarePaginator;

/**
 * 重写 LaravelLengthAwarePaginator 分页类
 */
class LengthAwarePaginator extends LaravelLengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->items->toArray(),
            'current_page' => $this->currentPage(),
            'per_page' => $this->perPage(),
            'total' => $this->total()
        ];
    }
}
