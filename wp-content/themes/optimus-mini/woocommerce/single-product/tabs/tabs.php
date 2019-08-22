<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

global $post;
global $product;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if (!$short_description) {
	return;
}

$_product_warranty = get_post_meta($product->get_id(), '_product_warranty', true);
$_product_return_policy = get_post_meta($product->get_id(), '_product_return_policy', true);
$_product_expected_delivery_date = get_post_meta($product->get_id(), '_product_expected_delivery_date', true);
?>


<div id="tabs" class="tabs">

    <ul class="tab-items">
        <li><a href="#tab-1">Product description</a></li>
        <?php
if (!empty($_product_expected_delivery_date) || !empty($_product_return_policy) || !empty($_product_expected_delivery_date)) {
	?>
                <li><a href="#tab-2">Additional Information</a></li>
                <?php
}
?>
<!--        <li><a href="#tab-3">Reviews</a></li>-->
    </ul>

    <div id="tabs_container" class="tabs-container">
        <div id="tab-1">
            <div class="styled-text section-inner-wrapper">

                <h2>Product description</h2>
                <p><?php echo $product->get_short_description(); // WPCS: XSS ok.                                                                                                                                                              ?></p>
            </div>
        </div>

        <div id="tab-2">
            <div class="styled-text section-inner-wrapper">
	            <?php
if (get_post_meta($product->get_id(), '_product_warranty', true)) {
	?>
                            <p><b>Warranty Information</b></p>
                        <?php
echo get_post_meta($product->get_id(), '_product_warranty', true);
}

if (get_post_meta($product->get_id(), '_product_return_policy', true)) {
	?>
                            <p><b>Return Policy</b></p>
                        <?php
echo get_post_meta($product->get_id(), '_product_return_policy', true);
}

if (get_post_meta($product->get_id(), '_product_expected_delivery_date', true)) {
	?>
                            <p><b>Expected Delivery Date</b></p>
                        <?php
echo get_post_meta($product->get_id(), '_product_expected_delivery_date', true);
}
?>
            </div>
        </div>

    </div>
</div>

<!-- Modal HTML embedded directly into document -->
<!--https://github.com/kylefox/jquery-modal-->
<div id="product_rating-form" class="modal-rating">

    <div class="your-rating">


        <div class="rating-widget">
            <div class="stars"  id="prod_stars" data-score=""></div>
        </div>


    </div>

    <div class="login-btns">
        <!-- <p>Login To Submit Your Rating</p> -->
        <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" class="button facebook">
</fb:login-button>
 -->
 <p>Login To Submit Your Rating</p>
<div id="status">
</div>
        <a href="#" class="button facebook" id="fb_login" style="display: ;"> <span class="icon-facebook"></span> Log In With facebook</a>
         <a href="#" class="button google" id="google_login_button" style="display: ;"> <span class="icon-google"> <img src="<?php echo get_template_directory_uri() . '/images/google-icon.svg'; ?>"> </span> Log In With Google</a>
    </div>


     <form action="<?php echo get_site_url() . '/wp-comments-post.php'; ?> "method="post" style="display: none;">

            <input type="text" id="prod_rating" name="rating" value="">
            <input type="text" id="prod_author" name="author" value="">
            <input type="text" id="prod_email" name="email" value="">
            <input type="text" name="comment_post_ID" value="<?php echo $product->get_id(); ?> "id="comment_post_ID">
            <input type="text" name="comment_parent" id="comment_parent" value="0">
            <input type="submit" id="rating_submit" class="submit button" value="Submit">

        </form>


        <script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};HandleGoogleApiLibrary()" onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>

        <script>

// Called when Google Javascript API Javascript is loaded
function HandleGoogleApiLibrary() {
  // Load "client" & "auth2" libraries
  gapi.load('client:auth2', {
    callback: function() {
      // Initialize client library
      // clientId & scope is provided => automatically initializes auth2 library
      gapi.client.init({
          apiKey: 'AIzaSyBGK442K-SxJ-5ChVV1bdIy1fMvQe4Y9Qw',
          clientId: '214940814253-fd11ba7nje065ncau0srk2p2keam69ea.apps.googleusercontent.com',
          scope: 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me'
      }).then(
        // On success
        function(success) {
            // After library is successfully loaded then enable the login button
            //$("#login-button").removeAttr('disabled');
            console.log('library initialized');
        },
        // On error
        function(error) {
          console.log(error);
          alert('Error : Failed to Load Library');
          }
      );
    },
    onerror: function() {
      // Failed to load libraries
    }
  });
}

 document.getElementById('google_login_button').addEventListener('click', function() {
    //do the login

    console.log('login button clicked');
  // API call for Google login
  gapi.auth2.getAuthInstance().signIn().then(
    // On success
    function(success) {
      // API call to get user information
      gapi.client.request({ path: 'https://www.googleapis.com/plus/v1/people/me' }).then(
        // On success
        function(success) {
          console.log(success);
          var user_info = JSON.parse(success.body);
          console.log(user_info);


          document.getElementById('prod_rating').value = $('#prod_stars').raty('score');
          document.getElementById('prod_author').value = user_info.displayName;
          document.getElementById('prod_email').value = user_info.emails[0].value;

          document.getElementById('rating_submit').click();

          document.getElementById('status').innerHTML = 'Thanks for submitting your rating, ' + user_info.displayName + '!';

          document.getElementById('fb_login').style.display = "none";
          document.getElementById('google_login_button').style.display = "none";




        },
        // On error
        function(error) {
          //$("#login-button").removeAttr('disabled');
          alert('Error : Failed to get user user information');
        }
      );
    },
    // On error
    function(error) {
      //$("#login-button").removeAttr('disabled');
      alert('Error : Login Failed');
    }
  );

}, false);



</script>


</div>







<script>

    document.getElementById('fb_login').addEventListener('click', function() {
    //do the login

    FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
}, false);


  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.

      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = '<p>Please login ' +
        'via facebook to submit your rating.</p>';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '379249239673535',
      cookie     : true,  // enable cookies to allow the server to access
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // The Graph API version to use for the call
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {

    FB.api('/me', { fields: 'name, email'} , function(response) {



    document.getElementById('fb_login').style.display = "none";
    document.getElementById('google-login-button').style.display = "none";

    document.getElementById('prod_rating').value = $('#prod_stars').raty('score');
    document.getElementById('prod_author').value = response.name;
    document.getElementById('prod_email').value = response.email;

    document.getElementById('rating_submit').click();

    document.getElementById('status').innerHTML =
        'Thanks for submitting your rating, ' + response.name + '!';
    });
  }
</script>

