<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/variables.css') }}" />
        <title>3čko</title>
    </head>
    <body>
        @include('components.header')

        <div class="main-content">
            @include('components.sidebar')

            <main>
                <section class="bestsellers-section">
                    <h1>Bestsellery</h1>
                    <div class="bestsellers-contents">
                        @foreach($products->take(6) as $product)
                            <a href="/product_detail/{{ $product->id }}">
                                <article class="product-card">
                                    <h3>{{ $product->name }}</h3>
                                    <img
                                        src="{{ asset($product->image) }}"
                                        alt="Product Photo"
                                    />
                                    <p>{{ number_format($product->price, 2) }}€</p>
                                </article>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="homepage-bottom-section">
                    <section class="novinky-section">
                        <h1>Novinky</h1>
                        <div class="novinky-contents">
                            @foreach($products->skip(6)->take(4) as $product)
                                <a href="/product_detail/{{ $product->id }}">
                                    <article class="product-card">
                                        <h3>{{ $product->name }}</h3>
                                        <img
                                            src="{{ asset($product->image) }}"
                                            alt="Product Photo"
                                        />
                                        <p>{{ number_format($product->price, 2) }}€</p>
                                    </article>
                                </a>
                            @endforeach
                        </div>
                    </section>

                    <section class="akcia-dna-section">
                        <h1>Akcia dňa</h1>
                        <div class="akcia-dna-contents">
                            @php $special = $products->first(); @endphp
                            @if($special)
                                <a href="/product_detail/{{ $special->id }}">
                                    <article class="akcia-dna-product-card">
                                        <h2>{{ $special->name }}</h2>
                                        <div class="akcia-dna-img-section">
                                            <div class="sale-badge">-25%</div>
                                            <img
                                                src="{{ asset($special->image) }}"
                                                alt="Product Photo"
                                            />
                                        </div>
                                        <div class="akcia-dna-price-section">
                                            <span class="old-price">{{ number_format($special->price, 2) }}€</span>
                                            <span class="new-price">{{ number_format($special->price * 0.75, 2) }}€</span>
                                        </div>
                                    </article>
                                </a>
                            @endif
                        </div>
                    </section>
                </section>
            </main>
        </div>

        <script>
            function toggle_sidebar() {
                const sidebar = document.querySelector(".sidebar");

                if (
                    sidebar.style.display === "none" ||
                    sidebar.style.display === ""
                ) {
                    sidebar.style.display = "flex";
                } else {
                    sidebar.style.display = "none";
                }
            }

            function toggle_searchbar() {
                const searchbar = document.querySelector(".search2");

                if (
                    searchbar.style.display === "none" ||
                    searchbar.style.display === ""
                ) {
                    searchbar.style.display = "flex";
                } else {
                    searchbar.style.display = "none";
                }
            }
        </script>
    </body>
</html>

<style>
    main {
        padding: 30px;
        padding-top: 0;
    }

    .homepage-bottom-section {
        display: flex;
        flex-wrap: wrap;
    }

    .novinky-section {
        flex: 1;
    }

    .akcia-dna-section {
        flex: 1;
    }

    .bestsellers-contents {
        display: flex;
        flex-wrap: wrap;
    }

    .novinky-contents {
        display: flex;
        flex-wrap: wrap;
    }

    .product-card {
        width: 180px;
        margin: 20px;
        border: 1px solid #666;
        border-radius: 20px;
        text-align: center;
    }

    .product-card:hover {
        background-color: #eee;
    }

    .product-card:active {
        background-color: #ddd;
    }

    .product-card > h3 {
        padding: 0 15px;
        height: 2em;
        line-height: 1em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-card > img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
    }

    .product-card > p {
        padding: 0 15px;
    }

    .akcia-dna-contents {
        display: flex;
        justify-content: center;
        width: 80%;
    }

    .akcia-dna-product-card {
        border: 1px solid #666;
        border-radius: 25px;
        text-align: center;
        margin: 20px;
    }

    .akcia-dna-product-card:hover {
        background-color: #eee;
    }

    .akcia-dna-product-card:active {
        background-color: #ddd;
    }

    .akcia-dna-product-card > h2 {
        padding: 15px 0;
    }

    .akcia-dna-img-section {
        position: relative;
        z-index: 0;
    }

    .sale-badge {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: green;
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .akcia-dna-img-section > img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
    }

    .akcia-dna-price-section {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px;
        font-size: 28px;
        padding: 15px 0;
    }

    .old-price {
        text-decoration: line-through;
        color: #555;
    }

    .new-price {
        color: black;
        font-weight: bold;
    }

    @media (max-width: 503px) {
        .product-card {
            width: 140px;
            margin: 5px;
        }
    }
</style>
