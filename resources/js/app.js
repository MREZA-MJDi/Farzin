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


    const initJananEditorialSlider = () => {
        const slider = document.querySelector('[data-janan-slider]');

        if (!slider) {
            return;
        }

        const cards = Array.from(
            slider.querySelectorAll('[data-slide-card]')
        );

        const currentEl = slider.querySelector('[data-slider-current]');
        const totalEl = slider.querySelector('[data-slider-total]');

        if (!cards.length) {
            return;
        }

        const total = cards.length;

        let activeIndex = 0;
        let timer = null;

        const updateNumber = () => {
            if (currentEl) {
                currentEl.textContent = String(activeIndex + 1).padStart(2, '0');
            }

            if (totalEl) {
                totalEl.textContent = String(total).padStart(2, '0');
            }
        };

        const updateCards = () => {
            cards.forEach((card, index) => {

                let slot = index - activeIndex;

                if (slot < 0) {
                    slot += total;
                }

                /*
                 * برای 5 کارت:
                 *
                 * 0 = main
                 * 1 = right
                 * 2 = top-right
                 * 3 = top-left
                 * 4 = left
                 */

                card.dataset.slot = slot;
            });

            updateNumber();
        };

        const nextSlide = () => {
            activeIndex = (activeIndex + 1) % total;

            updateCards();
        };

        const start = () => {
            if (timer) {
                clearInterval(timer);
            }

            timer = setInterval(() => {
                nextSlide();
            }, 3000);
        };

        updateCards();
        start();

        /*
         * اگر کاربر با موس خارج شد دوباره ادامه بده
         */
        slider.addEventListener('mouseenter', () => {
            if (timer) {
                clearInterval(timer);
            }
        });

        slider.addEventListener('mouseleave', () => {
            start();
        });

        /*
         * موبایل:
         * اگر swipe کرد، اسلاید هم عوض شود
         */
        let touchStartX = 0;
        let touchEndX = 0;

        slider.addEventListener(
            'touchstart',
            (event) => {
                touchStartX = event.changedTouches[0].clientX;
            },
            { passive: true }
        );

        slider.addEventListener(
            'touchend',
            (event) => {

                touchEndX = event.changedTouches[0].clientX;

                const distance = touchEndX - touchStartX;

                if (Math.abs(distance) > 50) {

                    if (distance < 0) {
                        nextSlide();
                    } else {
                        activeIndex =
                            (activeIndex - 1 + total) % total;

                        updateCards();
                    }

                    start();
                }
            },
            { passive: true }
        );
    };


    document.addEventListener(
        'DOMContentLoaded',
        () => {
            initJananEditorialSlider();
        }
    );

    window.addEventListener(
        "scroll",
        requestScrollUpdate,
        {
            passive: true
        }
    );


    updateScroll();
});
