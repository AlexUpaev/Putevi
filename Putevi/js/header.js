// Sticky header при прокрутке
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (!header) return;

    if (window.scrollY > 50) {
        header.classList.add('scroll-header', 'navbar-sticky');
    } else {
        header.classList.remove('scroll-header', 'navbar-sticky');
    }
});

// Функция показывает нужный раздел и скрывает остальные
function showSection(sectionId) {
    event.preventDefault();

    // Скрыть все секции
    document.querySelectorAll('.section-content').forEach(sec => sec.classList.remove('active'));

    // Показать нужную
    const section = document.getElementById(sectionId);
    if (section) {
        section.classList.add('active');

        // Прокрутка к секции с плавностью
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

// Закрытие активной секции при клике вне её
document.addEventListener('click', function(event) {
    const activeSections = document.querySelectorAll('.section-content.active');

    activeSections.forEach(section => {
        const sectionId = section.id;
        const link = document.querySelector(`[onclick="showSection('${sectionId}')"]`);

        if (
            !section.contains(event.target) &&
            event.target !== link &&
            !event.target.closest(`.dropdown-content`) // Не закрывать при клике по выпадающему меню
        ) {
            section.classList.remove('active');
        }
    });
});