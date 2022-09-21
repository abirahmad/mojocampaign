<?php

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /****************************       1        ***************/
        $question = new Question();
        $question->title = "মোজোর জন্মদিন বৈশাখের কত তারিখে পালিত হয়?";
        $question->question_set_id = 1;
        $question->save();

        // Add Options
        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "1st Boishakh";
        $questionOption->is_correct = true;
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "2nd Boishakh";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "1st March";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "2nd April";
        $questionOption->save();



        /****************************       2        ***************/
        $question = new Question();
        $question->title = "পহেলা বৈশাখ কত তারিখে পালিত হয়?";
        $question->question_set_id = 1;
        $question->save();

        // Add Options
        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "১ই জানুয়ারি";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "১৪ই এপ্রিল";
        $questionOption->is_correct = true;
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "২রা মার্চ";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "২৬ ডিসেম্বর";
        $questionOption->save();




        /****************************       3        ***************/
        $question = new Question();
        $question->title = "বাংলাদেশের স্বাধীনতা দিবস কবে?";
        $question->question_set_id = 1;
        $question->save();

        // Add Options
        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "১ই জানুয়ারি";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "২রা এপ্রিল";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "২৬শে মার্চ";
        $questionOption->is_correct = true;
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "১৬ ডিসেম্বর";
        $questionOption->save();


        /****************************       4        ***************/
        $question = new Question();
        $question->title = "বাংলাদেশের জাতির পিতার নাম কি?";
        $question->question_set_id = 1;
        $question->save();

        // Add Options
        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "শেখ মুজিবুর রহমান";
        $questionOption->is_correct = true;
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "মাওলানা ভাসানী";
        $questionOption->is_correct = true;
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "সোহরাও্যার্দী";
        $questionOption->save();

        $questionOption = new QuestionOption();
        $questionOption->question_id = $question->id;
        $questionOption->value = "জিয়াউর রহমান";
        $questionOption->save();
    }
}
