<header class="header">
  <h1 class="logo"><a href="/">3čko</a></h1>

  <div class="header-inner">
    <nav class="nav hover-underline">
      @guest
      <a href="/auth/login"><b>Prihlasenie</b></a>
      <div>|</div>
      <a href="/auth/register"><b>Registracia</b></a>
      @endguest

      @auth
        <div href="/auth/login">Prihlaseny ako: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
        <div>|</div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="logout-button" type="submit"><b>Logout</b></button>
        </form>
      @endauth
    </nav>

    <div class="header-inner-right">
      <form action="/search_results">
        <input class="searchbar" type="text" placeholder="vyhladat..." />
      </form>
      <button class="basket-button">
        <a href="/basket">Kosik🧺</a>
      </button>
    </div>
  </div>
</header>

<header class="header2">
  <div class="header2-inner-left">
    <button onclick="toggle_sidebar()">&nbsp;☰&nbsp;</button>
    <button>
      <a href="/auth/login">👤</a>
    </button>
  </div>

  <h1 class="logo"><a href="/">3čko</a></h1>

  <div class="header2-inner-right">
    <button onclick="toggle_searchbar()">🔍</button>
    <button>
      <a href="/basket">🛒</a>
    </button>
  </div>
</header>

<div class="search2">
  <form action="/search_results">
    <input type="text" placeholder="vyhladat..." />
  </form>
</div>
