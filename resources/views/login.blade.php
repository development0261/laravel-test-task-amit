<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        .alert{
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <div class="alert alert-danger" id="form_error"></div>
                        <form method="POST" action="{{url('api/login')}}" id="frm-submit">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email">
                                    <span id="email_error" class="invalid-feedback" role="alert"></span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control " name="password">
                                    <span id="password_error" class="invalid-feedback" role="alert"></span>


                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    <a href="{{ url('register') }}" class="btn btn-primary ml-5">
                                        {{ __('Register') }}
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //Check for existing user Session
        var key =  localStorage.getItem("jtoken");
        if(key){
            window.location.href = "home";
        }
        //User Login
        $("#frm-submit").submit(function(e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            var form = $(this);
            var url = form.attr('action');
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(),
                dataType: 'json',
                success: function(data){
                    localStorage.setItem("jtoken", 'Bearer ' + data.token);
                    window.location.href = "home";
               },
               error: function(data)
               {
                $('#form_error').css('display','none');
                if(data.status == 422){
                    var obj = JSON.parse(data.responseJSON.error);
                    $.each(obj, function( key, value) {
                        $('#'+key).addClass('is-invalid');
                        $('#'+key+'_error').html('<strong>'+value+'</strong>');
                    });
                }
                if(data.status == 400){
                    $('#form_error').css('display','block');
                    $('#form_error').html('Invalid Credentials');
                }

               }
         });
});
    });
</script>

