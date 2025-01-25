<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bug_log', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('bug_id')->nullable()->comment('bug id：关联 bug.id');
			$table->bigInteger('operator_id')->nullable()->comment('操作人id：关联 user.id');
			$table->string('operator_name')->default('')->comment('操作人名称');
			$table->json('before')->nullable()->comment("修改前数据");
			$table->json('after')->nullable()->comment("修改后数据");
			$table->text('content')->nullable()->comment('内容');
			$table->text('remark')->nullable()->comment('备注');
			$table->dateTime('created_at')->nullable()->comment('创建时间');
			$table->dateTime('updated_at')->nullable()->comment('修改时间');
			$table->comment('bug日志表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug_log');
    }
};
