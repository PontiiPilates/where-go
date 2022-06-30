<label for="category" class="form-label">Категория</label>
<select name="category" id="category" class="form-select">
    <option value="">Не имеет значения</option>

    @foreach($localstorage['categories'] as $category)
    @if (Request::input('category') == $category)
    <option selected value="{{ $category }}">{{ $category }}</option>
    @else
    <option value="{{ $category }}">{{ $category }}</option>
    @endif
    @endforeach

</select>