<form action="" method="post" enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input name="title" type="text" class="form-control" id="title" value="{{ $event->title ?? '' }}">
        <!-- <div id="emailHelp" class="form-text">Подсказка.</div> -->
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ $event->description ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Город</label>
        <select name="city" class="form-control" id="city">

            @php
                $cityes = array(
                'Абакан',
                'Ачинск',
                'Дивногорск',
                'Железхногорск',
                'Красноярск',
                'Минусинск',
                'Сосновоборск',
                );
            @endphp

            @foreach ($cityes as $city)

                @if ($event->city == $city)
                    <option selected value="{{ $city }}">{{ $city }}</option>
                @else
                    <option value="{{ $city }}">{{ $city }}</option>
                @endif

            @endforeach

        </select>
    </div>


    <div class="mb-3">
        <label for="category" class="form-label">Категория</label>
        <select name="category" class="form-control" id="category">
            
            @php
                $categories = array(
                'Спорт',
                'Туризм',
                'Развлечения',
                'Эзотерика',
                'Другое',
                'Шоу',
                'Кино',
                );
            @endphp

            @foreach ($categories as $category)

            @if ($event)

                @if ($event->category == $category)
                    <option selected value="{{ $category }}">{{ $category }}</option>
                @else
                    <option value="{{ $category }}">{{ $category }}</option>
                @endif
                    
            @else
                <option value="{{ $category }}">{{ $category }}</option>
            @endif

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label for="adress" class="form-label">Адрес</label>
        <input name="adress" type="text" class="form-control" id="adress" value="{{ $event->adress }}">
    </div>

    <div class="mb-3">
        <label for="date-start" class="form-label">Дата начала</label>
        <input name="date_start" type="date" class="form-control" id="date-start" value="{{ $event->date_start }}">
    </div>

    <div class="mb-3">
        <label for="time-start" class="form-label">Время начала</label>
        <input name="time_start" type="time" class="form-control" id="time-start" value="{{ $event->time_start }}">
    </div>

    <div class="mb-3">
        <label for="date-end" class="form-label">Дата окончания</label>
        <input name="date_end" type="date" class="form-control" id="date-end" value="{{ $event->date_end }}">
    </div>

    <div class="mb-3">
        <label for="time-end" class="form-label">Время окончания</label>
        <input name="time_end" type="time" class="form-control" id="time-end" value="{{ $event->time_end }}">
    </div>

    <div class="mb-3">
        <label for="preview" class="form-label">Превью</label>
        <input name="preview" type="file" class="form-control" id="preview">
        <div id="preview" class="form-text">{{ $event->preview }}</div>
    </div>

    <div class="mb-3">
        <label for="cost" class="form-label">Цена</label>
        <input name="cost" type="number" class="form-control" id="cost" value="{{ $event->cost }}">
    </div>

    <div class="mb-3 form-check">

        @php
        if( $event->free == 'on' ) {
            $c = 'checked';
        }
        @endphp
        
        <input name="free" type="checkbox" class="form-check-input" id="free" {{ $c ?? '' }}>
        <label class="form-check-label" for="free">Бесплатно</label>
    </div>

    <!-- <div class="mb-3">
        <label for="" class="form-label">X</label>
        <input name="" type="" class="form-control" id="">
    </div> -->

    <button type="submit" class="btn btn-success">Обновить</button>
    <a href="/delete/event/{{ $event->id }}" class="btn btn-danger">Удалить</a>

</form>