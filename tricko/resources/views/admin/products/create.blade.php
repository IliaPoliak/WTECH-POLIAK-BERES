<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />

  <title>Admin - Pridať produkt</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main style="padding: 30px; width: 100%;">
    <div style="margin-bottom: 20px;">
      <h1 style="margin-bottom: 8px;">Pridať produkt</h1>
      <p style="margin: 0;">Vyplň údaje nového produktu.</p>
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
      action="/admin/products"
      enctype="multipart/form-data"
      style="max-width: 700px;"
    >
      @csrf

      <div style="margin-bottom: 16px;">
        <label for="name">Názov produktu</label>
        <input
          type="text"
          id="name"
          name="name"
          value="{{ old('name') }}"
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
        >{{ old('description') }}</textarea>
      </div>

      <div style="margin-bottom: 16px;">
        <label for="category">Kategória</label>
        <select
          id="category"
          name="category"
          required
          style="display: block; width: 100%; padding: 10px; margin-top: 6px;"
        >
          <option value="">Vyber kategóriu</option>
          <option value="Tricka" {{ old('category') === 'Tricka' ? 'selected' : '' }}>Tričká</option>
          <option value="Mikiny" {{ old('category') === 'Mikiny' ? 'selected' : '' }}>Mikiny</option>
          <option value="Ciapky" {{ old('category') === 'Ciapky' ? 'selected' : '' }}>Čiapky</option>
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
          <option value="">Vyber pohlavie</option>
          <option value="unisex" {{ old('gender') === 'unisex' ? 'selected' : '' }}>Unisex</option>
          <option value="men" {{ old('gender') === 'men' ? 'selected' : '' }}>Muži</option>
          <option value="women" {{ old('gender') === 'women' ? 'selected' : '' }}>Ženy</option>
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
          value="{{ old('price') }}"
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
          <option value="">Vyber farbu</option>
          <option value="blue" {{ old('color') === 'blue' ? 'selected' : '' }}>Blue</option>
          <option value="red" {{ old('color') === 'red' ? 'selected' : '' }}>Red</option>
          <option value="green" {{ old('color') === 'green' ? 'selected' : '' }}>Green</option>
          <option value="yellow" {{ old('color') === 'yellow' ? 'selected' : '' }}>Yellow</option>
          <option value="black" {{ old('color') === 'black' ? 'selected' : '' }}>Black</option>
          <option value="white" {{ old('color') === 'white' ? 'selected' : '' }}>White</option>
        </select>
      </div>

      <div style="margin-bottom: 16px;">
        <label>Veľkosti</label>

        <div style="display: flex; gap: 14px; flex-wrap: wrap; margin-top: 8px;">
          @foreach(['S', 'M', 'L', 'XL', 'UNI'] as $size)
            <label style="display: flex; gap: 6px; align-items: center;">
              <input
                type="checkbox"
                name="sizes[]"
                value="{{ $size }}"
                {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}
              >
              {{ $size }}
            </label>
          @endforeach
        </div>
      </div>

      <div style="margin-bottom: 20px;">
        <label for="image">Obrázok produktu</label>
        <input
          type="file"
          id="image"
          name="image[]"
          accept="image/*"
          multiple
          required
          style="display: block; width: 100%; padding: 10px 0; margin-top: 6px;"
        >
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
          Pridať produkt
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
