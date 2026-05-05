<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>

  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/basket_pages.css') }}" />
  <title>3čko</title>
</head>

<body>

@include('components.header')


<div class="main-content">
  @include('components.sidebar')

  <main class="basket-step-page">
    <div class="basket-step-top">
      <a class="basket-step-back-left" href="/basket/basket_delivery_and_payment">
        ↩ zmeniť spôsob dopravy
      </a>

      <a class="basket-step-back-right" href="/">
        ↩ späť na prehliadávanie
      </a>
    </div>

    <section class="basket-step-content">
      <h1>Adresa</h1>

      <form method="POST" action="{{ route('basket.step2.store') }}" class="basket-address-form">
        @csrf

        <div class="basket-form-row">
          <label for="country">Krajina</label>
          <input id="country" name="country" type="text" value="{{ old('country', $deliveryMethod->country ?? '') }}" />
        </div>

        <div class="basket-form-row">
          <label for="city">Mesto</label>
          <input id="city" name="city" type="text" value="{{ old('city', $deliveryMethod->city ?? '') }}" />
        </div>

        <div class="basket-form-row basket-form-row-short">
          <label for="psc">PSČ</label>
          <input id="psc" name="postal_code" type="text" value="{{ old('postal_code', $deliveryMethod->postal_code ?? '') }}" />
        </div>

        <div class="basket-form-row">
          <label for="address">Adresa</label>
          <input id="address" name="address" type="text" value="{{ old('address', $deliveryMethod->address ?? '') }}" />
        </div>

        <div class="basket-form-row">
          <label for="phone">Tel. č.</label>
          <input id="phone" name="phone_number" type="text" value="{{ old('phone_number', $deliveryMethod->phone_number ?? '') }}" />
        </div>

        <div class="basket-step-bottom">
          <button type="submit" class="basket-step-next-btn">
            Pokračovať k platobným údajom
          </button>
        </div>
      </form>

    </section>
  </main>
</div>
</body>
</html>

<style>
  @media (max-width: 770px) {
    .basket-step-top {
      flex-direction: column;
      gap: 10px;
    }

    .basket-step-back-left {
      width: 264px;
    }
  }

  @media (max-width: 440px) {
    .basket-step-next-btn {
      font-size: 18px;
    }
  }

  @media (max-width: 405px) {
    .basket-step-next-btn {
      font-size: 16px;
    }
  }

  @media (max-width: 380px) {
    .basket-step-next-btn {
      font-size: 14px;
    }

    .basket-step-content {
      padding: 10px 9px 28px 9px;
    }
  }

  @media (max-width: 365px) {
    .basket-step-content {
      padding: 10px 0 28px 0;
    }
  }
</style>