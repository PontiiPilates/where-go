<label for="date-start" class="form-label">{{ __('Искать от даты') }}</label>
<input name="date_start" id="date-start" class="form-control" type="date" value="{{ Request::input('date_start') }}">