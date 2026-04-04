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
      <a class="basket-step-back-left" href="/basket">
        ↩ späť na prehľad košíka
      </a>

      <a class="basket-step-back-right" href="/">
        ↩ späť na prehliadanie
      </a>
    </div>

    <section class="basket-step-content">
      <h1>Doprava a platba</h1>

      <div class="basket-option-group">
        <h2>Vyberte spôsob platby</h2>

        <label class="basket-option">
          <input type="radio" name="payment" />
          <span>platba kartou</span>
        </label>

        <label class="basket-option">
          <input type="radio" name="payment" />
          <span>dobierka</span>
        </label>
      </div>

      <div class="basket-option-group">
        <h2>Vyberte spôsob dopravy</h2>

        <label class="basket-option">
          <input type="radio" name="delivery" />
          <span>osobné vyzdvihnutie</span>
        </label>

        <label class="basket-option">
          <input type="radio" name="delivery" />
          <span>kurierska spoločnosť</span>
        </label>

        <label class="basket-option">
          <input type="radio" name="delivery" />
          <span>poštou</span>
        </label>
      </div>

      <div class="basket-step-bottom">
        <a class="basket-step-next-btn" href="/basket/basket_address">
          Pokračovať k adrese
        </a>
      </div>
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

    .basket-step-back-right {
      width: 264px;
    }
  }
</style>