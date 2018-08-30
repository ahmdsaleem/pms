@extends('layouts.layout')

@section('pageTitle')

    Profile

@endsection

@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/lib/ion-range-slider/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/ion-range-slider/ion.rangeSlider.skinHTML5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/elements/player.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/pages/profile-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

@endsection

@section('content')

    <div class="profile-header-photo">
        <div class="profile-header-photo-in">
            <div class="tbl-cell">
                <div class="info-block">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-9 col-xl-offset-3 col-lg-8 col-lg-offset-4 col-md-offset-0">
                                <div class="tbl info-tbl">
                                    <div class="tbl-row">
                                        <div class="tbl-cell">
                                            <p class="title">{{ $user->name }}</p>
                                            <p>{{ $user->position }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--.profile-header-photo-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <aside class="profile-side">
                    <section class="box-typical profile-side-user">
                        <button type="button" class="avatar-preview avatar-preview-128">
                            <img src="{{ asset('img/avatar-1-256.png') }}" alt=""/>
                            <span class="update">
									<i class="font-icon font-icon-picture-double"></i>
									Update photo
								</span>
                            <input type="file"/>
                        </button>

                        <div class="bottom-txt">{{ $user->name }}</div>
                    </section>


                    <section class="box-typical">
                        <header class="box-typical-header-sm bordered">About</header>
                        <div class="box-typical-inner">
                            <p>{{ $user->profile->about }}</p>
                        </div>
                    </section>

                    <section class="box-typical">
                        <header class="box-typical-header-sm bordered">Info</header>
                        <div class="box-typical-inner">
                            <p class="line-with-icon">
                                <i class="font-icon font-icon-pin-2"></i>
                                {{ $user->profile->address }}
                            </p>

                            <p class="line-with-icon">
                                <i class="font-icon font-icon-phone"></i>
                                {{ $user->profile->mobile }}
                            </p>

                            <p class="line-with-icon">
                                <i class="font-icon font-icon-facebook"></i>
                                {{ $user->profile->facebook }}
                            </p>

                            <p class="line-with-icon">
                                <i class="font-icon font-icon-earth"></i>
                                <a href="http://{{ $user->profile->website }}">{{ $user->profile->website }}</a>
                            </p>
                            <p class="line-with-icon">
                                <i class="font-icon font-icon-calend"></i>
                                {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </section>

                </aside><!--.profile-side-->
            </div>

            <div class="col-xl-9 col-lg-8">
                <section class="tabs-section">
                    <div class="tabs-section-nav tabs-section-nav-left">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">About me</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-2-tab-4" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div><!--.tabs-section-nav-->

                    <div class="tab-content no-styled profile-tabs">
                        <div role="tabpanel" class="tab-pane active" id="tabs-2-tab-1">
                            <section class="box-typical profile-settings">
                                <section class="box-typical-section">
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">Name</label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->name }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">Position</label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->profile->position }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">About</label>
                                        </div>
                                        <div class="col-xl-6">
												<textarea rows="4" class="form-control">{{ $user->profile->about }}</textarea>
                                        </div>
                                    </div>

                                </section>
                                <section class="box-typical-section">
                                    <header class="box-typical-header-sm">Info</header>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">
                                                <i class="font-icon font-icon-pin-2"></i>
                                                Address
                                            </label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->profile->address }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">
                                                <i class="font-icon font-icon-phone"></i>
                                                Phone
                                            </label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->profile->mobile }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">
                                                <i class="font-icon font-icon-facebook"></i>
                                                Facebook
                                            </label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->profile->facebook }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">
                                                <i class="font-icon font-icon-earth"></i>
                                                Web
                                            </label>
                                        </div>
                                        <div class="col-xl-4">
                                            <input class="form-control" type="text" value="{{ $user->profile->website }}"/>
                                        </div>
                                    </div>
                                </section>
                                <section class="box-typical-section profile-settings-btns">
                                    <button type="submit" class="btn btn-rounded">Save Changes</button>
                                    <button type="button" class="btn btn-rounded btn-grey">Cancel</button>
                                </section>
                            </section>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tabs-2-tab-4">
                            <section class="box-typical box-typical-padding">
                                Projects
                            </section>
                        </div><!--.tab-pane-->
                        <!--.tab-pane-->
                    </div><!--.tab-content-->
                </section><!--.tabs-section-->
            </div>
        </div><!--.row-->
    </div><!--.container-fluid-->
@endsection


@section('scripts')
    <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <script src="{{ asset('js/lib/salvattore/salvattore.min.js') }}"></script>
    <script src="{{ asset('js/lib/ion-range-slider/ion.rangeSlider.js') }}"></script>
    <script src="{{ asset('js/lib/fancybox/jquery.fancybox.pack.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                padding: 0,
                openEffect	: 'none',
                closeEffect	: 'none'
            });

            $("#range-slider-1").ionRangeSlider({
                min: 0,
                max: 100,
                from: 30,
                hide_min_max: true,
                hide_from_to: true
            });

            $("#range-slider-2").ionRangeSlider({
                min: 0,
                max: 100,
                from: 30,
                hide_min_max: true,
                hide_from_to: true
            });

            $("#range-slider-3").ionRangeSlider({
                min: 0,
                max: 100,
                from: 30,
                hide_min_max: true,
                hide_from_to: true
            });

            $("#range-slider-4").ionRangeSlider({
                min: 0,
                max: 100,
                from: 30,
                hide_min_max: true,
                hide_from_to: true
            });

        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>



@endsection