//
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// --- Custom cursor ring ---
// Cuma jalan di device yang punya pointer halus (mouse), dan kalau user gak minta reduced motion
const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;
const hasFinePointer = window.matchMedia("(pointer: fine)").matches;

if (hasFinePointer && !prefersReducedMotion) {
    const cursor = document.getElementById("cursor-ring");
    const cursorLabel = document.getElementById("cursor-ring-label");

    if (cursor) {
        cursor.classList.add("cursor-ring--active");
        document.body.classList.add("custom-cursor-active");

        window.addEventListener(
            "pointermove",
            (e) => {
                cursor.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0)`;
            },
            { passive: true }
        );

        document.querySelectorAll("a, button, .tilt-card").forEach((el) => {
            el.addEventListener("mouseenter", () => {
                cursor.classList.add("cursor-ring--hover");
                cursorLabel.textContent = el.dataset.cursorText || "";
            });
            el.addEventListener("mouseleave", () => {
                cursor.classList.remove("cursor-ring--hover");
                cursorLabel.textContent = "";
            });
        });
    }
}

// --- Entrance effect: overlay wordmark fade-out pas awal load ---
if (!prefersReducedMotion) {
    const entrance = document.getElementById("entrance");
    if (entrance) {
        requestAnimationFrame(() => entrance.classList.add("entrance--ready"));
        window.addEventListener("load", () => {
            setTimeout(() => entrance.classList.add("entrance--done"), 600);
        });
    }
} else {
    document.getElementById("entrance")?.remove();
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
    window.dispatchEvent(
        new CustomEvent("theme-changed", { detail: { theme: next } })
    );
};

// --- Scroll-reveal: elemen dengan class "reveal" atau "reveal-line" fade/slide begitu masuk viewport ---
if (!prefersReducedMotion) {
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("reveal--visible");
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -60px 0px" }
    );

    document
        .querySelectorAll(".reveal, .reveal-line")
        .forEach((el) => revealObserver.observe(el));
} else {
    document
        .querySelectorAll(".reveal, .reveal-line")
        .forEach((el) => el.classList.add("reveal--visible"));
}

// --- Tilt card: efek miring halus ngikutin posisi kursor, cuma di device mouse ---
if (hasFinePointer && !prefersReducedMotion) {
    document.querySelectorAll(".tilt-card").forEach((card) => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            card.style.setProperty("--tilt-x", `${y * -8}deg`);
            card.style.setProperty("--tilt-y", `${x * 8}deg`);
            card.style.setProperty("--tilt-scale", "1.02");
        });
        card.addEventListener("mouseleave", () => {
            card.style.setProperty("--tilt-x", "0deg");
            card.style.setProperty("--tilt-y", "0deg");
            card.style.setProperty("--tilt-scale", "1");
        });
    });
}
