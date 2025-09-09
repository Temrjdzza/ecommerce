document.addEventListener('DOMContentLoaded', function() {
    console.log('Сайт загружен!');
    
    // Mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.menu-items');
    
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') { // Игнорируем ссылки только с #
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Закрываем мобильное меню после клика
                    if (navMenu && navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        hamburger.classList.remove('active');
                    }
                }
            }
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (navMenu && navMenu.classList.contains('active') && 
            !e.target.closest('.navbar') && 
            !e.target.closest('.menu-items')) {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }
    });

    // Обработка кликов по иконкам в header
    document.querySelectorAll('.header .menu-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Временный эффект при клике
            this.style.background = 'rgba(52, 152, 219, 0.2)';
            setTimeout(() => {
                this.style.background = '';
            }, 300);
        });
    });

    // Обработка кликов по пунктам sidebar меню
    const menuItemLists = document.querySelectorAll('.sidebar .menu-item-list');
    if (menuItemLists.length > 0) {
        menuItemLists.forEach(item => {
            item.addEventListener('click', function(e) {
                // Если кликнули на ссылку внутри, пропускаем стандартное поведение
                if (e.target.tagName === 'A') return;
                
                // Если есть подменю, переключаем его
                const submenu = this.nextElementSibling;
                if (submenu && submenu.classList.contains('submenu-items')) {
                    e.preventDefault();
                    submenu.classList.toggle('expanded');
                    return;
                }
                
                // Убираем активный класс у всех пунктов меню в этой секции
                const parentList = this.closest('.menu-items-list');
                if (parentList) {
                    parentList.querySelectorAll('.menu-item-list.active').forEach(activeItem => {
                        activeItem.classList.remove('active');
                    });
                }
                
                // Добавляем активный класс к текущему пункту
                this.classList.add('active');
            });
        });
    }
    
    // Обработка кликов по подпунктам меню
    const submenuItems = document.querySelectorAll('.sidebar .submenu-item');
    if (submenuItems.length > 0) {
        submenuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Убираем активный класс у всех подпунктов в этом подменю
                const parentSubmenu = this.closest('.submenu-items');
                if (parentSubmenu) {
                    parentSubmenu.querySelectorAll('.submenu-item.active').forEach(activeItem => {
                        activeItem.classList.remove('active');
                    });
                }
                
                // Добавляем активный класс к текущему подпункту
                this.classList.add('active');
            });
        });
    }

    // Обработка поиска
    const searchForm = document.querySelector('.search-container');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchInput = this.querySelector('.search-input');
            if (searchInput.value.trim()) {
                alert('Поиск: ' + searchInput.value);
                searchInput.value = '';
            }
        });
    }

    // Закрытие меню при изменении размера окна (если перешли на десктоп)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu && navMenu.classList.contains('active')) {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        }
    });
});