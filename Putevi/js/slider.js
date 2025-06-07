document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const slidesContainer = document.querySelector('.slides');
    let currentSlide = 0;
    
    // Показываем текущий слайд
    function showSlide(index) {
        // Скрываем все слайды
        slides.forEach(slide => {
            slide.style.display = 'none';
            slide.style.opacity = '0';
            slide.style.transition = 'opacity 0.5s ease';
        });
        
        // Показываем выбранный слайд с плавным появлением
        slides[index].style.display = 'block';
        setTimeout(() => {
            slides[index].style.opacity = '1';
        }, 10);
        
        currentSlide = index;
    }
    
    // Переход к предыдущему слайду
    prevBtn.addEventListener('click', function() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    });
    
    // Переход к следующему слайду
    nextBtn.addEventListener('click', function() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    });
    
    // Эффекты при наведении на стрелки
    [prevBtn, nextBtn].forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 0 10px rgba(0, 91, 170, 0.5)';
            this.style.transform = 'translateY(-50%) scale(1.1)';
            this.style.background = 'rgba(255, 255, 255, 0.95)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
            this.style.transform = 'translateY(-50%) scale(1)';
            this.style.background = 'rgba(255, 255, 255, 0.7)';
        });
    });
    
    // Инициализация первого слайда
    showSlide(currentSlide);
});