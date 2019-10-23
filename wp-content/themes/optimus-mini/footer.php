</div> <!-- Wrapper -->

<div id="age-restriction" class="age-restriction-modal modal">
    <div class="modal-content modal-inner">
        <div class="pattern-age-gate" style="background-image: url(<?php echo get_template_directory_uri() . '/images/pattern-age-gate.png';?>)"></div>

        <div class="modal-message">
            <header class="modal-header">
                <p>In order to continue, please confirm that you are above
                    <strong>18 years of age.</strong></p>
            </header>
            <form id="age-restriction" class="form">
                <ul class="checkbox-list">
                    <li>
                        <button class="button white-border-button" id="above_age">I'm above 18 years</button>
                        <button class="button white-solid-button" ID="below_age">I'm below 18 years</button>
                       <!--  <input type="checkbox" id="chk_html" name="tech_group">
                        <label for="chk_html">Yes, I'm 18 years and above.</label> -->
                    </li>
                </ul>
            </form>
        </div>

    </div>
</div>

<footer class="footer">
    <div id="cookieConsent" style="display:none;">
        <div class="inner-wrapper">
            <p>This website uses cookies to ensure you get the best experience on this website. <a
                        href="https://goby.shop/privacy-policy.php" target="_blank">Privacy Policy</a></p> <a
                    href="javascript:void(0)" class="cookieConsentOK button">Accept</a>
        </div>
    </div>

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

                <li>© 2019 <a href="https://goby.shop" target="_blank">Goby</a></li>
                <li><a href="https://goby.shop/privacy.php" target="_blank">Privacy</a></li>
            </ul>

            <span id="siteseal">
                <li><?php echo getVersion(); ?></li>
                <script async type="text/javascript"
                        src="https://seal.godaddy.com/getSeal?sealID=HhUTlNug1eynlbSH1Cx7pT6wGCkzW5K8K9x2Q6OdAoaxEbpcBUWDTASoTLpg"></script>
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