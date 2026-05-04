<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop_pages.css') }}" />
  <title>Search results</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main style="padding: 30px; padding-top: 0;">
    <section>
      <h1>Výsledky vyhľadávania</h1>

      @if(!empty($q))
        <p>Hľadaný výraz: <strong>{{ $q }}</strong></p>
      @endif

      @if($products->count() > 0)
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
          @foreach($products as $product)
            <a href="/product_detail/{{ $product->id }}">
              <article class="product-card">
                <h3>{{ $product->name }}</h3>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
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
      @else
        <p>Nenašli sa žiadne produkty.</p>
      @endif
    </section>
  </main>
</div>

@include('components.footer')
</body>
</html>

<style>
  .product-card {
    width: 180px;
    margin: 0;
    border: 1px solid #666;
    border-radius: 20px;
    text-align: center;
  }

  .product-card:hover {
    background-color: #eee;
  }

  .product-card:active {
    background-color: #ddd;
  }

  .product-card > h3 {
    padding: 0 15px;
    height: 2em;
    line-height: 1em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .product-card > img {
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    display: block;
  }

  .product-card > p {
    padding: 0 15px;
  }

  @media (max-width: 503px) {
    .product-card {
      width: 140px;
    }
  }
</style>
