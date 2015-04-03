<div class="width-f pl">
    <h3 class="custom-header3 textc">
        Add an Institution
    </h3>

    <div class="width-f pl tb-style1 bor1 bora borcdd">
        {!! $form !!}
        <div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-institution mg5r"></i>
                Name
            </label>

            <div class="width-f pl">
                {{-- Texfield for Name--}}
                {!! Form::text('name', null, ['class' => 'input', 'placeholder' => 'Institution Name']) !!}
            </div>
        </div>
        <div class="width-f pl pg10a">
            <div class="width50 pl pg10r">
                <label for="">
                    <i class="fa fa-calendar mg5r"></i>
                    Date of Establishment
                </label>

                <div class="width-f pl">
                    {{-- Texfield for Doe--}}
                    {!! Form::text('doe', null, ['class' => 'input', 'placeholder' => 'Date of establishment']) !!}
                </div>
            </div>
            <div class="width50 pl pg10l">
                <label for="">
                    <i class="fa fa-map-marker mg5r"></i>
                    Location (Physical Location)
                </label>

                <div class="width-f pl">
                    {{-- Texfield for Location--}}
                    {!! Form::text('location', null, ['class' => 'input', 'placeholder' => 'Location (physical)']) !!}
                </div>
            </div>
        </div>
        {{--<div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-photo mg5r"></i>
                Logo
            </label>

            <div class="width-f pl">
                <div class="width150x hgt150 mgalr ovh mg10b">
                    <img src="../images/manpic.png" alt="" class="width-f"/>
                </div>
                <input class="input" name="logo" type="file" placeholder="Photo"/>
            </div>
        </div>--}}
        <div class="width-f pl pg10a">
            <div class="width50 pl pg10r">
                <label for="">
                    <i class="fa fa-database mg5r"></i>
                    Category
                </label>

                <div class="width-f pl">
                    {!! Form::select('category', ['public' => 'Public', 'private' => 'Private'], null, []) !!}
                </div>
            </div>
            <div class="width50 pl pg10l">
                <label for="">
                    <i class="fa fa-clock-o mg5r"></i>
                    Intake Periods
                </label>

                <div class="width-f pl">
                    <label class="width50 pl mg5b crp">
                        <div class="pg0tb pg3lr pl custom-check">
                            <input id="intake-1" type="checkbox" name="intake-checkbox" value=""/>
                            <label for="intake-1">.</label>
                        </div>
                        <div class=" width_auto ovh pg10l">
                            <span class="pg2t pl">Intake 1</span>
                        </div>

                    </label>
                    <label class="width50 pl mg5b crp">
                        <div class="pg0tb pg3lr pl custom-check">
                            <input id="intake-2" type="checkbox" name="intake-checkbox" value=""/>
                            <label for="intake-2">.</label>
                        </div>
                        <div class=" width_auto ovh pg10l">
                            <span class="pg2t pl">Intake 1</span>
                        </div>

                    </label>
                    <label class="width50 pl mg5b crp">
                        <div class="pg0tb pg3lr pl custom-check">
                            <input id="intake-3" type="checkbox" name="intake-checkbox" value=""/>
                            <label for="intake-3">.</label>
                        </div>
                        <div class=" width_auto ovh pg10l">
                            <span class="pg2t pl">Intake 1</span>
                        </div>

                    </label>
                    <label class="width50 pl mg5b crp">
                        <div class="pg0tb pg3lr pl custom-check">
                            <input id="intake-4" type="checkbox" name="intake-checkbox" value=""/>
                            <label for="intake-4">.</label>
                        </div>
                        <div class=" width_auto ovh pg10l">
                            <span class="pg2t pl">Intake 1</span>
                        </div>

                    </label>

                </div>
            </div>
        </div>
        <div class="width-f pl pg10a">
            <div class="width50 pl pg10r">
                <label for="">
                    <i class="fa fa-institution mg5r"></i>
                    Campuses
                </label>

                <div class="width-f pl">
                    {{-- Texfield for Campuses--}}
                    {!! Form::text('campuses', null, ['class' => 'input', 'placeholder' => 'Campuses']) !!}
                </div>
            </div>
            <div class="width50 pl pg10l">
                <label for="">
                    <i class="fa fa-tag mg5r"></i>
                    Database Tag
                </label>

                <div class="width-f pl">
                    {{-- Texfield for Tag--}}
                    {!! Form::text('tags', null, ['class' => 'input', 'placeholder' => 'Database tag']) !!}
                </div>
            </div>
        </div>
        <div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-edit mg5r"></i>
                History
            </label>

            <div class="width-f pl">
                {{-- Textarea - History--}}
                {!! Form::textarea('history', null, ['class' => 'input custom-textarea', 'placeholder' => 'Institution
                History']) !!}
            </div>
        </div>
        <div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-edit mg5r"></i>
                Mision
            </label>

            <div class="width-f pl">
                {{-- Textarea - Mission--}}
                {!! Form::textarea('mission', null, ['class' => 'input custom-textarea', 'placeholder' => 'Institution
                mission']) !!}
            </div>
        </div>
        <div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-edit mg5r"></i>
                Vision
            </label>

            <div class="width-f pl">
                {{-- Textarea - Vision--}}
                {!! Form::textarea('vision', null, ['class' => 'input custom-textarea', 'placeholder' => 'Institution
                Vision']) !!}
            </div>
        </div>
        <div class="width-f pl pg10a">
            <label for="">
                <i class="fa fa-edit mg5r"></i>
                About
            </label>

            <div class="width-f pl">
                {{-- Textarea - About--}}
                {!! Form::textarea('about', null, ['class' => 'input custom-textarea', 'placeholder' => 'About
                Institution']) !!}
            </div>
        </div>
        <div class="width-f pl pg10a textc">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>