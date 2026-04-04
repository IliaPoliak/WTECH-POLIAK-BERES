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
      <article class="basket-item">
        <h2 class="basket-item-title">Modré Tričko</h2>

        <button class="basket-remove-btn">x</button>

        <div class="basket-item-content">
          <a href="/product_detail" class="basket-item-image-box">
            <img class="basket-item-image" src="../../assets/blue_t_shirt.png" alt="Product Photo" />
          </a>

          <div class="basket-item-details">
            <div class="basket-quantity-row">
              <span class="basket-quantity-text">Množstvo: 2</span>

              <div class="basket-quantity-buttons">
                <button type="button">+</button>
                <button type="button">-</button>
              </div>
            </div>

            <div class="basket-price-box">Cena: 45,98€</div>
          </div>
        </div>
      </article>

      <article class="basket-item">
        <h2 class="basket-item-title">Názov Produktu</h2>

        <button class="basket-remove-btn">x</button>

        <div class="basket-item-content">
          <a href="/product_detail" class="basket-item-image-box">
            <img class="basket-item-image" src="../../assets/blue_t_shirt.png" alt="Product Photo" />
          </a>

          <div class="basket-item-details">
            <div class="basket-quantity-row">
              <span class="basket-quantity-text">Množstvo: X</span>

              <div class="basket-quantity-buttons">
                <button type="button">+</button>
                <button type="button">-</button>
              </div>
            </div>

            <div class="basket-price-box">Cena: 0€</div>
          </div>
        </div>
      </article>

      <article class="basket-item">
        <h2 class="basket-item-title">Názov Produktu</h2>

        <button class="basket-remove-btn">x</button>

        <div class="basket-item-content">
          <a href="/product_detail" class="basket-item-image-box">
            <img class="basket-item-image" src="../../assets/blue_t_shirt.png" alt="Product Photo" />
          </a>

          <div class="basket-item-details">
            <div class="basket-quantity-row">
              <span class="basket-quantity-text">Množstvo: X</span>

              <div class="basket-quantity-buttons">
                <button type="button">+</button>
                <button type="button">-</button>
              </div>
            </div>

            <div class="basket-price-box">Cena: 0€</div>
          </div>
        </div>
      </article>
    </section>

    <section class="basket-summary">
      <div class="basket-total">Spolu: XY</div>

      <a class="basket-next-btn" href="basket/basket_delivery_and_payment">
        Pokračovať k doprave a platbe
      </a>
    </section>
  </main>
</div>
</body>
</html>