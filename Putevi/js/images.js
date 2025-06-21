// Автоматическая отправка формы при выборе файла
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            this.closest('form').submit();
        }
    });
});

// Функции для модального окна
function openModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = "block";
    modalImg.src = imageSrc;
}

function closeModal() {
    document.getElementById('imageModal').style.display = "none";
}

// Закрытие модального окна при клике вне изображения
window.onclick = function (event) {
    const modal = document.getElementById('imageModal');
    if (event.target == modal) {
        closeModal();
    }
}