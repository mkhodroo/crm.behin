@extends('layouts.guest')

@section('content')
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4>Behin CRM</h4>
        </div>
        <div class="card-body">
            <form action="javascript:void(0)" method="post" id="login-form">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-mail"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-12">
                <button type="submit" class="btn btn-primary col-sm-12" onclick="submit()">{{__('Login')}}</button>
            </div>
            <hr>
            <div class="center-align" style="text-align: center">
                <a href="{{ route('register') }}" class="text-center">{{__('Register')}}</a>
            </div>
            <hr>
            <div class="center-align" style="text-align: center">
                <a href="{{ route('password.request') }}" class="text-center">{{__('Forget Password')}}</a>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
    <script>
        function submit() {
            send_ajax_request(
                "{{ route('login') }}",
                $('#login-form').serialize(),
                function(response) {
                    show_message("{{__('Login: Please Wait')}}")
                    window.location = "{{ url('dashboard') }}"
                },
                function(response) {
                    // console.log(response);
                    show_error(response)
                    hide_loading();
                }
            )
        }
    </script>
@endsection
