</div> <!-- Wrapper -->
<footer class="footer">
    <div class="inner-wrapper">
        <h3>CONTACT US</h3>
        <ul>
            <?php if (get_option('blogprimaryphonenumber')) { ?>
                <li><span>Phone:</span> <a
                        href="tel:<?php echo get_option('blogprimaryphonenumber'); ?>"> <?php echo get_option('blogprimaryphonenumber'); ?></a>
                </li><?php } ?>
            <?php if (get_option('admin_email')) { ?>
                <li><span>Email:</span> <a
                        href="mailto:<?php echo get_option('admin_email'); ?>"><?php echo get_option('admin_email'); ?></a>
                </li><?php } ?>
            <?php if (get_option('blogprimaryaddress')) { ?>
                <li><span>Address:</span> <?php echo get_option('blogprimaryaddress'); ?></li><?php } ?>
        </ul>

        <div class="copyright">

            <ul>
                <li>© 2019 <a href="https://goby.shop" target="_blank">Goby</a> </li>
                <li><a href="https://goby.shop/privacy.php" target="_blank">Privacy</a></li>
<!--                <li><a href="#">Terms of Use</a></li>-->

            </ul>

            <span id="siteseal">
                <script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=HhUTlNug1eynlbSH1Cx7pT6wGCkzW5K8K9x2Q6OdAoaxEbpcBUWDTASoTLpg"></script>
            </span>
        </div>

    </div>
</footer>

<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/jquery-3.4.1.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/plugins.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/main.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/shop_rating.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/tracking.js'; ?>"></script>
</body>
</html>