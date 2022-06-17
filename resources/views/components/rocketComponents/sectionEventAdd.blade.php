 <!-- Форма создания события -->
 <form class="mb-5" action="" method="POST" enctype="multipart/form-data">

     @csrf

     <!-- Название -->
     <div class="mb-3">
         <label for="title" class="form-label">Название</label>
         <input name="title" type="text" id="title" value="{{ $title ?? @old('title') }}" class="form-control @error('title') is-invalid @enderror">
         @error('title')
         <div id="title" class="invalid-feedback">Придумайте название события</div>
         @enderror
     </div>
     <!-- /Название -->

     <!-- Описание -->
     <div class="mb-3">
         <label for="description" class="form-label">Описание</label>
         <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $description ?? @old('description') }}</textarea>
         <div id="description" class="form-text">Придумайте описание события не менее 120 символов</div>
         @error('description')
         <div id="description" class="invalid-feedback">Придумайте описание события</div>
         @enderror
     </div>
     <!-- /Описание -->


     @if(isset($preview))
     <img src="/public/img/previews/{{ $preview }}" class="rounded w-50 mb-3" alt="image">
     @endif


     <!-- Загрузка изображения -->
     <div class="mb-3">
         <label for="preview" class="form-label">Изображение</label>
         <input name="preview" type="file" id="preview" class="form-control">
     </div>
     <!-- /Загрузка изображения -->


     <!-- Выбо города -->
     @php
     // Просто массив значений
     $cityes = array(
     'Не имеет значения',
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

     @php
     $selected = '';
     // Если событие редактируется и $city существует
     if( isset($city) ) {
     $selected = $city;
     }
     // Если перед отправкой формы было установлено значение
     if( old('city') ) {
     $selected = old('city');
     }
     @endphp

     <div class="mb-3">
         <label for="city" class="form-label">Город</label>
         <select name="city" id="city" class="form-select @error('city') is-invalid @enderror">
             {{-- Вывод списка городов --}}
             @foreach($cityes as $city)

             {{-- Если $selected совпадает со значением из списка, то отображать его как selected --}}
             @if( $selected == $city )
             <option selected value="{{ $city }}">{{ $city }}</option>
             {{-- Иначе просто option --}}
             @else
             <option value="{{ $city }}">{{ $city }}</option>
             @endif

             @endforeach
         </select>
         @error('city')
         <div id="city" class="invalid-feedback">{{ $message }}</div>
         @enderror
     </div>
     <!-- /Выбор города -->

     <!-- Адрес -->
     <div class="mb-3">
         <label for="adress" class="form-label">Адрес</label>
         <input name="adress" type="text" id="adress" value="{{ $adress ?? @old('adress') }}" class="form-control @error('adress') is-invalid @enderror">
         <div id="adress" class="form-text">Укажите фактический адрес или ссылку</div>
         @error('adress')
         <div id="adress" class="invalid-feedback">Укажите адрес или ссылку</div>
         @enderror
     </div>
     <!-- /Адрес -->

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

     @php
     $selected = '';
     // Если событие редактируется и $category существует
     if( isset($category) ) {
     $selected = $category;
     }
     // Если перед отправкой формы было установлено значение
     if( old('category') ) {
     $selected = old('category');
     }
     @endphp
     <div class="mb-3">
         <label for="category" class="form-label">Категория</label>
         <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
             {{-- Вывод списка городов --}}
             @foreach($categories as $category)

             {{-- Если $selected совпадает со значением из списка, то отображать его как selected --}}
             @if( $selected == $category )
             <option selected value="{{ $category }}">{{ $category }}</option>
             {{-- Иначе просто option --}}
             @else
             <option value="{{ $category }}">{{ $category }}</option>
             @endif

             @endforeach
         </select>
         @error('category')
         <div id="title" class="invalid-feedback">{{ $message }}</div>
         @enderror
     </div>
     <!-- /Категория -->

     <div class="row">

         <!-- Дата начала -->
         @php
         if( isset($dateStart) ) {
         $dateStart = explode(' ', $dateStart);
         $dateStart = $dateStart[0];
         }
         @endphp
         <div class="col mb-3">
             <label for="date-start" class="form-label">Дата начала</label>
             <input name="date_start" type="date" id="date-start" value="{{ $dateStart ?? @old('date_start') }}" class="form-control @error('date_start') is-invalid @enderror">
             @error('date_start')
             <div id="title" class="invalid-feedback">Укажите время начала события</div>
             @enderror
         </div>
         <!-- /Дата начала -->

         <!-- Время начала -->
         <div class="col mb-3">
             <label for="time-start" class="form-label">Время начала</label>
             <input name="time_start" type="time" id="time-start" value="{{ $timeStart ?? @old('time_start') }}" class="form-control @error('time_start') is-invalid @enderror">
             @error('time_start')
             <div id="title" class="invalid-feedback">{{ $message }}</div>
             @enderror
         </div>
         <!-- /Время начала -->

     </div>

     <div class="row">

         <!-- Дата окончания -->
         @php
         if( isset($dateEnd) ) {
         $dateEnd = explode(' ', $dateEnd);
         $dateEnd = $dateEnd[0];
         }
         @endphp
         <div class="col mb-3">
             <label for="date-end" class="form-label">Дата окончания</label>
             <input name="date_end" type="date" id="date-end" value="{{ $dateEnd ?? @old('date_end') }}" class="form-control @error('date_end') is-invalid @enderror">
             @error('date_end')
             <div id="date_end" class="invalid-feedback">{{ $message }}</div>
             @enderror
         </div>
         <!-- /Дата окончания -->

         <!-- Время окончания -->
         <div class="col mb-3">
             <label for="time-end" class="form-label">Время окончания</label>
             <input name="time_end" type="time" id="time-end" value="{{ $timeEnd ?? @old('time_end') }}" class="form-control @error('time_end') is-invalid @enderror">
             @error('time_end')
             <div id="time_end" class="invalid-feedback">{{ $message }}</div>
             @enderror
         </div>
         <!-- /Время окончания -->

     </div>

     <div>

         <!-- Формат участия -->
         @php
         // Управление состоянием радио-кнопок
         $free_checked = 'checked';
         $donate_checked = '';
         $price_checked = '';

         if( isset($priceType) && $priceType === 'free' || old('price_type') === 'free' ) {
         $free_checked = 'checked';
         }

         if( isset($priceType) && $priceType === 'donate' || old('price_type') === 'donate' ) {
         $donate_checked = 'checked';
         }

         if( isset($priceType) && $priceType === 'price' || old('price_type') === 'price' ) {
         $price_checked = 'checked';
         }
         @endphp
         <div class="col d-flex gap-3">
             <!-- Бесплатно -->
             <div class="form-check mb-0">
                 <input name="price_type" type="radio" id="free" value="free" class="form-check-input @error('price_type') is-invalid @enderror" {{ $free_checked }}>
                 <label class="form-check-label" for="free">Бесплатно</label>
             </div>
             <!-- /Бесплатно -->
             <!-- Донат -->
             <div class="form-check mb-0">
                 <input name="price_type" type="radio" id="donate" value="donate" class="form-check-input @error('price_type') is-invalid @enderror" {{ $donate_checked }}>
                 <label class="form-check-label" for="donate">Донат</label>
             </div>
             <!-- /Донат -->
             <!-- Цена -->
             <div class="form-check mb-0">
                 <input name="price_type" type="radio" id="price" value="price" class="form-check-input @error('price_type') is-invalid @enderror" {{ $price_checked }}>
                 <label class="form-check-label" for="price">Цена</label>
             </div>
             <!-- /Цена -->
         </div>
         <!-- /Формат участия -->

         <div class="col mb-3">
             @error('price_type')
             <div id="price_type" class="invalid-feedback" style="display: block;">Выберите условие участия</div>
             @enderror
         </div>

         <!-- Стоимость -->
         @php
         // Управление состоянием поля цены
         $disabled = 'disabled';
         if( isset($priceType) && $priceType === 'price' || old('price_type') === 'price' ) {
         $disabled = '';
         }
         @endphp
         <div class="mb-4">
             <input name="cost" type="number" id="cost" value="{{ $cost ?? @old('cost') }}" placeholder="Цена в рублях" class="form-control @error('cost') is-invalid @enderror" {{ $disabled }}>
             @error('cost')
             <div id="cost" class="invalid-feedback">Укажите стоимость участия, если выбираете "Цена"</div>
             @enderror
         </div>
         <!-- /Стоимость -->

         <!-- Свидетель -->
         @if($userWitness === 1)
         <div class="form-check mb-3">
             <input name="event_witness" type="checkbox" id="witness" class="form-check-input" @if( isset($eventWitness) && $eventWitness===1 || old('event_witness') ) checked @endif>
             <label class="form-check-label" for="witness">Свидетель события</label>
         </div>

         <div class="mb-4">
             <!-- <label class="form-label" for="source">Информация об организаторе</label> -->
             <input name="source" type="text" id="source" class="form-control" @if ( empty($eventWitness) || $eventWitness != 1 ) disabled @endif placeholder="Оставьте ссылку на источник">
         </div>
         @endif
         <!-- /Свидетель -->



         <div class="d-flex justify-content-between gap-3">
             <button name="form_name" type="submit" value="add" class="btn btn-warning flex-fill">Сохранить</button>
             <button type="button" class="btn btn-light border flex-fill" data-bs-toggle="modal" data-bs-target="#actionConfirm">Удалить</button>
         </div>
 </form>
 <!-- /Форма создания события -->

 <!-- Модальное окно подтверждения действия -->
 {{-- Если есть идентификатор события, значит событие уже создано и это точно форма редактирования --}}
 @if( isset($id) )
 <x-rocketComponents.modalWindowSure :id="$id">
 </x-rocketComponents.modalWindowSure>
 @endif
 <!-- /Модальное окно подтверждения действия -->