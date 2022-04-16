@extends('layouts.main')
@section('login')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card w-75 shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                    <path d="M2365 5104 c-364 -35 -644 -114 -950 -266 -239 -120 -430 -255 -627 -447 -415 -402 -663 -884 -755 -1471 -26 -165 -26 -567 1 -735 69 -441 230 -824 498 -1183 98 -132 347 -379 488 -484 347 -259 723 -418 1150 -488 159 -26 591 -29 748 -5 742 111 1371 508 1776 1123 216 328 353 696 406 1095 15 117 12 533 -5 652 -135 955 -758 1729 -1656 2061 -136 50 -360 107 -509 129 -100 15 -475 28 -565 19z m1787 -2025 c351 -877 633 -1595 628 -1597 -11 -4 -27 1 -730 256 -289 105 -768 279 -1065 386 l-540 196 -420 -420 -420 -420 -648 0 c-356 0 -647 3 -647 7 0 14 3185 3193 3195 3190 5 -2 296 -721 647 -1598z"/>
                                    <path d="M2946 2821 c-271 -271 -456 -463 -452 -470 9 -14 1272 -16 1281 -1 5 9 -348 906 -364 922 -3 4 -213 -199 -465 -451z"/>
                                </g>
                            </svg>

                            <h3 class="mb-4">
                                {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}
                            </h3>

                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button onclick="location.href='/google/login'" class="btn btn-block btn-dark mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                            <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z"/>
                                            <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z"/>
                                            <path fill="#FBBC05" d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z"/>
                                            <path fill="#EA4335" d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z"/>
                                        </g>
                                    </svg>
                                    <span> Вход через Google</span>
                                </button>

                                <button onclick="location.href='/vk/login'" class="btn btn-block btn-dark mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f5f5f5" class="st0" d="M13.162 18.994c.609 0 .858-.406.851-.915-.031-1.917.714-2.949 2.059-1.604 1.488 1.488 1.796 2.519 3.603 2.519h3.2c.808 0 1.126-.26 1.126-.668 0-.863-1.421-2.386-2.625-3.504-1.686-1.565-1.765-1.602-.313-3.486 1.801-2.339 4.157-5.336 2.073-5.336h-3.981c-.772 0-.828.435-1.103 1.083-.995 2.347-2.886 5.387-3.604 4.922-.751-.485-.407-2.406-.35-5.261.015-.754.011-1.271-1.141-1.539-.629-.145-1.241-.205-1.809-.205-2.273 0-3.841.953-2.95 1.119 1.571.293 1.42 3.692 1.054 5.16-.638 2.556-3.036-2.024-4.035-4.305-.241-.548-.315-.974-1.175-.974h-3.255c-.492 0-.787.16-.787.516 0 .602 2.96 6.72 5.786 9.77 2.756 2.975 5.48 2.708 7.376 2.708z"/></svg>
                                    <span> Вход через VK</span>
                                </button>
                            </div>

                            <hr class="my-4">

                            <!--form start-->

                            @isset($url)
                                <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                            @else
                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @endisset
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        @if (Route::has('password.request'))<a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>@endif
                                    </div>
                                </form>
                            <!--form end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
