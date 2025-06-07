// Скрипт для галереи проектов
document.addEventListener('DOMContentLoaded', function () {
    const gallery = document.querySelector('.gallery-container');
    const items = document.querySelectorAll('.gallery-item');
    const prevBtn = document.querySelector('.gallery-prev');
    const nextBtn = document.querySelector('.gallery-next');
    let currentIndex = 0;
    const totalItems = items.length;

    function updateGallery() {
        gallery.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalItems;
        updateGallery();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        updateGallery();
    });
});