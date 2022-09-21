@extends('frontend.layouts.master')

@section('title')
Quiz | Mojo Eid Campaign
@endsection

@section('content')
<!-- user start -->
<div class="userDetails">
    <div class="container quiz-area">
        <div class="row formbox" id="quiz-div">
            <div class="offest-xl-1 col-xl-8 offset-lg-0 col-lg-8 offset-md-0 col-md-7">
                <div class="userbox">
                    <div class="userdetails">
                        <div class="map">
                            <div class="map_img">
                                <img src="{{ asset('public/assets/frontend/img/rankLogo.png') }}" alt="">
                            </div>
                            <div class="maprounder">
                                <h2> <span id="counter">10</span> </h2>
                            </div>
                        </div>
                        <h3>Mojo Quiz</h3>
                        <div class="question">
                            <h2>{{ $question->title }}</h2>
                        </div>
                        <div class="question_mark">
                            @foreach($questionOptions as $questionOption)
                            <button id="answer{{ $questionOption->id }}" onclick="checkAnswer(<?php echo  $questionOption->id ?>)">{{ $questionOption->value }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-3">
                <div class="botol"><img src="{{ $image }}" alt="botol"></div>
            </div>
        </div>
        <div class="timeLieft">
            <div class="titletime">
                <h3>
                    Time Left
                </h3>
                <p id="demo"></p>
            </div>
        </div>
    </div>
</div>
<!-- user end -->
@endsection

@section('footer')
@include('frontend.layouts.partials.footer')
@endsection

@section('scripts')
<script>
    checkCounter(10);
    const apiURL = "<?php echo route('check.answer'); ?>";
    const question_id = <?php echo $question->id ?>;
    const user_id = <?php echo Auth::id() ?>;

    function checkCounter(counter) {
        if (counter !== 0) {
            setTimeout(() => {
                counter--;
                $("#counter").html(counter);
                checkCounter(counter);
            }, 1000);
        } else {
            // Submit with a wrong answer in database
            const postData = {
                question_id: question_id,
                answer_id: null,
                time: 0,
                user_id: user_id
            };
            axios.post(apiURL, postData)
            .then(function(response) {
                $("#quiz-div").load(location.href + " .quiz-area");
                // window.location.reload();
            });
        }
    }

    let total_answer = 0;
    function checkAnswer(value) {
        total_answer++;

        let answer_id = value;
        let time = parseInt(10 - parseInt($("#counter").html()));
        time = time === 0 ? 1 : time;

        const postData = {
            question_id: question_id,
            answer_id: answer_id,
            time: time,
            user_id: <?php echo Auth::id() ?>
        };

        
        const apiGetOptions = "<?php echo route('options.get', $question->id); ?>";

        // call an api to check the answer
        axios.post(apiURL, postData)
            .then(function(response) {
                let insideText = $("#answer" + answer_id).html();

                // Disable all other answer
                axios.get(apiGetOptions).then(res => {
                    const options = res.data.options;
                    options.forEach(option => {
                        $("#answer" + option.id).attr('disabled', true);
                    });
                });

                if (response.data.status) {
                    const imagePath = response.data.image;
                    $("#answer" + answer_id).addClass('markquestion');
                    $("#answer" + answer_id).attr('disabled', true);
                    insideText = insideText + ' <i class="fas fa-check-circle"></i>';
                    const imageBottle = '<img  src="' + imagePath + '" alt="botol">';
                    $(".botol").html(imageBottle);
                } else {
                    $("#answer" + answer_id).addClass('markquestionwrong');
                    $("#answer" + answer_id).attr('disabled', true);
                    insideText = insideText + ' <i class="fas fa-times-circle"></i>';
                }
                $("#answer" + answer_id).html(insideText);

                console.log('total_answer', total_answer);
                if(total_answer >= 20) {
                    location.href = `${response.data.redirect_route}`;
                };

                // Wait for 0.5 seconds and go
                setTimeout(() => {
                    $("#quiz-div").load(location.href + " .quiz-area");
                }, 500)

            })
            .catch(function(error) {
                console.log(error);
            });

        // alert(question_id);
    }


    /**
    * Not used
    */
    function storeResponse() {
        const apiURLStore = "<?php echo route('response.store'); ?>";
        let time = parseInt(10 - parseInt($("#counter").html()));
        time = time === 0 ? 1 : time;

        const postData = {
            time: time,
            user_id: <?php echo Auth::id() ?>
        };

        axios.post(apiURLStore, postData)
            .then(res => {
                window.location.reload();
            }).catch(err => {
                alert('Sorry !!, Something wrong happened, Please try again.')
            })
    }
</script>
@endsection