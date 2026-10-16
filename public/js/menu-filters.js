"use strict";
document.addEventListener("DOMContentLoaded", () => {
    const themeFilter = document.querySelector("#theme-filter");
    const dietFilter = document.querySelector("#diet-filter");
    const priceFilter = document.querySelector("#price-filter");
    const peopleFilter = document.querySelector("#people-filter");
    const resetButton = document.querySelector("#reset-filters");
    const resultsCount = document.querySelector("#results-count");
    const noResults = document.querySelector("#no-results");
    const menuCards = document.querySelectorAll(".menu-card");
    if (!themeFilter ||
        !dietFilter ||
        !priceFilter ||
        !peopleFilter ||
        !resetButton ||
        !resultsCount ||
        !noResults) {
        return;
    }
    function filterMenus() {
        const selectedTheme = themeFilter.value;
        const selectedDiet = dietFilter.value;
        const maxPrice = priceFilter.value === ""
            ? Infinity
            : Number(priceFilter.value) * 100;
        const peopleCount = peopleFilter.value === "" ? null : Number(peopleFilter.value);
        let visibleCount = 0;
        menuCards.forEach((card) => {
            const theme = card.dataset.theme;
            const diet = card.dataset.diet;
            const price = Number(card.dataset.price);
            const minimumPeople = Number(card.dataset.minPeople);
            const matchesTheme = !selectedTheme || theme === selectedTheme;
            const matchesDiet = !selectedDiet || diet === selectedDiet;
            const matchesPrice = price <= maxPrice;
            const matchesPeople = peopleCount === null || peopleCount >= minimumPeople;
            const isVisible = matchesTheme && matchesDiet && matchesPrice && matchesPeople;
            card.hidden = !isVisible;
            if (isVisible) {
                visibleCount++;
            }
        });
        resultsCount.textContent = `${visibleCount} menu${visibleCount > 1 ? "s" : ""} trouvé${visibleCount > 1 ? "s" : ""}`;
        noResults.hidden = visibleCount !== 0;
    }
    themeFilter.addEventListener("change", filterMenus);
    dietFilter.addEventListener("change", filterMenus);
    priceFilter.addEventListener("input", filterMenus);
    peopleFilter.addEventListener("input", filterMenus);
    resetButton.addEventListener("click", () => {
        themeFilter.value = "";
        dietFilter.value = "";
        priceFilter.value = "";
        peopleFilter.value = "";
        filterMenus();
    });
    filterMenus();
});
