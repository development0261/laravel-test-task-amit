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
    <div class="col-md-2">
        <div class="pull-right">
            <a href="{{ url('/edit') }}" class="btn btn-default btn-flat">Edit Profile</a>
        </div>
        <div class="pull-right">
            <a href="#" class="btn btn-default btn-flat" id="logout">Log out</a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Update Profile') }}</div>

            <div class="card">
                
                <div class="card-body">
                    <div class="alert alert-danger" id="form_error"></div>
                    <div class="alert alert-success" id="form_success"></div>
                    <form method="POST" enctype="multipart/form-data" id="user-form" action="{{url('api/update')}}" >
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" name="name"  type="text" class="form-control" maxlength="100">
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
                            <label for="Father" class="col-md-4 col-form-label text-md-right">{{ __('Father') }}</label>

                            <div class="col-md-6">
                                <input id="father" name="father"  type="text" class="form-control" maxlength="100">
                                <span id="father_error" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Mother" class="col-md-4 col-form-label text-md-right">{{ __('Mother') }}</label>

                            <div class="col-md-6">
                                <input id="mother" name="mother"  type="text" class="form-control" maxlength="100">
                                <span id="mother_error" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Wife') }}</label>

                            <div class="col-md-6">
                                <input id="wife" name="wife"  type="text" class="form-control" maxlength="100">
                                <span id="wife_error" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Child') }}</label>

                            <div class="col-md-6">
                                <input id="child" name="child"  type="text" class="form-control" maxlength="100">
                                <span id="child_error" class="invalid-feedback" role="alert" ></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea name="address" id="address" class="form-control"></textarea>

                                <span id="address_error" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Zipcode') }}</label>

                            <div class="col-md-6">
                                <input id="zipcode" name="zipcode"  type="text" class="form-control" maxlength="6">
                                <span id="zipcode_error" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select name="country" id="country" class="form-control">
                                    <option>Select Country</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control">
                                    <option>Select State</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <select name="city" id="city" class="form-control">
                                        <option>Select City</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Profile image') }}</label>

                            <div class="col-md-6">
                                <div class="form-group">
                                <span id="imagePreview" class="hide"></span>
                                    <input type="file" name="image" placeholder="Choose image" id="image">
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
    </div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //Check for Existing User Session
        var key =  localStorage.getItem("jtoken");
        if(!key){
            window.location.href = "login";
        }
        //Get country
        getCountry();
        //Get state
        $('#country').change(function(){
            var countryID = $(this).val();
            getState(countryID,0);
        });
        //Get City
        $('#state').change(function(){
            var stateID = $(this).val();
            getCity(stateID,0);
        });
        //Image preview
        $("#image").change(function() {
          readURL(this);
        });
        //Get user data
        $.ajax({
           type: "GET",
           url: "{{ url('api/view') }}",
           headers: { "Authorization": localStorage.getItem('jtoken')},
           success: function(data){
               $('#name').val(data.user.name);
               $('#email').val(data.user.email);
               $('#phone').val(data.user.phone);
               $('#father').val(data.user.father);
               $('#mother').val(data.user.mother);
               $('#wife').val(data.user.wife);
               $('#child').val(data.user.child);
               $('#address').val(data.user.address);
               $('#zipcode').val(data.user.zipcode);
               $('#country').val(data.user.country);
               if(data.user.profile_image != '' && data.user.profile_image != null){
                 $('#imagePreview').css('display','block');
                 $('#imagePreview').html('<img src="uploads/'+data.user.profile_image+'" width="100" height="100" />');
               }
               getState(data.user.country,data.user.state);
               getCity(data.user.state,data.user.city);
            },
           error: function(data)
           {
            if(data.status == 400){
                $('#form_error').css('display','block');
                $('#form_error').html('Invalid Credentials');
            }

           }
        });
        //Update User Profile
        $('#user-form').submit(function(e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#form_error').text('');
            var form = $(this);
            var furl = form.attr('action');
            var formData = new FormData(this);
            $.ajax({
                headers: { "Authorization": localStorage.getItem('jtoken')},
                type:'POST',
                url: furl,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data)
                {
                  $('#form_success').css('display','block');
                  $('#form_success').html('data updated successfully!!');
                  $([document.documentElement, document.body]).animate({
                        scrollTop: $("#form_success").offset().top
                    }, 500);
                   setTimeout(function(){ 
                        $('#form_success').html(''); 
                        $('#form_success').hide(); 
                    },3000);
                },
                error: function(data) {
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
        //Logout
        $('#logout').click(function(){
            $('#form_error').text('');
            $.ajax({
                type:"POST",
                url:"{{ url('api/logout') }}",
                headers: { "Authorization": localStorage.getItem('jtoken')},
                success:function(res){
                    localStorage.removeItem("jtoken");
                    window.location.href = "login";
                },
                error: function(data) {
                    if(data.status == 400){
                        $('#form_error').css('display','block');
                        $('#form_error').html('Invalid Operation');
                    }
                }
            });
        });
    });
        // Image Preview
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#imagePreview').css('display','block');
              $('#imagePreview').html('<img src="'+ e.target.result+'" width="100" height="100" />');
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }
        //Get Country
        function getCountry(){
            $.ajax({
                type:"GET",
                url:"{{ url('api/country') }}",
                headers: { "Authorization": localStorage.getItem('jtoken')},
                success:function(res){
                    if(res.data){
                        $("#country").empty();
                        $("#country").append('<option value="0">Select Country</option>');
                        $.each(res.data,function(key,value){
                            $("#country").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                }
            });
        }
        //Get State
        function getState(countryID,stateID){
            if(countryID){
                $.ajax({
                    type:"POST",
                    url:"{{ url('api/state') }}",
                    data:{ cid : countryID},
                    headers: { "Authorization": localStorage.getItem('jtoken')},
                    success:function(res){
                        if(res.data){
                            $("#state").empty();
                            $("#state").append('<option option value="0">Select State</option>');
                            $.each(res.data,function(key,value){
                                $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            $('#state').val(stateID);
                            $("#city").empty();
                            $("#city").append('<option option value="0">Select City</option>');
                        }
                    }
                });
            }else{
                $("#state").empty();
                $("#state").append('<option option value="0">Select State</option>');
                $("#city").empty();
                $("#city").append('<option option value="0">Select City</option>');
            }
        }
        //Get City
        function getCity(stateID,cityID){
            if(stateID){
                $.ajax({
                    type:"POST",
                    url:"{{ url('api/city') }}",
                    data:{ sid : stateID},
                    headers: { "Authorization": localStorage.getItem('jtoken')},
                    success:function(res){
                        if(res.data){
                            $("#city").empty();
                            $("#city").append('<option option value="0">Select City</option>');
                            $.each(res.data,function(key,value){
                                $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            $('#city').val(cityID);
                        }
                    }
                });
            }else{
                $("#state").empty();
                $("#state").append('<option option value="0">Select State</option>');
                $("#city").empty();
                $("#city").append('<option option value="0">Select City</option>');
            }
        }
</script>
