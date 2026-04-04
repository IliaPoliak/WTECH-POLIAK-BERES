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
    <div class="basket-step-top basket-step-top-right-only">
      <a class="basket-step-back-right" href="/">
        ↩ späť na prehliadávanie
      </a>
    </div>

    <section class="basket-step-content basket-thank-you-page">
      <div class="basket-thank-you-message">
        <h1>Ďakujeme za nákup</h1>
        <h2>3čko</h2>
      </div>
    </section>
  </main>
</div>
</body>
</html>