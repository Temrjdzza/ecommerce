<section class="content-section">
    <div class="auth-container-inline">
        <div class="auth-card-inline">
            <div class="auth-header">
                <h2>Добро пожаловать в Pando!</h2>
                <p>Войдите в свой аккаунт</p>
            </div>

            <form class="auth-form" action="includes/auth.php" method="POST">
                <input type="hidden" name="action" value="login">
                
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
                    <input type="password" id="password" name="password" required placeholder="Введите ваш пароль">
                    <span class="toggle-password" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Запомнить меня
                    </label>
                    <a href="#" class="forgot-password">Забыли пароль?</a>
                </div>

                <button type="submit" class="auth-button">
                    <i class="fas fa-sign-in-alt"></i>
                    Войти
                </button>
            </form>

            <div class="auth-footer">
                <p>Нет аккаунта? <a href="?page=register">Зарегистрироваться</a></p>
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
    </script>
</section>