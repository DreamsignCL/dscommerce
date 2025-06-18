/*Menú mobile*/
document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('main-nav').classList.toggle('active');
});
document.getElementById('menu-close').addEventListener('click', function () {
    document.getElementById('main-nav').classList.remove('active');
});

document.addEventListener('DOMContentLoaded', function () {
    /*-----------------------------
    --------- Slider home ---------
    -----------------------------*/
    
    const slider = document.querySelector('.slider');
    const slideContainer = slider.querySelector('.slider__slides');
    const slides = slider.querySelectorAll('.slider__slide');
    const prevBtn = slider.querySelector('.slider__button--prev-slide');
    const nextBtn = slider.querySelector('.slider__button--next-slide');

    let currentIndex = 0;
    const totalSlides = slides.length;
    let autoSlideInterval;

    function updateSlidePosition() {
        slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlidePosition();
    }

    function prevSlideFunc() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlidePosition();
    }

    // Botones de navegación
    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoSlide();
    });

    prevBtn.addEventListener('click', () => {
        prevSlideFunc();
        resetAutoSlide();
    });

    // Auto slide cada 5 segundos
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    startAutoSlide();

    /*-----------------------------
    ------------ Modal ------------
    -----------------------------*/

    const triggers = document.querySelectorAll('[data-modal-target]');
    const closeElements = document.querySelectorAll('[data-modal-close]');

    triggers.forEach(trigger => {
        const targetId = trigger.getAttribute('data-modal-target');
        const targetModal = document.getElementById(targetId);

        trigger.addEventListener('click', () => {
        if (targetModal) {
            targetModal.classList.add('modal--active');
        }
        });
    });

    closeElements.forEach(el => {
        el.addEventListener('click', () => {
        const modal = el.closest('.modal');
        if (modal) {
            modal.classList.remove('modal--active');
        }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
        document.querySelectorAll('.modal.modal--active').forEach(modal => {
            modal.classList.remove('modal--active');
        });
        }
    });
});



/*Firma Dreamsign*/
fetch('https://www.dreamsign.cl/ds-signs/ds-sign-2025.html')
.then(response => response.text())
.then(html => {
    document.getElementById('ds-signature').innerHTML = html;
})
.catch(error => console.error('Error cargando la firma:', error));