import "../css/app.css";
import "../css/components.css";
import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

window.Alpine = Alpine;

Alpine.plugin(collapse);

Alpine.start();


/* =========================================================
   PRODUCT CARD REVEAL
========================================================= */

document.addEventListener("DOMContentLoaded", () => {
    const productCards = document.querySelectorAll(
        "[data-product-card]"
    );

    if (!productCards.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add("is-visible");

                obs.unobserve(entry.target);
            });
        },
        {
            threshold: 0.12,
            rootMargin: "0px 0px -40px 0px",
        }
    );

    productCards.forEach((card) => {
        observer.observe(card);
    });
});
/* =========================================================
   FARZIN HERO
   Mouse Parallax + Scroll Interaction
========================================================= */

document.addEventListener("DOMContentLoaded", () => {
    const hero = document.querySelector("[data-hero]");

    if (!hero) {
        return;
    }

    const visual = hero.querySelector("[data-hero-visual]");
    const media = hero.querySelector("[data-hero-media]");

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    if (reduceMotion.matches) {
        hero.classList.add("is-ready");
        return;
    }


    /* =====================================================
       INTRO
    ====================================================== */

    requestAnimationFrame(() => {
        hero.classList.add("is-ready");
    });


    /* =====================================================
       MOUSE
    ====================================================== */

    let targetX = 0;
    let targetY = 0;

    let currentX = 0;
    let currentY = 0;

    const updateMouse = () => {
        currentX += (targetX - currentX) * 0.08;
        currentY += (targetY - currentY) * 0.08;

        hero.style.setProperty(
            "--hero-mx",
            currentX.toFixed(4)
        );

        hero.style.setProperty(
            "--hero-my",
            currentY.toFixed(4)
        );

        requestAnimationFrame(updateMouse);
    };

    updateMouse();


    if (visual && window.matchMedia("(pointer: fine)").matches) {

        visual.addEventListener("pointermove", (event) => {

            const rect = visual.getBoundingClientRect();

            const x =
                (event.clientX - rect.left)
                / rect.width;

            const y =
                (event.clientY - rect.top)
                / rect.height;

            targetX = (x - 0.5) * 2;
            targetY = (y - 0.5) * 2;
        });


        visual.addEventListener("pointerleave", () => {
            targetX = 0;
            targetY = 0;
        });

    }


    /* =====================================================
       SCROLL
    ====================================================== */

    let ticking = false;

    const updateScroll = () => {

        const rect = hero.getBoundingClientRect();

        const viewportHeight =
            window.innerHeight;

        const progress = Math.min(
            Math.max(
                (viewportHeight - rect.top)
                /
                (viewportHeight + rect.height),
                0
            ),
            1
        );


        const relative =
            Math.min(
                Math.max(
                    -rect.top / viewportHeight,
                    0
                ),
                1
            );


        const moveY =
            relative * -28;

        const scale =
            relative * 0.025;


        hero.style.setProperty(
            "--hero-scroll-y",
            `${moveY}px`
        );

        hero.style.setProperty(
            "--hero-scroll-scale",
            scale.toFixed(4)
        );

        ticking = false;
    };


    const requestScrollUpdate = () => {

        if (!ticking) {
            requestAnimationFrame(
                updateScroll
            );

            ticking = true;
        }
    };


    window.addEventListener(
        "scroll",
        requestScrollUpdate,
        {
            passive: true
        }
    );


    updateScroll();
});
