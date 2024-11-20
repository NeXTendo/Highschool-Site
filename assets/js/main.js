document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.querySelector(".btn-login");
    
    loginBtn.addEventListener("click", () => {
        alert("Redirecting to login...");
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.3 });

    sections.forEach(section => observer.observe(section));

    // Sticky Header Interaction
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.formal-header');
        if (window.scrollY > 100) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
    });
});
// JavaScript for triggering hero animation on scroll and load
document.addEventListener("DOMContentLoaded", function () {
    const heroSection = document.querySelector(".hero");

    function animateHero() {
        const heroPosition = heroSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;

        // Add 'active' class if hero section is in view
        if (heroPosition < screenPosition) {
            heroSection.classList.add("active");
            window.removeEventListener("scroll", animateHero); // Remove scroll listener after activation
        }
    }

    // Initial check on page load
    animateHero();

    // Scroll listener for rechecking
    window.addEventListener("scroll", animateHero);
});
