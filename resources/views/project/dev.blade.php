<form action="" method="post" class="form-filters border mb-3">

    @csrf

    @php
    $now = date('Y-m-d');

    // это, чтобы дата окончания в форме не оставалась пустой при переходе
    if ( isset($_POST['date_end']) ) {
    $de = $_POST['date_end'];
    }

    @endphp

    <div class="row bg-gray">
        

        <div class="col-6 mb-3">
            <label for="date-start" class="form-label">От</label>
            <input name="date_start" type="date" class="form-control" id="date-start" aria-describedby="emailHelp" value="{{ $now }}">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>

        <div class="col-6 mb-3">
            <label for="date-end" class="form-label">До</label>
            <input name="date_end" type="date" class="form-control" id="date-end" aria-describedby="emailHelp" value="{{ $de ?? '' }}">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>

        {{-- <!-- Категоия --> --}}
        <div class="col mb-3">
            <label for="category" class="form-label">Категория</label>
            <select name="category" class="form-control @error('category') is-invalid @enderror" id="category">
                @php
                $categories = array(
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

                <option selected value="">Не имеет значения</option>
                @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
                @endforeach

            </select>

        </div>

    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Город</label>
        <select name="city" class="form-control" id="city">

            @php
            $cityes = array(
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

            <option value="">Не имеет значения</option>
            @foreach ($cityes as $city)
            <option value="{{ $city }}">{{ $city }}</option>
            @endforeach

        </select>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">Искать</button>
    </div>

</form>