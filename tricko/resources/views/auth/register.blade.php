<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="../../utils.js"></script>
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
  <title>3čko</title>
</head>
<body>
@include('components.header')

<div class="main-content">
  @include('components.sidebar')

  <main>
    <h1>Registrácia</h1>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-row">
        <label for="register-name">Meno</label>
        <input type="text" id="register-name" name="first_name" required />
      </div>

      <div class="form-row">
        <label for="register-surname">Priezvisko</label>
        <input type="text" id="register-surname" name="last_name" required />
      </div>

      <div class="form-row">
        <label for="register-email">e-mail</label>
        <input type="email" id="register-email" name="email" required/>
      </div>

      <div class="form-row">
        <label for="register-password">Heslo</label>
        <input type="password" id="register-password" name="password" required/>
      </div>

      <button type="submit" class="submit-button">Registrovať sa</button>
    </form>

    <div class="empty-space"></div>

    <div class="redirect-link-container">
      <p>Ste už zaregistrovaný?</p>
      <a href="/auth/login" class="redirect-link">Prihlasenie</a>
    </div>
  </main>
</div>
</body>
</html>