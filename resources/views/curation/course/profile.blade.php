@extends('layouts.curation.profile')

@section('profile-header')
    {{ $course->faculty->institute->name }}
    {{ $course->faculty->name }}
    {{ $course->name }}
@stop

@section('profile-tabs')
    <li class="width-f pl mg0a active">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#school-profile">
            Course/ Degree Profile
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#add-course">
            Add Unit
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#view-course">
            View Units
        </a>
    </li>
@stop

@section('profile-tab-content')
    <div id="school-profile" class="width-f pl mg20b tab-pane active">
        @include('curation.course.new')
    </div>
    <div id="add-course" class="width-f pl mg20b tab-pane">
        @include('curation.unit.new')
    </div>
    <div id="view-course" class="width-f pl mg20b tab-pane">
        <div class="width-f pl">
            @forelse($units = $course->units()->paginate(getPageSize()) as $unit)
                <div class="width25 pl">
                    {!! delete_form(['url' => route('curation_unit_show', ['institute' => $unit->course->faculty->institute->url, 'faculty' => $unit->course->faculty->url, 'course' => $unit->course->url, 'entity' => $unit->url])]) !!}
                    <a href="{{ route('curation_unit_destroy', ['institute' => $unit->course->faculty->institute->url, 'faculty' => $unit->course->faculty->url, 'course' => $unit->course->url, 'entity' => $unit->url]) }}"
                       class="pl textc pg5a mg5b">
                        <div class="width-f pl hgt120 bggiga5 z-depth-1 pg5a br2">
                            <div class="div-vertical">
                                <h4 class="custom-header5 crff">
                                    {{ $unit->name }}
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <span class="alert alert-info width-f pl">No courses found</span>
            @endforelse
        </div>
        {!! $units->render() !!}
    </div>

@stop