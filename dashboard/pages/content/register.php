<section class="content-section">
    <div class="auth-container-inline">
        <div class="auth-card-inline">
            <div class="auth-header">
                <h2>Создать аккаунт Pando</h2>
                <p>Заполните форму для регистрации</p>
            </div>

            <form class="auth-form" action="includes/auth.php" method="POST">
                <input type="hidden" name="action" value="register">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">
                            <i class="fas fa-user"></i>
                            Имя
                        </label>
                        <input type="text" id="first_name" name="first_name" required placeholder="Введите ваше имя">
                    </div>

                    <div class="form-group">
                        <label for="last_name">
                            <i class="fas fa-user"></i>
                            Фамилия
                        </label>
                        <input type="text" id="last_name" name="last_name" required placeholder="Введите вашу фамилию">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email адрес
                    </label>
                    <input type="email" id="email" name="email" required placeholder="Введите ваш email">
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Пароль
                    </label>
                    <input type="password" id="password" name="password" required placeholder="Создайте пароль">
                    <span class="toggle-password" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">
                        <i class="fas fa-lock"></i>
                        Подтвердите пароль
                    </label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Повторите пароль">
                    <span class="toggle-password" onclick="togglePassword('confirm_password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark"></span>
                        Я принимаю <a href="#">условия использования</a>
                    </label>
                </div>

                <button type="submit" class="auth-button">
                    <i class="fas fa-user-plus"></i>
                    Зарегистрироваться
                </button>
            </form>

            <div class="auth-footer">
                <p>Уже есть аккаунт? <a href="?page=login">Войти</a></p>
            </div>
        </div>
    </div>

    <script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Пароли не совпадают!');
        }
    });
    </script>
</section>