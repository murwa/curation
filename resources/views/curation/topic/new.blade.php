<div class="width-f pl tb-style1 bor1 bora borcdd">
    {!! $topicForm !!}
    <div class="width-f pl pg10a ">
        <div class="width50 pl pg10r">
            <label for="">
                <i class="fa fa-edit mg5r"></i>
                Topic Name
            </label>
            <div class="width-f pl">
                {{-- Texfield for Name--}}
                {!! Form::text('name', null, ['class' => 'input', 'placeholder' => 'Topic name']) !!}
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
    <div class="width-f pl pg10a  textc">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>