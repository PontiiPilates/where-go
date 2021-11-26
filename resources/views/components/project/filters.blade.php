<form action="" method="post">
    @csrf

    @php
        $now = date('Y-m-d');
    @endphp
    
    <div class="mb-3">
        <label for="date-start" class="form-label">От</label>
        <input name="date_start" type="date" class="form-control" id="date-start" aria-describedby="emailHelp" value="{{ $now }}">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>

    <div class="mb-3">
        <label for="date-end" class="form-label">До</label>
        <input name="date_end" type="date" class="form-control" id="date-end" aria-describedby="emailHelp">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>

    <!-- <div class="mb-3">
        <label for="category" class="form-label">Категория</label>

        <select name="category" class="form-control" id="category"> -->

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
    <!-- <option value="{{ $category }}">{{ $category }}</option> -->
    @endforeach

    <!-- </select>
    </div> -->

    <button type="submit" class="btn btn-primary">Искать</button>

</form>