//
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// --- Custom cursor ringan ---
// Cuma jalan di device yang punya pointer halus (mouse), dan kalau user gak minta reduced motion
const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;
const hasFinePointer = window.matchMedia("(pointer: fine)").matches;

if (hasFinePointer && !prefersReducedMotion) {
    const cursor = document.getElementById("cursor-dot");

    if (cursor) {
        cursor.classList.add("cursor-dot--active");

        window.addEventListener(
            "pointermove",
            (e) => {
                cursor.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0)`;
            },
            { passive: true }
        );
    }
}

// --- Toggle dark/light mode, dipanggil dari tombol di navbar (x-on:click="toggleTheme()") ---
window.toggleTheme = function () {
    const html = document.documentElement;
    const next =
        html.getAttribute("data-theme") === "alhijaz-dark"
            ? "alhijaz-light"
            : "alhijaz-dark";
    html.setAttribute("data-theme", next);
    localStorage.setItem("theme", next);
};
