@extends('layouts.curation.profile')

@section('profile-header')
    {{ $institute->name }}
@stop

@section('profile-tabs')
    <li class="width-f pl mg0a active">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#add-institution">
            Institution Profile
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#add-school">
            Add School/Faculty
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#view-school">
            View Schools
        </a>
    </li>
@stop

@section('profile-tab-content')
    <div id="add-institution" class="width-f pl mg20b tab-pane active">
        @include('curation.institution.new')
    </div>
    <div id="add-school" class="width-f pl mg20b tab-pane">
        @include('curation.school.new')
    </div>
    <div id="view-school" class="width-f pl mg20b tab-pane">
        <div class="width-f pl">
            @forelse($faculties = $institute->faculties()->paginate(getPageSize()) as $faculty)
                <div class="width-f pl">
                    {!! delete_form(['url' => route('curation_school_destroy', ['institute' => $faculty->institute->url, 'faculty' => $faculty->url])]) !!}
                <a href="{{ route('curation_school_show', ['institute' => $institute->url, 'faculty' => $faculty->url]) }}" class="width25 pl textc pg5a mg5b">
                    <div class="pl hgt120 bggiga5 z-depth-1 pg5a br2">
                        <div class="div-vertical">
                            <h4 class="custom-header5 crff">
                                {{ $faculty->name }}
                            </h4>
                        </div>
                    </div>
                </a></div>
            @empty
                <span class="alert alert-info width-f pl">No faculties found</span>
            @endforelse
        </div>
        {!! $faculties->render() !!}
    </div>

@stop