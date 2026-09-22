import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const initHomeHero = () => {
    const hero = document.querySelector('#home-hero');

    if (!hero) {
        return;
    }

    const video = hero.querySelector('#home-hero-video');
    const revealItems = hero.querySelectorAll('.hero-reveal');
    const title = hero.querySelector('.home-hero__title');
    const productCard = hero.querySelector('.home-hero__product-card');

    const progress = hero.querySelector('#hero-video-progress');
    const currentTime = hero.querySelector('#hero-video-current');
    const durationTime = hero.querySelector('#hero-video-duration');

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    gsap.set(revealItems, {
        opacity: 0,
        y: 34
    });

    if (video) {
        gsap.set(video, {
            scale: 1.06
        });
    }

    if (productCard) {
        gsap.set(productCard, {
            opacity: 0,
            x: -30,
            scale: 0.96
        });
    }

    if (reduceMotion) {
        gsap.set(revealItems, {
            opacity: 1,
            y: 0
        });

        if (video) {
            gsap.set(video, {
                scale: 1
            });
        }

        if (productCard) {
            gsap.set(productCard, {
                opacity: 1,
                x: 0,
                scale: 1
            });
        }

        return;
    }

    const intro = gsap.timeline();

    intro.to(video, {
        scale: 1,
        duration: 1.6,
        ease: 'power2.out'
    });

    intro.to(
        revealItems,
        {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power3.out'
        },
        '-=0.9'
    );

    if (productCard) {
        intro.to(
            productCard,
            {
                opacity: 1,
                x: 0,
                scale: 1,
                duration: 0.8,
                ease: 'power3.out'
            },
            '-=0.45'
        );
    }

    if (title) {
        gsap.to(title, {
            yPercent: -5,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 1
            }
        });
    }

    if (video) {
        gsap.to(video, {
            scale: 1.12,
            yPercent: 5,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 1
            }
        });
    }

    if (video) {
        const updateVideoUI = () => {
            if (!Number.isFinite(video.duration) || video.duration <= 0) {
                return;
            }

            const ratio = video.currentTime / video.duration;

            if (progress) {
                progress.style.width = `${ratio * 100}%`;
            }

            if (currentTime) {
                currentTime.textContent = String(
                    Math.floor(video.currentTime)
                ).padStart(2, '0');
            }

            if (durationTime) {
                durationTime.textContent = String(
                    Math.ceil(video.duration)
                ).padStart(2, '0');
            }
        };

        const playVideo = () => {
            if (video.paused) {
                const promise = video.play();

                if (promise) {
                    promise.catch(() => {});
                }
            }
        };

        video.addEventListener('loadedmetadata', updateVideoUI);
        video.addEventListener('timeupdate', updateVideoUI);
        video.addEventListener('durationchange', updateVideoUI);

        if (video.readyState >= 2) {
            playVideo();
        }

        video.addEventListener('loadeddata', playVideo, {
            once: true
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                video.pause();
            } else {
                playVideo();
            }
        });
    }

    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
    });
};

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        initHomeHero
    );
} else {
    initHomeHero();
}
