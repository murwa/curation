<div class="width-f pl tb-style1 bor1 bora borcdd">
    {!! $unitForm !!}
    <div class="width-f pl pg10a">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-book mg5r"></i>
                Unit Code
            </label>
            <div class="width-f pl">
                {{-- Texfield for Code--}}
                {!! Form::text('code', null, ['class' => 'input', 'placeholder' => 'Unit Code']) !!}
            </div>
        </div>
        <div class="width50 pl pg10l">
            <label for="">
                <i class="fa fa-bookmark mg5r"></i>
                Unit Name
            </label>
            <div class="width-f pl">
                {{-- Texfield for Name--}}
                {!! Form::text('name', null, ['class' => 'input', 'placeholder' => 'Unit name']) !!}
            </div>
        </div>
    </div>
    <div class="width-f pl pg10a">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-clock-o mg5r"></i>
                No of Hours
            </label>
            <div class="width-f pl">
                {{-- Texfield for Duration--}}
                {!! Form::text('duration', null, ['class' => 'input', 'placeholder' => 'No. of hours']) !!}
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
    {!! Form::file('csv') !!}
    <div class="width-f pl pg10a textc">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>