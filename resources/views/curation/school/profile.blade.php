@extends('layouts.curation.profile')

@section('profile-header')
    {{ $faculty->name }}
@stop

@section('profile-tabs')
    <li class="width-f pl mg0a active">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#school-profile">
            School Profile
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#add-course">
            Add Course/ Degree
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#view-course">
            View Courses/ Degrees
        </a>
    </li>
@stop

@section('profile-tab-content')
    <div id="school-profile" class="width-f pl mg20b tab-pane active">
        @include('curation.school.new')
    </div>
    <div id="add-course" class="width-f pl mg20b tab-pane">
        @include('curation.course.new')
    </div>
    <div id="view-course" class="width-f pl mg20b tab-pane">
        <div class="width-f pl">
            @forelse($courses = $faculty->courses()->paginate(getPageSize()) as $course)
                <div class="width25 pl">
                    {!! delete_form(['url' => route('curation_course_destroy', ['institute' =>
                    $course->faculty->institute->url, 'faculty' => $course->faculty->url, 'course' => $course->url])])
                    !!}
                    <a href="{{ route('curation_course_show', ['institute' => $faculty->institute->url, 'faculty' => $faculty->url, 'course' => $course->url]) }}"
                       class="pl textc pg5a mg5b">
                        <div class="width-f pl hgt120 bggiga5 z-depth-1 pg5a br2">
                            <div class="div-vertical">
                                <h4 class="custom-header5 crff">
                                    {{ $course->name }}
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <span class="alert alert-info width-f pl">No courses found</span>
            @endforelse
        </div>
        {!! $courses->render() !!}
    </div>

@stop