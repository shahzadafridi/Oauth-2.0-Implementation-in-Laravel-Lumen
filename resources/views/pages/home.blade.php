<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Floating labels example · Bootstrap</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="/css/signin.css" rel="stylesheet">
</head>

<body>

  <!-- curl --location --request POST "https://shahzadafridi10.000webhostapp.com/oauth/token" \
  --form "grant_type=password" \
  --form "client_id=2" \
  --form "client_secret=04DwBjUKRa2CSsnIFTR0OVXnuP3CPyaNPSJidLAW" \
  --form "username=shahzad11@gmail.com" \
  --form "password=pass"
   -->

  <!-- Generate Token -->

  <div class="container">

    <div class="row">

      <!-- Registration -->

      <div class="col">

        <form id="token_form" class="form" action="api/user/create" method="post">

          <h1 class="h3 mb-3 font-weight-normal">Registration</h1>

          <div class="form-label-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
            <label>Enter email</label>
          </div>

          <div class="form-label-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <label>Enter password</label>
          </div>

          <div class="form-label-group">
            <input type="hidden" name="token" id="token" class="form-control" placeholder="Token">
          </div>

          <div class="form-label-group">
            <input type="hidden" name="refresh_token" id="refresh_token" class="form-control" placeholder="Refresh">

          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

        </form>

      </div>


      <div class="col" id="row-col">
        <h1 class="h3 mb-3 font-weight-normal">Response:</h1>
        <br>
        <?php 
        $key_sucess = ['Api Type:', 'status:','Message:'];
        $key_failed = ['Api Type:', 'status:','Message:'];
        $count = 0;
        if (is_array($data) || is_object($data)){
          if ($data['api_type'] == 'registration') {
            if($data['status'] == 'success'){
              foreach ($data as $value){
                echo "<h5 class=h5 mb-3 font-weight-normal>".$key_sucess[$count]."</h5>";
                echo "<h1 class=result>";
                echo $value;
                echo "</h1>";
                $count = $count + 1;
              }
            }else {
              foreach ($data as $value){
                echo "<h5 class=h5 mb-3 font-weight-normal>".$key_failed[$count]."</h5>";
                echo "<h1 class=result>";
                echo $value;
                echo "</h1>";
                $count = $count + 1;
              }
            }
          }
        }
      ?>
      </div>


      <div class="w-100"></div>

      <!-- Create Token -->

      <div class="col">

        <form id="token_form" class="form" action="/api/token" method="post">


          <h1 class="h3 mb-3 font-weight-normal">Token</h1>

          <div class="form-label-group">
            <input type="text" name="grant_type" id="grant_type" class="form-control" placeholder="Grant type" required>
            <label>Enter grant type</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="client_id" id="client_id" class="form-control" placeholder="Client id" required>
            <label>Enter client id</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="client_secret" id="client_secret" class="form-control" placeholder="Client secret"
              required>
            <label>Enter client secret</label>
          </div>

          <div class="form-label-group">
            <input type="email" name="username" id="username" class="form-control" placeholder="Email address" required>
            <label>Enter email</label>
          </div>

          <div class="form-label-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <label>Enter password</label>
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit">Generate Token</button>

        </form>

      </div>
      <div class="col" id="row-col">
        <h1 class="h3 mb-3 font-weight-normal">Response:</h1>
        <br>
        <?php 
        $key_sucess = ['User id','Api Type:', 'status:','Token type:','Expire time in seconds:','Token','Refresh Token'];
        $key_failed = ['Api Type:', 'status:','Message:'];
        $count = 0;
        if (is_array($data) || is_object($data)){
          if ($data['api_type'] == 'token') {
            if($data['status'] == 'success'){
              foreach ($data as $value){
                echo "<h5 class=h5 mb-3 font-weight-normal>".$key_sucess[$count]."</h5>";
                echo "<h1 class=result>";
                echo $value;
                echo "</h1>";
                $count = $count + 1;
              }
            }else {
              foreach ($data as $value){
                echo "<h5 class=h5 mb-3 font-weight-normal>".$key_failed[$count]."</h5>";
                echo "<h1 class=result>";
                echo $value;
                echo "</h1>";
                $count = $count + 1;
              }
            }
          }
        }
      ?>
      </div>


      <div class="w-100"></div>

      <!-- Login -->


      <div class="col">

        <form id="token_form" class="form" action="api/user/login" method="post">

          <h1 class="h3 mb-3 font-weight-normal">Login</h1>

          <div class="form-label-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
            <label>Enter email</label>
          </div>

          <div class="form-label-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <label>Enter password</label>
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

        </form>

      </div>

      <div class="col" id="row-col">
          <h1 class="h3 mb-3 font-weight-normal">Response:</h1>
          <br>
          <?php 
          $key_sucess = ['Api Type:', 'status:','email:','Token:','Refresh Token:'];
          $key_failed = ['Api Type:', 'status:','Message:'];
          $count = 0;
          if (is_array($data) || is_object($data)){
            if ($data['api_type'] == 'login') {
              if($data['status'] == 'success'){
                foreach ($data as $value){
                  echo "<h5 class=h5 mb-3 font-weight-normal>".$key_sucess[$count]."</h5>";
                  echo "<h1 class=result>";
                  echo $value;
                  echo "</h1>";
                  $count = $count + 1;
                }
              }else {
                foreach ($data as $value){
                  echo "<h5 class=h5 mb-3 font-weight-normal>".$key_failed[$count]."</h5>";
                  echo "<h1 class=result>";
                  echo $value;
                  echo "</h1>";
                  $count = $count + 1;
                }
              }
            }
          }
        ?>
      </div>


      <div class="w-100"></div>

      <!-- Refresh Token -->

      <div class="col">

        <form id="token_form" class="form" action="api/refreshToken" method="post">

          <h1 class="h3 mb-3 font-weight-normal">Refresh
            Token</h1>

          <div class="form-label-group">
            <input type="text" name="grant_type" id="grant_type" class="form-control" placeholder="Grant type" required>
            <label>Enter grant type</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="client_id" id="client_id" class="form-control" placeholder="Client id" required>
            <label>Enter client id</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="client_secret" id="client_secret" class="form-control" placeholder="Client secret"
              required>
            <label>Enter client secret</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="refresh_token" id="refresh_token" class="form-control" placeholder="Refresh Token"
              required>
            <label>Refresh Token</label>
          </div>

          <div class="form-label-group">
            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User Id" required>
            <label>User Id</label>
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit">Refresh Token</button>

        </form>

      </div>

      <div class="col" id="row-col">
          <h1 class="h3 mb-3 font-weight-normal">Response:</h1>
          <br>
          <?php 
          $key_sucess = ['Api Type:', 'status:','Token type:','Expire time in seconds:','Token','Refresh Token'];
          $key_failed = ['Api Type:', 'status:','Message:'];
          $count = 0;
          if (is_array($data) || is_object($data)){
            if ($data['api_type'] == 'refresh_token') {
              if($data['status'] == 'success'){
                foreach ($data as $value){
                  echo "<h5 class=h5 mb-3 font-weight-normal>".$key_sucess[$count]."</h5>";
                  echo "<h1 class=result>";
                  echo $value;
                  echo "</h1>";
                  $count = $count + 1;
                }
              }else {
                foreach ($data as $value){
                  echo "<h5 class=h5 mb-3 font-weight-normal>".$key_failed[$count]."</h5>";
                  echo "<h1 class=result>";
                  echo $value;
                  echo "</h1>";
                  $count = $count + 1;
                }
              }
            }
          }
        ?>
      </div>

    </div>


    <!-- Script -->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
      $('#token_form').on('submit', function(){

  var vgrant_type = $('#grant_type').val();
  var vclient_id = $('#client_id').val();
  var vclient_secret = $('#client_secret').val();
  var vusername = $('#username').val();
  var vpassword = $('#password').val();

  var daraString = 
  "grant_type="+vgrant_type+
  "&client_id="+vclient_id+
  "&client_secret="+vclient_secret+
  "&username="+vusername+
  "&password="+vpassword;

  $.ajax({
    type: "POST",
    url: "/oauth/token",
    data: daraString,
    success: function(data){
      console.log(data);
      $('#username').text(data);
    }
  });


  // $.post('/oauth/token', {
  //   grant_type:vgrant_type, 
  //   client_id:vclient_id,
  //   client_secret:vclient_secret,
  //   username:vusername, 
  //   password:vpassword}, function(data){
  //     $('#token_p').html(data);
  //     console.log(data);
  //   });
    
});
    </script>
</body>

</html>