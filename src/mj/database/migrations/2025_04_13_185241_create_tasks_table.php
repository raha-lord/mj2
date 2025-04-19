<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('task.tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->timestamp('d_start');
            $table->timestamp('d_end')->nullable();
            $table->timestamp('d_close')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();

            // Внешние ключи
            $table->foreign('status_id')
                ->references('id')
                ->on('task.statuses')
                ->onDelete('set null');

            $table->foreign('project_id')
                ->references('id')
                ->on('task.projects')
                ->onDelete('set null');

            // Системные поля
            $table->timestamps();
            // Мягкое удаление
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task.tasks');
    }
}
