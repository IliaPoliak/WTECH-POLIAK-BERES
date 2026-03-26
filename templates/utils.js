function toggle_filters() {
  const filters = document.querySelector(".category-filters");
  const main = document.querySelector("main");

  if (!filters || !main) return;

  const width = window.innerWidth;

  if (filters.style.display === "none" || filters.style.display === "") {
    filters.style.display = "block";
    main.style.marginLeft =
        width > 655
            ? "calc(var(--sidebar-width) + var(--filter-width) + 25px)"
            : "calc(var(--filter-width) + 25px)";
  } else {
    filters.style.display = "none";
    main.style.marginLeft = width > 655 ? "var(--sidebar-width)" : "0";
  }
}

function toggle_sidebar() {
  const sidebar = document.querySelector(".sidebar");

  if (!sidebar) return;

  if (sidebar.style.display === "none" || sidebar.style.display === "") {
    sidebar.style.display = "flex";
  } else {
    sidebar.style.display = "none";
  }
}

function toggle_searchbar() {
  const searchbar = document.querySelector(".search2");

  if (!searchbar) return;

  if (searchbar.style.display === "none" || searchbar.style.display === "") {
    searchbar.style.display = "flex";
  } else {
    searchbar.style.display = "none";
  }
}