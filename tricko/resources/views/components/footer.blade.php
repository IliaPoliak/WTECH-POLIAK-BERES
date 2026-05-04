<section class="recommend-footer">
  <h2>Mohlo by sa Vám páčiť</h2>

  <div class="recommend-grid">
    @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
      @foreach($recommendedProducts as $product)
        <a href="/product_detail/{{ $product->id }}" class="recommend-card">
          <img
            class="recommend-product-image"
            src="{{ asset($product->image) }}"
            alt="{{ $product->name }}"
          />

          <div class="recommend-product-info">
            <h3>{{ $product->name }}</h3>
            <p>{{ number_format($product->price, 2) }}€</p>
          </div>
        </a>
      @endforeach
    @else
      <div class="recommend-card">
        <div class="recommend-image">Fotka produktu</div>
      </div>

      <div class="recommend-card">
        <div class="recommend-image">Fotka produktu</div>
      </div>

      <div class="recommend-card">
        <div class="recommend-image">Fotka produktu</div>
      </div>

      <div class="recommend-card">
        <div class="recommend-image">Fotka produktu</div>
      </div>
    @endif
  </div>
</section>

<style>
  .recommend-footer {
    margin-top: 40px;
    border-top: 1px solid #bdbdbd;
    background-color: #f1f1f1;
  }

  .recommend-footer h2 {
    margin: 0;
    padding: 14px 16px;
    border-bottom: 1px solid #bdbdbd;
    font-size: 22px;
  }

  .recommend-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border-left: 1px solid #d0d0d0;
  }

  .recommend-card {
    min-height: 180px;
    padding: 12px;
    border-right: 1px solid #d0d0d0;
    text-align: center;
    color: inherit;
    text-decoration: none;
    background-color: white;
  }

  .recommend-card:hover {
    background-color: #eeeeee;
  }

  .recommend-product-image {
    width: 100%;
    max-width: 150px;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    display: block;
    margin: 0 auto 8px;
  }

  .recommend-product-info h3 {
    margin: 6px 0;
    font-size: 16px;
    line-height: 1.1em;
    height: 2.2em;
    overflow: hidden;
  }

  .recommend-product-info p {
    margin: 0;
    font-size: 16px;
  }

  .recommend-image {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 140px;
  }

  @media (max-width: 900px) {
    .recommend-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 500px) {
    .recommend-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
