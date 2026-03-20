async function loadComponent(id, file) {
  const res = await fetch(file);
  document.getElementById(id).innerHTML = await res.text();
}

async function loadProducts(category) {
  const res = await fetch("products.json");
  const data = await res.json();

  const container = document.getElementsByClassName("category-products-grid");

  data[category].forEach((product) => {
    const item = document.createElement("div");
    item.innerHTML = `
              <a href="pages/product-detail.html" class="category-product-card">
                <div class="category-card-top">
                  <h3>${product.name}</h3>
                  <span class="category-price">${product.price}</span>
                </div>
                <div class="category-color">${product.color}</div>
                <div class="category-image">Fotka produktu</div>
              </a>
          `;
    container[0].appendChild(item);
  });
}

function loadBasePath(path) {
  const base = document.createElement("base");
  base.href = path;
  document.head.prepend(base);
}

function toggle_filters() {
  const filters = document.querySelector(".category-filters");
  const main = document.querySelector("main");

  // Show filters
  if (filters.style.display === "none") {
    filters.style.display = "block";
    main.style.marginLeft =
      "calc(var(--sidebar-width) + var(--filter-width) + 25px)";
  }
  // Hide filters
  else {
    filters.style.display = "none";
    main.style.marginLeft = "var(--sidebar-width)";
  }
}

function toggle_sidebar() {
  const sidebar = document.querySelector(".sidebar");

  // Show sidebar
  if (sidebar.style.display === "none") {
    sidebar.style.display = "flex";
  }
  // Hide sidebar
  else {
    sidebar.style.display = "none";
  }
}

function toggle_searchbar() {
  const searchbar = document.querySelector(".search2");

  // Show searchbar
  if (searchbar.style.display === "none") {
    searchbar.style.display = "flex";
  }
  // Hide searchbar
  else {
    searchbar.style.display = "none";
  }
}
