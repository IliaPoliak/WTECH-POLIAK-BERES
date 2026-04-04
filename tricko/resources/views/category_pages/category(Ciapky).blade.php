<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/category_pages.css') }}" />
  <title>Category - Čiapky</title>
</head>
<body>
@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main>
    @include('components.category_filters')

    <section class="category-content">
      <div class="category-top">
        <h1>Čiapky</h1>

        @include('components.category_sortbox')
      </div>

      <div class="category-products-grid">
        <a href="../product_detail">
          <article class="product-card">
            <h3>Čierna čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>12.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Modrá čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>13.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Zelená čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>11.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Červená čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>12.49€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Biela čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>10.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Žltá čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>11.49€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Zimná čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>15.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Premium čiapka</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>18.99€</p>
          </article>
        </a>
      </div>

      @include('components.category_pagination')
    </section>
  </main>
</div>
</body>
</html>