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
        Schema::create('project_setting', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('project_id')->nullable()->comment('项目id：关联 project.id');
			$table->bigInteger('bug_status_dictionary_id')->nullable()->comment('bug状态字典id，关联 dictionary.id');
			$table->dateTime('created_at')->nullable()->comment('创建时间');
			$table->dateTime('updated_at')->nullable()->comment('修改时间');
			$table->dateTime('deleted_at')->nullable()->comment('删除时间');
			$table->comment('项目设置表');
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_setting');
    }
};
