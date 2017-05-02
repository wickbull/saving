<div class="col">
    <div class="row">

        @foreach ($sliders as $slider)
            <div class="col-md-4 text-center m-t-sm gallery-check">
                <input
                    id="gallery-{{ $slider->id }}"
                    type="radio"
                    name="gallery"
                    value="{{ $slider->id }}"
                    data-title="{{ $slider->title }}"
                    data-date="{{ $slider->updated_at->format('Y-m-d') }}"
                />
                <label for="gallery-{{ $slider->id }}">
                    @if ($image = $slider->galleryImages->first())
                        <img src="{{ $image->image->thumb('100x100') }}" alt="">
                    @endif
                    <div class="info">
                        <p>{{ $slider->title }}</p>
                        <time datetime="{{ $slider->updated_at->format('Y-m-d') }}">
                            {{ $slider->updated_at->format('Y-m-d') }}
                        </time>
                    </div>
                </label>
            </div>
        @endforeach

    </div>
    <div class="row">
        <div class="col-md-12 text-center m-t-sm">
            {!! $sliders->render() !!}
        </div>
    </div>
</div>
