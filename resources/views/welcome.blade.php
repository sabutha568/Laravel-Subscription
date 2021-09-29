<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Add csrf-->
        <meta name= "csrf-token" content="{{csrf_token}}" >
        <title>LaravelProject</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- Styles -->
        <style>
            html, body {
                height: 100%;
                color:white;
            }
            body {
                display: -ms-flexbox;
                display: -webkit-box;
                display: flex;
                -ms-flex-align: center;
                -ms-flex-pack: center;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background: #6441A5; 
                background: -webkit-linear-gradient(to right, #2a0845, #6441A5);  
                background: linear-gradient(to right, #2a0845, #6441A5); 
            }

            .btn-primary {
                
                background-color: transparent;
                border: 1px solid white;
                cursor: pointer;
            }

            .btn-primary:hover {
                background-color: white;
                color:black;
                border: 1px solid white;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
            <div class="container">
            <div class="row">
                <div class="col-12 text-center">

                    <h1>
                        Hey, wait...
                    </h1>
                    <h2>
                        Subscribe to get 20 % discount!
                    </h2>
                    <p>
                        The first 50 subscribers will get 30% discount on their first purchase.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="offset-4 col-4 text-center m-auto subscribe-section pt-5">
                    <!-- FORM START -->
                    <form method="POST">
                        <div class="form-row">
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                    </div>
                                    <input name="email" type="text" class="form-control " id="emailField" placeholder="Email">
                                    <div class="invalid-feedback d-none">
                                        Please provide a valid email
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-left">
                                <button class="btn btn-primary" id="submitButton" type="submit">Subscribe</button>
                            </div>
                        </div>
                    </form>
                    <!-- FORM END -->
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('form').on('submit', function (e) {
                    e.preventDefault();
                    $("#submitButton").prop('disabled', true);

                    $a.jax({
                        type: 'POST',
                        url: '/',
                        data:$(this).serialize()
                        success: function(data){
                            if (data.success){
                                $('.subscribe-section').html('<div class='alert alert-subscribe' role="alert">Thank you for Subscribing</div>');
                            }
                        },
                        error:function(data){
                            var errorFromServer = JSON.parse(data.responseText);
                            $("#email\Field").addClass('is-invalid');

                            var invalidFeedbackBox = $(".invalid-feedback");
                            invalidFeedbackBox.html(errorFromServer.message);
                            invalidFeedbackBox.removeClass('d-none')
                            
                            $("#submitButton").prop('disabled', false);
                        }
                    });
                });
            });
        </script>

        

    
    </body>
</html>



