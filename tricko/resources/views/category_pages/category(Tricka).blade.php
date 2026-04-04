<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/category_pages.css') }}" />  
  <title>Category - Tricka</title>
</head>
<body>

@include('components.header')

<div class="main-content">

@include('components.sidebar')

<main>

    @include('components.category_filters')
    

    <section class="category-content">
      <div class="category-top">
        <h1>Tričká</h1>

        @include('components.category_sortbox')
      </div>

      <div class="category-products-grid">
        <a href="../product_detail">
          <article class="product-card">
            <h3>Biele tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>19.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Čierne tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>17.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Modré tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>18.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Zelené tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>16.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Žlté tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>14.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Oranžové tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>14.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Fialové tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>10.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Svetlomodré tričko</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>19.99€</p>
          </article>
        </a>
      </div>

      @include('components.category_pagination')
    </section>
  </main>
</div>
</body>
</html>