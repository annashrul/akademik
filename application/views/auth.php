
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login SIAKAD</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>assets/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>assets/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url()?>assets/admin/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>assets/admin/build/css/custom.min.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="<?=base_url('assets/admin/vendors/jquery/dist/jquery.min.js')?>"></script>
  </head>
  <style type="text/css" media="screen">
    .alert,.btn, .form-control{border-radius:0px!important;}
    .login_form{border: 2px solid #EEEEEE; padding:5px;}
    .alert-danger{background:#EEEEEE!important;border:2px solid #EEEEEE!important;color:#73879C !important;font-weight:bold;}
  </style>
  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?=base_url('auth/login')?>" method="post">
              <h1>LOGIN SIAKAD</h1>
              <?php 
                if($this->session->flashdata('gagal')){
                  echo "<div class='alert alert-danger alert-message'> <i class='fa fa-remove'></i>  ";
                  echo $this->session->flashdata('gagal');
                  echo "</div>";
                }
              ?>
              <div>
                <input type="text" name="username" class="form-control test" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Masuk</a> <br/>
              </div>
                <p class="text-center">Apabila Lupa Dengan Akun Anda, Hubungi Segera Pihak Akademik</p>
              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    // $(".submit").click(function(){
    //   alert('test');
    // });

    $(".alert-message").delay('4000').slideUp('slow');
    </script>
  </body>
</html>
