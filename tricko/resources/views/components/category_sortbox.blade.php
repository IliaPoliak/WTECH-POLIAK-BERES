<div class="sort-box">
  <form method="GET" action="" style="display: flex; flex-direction: column; gap: 10px;">
    <div class="sort-title">Zoradiť podľa ceny</div>

    <input type="hidden" name="color" value="{{ request('color') }}">
    <input type="hidden" name="size" value="{{ request('size') }}">
    <input type="hidden" name="price_min" value="{{ request('price_min') }}">
    <input type="hidden" name="price_max" value="{{ request('price_max') }}">

    <div class="sort-buttons">
      <button type="submit" name="sort" value="desc" class="sort-button">ZOSTUPNE</button>
      <button type="submit" name="sort" value="asc" class="sort-button">VZOSTUPNE</button>
    </div>
  </form>
</div>
