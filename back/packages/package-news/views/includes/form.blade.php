<div class="form-group">
    {!! Form::hidden('lang', $lang) !!}
    {!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', _('Slug'), ['class' => 'control-label']) !!}

    <div class="input-group m-b">
        {!! Form::input('text', 'slug', null, ['class' => 'form-control js-slug', 'data-require' => 'slug', 'data-source' => 'input[name=title]', 'data-locker' => '#slug-locker', 'data-check' => action('\Packages\PackageNewsController@getCheckSlug'), 'data-check-status' => '#slug-check-status', 'required', 'placeholder' => _('Enter slug')]) !!}

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
    {!! Form::label('subtitle', _('Subtitle'), ['class' => 'control-label']) !!}
    {!! Form::input('text', 'subtitle', null, ['class' => 'form-control', 'autofocus']) !!}
</div>


<div class="form-group">
    {!! Form::label('body', _('Body'), ['class' => 'control-label']) !!}
    {!! Form::textarea('body', null, ['class' => 'form-control resize-v js-wysiwyg', 'cols' => 30, 'rows' => 8, 'data-require' => 'wysiwyg']) !!}
</div>


<div class="line line-dashed b-b line-lg"></div>


{!! inject_tpl([
        'NewsFormBase',
        'PublicationsFormBase',
        'LecturersFormBase',
        'NewsCategoryFormBase',
        'TagsFormBase',
        'LaboratoriesFormBase',
        'StatusesFormBase',
        'ChairsFormBase',
        'StoragableFormBase'
    ], isset($news) ? $news : "Packages\News") !!}


<div class="form-group">

    {!! Form::label('publish_at', _('Publication time'), ['class' => 'control-label']) !!}

    <div class="input-group w-md">

        {!! Form::input('text', 'publish_at', isset($news) ? $news->publish_at->format('d.m.Y H:i') : \Carbon\Carbon::now()->format('d.m.Y H:i'), ['class' => 'form-control w-md js-datepicker js-publish-time', 'data-require' => 'datepicker', 'data-timepick' => 'true', 'data-drops' => 'up', 'data-format' => 'DD.MM.YYYY HH:mm' , 'required' => 'required']) !!}

    </div>

</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
    <input type="hidden" name="is_active" value="0">

    <label class="checkbox-inline i-checks">
        {!! Form::checkbox('is_active', 1, null, ['class' => 'js-is-active']) !!}<i></i> {{_('is active')}}
    </label>
</div>

<div class="form-group">
    <input type="hidden" name="is_top" value="0">

    <label class="checkbox-inline i-checks">
        {!! Form::checkbox('is_top') !!}<i></i> {{_('is top')}}
    </label>
</div>

{!! inject_tpl(['NewsCheckBoxes'], isset($news) ? $news : "Packages\News") !!}
