<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />

  <title>Admin - Produkty</title>
</head>
<body>

@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main style="padding: 30px; width: 100%;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap; margin-bottom: 20px;">
      <div>
        <h1 style="margin-bottom: 8px;">Admin - Produkty</h1>
        <p style="margin: 0;">Správa produktov v e-shope 3čko.</p>
      </div>

      <a
        href="/admin/products/create"
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
        + Pridať produkt
      </a>
    </div>

    @if(session('success'))
      <div style="margin-bottom: 20px; padding: 12px 16px; border: 1px solid #7ab97a; background: #eaf8ea; border-radius: 10px;">
        {{ session('success') }}
      </div>
    @endif

    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
        <thead>
          <tr style="background: #e9e9e9;">
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">ID</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Obrázok</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Názov</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Kategória</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Farba</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Cena</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Veľkosti</th>
            <th style="border: 1px solid #999; padding: 12px; text-align: left;">Akcie</th>
          </tr>
        </thead>

        <tbody>
          @forelse($products as $product)
            <tr>
              <td style="border: 1px solid #999; padding: 12px;">{{ $product->id }}</td>

              <td style="border: 1px solid #999; padding: 12px;">
                @if($product->imgs->first() && $product->imgs->first()->image)
                  <img
                    src="{{ asset($product->imgs->first()->image) }}"
                    alt="{{ $product->name }}"
                    style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; display: block;"
                  />
                @else
                  <span>Bez obrázka</span>
                @endif
              </td>

              <td style="border: 1px solid #999; padding: 12px;">{{ $product->name }}</td>
              <td style="border: 1px solid #999; padding: 12px;">{{ $product->category }}</td>
              <td style="border: 1px solid #999; padding: 12px;">{{ $product->color }}</td>
              <td style="border: 1px solid #999; padding: 12px;">{{ number_format($product->price, 2) }}€</td>

              <td style="border: 1px solid #999; padding: 12px;">
                @foreach($product->sizes as $size)
                  <span
                    style="
                      display: inline-block;
                      padding: 4px 8px;
                      margin-right: 6px;
                      margin-bottom: 6px;
                      border: 1px solid #999;
                      border-radius: 999px;
                      font-size: 14px;
                    "
                  >
                    {{ $size->size }}
                  </span>
                @endforeach
              </td>

              <td style="border: 1px solid #999; padding: 12px;">
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                  <a
                    href="/admin/products/{{ $product->id }}/edit"
                    style="
                      display: inline-block;
                      padding: 8px 12px;
                      border: 1px solid #666;
                      border-radius: 8px;
                      text-decoration: none;
                      color: black;
                      background: #f3f3f3;
                    "
                  >
                    Upraviť
                  </a>

                  <form
                    method="POST"
                    action="/admin/products/{{ $product->id }}"
                    onsubmit="return confirm('Naozaj chceš vymazať tento produkt?');"
                  >
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      style="
                        padding: 8px 12px;
                        border: 1px solid #a33;
                        border-radius: 8px;
                        background: #f8eaea;
                        cursor: pointer;
                      "
                    >
                      Vymazať
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="border: 1px solid #999; padding: 20px; text-align: center;">
                Žiadne produkty.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($products->lastPage() > 1)
      <div style="margin-top: 20px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        @if ($products->onFirstPage())
          <span>&laquo;</span>
        @else
          <a href="{{ $products->appends(request()->query())->previousPageUrl() }}">&laquo;</a>
        @endif

        @for ($page = 1; $page <= $products->lastPage(); $page++)
          @if ($page == $products->currentPage())
            <strong>{{ $page }}</strong>
          @else
            <a href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a>
          @endif
        @endfor

        @if ($products->hasMorePages())
          <a href="{{ $products->appends(request()->query())->nextPageUrl() }}">&raquo;</a>
        @else
          <span>&raquo;</span>
        @endif
      </div>
    @endif
  </main>
</div>

</body>
</html>
