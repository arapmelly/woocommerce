
<footer class="footer">
    <div class="inner-wrapper">
        <h3>CONTACT US</h3>
        <ul>
            <li><span>Phone:</span> <a href="tel:<?php echo get_option('blogprimaryphonenumber'); ?>"> <?php echo get_option('blogprimaryphonenumber'); ?></a></li>
            <li><span>Email:</span> <a href="mailto:<?php echo get_option('blogprimaryemail'); ?>"><?php echo get_option('blogprimaryemail'); ?></a></li>
            <li><span>Address:</span> <?php echo get_option('blogprimaryaddress'); ?></li>
           <!-- <li>P. O. Box 0000 GPO 00100 <br>Nairobi ,Kenya</li> -->
        </ul>

        <div class="copyright">

            <ul>
                <li>© 2019 Squad</li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms of Use</a></li>

            </ul>
        </div>

    </div>
</footer>

<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/jquery-3.4.1.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/plugins.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/main.js'; ?>"></script>
</body>
</html>