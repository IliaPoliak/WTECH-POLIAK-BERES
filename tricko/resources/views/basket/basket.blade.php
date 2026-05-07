<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/basket_pages.css') }}" />
  <title>3čko</title>
</head>

<body>
@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main class="basket-page">
    <section class="basket-header">
      <h1>Prehľad košíka</h1>
      <a class="basket-back-link" href="/">↩ späť na prehliadanie</a>
    </section>

    <section class="basket-items">
      @forelse($basketItems as $item)
        <article class="basket-item">
          <h2 class="basket-item-title">
            {{ $item->size->product->name }} ({{ $item->size->size }})
          </h2>

          <form method="POST" action="{{ route('basket.remove', $item->id) }}">
            @csrf
            <button class="basket-remove-btn" type="submit">x</button>
          </form>

          <div class="basket-item-content">
            <a href="/product_detail/{{ $item->size->product->id }}" class="basket-item-image-box">
              <img class="basket-item-image" src="{{ $item->size->product->imgs->first() ? asset($item->size->product->imgs->first()->image) : '' }}" alt="Product Photo" />
            </a>

            <div class="basket-item-details">
              <div class="basket-quantity-row">
                <span class="basket-quantity-text">Množstvo: {{ $item->quantity }}</span>

                <div class="basket-quantity-buttons custom-basket-buttons">
                  <form method="POST" action="{{ route('basket.increase', $item->id) }}">
                    @csrf
                    <button type="submit" class="basket-qty-btn">+</button>
                  </form>

                  <form method="POST" action="{{ route('basket.decrease', $item->id) }}">
                    @csrf
                    <button type="submit" class="basket-qty-btn">−</button>
                  </form>
                </div>
              </div>

              <div class="basket-price-box">
                Cena: {{ number_format($item->size->product->price * $item->quantity, 2) }}€
              </div>
            </div>
          </div>
        </article>
      @empty
        <article class="basket-item">
          <h2 class="basket-item-title">Košík je prázdny</h2>
        </article>
      @endforelse
    </section>

    <section class="basket-summary">
      <div class="basket-total">Spolu: {{ number_format($total, 2) }}€</div>

      <a class="basket-next-btn" href="/basket/basket_delivery_and_payment">
        Pokračovať k doprave a platbe
      </a>
    </section>
  </main>
</div>

<style>
  .custom-basket-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .basket-qty-btn {
    width: 44px;
    height: 44px;
    border: none;
    border-radius: 10px;
    background: #8fa5b7;
    color: white;
    font-size: 28px;
    line-height: 1;
    cursor: pointer;
    transition: 0.2s ease;
  }

  .basket-qty-btn:hover {
    background: #7b93a7;
  }

  .basket-qty-btn:active {
    background: #6d8599;
  }
</style>
</body>
</html>
