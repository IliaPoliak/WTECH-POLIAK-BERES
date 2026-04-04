<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop_pages.css') }}" />  
  <title>Product detail</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main class="product-detail-page">
    <section class="product-detail-layout">
      <div class="product-detail-image-box">
        <img
                class="product-detail-image"
                src="../assets/blue_t_shirt.png"
                alt="Product Photo"
        />
      </div>

      <div class="product-detail-info">
        <h1>Modré tričko</h1>
        <p class="product-detail-price">22,99€</p>
        <p class="product-detail-color">Farba: Modrá</p>

        <div class="product-detail-sizes">
          <h2>Veľkosť</h2>
          <div class="product-detail-size-options">
            <button type="button" class="product-size-button">S</button>
            <button type="button" class="product-size-button">M</button>
            <button type="button" class="product-size-button">L</button>
            <button type="button" class="product-size-button">XL</button>
          </div>
        </div>

        <div class="product-detail-actions">
          <button type="button" class="product-detail-cart-button">
            Pridať do košíka
          </button>
        </div>
      </div>
    </section>

    <section class="product-detail-description">
      <h2>Popis produktu</h2>
      <p>
        Modré tričko z príjemného materiálu na každodenné nosenie.
        Jednoduchý dizajn, pohodlný strih a moderný vzhľad.
      </p>
    </section>
  </main>
</div>

@include('components.footer')
</body>
</html>