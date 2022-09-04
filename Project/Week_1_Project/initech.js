let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}
function showSlides(n) {
    let i;
    let gals = document.getElementsByClassName("galleryimages");
    if (n > gals.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = gals.length
    }
    for (i = 0; i < gals.length; i++) {
        gals[i].style.display = "none";
    }
    gals[slideIndex-1].style.display = "inline";
}