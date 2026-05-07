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
    <h1>Prihlásenie</h1>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-row">
        <label for="login-email">e-mail</label>
        <input type="email" id="login-email" name="email" value="{{ old('email') }}" required />
      </div>

      <div class="form-row">
        <label for="login-password">heslo</label>
        <input type="password" id="login-password" name="password" required/>
      </div>

      <button type="submit" class="submit-button">Prihlasit sa</button>
    
      @error('email')
        <p class="error">{{ $message }}</p>
      @enderror
    </form>


    <div class="empty-space"></div>

    <div class="redirect-link-container">
      <p>Ešte nemáte účet?</p>
      <a href="/auth/register" class="redirect-link">Registracia</a>
    </div>
  </main>
</div>
</body>
</html>