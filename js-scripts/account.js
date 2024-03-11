const stars = document.querySelectorAll('.star i');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        stars.forEach((otherStar, otherIdx) => {
            if (otherIdx <= index) {
                otherStar.classList.add('selected');
            } else {
                otherStar.classList.remove('selected');
            }
        });
    });
});