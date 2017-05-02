<div class="form-group">
    {!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', _('Slug'), ['class' => 'control-label']) !!}

    <div class="input-group m-b">
        {!! Form::input('text', 'slug', null, ['class' => 'form-control js-slug', 'data-require' => 'slug', 'data-source' => 'input[name=title]', 'data-locker' => '#slug-locker', 'data-check' => action('\Packages\PackageLecturersController@getCheckSlug'), 'data-check-status' => '#slug-check-status', 'required', 'placeholder' => _('Enter slug')]) !!}

        <label class="input-group-addon" id="slug-check-status">
            <i class="fa fa-pencil text-muted"></i>
        </label>

        <label class="input-group-addon">
            <input type="checkbox" id="slug-locker">
            {{ _('manual') }}
        </label>

    </div>

</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
    {!! Form::label('position', _('Position'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'position', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('degree', _('Degree'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'degree', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', _('Body'), ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ['class' => 'form-control resize-v js-wysiwyg', 'cols' => 30, 'rows' => 10, 'data-require' => 'wysiwyg']) !!}
</div>

<div class="line line-dashed b-b line-lg"></div>


{!! inject_tpl(['StoragableFormBase', 'ChairsFormSelect'], isset($lecturer) ? $lecturer : 'Packages\Lecturer') !!}


<div class="form-group">
    {!! Form::label('birth', _('Birth data'), ['class' => 'control-label']) !!}
    <div class="input-group w-md">
        {!! Form::input('text', 'birth',
            isset($lecturer->birth) ? $lecturer->birth->format('d.m.Y') : null,
            [
                'class' => 'form-control w-md js-datepicker js-birth-time',
                'data-require' => 'datepicker',
                'data-timepick' => 'false',
                'data-drops' => 'up',
                'data-format' => 'DD.MM.YYYY'
            ])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', _('Email'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('telephone', _('Telephone'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'telephone', null, ['class' => 'form-control']) !!}
</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
    <input type="hidden" name="is_dean" value="0">

    <label class="checkbox-inline i-checks">
        {!! Form::checkbox('is_dean', 1, null, ['class' => 'js-is-active']) !!}<i></i> {{ _('is dean') }}
    </label>
</div>

<div class="form-group">
    <input type="hidden" name="is_active" value="0">

    <label class="checkbox-inline i-checks">
        {!! Form::checkbox('is_active', 1, null, ['class' => 'js-is-active']) !!}<i></i> {{ _('is active') }}
    </label>
</div>
