<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQustionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qustion_answers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('response_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('question_option_id')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->unsignedInteger('total_time')->default(0)->comment('in milli seconds');

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('response_id')->references('id')->on('responses')->onDelete('cascade');
            $table->foreign('question_option_id')->references('id')->on('question_options')->onDelete('cascade');
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
        Schema::dropIfExists('qustion_answers');
    }
}
