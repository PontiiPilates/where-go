 <!-- Форма создания события -->
 <form class="mb-5">
     <div class="mb-3">
         <label for="create-name" class="form-label">Название</label>
         <input name="create_name" type="email" class="form-control" id="create-name">
     </div>

     <div class="mb-3">
         <label for="create-description" class="form-label">Описание</label>
         <textarea name="create_description" class="form-control " id="create-description" cols="30" rows="5"></textarea>
     </div>

     <img src="/public/img/previews/2021_12_25__04_24_30__wsapy.jpeg" class="rounded w-50 mb-3" alt="image">

     <div class="mb-3">
         <label for="create-preview" class="form-label">Изображение</label>
         <input name="create_preview" type="file" class="form-control" id="create-preview">
     </div>

     <div class="mb-3">
         <label for="create-city" class="form-label">Город</label>
         <select name="create_city" id="create-city" class="form-select" aria-label="Default select example">
             <option selected>Красноярск</option>
             <option value="1">Абакан</option>
             <option value="2">Дивногорск</option>
             <option value="3">Магнитогорск</option>
         </select>
     </div>

     <div class="mb-3">
         <label for="create-category" class="form-label">Категория</label>
         <select name="create_category" id="create-category" class="form-select" aria-label="Default select example">
             <option selected>Развлечения</option>
             <option value="1">Карьера</option>
             <option value="2">Спорт</option>
             <option value="3">Отдых</option>
         </select>
     </div>

     <div class="row">
         <div class="col mb-3">
             <label for="create-date-start" class="form-label">Дата начала</label>
             <input name="create-date_start" type="date" class="form-control " id="create-date-start" value="">
         </div>
         <div class="col mb-3">
             <label for="create-time-start" class="form-label">Время начала</label>
             <input name="create_time_start" type="time" class="form-control " id="create-time-start" value="">
         </div>
     </div>

     <div class="row">
         <div class="col mb-3">
             <label for="create-date-end" class="form-label">Дата окончания</label>
             <input name="create_date_end" type="date" class="form-control " id="create-date-end" value="">
         </div>
         <div class="col mb-3">
             <label for="create-time-end" class="form-label">Время окончания</label>
             <input name="create_time_end" type="time" class="form-control " id="create-time-end" value="">
         </div>
     </div>

     <div class="form-check form-check-inline mb-3">
         <input class="form-check-input r-f-free " type="radio" name="create_price_type" id="free" value="free" checked="">
         <label class="form-check-label" for="free">Бесплатно</label>
     </div>

     <div class="form-check form-check-inline">
         <input class="form-check-input r-f-donate " type="radio" name="create_price_type" id="donate" value="donate">
         <label class="form-check-label" for="donate">Донат</label>
     </div>

     <div class="form-check form-check-inline">
         <input class="form-check-input r-f-price " type="radio" name="create_price_type" id="price" value="price">
         <label class="form-check-label" for="price">Цена</label>
     </div>

     <div class="mb-4">
         <input name="cost" type="number" class="form-control r-f-cost " id="cost" value="" placeholder="Цена в руб." disabled="">
     </div>

     <div class="form-check mb-4">
         <input name="witness" class="form-check-input" type="checkbox" value="1" id="witness">
         <label class="form-check-label" for="witness">Свидетель события</label>
     </div>

     <div class="d-flex justify-content-between gap-3">
         <button type="submit" class="btn btn-warning flex-fill">Сохранить</button>
         <a href="#" class="btn btn-light border flex-fill">Удалить</a>
     </div>
 </form>
 <!-- /Форма создания события -->


 <!-- Модальное окно подтверждения действия -->
 <x-rocketComponents.modalWindowSure></x-rocketComponents.modalWindowSure>
 <!-- /Модальное окно подтверждения действия -->