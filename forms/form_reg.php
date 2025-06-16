<form action="" method="get" class="form">
    <label for="username">Имя пользователя
        <input type="text" name="username" placeholder="VasyaPupkin228">
    </label>
    <label for="password_first">Введите пароль
        <input type="password" name="password_first" id="password_first">
    </label>
    <label for="password_repeat">Повторите пароль
        <input type="text" name="password_repeat">
    </label>
    <label for="phone">Введите ваш номер телефона
    <small>в формате: +7 999 999-99-99</small>
    <input
    type="tel"
    id="phone"
    name="phone"
    pattern="+7 [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}"
    required />
    </label>
    <input type="submit" value="Зарегистрироваться" class="button__register">
</form>