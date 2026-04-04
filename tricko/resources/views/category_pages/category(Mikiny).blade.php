<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/category_pages.css') }}" />  
  <title>Category - Mikiny</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main>
      @include('components.category_filters')

    <section class="category-content">
      <div class="category-top">
        <h1>Mikiny</h1>

        @include('components.category_sortbox')
      </div>

      <div class="category-products-grid">
        <a href="../product_detail">
          <article class="product-card">
            <h3>Premium mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>70.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Čierna mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>49.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Sivá mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>44.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Modrá mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>46.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Zelená mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>45.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Biela mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>47.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Oversized mikina</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>54.99€</p>
          </article>
        </a>

        <a href="../product_detail">
          <article class="product-card">
            <h3>Mikina s kapucňou</h3>
            <img src="../../assets/blue_t_shirt.png" alt="Product Photo" />
            <p>52.99€</p>
          </article>
        </a>
      </div>

      @include('components.category_pagination')
    </section>
  </main>
</div>
</body>
</html>