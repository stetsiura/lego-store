<footer class="main-footer bg-brand">
    <div class="container clearfix">
        <div class="bottom-menu-subscribe">
            <p class="form-header">Подпишитесь на нашу рассылку</p>
            <form id="subscribe-form" action="/support/subscribe/">
                <div class="footer-subscribe">
                    <input type="text" class="subscribe-input" placeholder="Ваш E-mail..." id="subscribe-email" />
                    <button type="submit" class="subscribe-btn">
                        Подписаться
                    </button>
                </div>
            </form>
            <p class="form-footer">
                Обещаем присылать только самые интересные предложения!
            </p>
        </div>
        <div class="social-payment-methods">
            <p class="social-header">
                Мы в социальных сетях
            </p>
            <ul>
                <li>
                    <a href="https://www.facebook.com/minisoua/" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/minisoukraine/" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="footer-menu">
            <ul>
                <li>
                    <img src="/app/assets/img/common/footer-logo.png" alt="Miniso logo" />
                </li>
                <li>
                    <a href="/catalog/" class="link color-white">Каталог</a>
                </li>
                <li>
                    <a href="/news/" class="link color-white">Новости</a>
                </li>
                <li>
                    <a href="/about-us/" class="link color-white">О нас</a>
                </li>
                <li>
                    <a href="/support/" class="link color-white">Поддержка</a>
                </li>
            </ul>
            <span class="copyright">
                &COPY; <?php echo date("Y"); ?> MINISO Украина. Все права защищены
            </span>
        </div>
    </div>
</footer>

<div id="notification" class="notification success">
    <i class="fa fa-check-circle"></i>
    <div id="notification-content" class="notification-content">
        Добро пожаловать на сайт &laquo;MINISO Украина&raquo;!
    </div>
</div>

<?php Asset::render('js'); ?>
</body>
</html>