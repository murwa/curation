{{--


 Created by PhpStorm.
 User: peter.wanjala
 Date: 3/30/2015
 Time: 3:21 PM

 --}}

@extends('layouts.curation.main')

@section('body')
    <div class="custom-wrapper mg100t row">

        <div class="large-8 medium-10 columns center">
            <div class="width-f pl">

                <div class="row width-f pl welcome-classes">
                    <h2 class=""> Gigavia Content Curation</h2>

                    <p class="mg10b">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                        cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                        Praesent mauris. Fusce nec tellus sed augue semper porta.
                    </p>

                    <div class="width-f pl">
                        <ul class="width-f pl mg20b curation-tabs mg0a">
                            <li class="width30pc pl pg5lr active">
                                <a href="#" data-toggle="tab" data-target="#curation-listschool" class="width-f pl pg20a bgff bor1 bora borcdd br3 textc">
                                    <i class="fa fa-list fa-20x mg5r"></i>
                                    <h4 class="nomg nopg">List</h4>
                                </a>
                            </li>
                            <li class="width30pc pl pg5l">
                                <a href="#" data-toggle="tab" data-target="#curation-addschool" class="width-f pl pg20a bgff bor1 bora borcdd br3 textc">
                                    <i class="fa fa-plug fa-20x mg5r"></i>
                                    <h4 class="nomg nopg">Add </h4>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="xlarge-12 large-12 columns content-curation ">
                        <div class="width-f pl tab-content">
                            <div id="curation-listschool" class="width-f pl mg20b tab-pane active">
                                <div class="width-f pl">
                                    @forelse($institutes as $institute)
                                        <div class="width30pc pl">
                                            {!! delete_form(['url' => route('curation_institution_destroy', ['institute' => $institute->url])]) !!}
                                            <a href="{{ route('curation_institution_show', ['institution' => $institute->url]) }}"
                                               class="pl textc pg10a">
                                                <div class="width-f pl hgt150 bggiga5 z-depth-2">
                                                    <div class="div-vertical">
                                                        <h4 class="custom-header3 crff bold">
                                                            {{ $institute->name }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <span class="alert alert-info width-f pl">No Institution found</span>
                                    @endforelse

                                </div>
                                {!! $institutes->render() !!}
                            </div>
                            <div id="curation-addschool" class="width-f pl mg20b tab-pane">
                                @include('curation.institution.new')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
