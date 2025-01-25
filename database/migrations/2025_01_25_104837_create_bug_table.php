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
        Schema::create('bug', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('project_id')->nullable()->comment('项目id：关联 project.id');
			$table->integer('parent_id')->nullable()->comment('父级编号');
			$table->integer('left')->comment('区间');
			$table->integer('right')->comment('区间');
			$table->bigInteger('creator_id')->nullable()->comment('创建人id：关联 user.id');
			$table->bigInteger('executor_id')->nullable()->comment('执行人id：关联 user.id');
			$table->string('title')->default('')->comment('标题');
			$table->text('content')->nullable()->comment('内容');
			$table->tinyInteger('urgency')->default(0)->comment('紧急度，越小越紧急');
			$table->tinyInteger('priority')->default(0)->comment('优先级，越小越优先');
			$table->tinyInteger('status')->default(0)->comment("状态");
			$table->dateTime('completed_at')->nullable()->comment('完成时间');
			$table->dateTime('deadline_at')->nullable()->comment('截止时间');
			$table->dateTime('created_at')->nullable()->comment('创建时间');
			$table->dateTime('updated_at')->nullable()->comment('修改时间');
			$table->dateTime('deleted_at')->nullable()->comment('删除时间');
			$table->comment('bug表');
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug');
    }
};
