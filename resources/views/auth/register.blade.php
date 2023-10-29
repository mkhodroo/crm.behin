@extends('layouts.guest')

@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center col-sm-12">
                <h4>Behin CRM</h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post" id="register-form">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="email" placeholder="{{__('Email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
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
                    <button type="submit" class="btn btn-primary col-sm-12" onclick="submit()">{{__('Register')}}</button>
                </div>
                <hr>
                <div style="text-align: center">
                    <a href="{{ route('login') }}" class="text-center">{{__('Login')}}</a>
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
                "{{ route('register') }}",
                $('#register-form').serialize(),
                function(response) {
                    show_message("{{__('Registered: Please Wait')}}")
                    window.location = "{{ url('') }}" + response
                },
                function(response) {
                    console.log(response);
                    show_error(response)
                    hide_loading()
                }
            )
        }
    </script>
@endsection
