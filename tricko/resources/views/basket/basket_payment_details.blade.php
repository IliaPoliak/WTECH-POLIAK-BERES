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
      <a class="basket-step-back-left" href="/basket/basket_address">
        ↩ zmeniť spôsob platby
      </a>

      <a class="basket-step-back-right" href="/">
        ↩ späť na prehliadávanie
      </a>
    </div>

    <section class="basket-step-content">
      <h1>Platobné údaje</h1>

      <form method="POST" action="{{ route('basket.step3.store') }}" class="basket-payment-form">
        @csrf
      
        <div class="basket-form-row">
          <label for="card-number">číslo karty</label>
          <input id="card-number" name="card_number" type="text" value="{{ old('card_number', $paymentMethod->card_number ?? '') }}" />
        </div>

        <div class="basket-form-row basket-expiration-row">
          <label for="exp-month">Dátum expirácie</label>
          <div class="basket-expiration-inputs">
            <input id="exp-month" name="expiration_date_month" type="text" value="{{ old('expiration_date_month', $paymentMethod->expiration_date_month ?? '') }}" />
            <input id="exp-year" name="expiration_date_year" type="text" value="{{ old('expiration_date_year', $paymentMethod->expiration_date_year ?? '') }}" />
          </div>
        </div>

        <div class="basket-form-row basket-form-row-short">
          <label for="cvv">cvv</label>
          <input id="cvv" name="cvv" type="text" value="{{ old('cvv', $paymentMethod->cvv ?? '') }}" />
        </div>

        <div class="basket-step-bottom">
          <button type="submit" class="basket-step-next-btn">
            Dokončiť nákup
          </button>
        </div>
      </form>

    </section>
  </main>
</div>
</body>
</html>

<style>
  .basket-expiration-row {
    gap: 40px;
  }

  @media (max-width: 770px) {
    .basket-step-top {
      flex-direction: column;
      gap: 10px;
    }

    .basket-step-back-left {
      width: 264px;
    }
  }

  @media (max-width: 380px) {
    .basket-expiration-row {
      gap: 30px;
    }

    .basket-step-content {
      padding: 10px 9px 28px 9px;
    }
  }
</style>