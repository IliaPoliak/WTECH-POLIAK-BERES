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
        @foreach($products as $product)
          <a href="/product_detail/{{ $product->id }}">
            <article class="product-card">
              <h3>{{ $product->name }}</h3>
              <img src="{{ $product->imgs->first() ? asset($product->imgs->first()->image) : '' }}" alt="{{ $product->name }}" />
              <p>{{ number_format($product->price, 2) }}€</p>
            </article>
          </a>
        @endforeach
      </div>

      <div style="margin-top: 20px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        @if ($products->onFirstPage())
          <span>Predošlá</span>
        @else
          <a href="{{ $products->appends(request()->query())->previousPageUrl() }}">Predošlá</a>
        @endif

        @for ($page = 1; $page <= $products->lastPage(); $page++)
          @if ($page == $products->currentPage())
            <strong>{{ $page }}</strong>
          @else
            <a href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a>
          @endif
        @endfor

        @if ($products->hasMorePages())
          <a href="{{ $products->appends(request()->query())->nextPageUrl() }}">Ďalšia</a>
        @else
          <span>Ďalšia</span>
        @endif
      </div>
    </section>
  </main>
</div>

</body>
</html>
