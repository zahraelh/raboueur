
// animation page ACCUEIL titre "A PROPOS "
const titre = document.querySelector('.ti');

let isUp = true;

function animateTitle() {
    if (isUp) {
        titre.classList.remove('down');
        titre.classList.add('up');
    } else {
        titre.classList.remove('up');
        titre.classList.add('down');
    }
    
    isUp = !isUp;
}

setInterval(animateTitle, 1500); // Répète l'animation toutes les 1,5 seconde
   

// ANIMATION PHOTOS PAGE ACCUEIL
function Slider() {
    const carouselSlides = document.querySelectorAll('.slide');
    const btnPrev = document.querySelector('.prev');
    const btnNext = document.querySelector('.next');
    const dotsSlide = document.querySelector('.dots-container');
    let currentSlide = 0;
  
    const activeDot = function (slide) {
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        document.querySelector(`.dot[data-slide="${slide}"]`).classList.add('active');
    };
    activeDot(currentSlide);

    const changeSlide = function (slides) {
        carouselSlides.forEach((slide, index) => (slide.style.transform = `translateX(${100 * (index - slides)}%)`));
    };
    changeSlide(currentSlide);

    btnNext.addEventListener('click', function () {
        currentSlide++; 
        if (carouselSlides.length - 1 < currentSlide) {
            currentSlide = 0;
        };
        changeSlide(currentSlide);
        activeDot(currentSlide);
});
    btnPrev.addEventListener('click', function () {
        currentSlide--;
        if (0 >= currentSlide) {
            currentSlide = 0;
        }; 
        changeSlide(currentSlide);
        activeDot(currentSlide);
    });

    dotsSlide.addEventListener('click', function (e) {
        if (e.target.classList.contains('dot')) {
            const slide = e.target.dataset.slide;
            changeSlide(slide);
            activeDot(slide);
        }
    });
  };
Slider();
// FIN ANIMATION


// ANIMATION PHOTOS PAGE PRO 
$(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );
//   FIN ANIMATION