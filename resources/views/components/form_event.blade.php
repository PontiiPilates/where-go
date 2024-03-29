<form class="mb-5" action="" method="POST" enctype="multipart/form-data" id="form_event">

    @csrf

    {{-- Название --}}
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input name="title" type="text" id="title" class="form-control @error('title') is-invalid @enderror"
            value="{{ $event->title ?? @old('title') }}">
        @error('title')
        <div id="title" class="invalid-feedback">Придумайте название события</div>
        @enderror
    </div>

    {{-- Описание --}}
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        {{-- Wysiwyg --}}
        <x-field_wysiwyg></x-field_wysiwyg>
        {{-- Fake field --}}
        <div class="form-control editor" id="wysiwyg" contenteditable="true">{!! $event->description ??
            @old('description') !!}</div>
        {{-- True field --}}
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
            cols="30" rows="5" style="display: none;">{{ $event->description ?? @old('description') }}</textarea>
        @error('description')
        <div id="description" class="invalid-feedback">Придумайте описание события не менее 120 символов</div>
        @enderror
    </div>

    {{-- Изображение --}}
    @isset($event->preview)
    <img src="/public/img/previews/{{ $event->preview }}" class="rounded w-50 mb-3" alt="image">
    @endisset

    {{-- Загрузка изображения --}}
    <div class="mb-3">
        <label for="preview" class="form-label">Изображение</label>
        <input name="preview" type="file" id="preview" class="form-control @error('preview') is-invalid @enderror">
        @error('preview')
        <div id="preview" class="invalid-feedback">Изображение должно быть в формате: .jpg или .png</div>
        @enderror
    </div>

    {{-- Адрес --}}
    <div class="mb-3">
        <label for="adress" class="form-label">Место встречи</label>
        <input name="adress" type="text" id="adress" class="form-control @error('adress') is-invalid @enderror"
            value="{{ $event->adress ?? @old('adress') }}" placeholder="ост. Театр Пушкина">
        @error('adress')
        <div id="adress" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Категория --}}
    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
            @foreach($localstorage['categories'] as $category)
            @if( isset($event) && $event->category == $category || old('category') == $category)
            <option selected value="{{ $category }}">{{ $category }}</option>
            @else
            <option value="{{ $category }}">{{ $category }}</option>
            @endif
            @endforeach
        </select>
        @error('category')
        <div id="category" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Дополнительные фасеты --}}
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input name="facet_child" type="checkbox" id="facet-child" class="form-check-input" @if(
                isset($event->facet_child) ||
            old('facet_child') ) checked @endif>
            <label class="form-check-label" for="facet-child">В эти выходные</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="facet_weekends" type="checkbox" id="facet-weekends" class="form-check-input" @if(
                isset($event->facet_weekends) ||
            old('facet_weekends') ) checked @endif>
            <label class="form-check-label" for="facet-weekends">Можно с детьми</label>
        </div>
    </div>

    <div class="row">
        {{-- Дата начала --}}
        <div class="col mb-3">
            <label for="date-start" class="form-label">Дата начала</label>
            <input name="date_start" type="date" id="date-start"
                class="form-control @error('date_start') is-invalid @enderror"
                value="{{ $event->date_start ?? @old('date_start') }}">
            @error('date_start')
            <div id="title" class="invalid-feedback">Укажите время начала события</div>
            @enderror
        </div>
        {{-- Время начала --}}
        <div class="col mb-3">
            <label for="time-start" class="form-label">Время начала</label>
            <input name="time_start" type="time" id="time-start"
                class="form-control @error('time_start') is-invalid @enderror"
                value="{{ $event->time_start ?? @old('time_start') }}">
            @error('time_start')
            <div id="title" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        {{-- Дата окончания --}}
        <div class="col mb-3">
            <label for="date-end" class="form-label">Дата окончания</label>
            <input name="date_end" type="date" id="date-end"
                class="form-control @error('date_end') is-invalid @enderror"
                value="{{ $event->date_end ?? @old('date_end') }}">
            @error('date_end')
            <div id="date_end" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- Время окончания --}}
        <div class="col mb-3">
            <label for="time-end" class="form-label">Время окончания</label>
            <input name="time_end" type="time" id="time-end"
                class="form-control @error('time_end') is-invalid @enderror"
                value="{{ $event->time_end ?? @old('time_end') }}">
            @error('time_end')
            <div id="time_end" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col d-flex gap-3">
        {{-- Бесплатно --}}
        <div class="form-check mb-0">
            <input name="price_type" type="radio" id="free"
                class="form-check-input @error('price_type') is-invalid @enderror" @if( $event && $event->free ==
            'checked' || old('price_type') == 'free' ) checked @endif
            value="free">
            <label class="form-check-label" for="free">Бесплатно</label>
        </div>
        {{-- Донат --}}
        <div class="form-check mb-0">
            <input name="price_type" type="radio" id="donate"
                class="form-check-input @error('price_type') is-invalid @enderror" @if( $event && $event->donate ==
            'checked' || old('price_type') == 'donate' ) checked @endif
            value="donate">
            <label class="form-check-label" for="donate">Донат</label>
        </div>
        {{-- Цена --}}
        <div class="form-check mb-0">
            <input name="price_type" type="radio" id="price"
                class="form-check-input @error('price_type') is-invalid @enderror" @if( $event && $event->price ==
            'checked' || old('price_type') == 'price' ) checked @endif
            value="price">
            <label class="form-check-label" for="price">Цена от</label>
        </div>
    </div>

    <div class="col mb-3">
        @error('price_type')
        <div id="price_type" class="invalid-feedback" style="display: block;">Выберите формат участия</div>
        @enderror
    </div>

    {{-- Стоимость --}}
    <div class="mb-3">
        <input name="cost" type="number" id="cost" class="form-control @error('cost') is-invalid @enderror"
            value="{{ $event->cost ?? @old('cost') }}" @if( $event && $event->price_type != 'price' && old('price_type')
        != 'price' ) disabled @endif
        placeholder="Цена в рублях" class="form-control">
        @error('cost')
        <div id="cost" class="invalid-feedback">Укажите стоимость участия, если выбираете "Цена"</div>
        @enderror
    </div>

    {{-- Свидетель --}}
    @if( session('witness') )
    <div class="form-check mb-3">
        <input name="witness" type="checkbox" id="witness" class="form-check-input" @if( isset($event->witness) ||
        old('witness') ) checked @endif>
        <label class="form-check-label" for="witness">Свидетель события</label>
    </div>

    {{-- Источник --}}
    <div class="mb-4">
        <input name="source" type="text" id="source" class="form-control" value="{{ $event->source ?? @old('source') }}"
            @isset($event) @unless( $event->witness || old('witness' ) ) disabled @endunless
        @endisset
        placeholder="Cсылка на источник">
    </div>
    @endif

    <div class="d-flex justify-content-between gap-3">
        <button name="form_name" type="submit" value="add" class="btn btn-warning flex-fill">Сохранить</button>
        <button type="button" class="btn btn-light border flex-fill" data-bs-toggle="modal"
            data-bs-target="#actionConfirm">Удалить</button>
    </div>

</form>

{{-- Подтверждение удаления --}}
@isset( $event->id )
<x-modal_shure :id="$event->id"></x-modal_shure>
@endisset