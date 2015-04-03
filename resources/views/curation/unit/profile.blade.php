@extends('layouts.curation.profile')

@section('profile-header')
    {{ $unit->course->faculty->institute->name }}
    {{ $unit->course->faculty->name }}
    {{ $unit->course->name }}
    {{ $unit->name }}
@stop

@section('profile-tabs')
    <li class="width-f pl mg0a active">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#school-profile">
            Unit Profile
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#add-course">
            Add Topic
        </a>
    </li>
    <li class="width-f pl mg0a">
        <a class="width-f pl pg10a" href="#" data-toggle="tab" data-target="#view-course">
            View Topics
        </a>
    </li>
@stop

@section('profile-tab-content')
    <div id="school-profile" class="width-f pl mg20b tab-pane active">
        @include('curation.unit.new')
    </div>
    <div id="add-course" class="width-f pl mg20b tab-pane">
        @include('curation.topic.new')
    </div>
    <div id="view-course" class="width-f pl mg20b tab-pane">
        <div class="width-f pl">
            @forelse($topics = $unit->topics()->paginate(getPageSize()) as $topic)
                <a class="width25 pl textc pg5a mg5b crp">
                    {!! delete_form(['url' => route('curation_topic_destroy', ['institute' => $topic->unit->course->faculty->institute->url, 'faculty' => $topic->unit->course->faculty->url, 'degree' => $topic->unit->course->url, 'entity' => $topic->unit->url, 'topic' => $topic->url])]) !!}
                    <div class="width-f pl hgt120 bggiga5 z-depth-1 pg5a br2">
                        <div class="div-vertical">
                            <h4 class="custom-header5 crff">
                                {{ $topic->name }}
                            </h4>
                        </div>
                    </div>
                </a>
            @empty
                <span class="alert alert-info width-f pl">No topics found</span>
            @endforelse
        </div>
        {{ $topics->render() }}
    </div>

@stop