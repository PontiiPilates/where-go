<x-rocketComponents.index
:stdVarFavourites="$stdVarFavourites"
:stdAvatar="$stdAvatar"
:userId="$userId">

        <!-- Фильтр -->
        <div class="mb-5 pb-3 d-lg-none">
          <form method="get" action="">

              {{-- Фильтр по городу --}}
              <div class="mb-3">
                  @php
                  // Просто массив значений
                  $cityes = array(
                  'Ачинск',
                  'Артемовск',
                  'Боготол',
                  'Бородино',
                  'Енисейск',
                  'Железногорск',
                  'Дивногорск',
                  'Дудинка',
                  'Заозерный',
                  'Зеленогорск',
                  'Игарка',
                  'Иланский',
                  'Канск',
                  'Кодинск',
                  'Красноярск',
                  'Лесосибирск',
                  'Минусинск',
                  'Назарово',
                  'Норильск',
                  'Сосновоборск',
                  'Ужур',
                  'Уяр',
                  'Шарыпово',
                  );
                  @endphp
                  <label for="city" class="form-label">Город</label>
                  <select name="city" id="city" class="form-select">
                      <option value="">Не имеет значения</option>
                      @foreach($cityes as $city)
                      @if (Request::input('city') == $city)
                      <option selected value="{{ $city }}">{{ $city }}</option>
                      @else
                      <option value="{{ $city }}">{{ $city }}</option>
                      @endif
                      @endforeach
                  </select>
              </div>
              {{-- /Фильтр по городу --}}

              {{-- Фильтр по категории --}}
              <div class="mb-3">
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
                  <label for="category" class="form-label">Категория</label>
                  <select name="category" id="category" class="form-select">
                      <option value="">Не имеет значения</option>
                      @foreach($categories as $category)
                      @if (Request::input('category') == $category)
                      <option selected value="{{ $category }}">{{ $category }}</option>
                      @else
                      <option value="{{ $category }}">{{ $category }}</option>
                      @endif
                      @endforeach
                  </select>
              </div>
              {{-- /Фильтр по категории --}}

              {{-- Фильтр по дате --}}
              @php
              $date_start = Request::input('date_start');
              @endphp
              <div class="mb-4">
                  <label for="date-start" class="form-label">
                      {{ __('Искать от даты') }}
                  </label>
                  <input name="date_start" id="date-start" class="form-control" type="date" value="{{ $date_start }}">
              </div>
              {{-- Фильтр по дате --}}

              <button name="filter" value="true" type="submit" class="btn btn-warning w-100 text-start">
                  <i class="bi bi-search me-2"></i>
                  {{ __('Искать') }}
              </button>
          </form>
      </div>
      <!-- /Фильтр -->

  <!-- Компонент: вывод списка событий -->
  <x-rocketComponents.componentEventList
    :events="$events"
    :bookmarks="$bookmarks">
  </x-rocketComponents.componentEventList>
  <!-- /Компонент: вывод списка событий -->

</x-rocketComponents.index>