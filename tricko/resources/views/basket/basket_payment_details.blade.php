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

      <form class="basket-payment-form">
        <div class="basket-form-row">
          <label for="card-number">číslo karty</label>
          <input id="card-number" type="text" />
        </div>

        <div class="basket-form-row basket-expiration-row">
          <label for="exp-month">Dátum expirácie</label>
          <div class="basket-expiration-inputs">
            <input id="exp-month" type="text" />
            <input id="exp-year" type="text" />
          </div>
        </div>

        <div class="basket-form-row basket-form-row-short">
          <label for="cvv">cvv</label>
          <input id="cvv" type="text" />
        </div>
      </form>

      <div class="basket-step-bottom">
        <a class="basket-step-next-btn" href="/basket/basket_thank_you">
          Dokončiť nákup
        </a>
      </div>
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