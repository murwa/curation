@extends('layouts.curation.main')

@section('body')
    <div class="custom-wrapper mg100t row">

        <div class="large-8 medium-10 columns center">
            <div class="width-f pl">

                <div class="row width-f pl">
                    <div class="width-f pl textc posr">
                        <h2 class="custom-header2 bold">

                            @yield('profile-header')

                        </h2>
                        <div class="pr posa right0 top0 mg10t">
                            <a href="#" data-toggle="modal" data-target="#edit-institution" class="btn btn-primary">Edit</a>
                        </div>
                    </div>

                    <div class="xlarge-3 large-3 show-l columns content-curation pg0a curation">
                        <div class="width-f pl z-depth-1 bor1 bora borccc bgff pg10a">
                            <ul class="width-f pl mg0a pg0a no-bullet side-tabs">
                                <!-- Tabs here -->
                                @yield('profile-tabs')
                            </ul>
                        </div>
                    </div>
                    <div class="xlarge-9 large-9 columns content-curation ">
                        <div class="width-f pl tab-content">
                            <!-- Tab content here -->
                            @yield('profile-tab-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop