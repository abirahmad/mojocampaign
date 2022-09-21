<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('question_set_id');
            $table->boolean('status')->default(1);
            $table->enum('type', ['radio', 'checkbox_single', 'checkbox_multiple', 'select_single', 'select_multiple', 'text'])
                ->default('checkbox_single');

            $table->foreign('question_set_id')->references('id')->on('question_sets')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
}
