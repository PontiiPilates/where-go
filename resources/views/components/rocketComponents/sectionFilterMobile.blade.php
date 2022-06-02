  <!-- Фильтр -->
  <div class="mb-5 d-lg-none">
      <form>
          <div class="mb-3">
              <label for="city" class="form-label">Город</label>
              <select name="city" id="city" class="form-select">
                  <option selected>Красноярск</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="category" class="form-label">Город</label>
              <select name="category" id="category" class="form-select">
                  <option selected>Развлечения</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="date-start" class="form-label">Искать от даты</label>
              <input name="date_start" id="date-start" class="form-control" type="date">
          </div>
          <button type="submit" class="btn btn-warning w-100 text-center"><i class="bi bi-search me-2"></i>Искать</button>
      </form>
  </div>
  <!-- /Фильтр -->