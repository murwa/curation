<div class="width-f pl tb-style1 bor1 bora borcdd">
    {!! $courseForm !!}
    <div class="width-f pl pg10a">
        <label for="">
            <i class="fa fa-graduation-cap mg5r"></i>
            Course Name
        </label>
        <div class="width-f pl">
            {{-- Texfield for Name--}}
            {!! Form::text('name', null, ['class' => 'input', 'placeholder' => 'Course Name']) !!}
        </div>
    </div>
    <div class="width-f pl pg10a">
        <label for="">
            <i class="fa fa-edit mg5r"></i>
            Course Description
        </label>
        <div class="width-f pl">
            {{-- Textarea - Descr--}}
            {!! Form::textarea('descr', null, ['class' => 'input custom-textarea', 'placeholder' => 'Course
            description']) !!}
        </div>
    </div>
    <div class="width-f pl pg10a">
        <label for="">
            <i class="fa fa-wrench mg5r"></i>
            Entry Requirement
        </label>
        <div class="width-f pl">
            {{-- Textarea - Requirements--}}
            {!! Form::textarea('requirements', null, ['class' => 'input custom-textarea', 'placeholder' => 'Entry
            requirements']) !!}
        </div>
    </div>
    <div class="width-f pl pg10a">
        <label for="">
            <i class="fa fa-briefcase mg5r"></i>
            Career Options
        </label>
        <div class="width-f pl">
            {{-- Textarea - Options--}}
            {!! Form::textarea('options', null, ['class' => 'input', 'placeholder' => 'Career options']) !!}
        </div>
    </div>
    <div class="width-f pl pg10a">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-user mg5r"></i>
                Course Population
            </label>
            <div class="width-f pl">
                {{-- Texfield for Population--}}
                {!! Form::text('population', null, ['class' => 'input', 'placeholder' => 'Course population']) !!}
            </div>
        </div>
        <div class="width50 pl pg10l">
            <label for="">
                <i class="fa fa-calendar mg5r"></i>
                Course Duration
            </label>
            <div class="width-f pl">
                {{-- Texfield for Duration--}}
                {!! Form::text('duration', null, ['class' => 'input', 'placeholder' => 'Course duration']) !!}
            </div>
        </div>
    </div>
    <div class="width-f pl pg10a">
        <div class="width-f pl">
            <label for="">
                <i class="fa fa-tag mg5r"></i>
                Database Tag
            </label>
            <div class="width-f pl">
                {{-- Texfield for Tags--}}
                {!! Form::text('tags', null, ['class' => 'input', 'placeholder' => 'Database tag']) !!}
            </div>
        </div>
    </div>
    <div class="width-f pl pg10a textc">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>