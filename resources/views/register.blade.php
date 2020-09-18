<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        .alert , .hide{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                    <div class="alert alert-danger" id="form_error"></div>
                     <div class="alert alert-success" id="form_success"></div>
                        <form id="frm-submit" method="POST" action="{{url('api/register')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" name="name"  type="text" class="form-control"  >
                                    <span id="name_error" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" name="email" type="email" class="form-control" maxlength="100">
                                    <span id="email_error" class="invalid-feedback" role="alert"></span>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" maxlength="10">
                                    <span id="phone_error" class="invalid-feedback" role="alert"></span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control " name="password" >
                                    <span id="password_error" class="invalid-feedback" role="alert"></span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                    <span id="password_confirmation_error" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{ url('login') }}" class="btn btn-primary ml-5">
                                        {{ __('Login') }}
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
        //New user Registration
        $("#frm-submit").submit(function(e) {
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        $('#form_error').html('');
        $('#form_error').css('display','none');
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            headers: { "Authorization": localStorage.getItem('jtoken')},
            success: function(data)
            {
                 $('#form_success').css('display','block');
                 $('#form_success').html('Data Added successfully!!');
                 $([document.documentElement, document.body]).animate({
                        scrollTop: $("#form_success").offset().top
                    }, 500);
                   setTimeout(function(){ 
                        $('#form_success').html(''); 
                        $('#form_success').hide(); 
                    },3000);
                window.location.href = "login";
            },
            error: function(data){
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
                    $('#form_error').html(data.responseJSON.error);
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#form_error").offset().top
                    }, 500);
                    setTimeout(function(){ 
                        $('#form_error').html(''); 
                        $('#form_error').hide(); 
                    },3000);
                }
            }
         });
});
    });
</script>
