document.addEventListener("DOMContentLoaded", () => {
    const langBtn = document.getElementById("langBtn");
    const themeBtn = document.getElementById("themeBtn");
    const html = document.documentElement;

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        html.setAttribute("data-theme", savedTheme);
        themeBtn.textContent = savedTheme === "dark" ? "☀️" : "🌙";
    }

    themeBtn.addEventListener("click", () => {
        const currentTheme = html.getAttribute("data-theme") || "light";
        const newTheme = currentTheme === "light" ? "dark" : "light";
        html.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        themeBtn.textContent = newTheme === "dark" ? "☀️" : "🌙";
    });

    const savedLang = localStorage.getItem("lang") || "fr";
    setLanguage(savedLang);

    langBtn.addEventListener("click", () => {
        const currentLang = html.getAttribute("lang") || "fr";
        const newLang = currentLang === "fr" ? "en" : "fr";
        setLanguage(newLang);
        localStorage.setItem("lang", newLang);
    });

    function setLanguage(lang) {
        document.documentElement.setAttribute("lang", lang);
        document.cookie = "lang=" + lang + ";path=/";
        document.querySelectorAll("[data-fr]").forEach(el => {
            const text = lang === "fr" ? el.getAttribute("data-fr") : el.getAttribute("data-en");
            el.textContent = text;
        });

        document.querySelectorAll("[data-fr-placeholder]").forEach(el => {
            const placeholder = lang === "fr"
                ? el.getAttribute("data-fr-placeholder")
                : el.getAttribute("data-en-placeholder");
            el.setAttribute("placeholder", placeholder);
        });

        langBtn.textContent = lang === "fr" ? "EN" : "FR";
    }
});
