<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />

  <title>Admin - Upraviť produkt</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main style="padding: 30px; width: 100%;">
    <div style="margin-bottom: 20px;">
      <h1 style="margin-bottom: 8px;">Upraviť produkt</h1>
      <p style="margin: 0;">Uprav údaje produktu: <strong>{{ $product->name }}</strong></p>
    </div>

    @if ($errors->any())
      <div style="margin-bottom: 20px; padding: 12px 16px; border: 1px solid #b96b6b; background: #ffeaea; border-radius: 10px;">
        <strong>Chyba:</strong>
        <ul style="margin-bottom: 0;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form
      method="POST"
      action="/admin/products/{{ $product->id }}"
      enctype="multipart/form-data"
      style="max-width: 700px;"
    >
      @csrf
      @method('PUT')

      <div style="margin-bottom: 16px;">
        <label for="name">Názov produktu</label>
        <input
          type="text"
          id="name"
          name="name"
          value="{{ old('name', $product->name) }}"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
      </div>

      <div style="margin-bottom: 16px;">
        <label for="description">Popis produktu</label>
        <textarea
          id="description"
          name="description"
          rows="4"
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >{{ old('description', $product->description) }}</textarea>
      </div>

      <div style="margin-bottom: 16px;">
        <label for="category">Kategória</label>
        <select
          id="category"
          name="category"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
          <option value="Tricka" {{ old('category', $product->category) === 'Tricka' ? 'selected' : '' }}>Tričká</option>
          <option value="Mikiny" {{ old('category', $product->category) === 'Mikiny' ? 'selected' : '' }}>Mikiny</option>
          <option value="Ciapky" {{ old('category', $product->category) === 'Ciapky' ? 'selected' : '' }}>Čiapky</option>
        </select>
      </div>

      <div style="margin-bottom: 16px;">
        <label for="gender">Pohlavie</label>
        <select
          id="gender"
          name="gender"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
          <option value="unisex" {{ old('gender', $product->gender) === 'unisex' ? 'selected' : '' }}>Unisex</option>
          <option value="men" {{ old('gender', $product->gender) === 'men' ? 'selected' : '' }}>Muži</option>
          <option value="women" {{ old('gender', $product->gender) === 'women' ? 'selected' : '' }}>Ženy</option>
        </select>
      </div>

      <div style="margin-bottom: 16px;">
        <label for="price">Cena</label>
        <input
          type="number"
          step="0.01"
          min="0"
          id="price"
          name="price"
          value="{{ old('price', $product->price) }}"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
      </div>

      <div style="margin-bottom: 16px;">
        <label for="color">Farba</label>
        <select
          id="color"
          name="color"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
          <option value="blue" {{ old('color', $product->color) === 'blue' ? 'selected' : '' }}>Blue</option>
          <option value="red" {{ old('color', $product->color) === 'red' ? 'selected' : '' }}>Red</option>
          <option value="green" {{ old('color', $product->color) === 'green' ? 'selected' : '' }}>Green</option>
          <option value="yellow" {{ old('color', $product->color) === 'yellow' ? 'selected' : '' }}>Yellow</option>
          <option value="black" {{ old('color', $product->color) === 'black' ? 'selected' : '' }}>Black</option>
          <option value="white" {{ old('color', $product->color) === 'white' ? 'selected' : '' }}>White</option>
        </select>
      </div>

      @php
        $selectedSizes = old('sizes', $product->sizes->pluck('size')->toArray());
      @endphp

      <div style="margin-bottom: 16px;">
        <label>Veľkosti</label>

        <div style="display: flex; gap: 14px; flex-wrap: wrap; margin-top: 8px;">
          @foreach(['S', 'M', 'L', 'XL', 'UNI'] as $size)
            <label style="display: flex; gap: 6px; align-items: center;">
              <input
                type="checkbox"
                name="sizes[]"
                value="{{ $size }}"
                {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
              >
              {{ $size }}
            </label>
          @endforeach
        </div>
      </div>

      <div style="margin-bottom: 20px;">
        <label>Aktuálny obrázok</label>
        <br />

        @foreach ($product->imgs as $img)
          <div style="display: inline-block; ">  
            <label> 
              <input type="checkbox" name="imgsToDelete[]"
                  value="{{ $img->id }}"
              >
              Delete
            </label>
            <img
              src="{{ asset($img->image) }}"
              alt="Product Image"
              style="display: block; width: 160px; height: 160px; object-fit: cover; border: 1px solid #999; border-radius: 10px; margin-top: 8px;"
            >
          </div>
        @endforeach
      </div>

      <div style="margin-bottom: 20px;">
        <label for="image">Nový obrázok produktu</label>
        <input
          type="file"
          id="image"
          name="image[]"
          accept="image/*"
          multiple
          style="display: block; width: 100%; padding: 10px 0; margin-top: 6px;"
        >
        <small>Ak nevyberieš nový obrázok, ostane pôvodný.</small>
      </div>

      <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <button
          type="submit"
          style="
            padding: 10px 16px;
            border: 1px solid #666;
            border-radius: 10px;
            background: #e9f4e9;
            cursor: pointer;
          "
        >
          Uložiť zmeny
        </button>

        <a
          href="/admin/products"
          style="
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid #666;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            background: #f3f3f3;
          "
        >
          Späť
        </a>
      </div>
    </form>
  </main>
</div>

</body>
</html>
