@extends('master.master')

@section('content')
<div class="container">
  <h2>Register</h2>
  <br>
  <!-- Nav tabs -->
  <div class="" id="tabs">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link menu-1 active" href="#menu-1"><span class="fas fa-user"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu-2" href="#menu-2"><span class="far fa-envelope"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu-3" href="#menu-3"><span class="fas fa-cog"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link menu-4" href="#menu-4"><span class="far fa-thumbs-up"></span></a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="menu-1" class="container tab-pane menutab-1 active"><br>
        <h3>Nama</h3>
        <div class="col-8">
          <div class="form-group row">
              <div class="col-md-6">
                  <input id="nama_depan" type="text" class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan" value="{{ old('nama_depan') }}" required autocomplete="nama_depan" placeholder="Nama depan" autofocus>
                  @error('nama_depan')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <input id="nama_belakang" type="text" class="form-control @error('nama_belakang') is-invalid @enderror" name="nama_belakang" value="{{ old('nama_belakang') }}" required autocomplete="nama_belakang" placeholder="Nama Belakang">
                  @error('nama_belakang')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <button class="btn btn-primary" type="button" name="button" id="nexttab1">Next</button>
        </div>
      </div>
      <div id="menu-2" class="container tab-pane menutab-2"><br>
        <h3>Email & Telp</h3>
        <div class="col-8">
          <div class="form-group row">
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" placeholder="No Telp">
                  @error('no_telp')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <button class="btn btn-primary" type="button" name="button" id="nexttab2">Next</button>
        </div>
      </div>
      <div id="menu-3" class="container tab-pane menutab-3"><br>
        <div class="col-8">
          <h3>Password</h3>
          <div class="form-group row">
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Password confirm">
              </div>
          </div>
          <button class="btn btn-primary" type="button" name="button" id="nexttab3">Next</button>
        </div>
      </div>
      <div id="menu-4" class="container tab-pane menutab-4"><br>
        <div class="col-8">
          <h3>Result</h3>
          <div id="berhasil">

          </div>
          {{-- <button class="btn btn-primary" type="button" name="button" id="nexttab3">Next</button> --}}
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#nexttab1").click(function() {
  var nama_depan = $('#nama_depan').val();
  var nama_belakang = $('#nama_belakang').val();

  if (nama_depan == '' || nama_depan == null) {
    alert('Nama depan tidak boleh kosong');
  }else {
    if (nama_belakang == '' || nama_belakang == null) {
      alert('Nama belakang tidak boleh kosong');
    }else {
      $(".menu-1").removeClass("active");
      $(".menu-2").addClass("active");
      $(".menutab-1").removeClass("active");
      $(".menutab-2").addClass("active");
    }
  }


});
$("#nexttab2").click(function() {
  var email = $('#email').val();
  var no_telp = $('#no_telp').val();

  if (email == '' || email == null) {
    alert('Email tidak boleh kosong');
  }else {
    if (!isEmail(email)) {
      alert('Format Email salah');
    }else {
      if (no_telp == '' || no_telp == null) {
        alert('No telp tidak boleh kosong');
      }else {
        $.ajax({
          url:"{{url('cekemail')}}",
          method:"POST",
          data:{
            email:email
          },
           success:function(data){
             if (data == 'kosong') {
               $(".menu-2").removeClass("active");
               $(".menu-3").addClass("active");
               $(".menutab-2").removeClass("active");
               $(".menutab-3").addClass("active");
             }else {
               alert('Email telah digunakan');
             }
            },
          error: function(request, status, error){
            console.log(error);
          }
        });
      }
    }
  }
});

$("#nexttab3").click(function() {
  var nama_depan = $('#nama_depan').val();
  var nama_belakang = $('#nama_belakang').val();
  var email = $('#email').val();
  var no_telp = $('#no_telp').val();
  var password = $('#password').val();
  var passwordconfirm = $('#passwordconfirm').val();

  if (password == '' || password == null) {
    alert('Password tidak boleh kosong');
  }else if (password.length < 8) {
    alert('Password kurang dari 8');
  }else {
    if (passwordconfirm == '' || passwordconfirm == null) {
      alert('Password confirm tidak boleh kosong');
    }else {
      if (password == passwordconfirm) {
        $(".menu-3").removeClass("active");
        $(".menu-4").addClass("active");
        $(".menutab-3").removeClass("active");
        $(".menutab-4").addClass("active");
        $.ajax({
          url:"{{url('regis')}}",
          method:"POST",
          data:{
            nama_depan:nama_depan,
            nama_belakang:nama_belakang,
            email:email,
            no_telp:no_telp,
            password:password,
            passwordconfirm:passwordconfirm
          },
           success:function(data){
             document.getElementById("berhasil").innerHTML = data;
             console.log(data);
           },
          error: function(request, status, error){
            console.log(error);
          }
        });

      }else {
        alert('password berbeda');
      }
    }
  }
});
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
@endsection
