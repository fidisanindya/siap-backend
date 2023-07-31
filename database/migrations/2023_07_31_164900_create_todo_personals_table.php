<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_personals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('deadline')->nullable()->default(null);
            $table->boolean('repeat')->nullable()->default(0);
            $table->string('repeat_category')->nullable()->default(null);
            $table->date('date')->nullable()->default(null);
            $table->time('time')->nullable()->default(null);
            $table->boolean('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_personals');
    }
}
