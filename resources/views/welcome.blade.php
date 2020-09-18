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
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body"><p>Welcome To Dashboard <span id="uname" class="font-weight-bold"></span></p></div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var key =  localStorage.getItem("jtoken");
        if(!key){
            window.location.href = "login";
        }
        //Get user data
        $.ajax({
           type: "GET",
           url: "{{ url('api/view') }}",
           headers: { "Authorization": localStorage.getItem('jtoken')},
           success: function(data){
               $('#uname').text(data.user.name);
           },
           error: function(data)
           {
                $('#form_error').css('display','none');
                if(data.status == 400){
                    $('#form_error').css('display','block');
                    $('#form_error').html('Invalid Credentials');
                }
            }
        });
        //Logout
        $('#logout').click(function(){
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
</script>
</body>
</html>

