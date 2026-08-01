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
    const tooltip = document.getElementById("cursor-tooltip");
    const tooltipLabel = document.getElementById("cursor-tooltip-label");

    if (cursor) {
        cursor.classList.add("cursor-ring--active");
        document.body.classList.add("custom-cursor-active");

        const HOVER_SELECTOR = "a, button, .tilt-card";
        const TOOLTIP_OFFSET = 26;
        let pointerX = -1;
        let pointerY = -1;
        let hoveredEl = null;
        let frameQueued = false;

        function setHovered(el) {
            if (el === hoveredEl) return;
            hoveredEl = el;
            cursor.classList.toggle("cursor-ring--hover", !!el);
            const text = el?.dataset.cursorText || "";
            if (tooltip) {
                tooltip.classList.toggle("cursor-tooltip--visible", !!text);
                tooltipLabel.textContent = text;
            }
        }

        // Posisi + cek elemen di bawah cursor digabung jadi satu rAF per frame —
        // daripada elementFromPoint() dipanggil di tiap raw event (bisa ratusan
        // kali/detik di mouse polling rate tinggi).
        function syncFrame() {
            frameQueued = false;
            cursor.style.transform = `translate3d(${pointerX}px, ${pointerY}px, 0)`;
            if (tooltip) {
                tooltip.style.transform = `translate3d(${
                    pointerX + TOOLTIP_OFFSET
                }px, ${pointerY + TOOLTIP_OFFSET}px, 0)`;
            }
            if (pointerX < 0) return;
            const target = document.elementFromPoint(pointerX, pointerY);
            setHovered(target ? target.closest(HOVER_SELECTOR) : null);
        }

        function queueSync(x, y) {
            if (x !== undefined) pointerX = x;
            if (y !== undefined) pointerY = y;
            if (frameQueued) return;
            frameQueued = true;
            requestAnimationFrame(syncFrame);
        }

        window.addEventListener(
            "pointermove",
            (e) => queueSync(e.clientX, e.clientY),
            { passive: true }
        );

        // Scroll bisa mindahin elemen yang ada di bawah cursor tanpa mouse-nya
        // sendiri gerak — jadi mouseenter/mouseleave gak sempet kepanggil, dan
        // tooltip-nya nyangkut walau elemennya udah gak di bawah cursor lagi.
        // Makanya posisi terakhir cursor tetep dicek ulang tiap scroll.
        window.addEventListener("scroll", () => queueSync(), {
            passive: true,
        });

        document.addEventListener("pointerleave", () => setHovered(null));
        window.addEventListener("blur", () => setHovered(null));
    }
}

// --- Entrance effect: benang ditenun (loom) + sekoci lewat, lalu menyatu ke wordmark + slogan, fade-out ---
if (!prefersReducedMotion) {
    const entrance = document.getElementById("entrance");
    if (entrance) {
        // Nunggu shuttle lewat + ripple warna kelar (~1325ms), loom menyusut bareng wordmark muncul
        setTimeout(() => {
            entrance.classList.add("entrance--collapsing");
            entrance.classList.add("entrance--title-visible");
        }, 1350);
        setTimeout(
            () => entrance.classList.add("entrance--slogan-visible"),
            1800
        );
        setTimeout(() => entrance.classList.add("entrance--done"), 2700);
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

// --- Scroll-reveal: elemen dengan class "reveal" atau "reveal-line" fade/slide
// tiap masuk viewport, dan balik ke state semula tiap keluar viewport — jadi
// animasinya ngulang baik pas scroll turun maupun scroll naik, gak cuma sekali. ---
if (!prefersReducedMotion) {
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                entry.target.classList.toggle(
                    "reveal--visible",
                    entry.isIntersecting
                );
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -60px 0px" }
    );

    document
        .querySelectorAll(".reveal, .reveal-line, .reveal-image")
        .forEach((el) => revealObserver.observe(el));
} else {
    document
        .querySelectorAll(".reveal, .reveal-line, .reveal-image")
        .forEach((el) => el.classList.add("reveal--visible"));
}

// --- Tilt card: efek miring halus ngikutin posisi kursor, cuma di device mouse ---
if (hasFinePointer && !prefersReducedMotion) {
    document.querySelectorAll(".tilt-card").forEach((card) => {
        let queued = false;
        let lastEvent = null;

        function applyTilt() {
            queued = false;
            const rect = card.getBoundingClientRect();
            const x = (lastEvent.clientX - rect.left) / rect.width - 0.5;
            const y = (lastEvent.clientY - rect.top) / rect.height - 0.5;
            card.style.setProperty("--tilt-x", `${y * -14}deg`);
            card.style.setProperty("--tilt-y", `${x * 14}deg`);
            card.style.setProperty("--tilt-scale", "1.04");
        }

        card.addEventListener(
            "mousemove",
            (e) => {
                lastEvent = e;
                if (queued) return;
                queued = true;
                requestAnimationFrame(applyTilt);
            },
            { passive: true }
        );
        card.addEventListener("mouseleave", () => {
            card.style.setProperty("--tilt-x", "0deg");
            card.style.setProperty("--tilt-y", "0deg");
            card.style.setProperty("--tilt-scale", "1");
        });
    });
}
