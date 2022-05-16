<form action="" method="post" enctype="multipart/form-data">

    @csrf

    {{-- <!-- Изображение события --> --}}
    <div class="mb-3">

        @if(isset($event->preview))
        <img src="/public/img/previews/{{ $event->preview}}" class="img-thumbnail mb-2" alt="{{ $event->preview}}">
        @else
        <label for="preview" class="form-label">Изображение</label>
        @endif

        <input name="preview" type="file" class="form-control @error('preview') is-invalid @enderror" id="preview">
        @error('preview')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <!-- Название -->
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $event->title ?? old('title') }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Название -->

    <!-- Описание -->
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="5">{{ $event->description ?? old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Описание -->

    <!-- Город -->
    @php
    $cityes = array(
    'Не имеет значения',
    'Красноярск',
    'Норильск',
    'Ачинск',
    'Канск',
    'Железногорск',
    'Минусинск',
    'Зеленогорск',
    'Лесосибирск',
    'Назарово',
    'Шарыпово',
    'Сосновоборск',
    'Дивногорск',
    'Дудинка',
    'Боготол',
    'Енисейск',
    'Бородино',
    'Иланский',
    'Ужур',
    'Кодинск',
    'Уяр',
    'Заозерный',
    'Игарка',
    'Артемовск',
    );
    @endphp
    <div class="mb-3">
        <label for="city" class="form-label">Город</label>
        <select name="city" class="form-control @error('city') is-invalid @enderror" id="city">
            @foreach ($cityes as $city)
            @if (isset($event->city) && $event->city == $city)
            <option selected value="{{ $city }}">{{ $city }}</option>
            @else
            <option value="{{ $city }}">{{ $city }}</option>
            @endif
            @endforeach
        </select>
        @error('city')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Город -->

    <!-- Категория -->
    @php
    $categories = array(
    //*
    'Не имеет значения',
    //* Б
    'Бизнес',
    //* В
    'Вечеринка',
    'Выставка',
    //* Д
    'Досуг',
    //* З
    'Здоровье',
    //* И
    'Игры',
    'Искусство',
    //* К
    'Карьера',
    'Кино',
    'Конференция',
    'Концерт',
    'Культура',
    'Курсы',
    //* Э
    'Эзотерика',
    //* М
    'Мастер-классы',
    'Музыка',
    //* Н
    'Наука',
    //* О
    'Общение',
    'Образование',
    'Отдых',
    'Онлайн',
    //* Р
    'Развлечения',
    //* С
    'Семинар',
    'Спорт',
    'Стендап',
    //* Т
    'Туризм',
    //* Х
    'Хобби',
    //* Ш
    'Шоу',
    //*
    'Другое',
    );
    @endphp
    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
            @foreach ($categories as $category)
            @if (isset($event->category) && $event->category == $category)
            <option selected value="{{ $category }}">{{ $category }}</option>
            @else
            <option value="{{ $category }}">{{ $category }}</option>
            @endif
            @endforeach
        </select>
        @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Категория -->

    <!-- Адрес -->
    <div class="mb-3">
        <label for="adress" class="form-label">Адрес</label>
        <input name="adress" type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" value="{{ $event->adress ?? old('adress') }}">
        @error('adress')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Адрес -->

    <div class="row">
        <!-- Дата начала -->
        <div class="col mb-3">
            <label for="date-start" class="form-label">Дата начала</label>
            @php
            $date_start = '';
            if(isset($event->date_start)) {
            $date_start = substr($event->date_start, 0, -9);
            }
            @endphp
            <input name="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" id="date-start" value="{{ $date_start ?? old('date_start') }}">
            @error('date_start')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- /Дата начала -->

        <!-- Время начала -->
        <div class="col mb-3">
            <label for="time-start" class="form-label">Время начала</label>
            <input name="time_start" type="time" class="form-control @error('time_start') is-invalid @enderror" id="time-start" value="{{ $event->time_start ?? old('time_start') }}">
            @error('time_start')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- /Время начала -->
    </div>

    <div class="row">
        <!--Ддата окончания -->
        <div class="col mb-3">
            <label for="date-end" class="form-label">Дата окончания</label>
            <input name="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" id="date-end" value="{{ $event->date_end ?? old('date_end') }}">
            @error('date_end')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- /Дата окончания -->

        <!-- Время окончания -->
        <div class="col mb-3">
            <label for="time-end" class="form-label">Время окончания</label>
            <input name="time_end" type="time" class="form-control @error('time_end') is-invalid @enderror" id="time-end" value="{{ $event->time_end ?? old('time_end') }}">
            @error('time_end')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- /Время окончания -->
    </div>


    <!-- Бесплатно -->
    <div class="form-check form-check-inline mb-3">
        <input class="form-check-input r-f-free @error('price_type') is-invalid @enderror" type="radio" name="price_type" id="free" value="free" @if(isset($event->price_type) && $event->price_type == 'free') checked @else checked @endif>
        <label class="form-check-label" for="free">Бесплатно</label>
        @error('price_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Бесплатно -->

    <!-- Донат -->
    <div class="form-check form-check-inline">
        <input class="form-check-input r-f-donate @error('price_type') is-invalid @enderror" type="radio" name="price_type" id="donate" value="donate" @if(isset($event->price_type) && $event->price_type == 'donate') checked @endif>
        <label class="form-check-label" for="donate">Донат</label>
        @error('price_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Донат -->

    <!-- Цена -->
    <div class="form-check form-check-inline">
        <input class="form-check-input r-f-price @error('price_type') is-invalid @enderror" type="radio" name="price_type" id="price" value="price" @if(isset($event->price_type) && $event->price_type == 'price') checked @endif>
        <label class="form-check-label" for="price">Цена</label>
        @error('price_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Цена -->


    <!-- Сумма -->
    <div class="mb-3">
        <input name="cost" type="number" class="form-control r-f-cost @error('cost') is-invalid @enderror" id="cost" value="{{ $event->cost ?? old('cost') }}" placeholder="Цена в руб." @if(!isset($event->price_type) || $event->price_type !== 'price' ) disabled @endif>
        @error('cost')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- /Сумма -->

    {{--
        Добавить сюда возможность быть свидетелем
        При выборе, данные будут заноситься в аналогичное поле в таблице эвентов
        Событие взятое из эвентов будет проверяться на состояние этого поля и влиять на отображение блока контактов
    --}}

    @if($status)
    <div class="form-check mb-3">
        <input name="witness" class="form-check-input" type="checkbox" value="1" id="witness"  @if(isset($event->witness) && $event->witness == 1) checked @endif>
        <label class="form-check-label" for="witness">{{ __('Свидетель события') }}</label>
    </div>
    @endif


    <div class="d-flex justify-content-between gap-2 mb-3">
        @if (isset($event->id))
        <a href="/delete/event/{{ $event->id ?? '' }}" class="btn btn-secondary w-100">Удалить</a>
        @endif
        <button type="submit" class="btn btn-primary w-100">{{ __('Сохранить') }}</button>
    </div>

</form>