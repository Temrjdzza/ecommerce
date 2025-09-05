// Mobile menu toggle
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

//-----------------------------
// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.navbar') && navMenu.classList.contains('active')) {
        navMenu.classList.remove('active');
    }
});

//-----------------------------
document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Временный эффект при клике
            this.style.background = 'rgba(52, 152, 219, 0.2)';
            setTimeout(() => {
                this.style.background = '';
            }, 300);
        });
    });


// -----
// Обработка кликов по пунктам меню
        document.querySelectorAll('.menu-item-list').forEach(item => {
            item.addEventListener('click', function() {
                // Если это родительский элемент с подменю
                if (this.nextElementSibling && this.nextElementSibling.classList.contains('submenu-items')) {
                    this.nextElementSibling.classList.toggle('expanded');
                    return;
                }
                
                // Убираем активный класс у всех пунктов меню
                document.querySelectorAll('.menu-item-list.active').forEach(activeItem => {
                    activeItem.classList.remove('active');
                });
                
                // Добавляем активный класс к текущему пункту
                this.classList.add('active');
                
                // Обновляем заголовок контента
                const contentTitle = this.querySelector('span').textContent;
                document.querySelector('.header-content h1').textContent = contentTitle;
            });
        });
        
        // Обработка кликов по подпунктам меню
        document.querySelectorAll('.submenu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.submenu-item.active').forEach(activeItem => {
                    activeItem.classList.remove('active');
                });
                this.classList.add('active');
                
                const contentTitle = this.querySelector('span').textContent;
                document.querySelector('.header-content h1').textContent = contentTitle;
            });
        });
    