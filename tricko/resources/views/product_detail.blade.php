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

        @if ($product->imgs->count() > 1)
          <button type="button" onclick="prevImage()"><</button>  
        @endif
        

        <img id="mainImage"
          class="product-detail-image"
          src="{{ $product->imgs->first() ? asset($product->imgs->first()->image) : '' }}"
          alt="Product Photo"
        />

        @if ($product->imgs->count() > 1)
          <button type="button" onclick="nextImage()">></button>
        @endif
      </div>

      <div class="product-detail-info">
        <h1>{{ $product->name }}</h1>
        <p class="product-detail-price">{{ number_format($product->price, 2) }}€</p>
        <p class="product-detail-color">Farba: {{ $product->color }}</p>

        <form method="POST" action="{{ route('basket.add') }}">
          @csrf

          <div class="product-detail-sizes">
            <h2>Veľkosť</h2>

            <div class="product-detail-size-options custom-size-options">
              @foreach($product->sizes as $size)
                <label class="custom-size-label">
                  <input
                    type="radio"
                    name="item_id"
                    value="{{ $size->id }}"
                    required
                    class="custom-size-input"
                  >
                  <span class="custom-size-pill">{{ $size->size }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="product-detail-actions">
            <button type="submit" class="product-detail-cart-button">
              Pridať do košíka
            </button>
          </div>
        </form>
      </div>
    </section>

    <section class="product-detail-description">
      <h2>Popis produktu</h2>
      <p>
        {{ $product->description }}
      </p>
    </section>
  </main>
</div>

@include('components.footer')

<style>
  .custom-size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 12px;
  }

  .custom-size-label {
    cursor: pointer;
  }

  .custom-size-input {
    display: none;
  }

  .custom-size-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 54px;
    height: 54px;
    padding: 0 14px;
    border: 1px solid #b8b8b8;
    border-radius: 12px;
    background: #f7f7f7;
    font-size: 24px;
    transition: 0.2s ease;
  }

  .custom-size-label:hover .custom-size-pill {
    background: #ececec;
  }

  .custom-size-input:checked + .custom-size-pill {
    background: #8fa5b7;
    color: white;
    border-color: #8fa5b7;
  }
</style>
</body>
</html>

<script>
let images = @json($product->imgs->pluck('image')->map(fn($img) => asset($img)));
let index = 0;

function showImage() {
    if (images.length > 0) {
        document.getElementById('mainImage').src = images[index];
    }
}

function nextImage() {
    if (images.length === 0) return;
    index = (index + 1) % images.length;
    showImage();
}

function prevImage() {
    if (images.length === 0) return;
    index = (index - 1 + images.length) % images.length;
    showImage();
}
</script>
