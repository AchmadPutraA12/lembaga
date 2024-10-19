<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('dist-assets/css/themes/lite-blue.min.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('dist-assets/images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist-assets/images/logo.png') }}" type="image/x-icon">

</head>
<div class="auth-layout-wrap" style="background-image: url(../../dist-assets/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class=" text-center mb-4" ><img class="pl- 3" src="https://dev2.kopertis7.go.id/images/logo_dikbud.png" style="height: 100px" alt="logo dikti"></div>
                        <h1 class=" text-center mb-2 text-17">Welcome to LLDIKTI VII <br> Sign in to Your Account</h1>
                        <form method="post" action="{{ route('authenticate') }}" >
                            @csrf
                            <div class="form-group">
                                <label for="email">Masukkan nip/email</label>
                                <input class="form-control form-control-rounded" id="nip_or_email_field" type="text" name="nip_or_email_field" placeholder="nip atau email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control form-control-rounded" id="password" type="password" name="password" placeholder="password" required>
                            </div>
                            
                            @if(session()->has('loginError'))
                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;"> 
                                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </symbol>
                                </svg>
                                
                                <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                    <svg class="bi flex-shrink-0 me-5" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    {{ session('loginError') }}
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
    
                            <button class="btn btn-rounded btn-primary btn-block mt-2">Log In</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 text-center" style="background-size: cover;background-image: url(../../dist-assets/images/photo-long-3.jpg)">
                    
                </div>
            </div>
        </div>
    </div>
</div>