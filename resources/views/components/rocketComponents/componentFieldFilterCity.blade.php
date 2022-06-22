<label for="city" class="form-label">Город</label>
<select name="city" id="city" class="form-select">
    <option value="">Не имеет значения</option>

    @foreach( $localstorage['cityes'] as $city )
    @if ( Request::input('city') == $city )
    <option selected value="{{ $city }}">{{ $city }}</option>
    @else
    <option value="{{ $city }}">{{ $city }}</option>
    @endif
    @endforeach
    
</select>