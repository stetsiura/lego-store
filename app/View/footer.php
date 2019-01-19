<footer class="footer padding-b-40">
    <div class="container">
        <div class="row clearfix">
            <div class="left-side">
                <div class="logo">
                    <img src="/app/assets/img/common/logo-white.png" alt="BricksUnity logo">
                </div>
                <div class="menu">
                    <span>&COPY; <?php echo date("Y"); ?> BricksUnity</span>
                    <ul>
                        <li><a href="/catalog/">Каталог</a></li>
                        <li><a href="#">Блог</a></li>
                        <li><a href="#">Служба поддержки</a></li>
                    </ul>
                </div>
            </div>
            <div class="right-side">
                <h6>Подписаться на расслыку</h6>
                <div class="email-subscription">
                    <form method="POST">
                        <input type="text" name="email" id="subscription-email" class="subscription-email" placeholder="Ваш E-mail..." /><button type="submit" class="subscription-btn">@</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>


<div id="notification" class="notification success">
    <i class="fa fa-check-circle"></i>
    <div id="notification-content" class="notification-content">
        Добро пожаловать на сайт &laquo;BricksUnity&raquo;!
    </div>
</div>

<?php Asset::render('js'); ?>
</body>
</html>