<div class="width-f pl tb-style1 bor1 bora borcdd">
    {!! $facultyForm !!}
    <div class="width-f pl pg10a">
        <label for="">
            <i class="fa fa-institution mg5r"></i>
            Name
        </label>
        <div class="width-f pl">
            {{-- Texfield for Name--}}
            {!! Form::text('name', null, ['class' => 'input', 'placeholder' => 'School name']) !!}
        </div>
    </div>
    <div class="width-f pl pg10a">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-user mg5r"></i>
                Dean of The School
            </label>
            <div class="width-f pl">
                {{-- Texfield for Dean--}}
                {!! Form::text('dean', null, ['class' => 'input', 'placeholder' => 'Dean of school']) !!}
            </div>
        </div>
        {{--<div class="width50 pl pg10l">
            <label for="">
                <i class="fa fa-photo mg5r"></i>
                Logo
            </label>
            <div class="width-f pl">
                <div class="width150x hgt150 mgalr ovh mg10b">
                    <img src="../images/manpic.png" alt="" class="width-f"/>
                </div>
                <input class="input" type="file" placeholder="Photo"/>
            </div>
        </div>--}}
    </div>
    <div class="width-f pl pg10a">
        <div class="width-f pl pg10r">
            <label for="">
                <i class="fa fa-envelope mg5r"></i>
                Contacts
            </label>
            <div class="width-f pl">
                {{-- Texfield for Contacts--}}
                {!! Form::text('contacts', null, ['class' => 'input', 'placeholder' => 'Contacts']) !!}
            </div>
        </div>
    </div>
    <div class="width-f pl pg10a">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-user mg5r"></i>
                Student Population
            </label>
            <div class="width-f pl">
                {{-- Texfield for Population--}}
                {!! Form::text('population', null, ['class' => 'input', 'placeholder' => 'Student population']) !!}
            </div>
        </div>
        <div class="width50 pl pg10l">
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