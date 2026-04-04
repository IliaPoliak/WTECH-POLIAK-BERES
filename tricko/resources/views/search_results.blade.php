<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop_pages.css') }}" />
  <title>Search Results</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  
  @include('components.sidebar')

  <main class="search-results-page">
    <div class="search-results-top">
      <h1>Výsledky vyhľadávania</h1>
      <p>Výsledok pre: <strong>Modré tričko</strong></p>
    </div>

    <section class="search-results-grid">
      <a href="/product_detail">
        <article class="product-card">
          <h3>Modré tričko</h3>
          <img src="../assets/blue_t_shirt.png" alt="Product Photo" />
          <p>22,99€</p>
        </article>
      </a>

      <a href="/product_detail">
        <article class="product-card">
          <h3>Svetlomodré tričko</h3>
          <img src="../assets/blue_t_shirt.png" alt="Product Photo" />
          <p>19,99€</p>
        </article>
      </a>

      <a href="/product_detail">
        <article class="product-card">
          <h3>Tmavomodré tričko</h3>
          <img src="../assets/blue_t_shirt.png" alt="Product Photo" />
          <p>24,99€</p>
        </article>
      </a>
    </section>
  </main>
</div>

@include('components.footer')
</body>
</html>