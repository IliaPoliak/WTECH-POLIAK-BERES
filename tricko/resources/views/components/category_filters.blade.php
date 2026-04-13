<button type="button" onclick="toggleFiltersPanel()" class="toggle-filters-button">
  filtre
</button>

<aside class="category-filters" id="filters-panel">
  <form method="GET" action="">
    <h2>Použiť filtre:</h2>

    <div class="filter-section">
      <h3>Cena</h3>
      <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
        <input type="number" name="price_min" placeholder="od" value="{{ request('price_min') }}">
        <input type="number" name="price_max" placeholder="do" value="{{ request('price_max') }}">
      </div>
    </div>

    <div class="filter-section">
      <h3>Veľkosť</h3>
      <div style="display: flex; flex-wrap: wrap; gap: 10px;">
        <label><input type="radio" name="size" value="S" {{ request('size') == 'S' ? 'checked' : '' }}> S</label>
        <label><input type="radio" name="size" value="M" {{ request('size') == 'M' ? 'checked' : '' }}> M</label>
        <label><input type="radio" name="size" value="L" {{ request('size') == 'L' ? 'checked' : '' }}> L</label>
        <label><input type="radio" name="size" value="XL" {{ request('size') == 'XL' ? 'checked' : '' }}> XL</label>
      </div>
    </div>

    <div class="filter-section">
      <h3>Farba</h3>
      <div style="display: flex; flex-direction: column; gap: 10px;">
        <label><input type="radio" name="color" value="black" {{ request('color') == 'black' ? 'checked' : '' }}> Black</label>
        <label><input type="radio" name="color" value="blue" {{ request('color') == 'blue' ? 'checked' : '' }}> Blue</label>
        <label><input type="radio" name="color" value="red" {{ request('color') == 'red' ? 'checked' : '' }}> Red</label>
        <label><input type="radio" name="color" value="green" {{ request('color') == 'green' ? 'checked' : '' }}> Green</label>
        <label><input type="radio" name="color" value="yellow" {{ request('color') == 'yellow' ? 'checked' : '' }}> Yellow</label>
        <label><input type="radio" name="color" value="purple" {{ request('color') == 'purple' ? 'checked' : '' }}> Purple</label>
      </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 20px;">
      <a
        href="/category_pages/category(Tricka)"
        style="
          display: inline-block;
          text-align: center;
          padding: 10px 12px;
          border: 1px solid #666;
          border-radius: 8px;
          background: #f3f3f3;
          color: black;
          text-decoration: none;
          font-weight: bold;
        "
      >
        Zrušiť filtre
      </a>

      <button type="submit" class="filter-submit-button">Filtrovať</button>
    </div>
  </form>
</aside>

<script>
  function toggleFiltersPanel() {
    const panel = document.getElementById('filters-panel');

    if (panel.style.display === 'none') {
      panel.style.display = 'block';
    } else {
      panel.style.display = 'none';
    }
  }
</script>
