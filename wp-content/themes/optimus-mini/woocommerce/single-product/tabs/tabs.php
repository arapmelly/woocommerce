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

?>


<div id="tabs" class="tabs">

    <ul class="tab-items">
        <li><a href="#tab-1">Overview</a></li>
        <li><a href="#tab-2">Additional Information</a></li>
        <li><a href="#tab-3">Reviews</a></li>
    </ul>

    <div id="tabs_container" class="tabs-container">
        <div id="tab-1">
            <div class="styled-text section-inner-wrapper">

                <h2>Product description</h2>
                <p><?php echo $product->get_short_description(); // WPCS: XSS ok.                                                                           ?></p>
            </div>
        </div>

        <div id="tab-2">
            <div class="styled-text section-inner-wrapper">

                 <p><b>Warranty Information</b></p>
                <?php if (get_post_meta($product->get_id(), '_product_warranty', true)) {?>
                <p><?php echo get_post_meta($product->get_id(), '_product_warranty', true); ?></p>
            <?php } else {?>
                <p> No warranty information </p>
            <?php }?>

                <p><b>Return Policy</b></p>
                <?php if (get_post_meta($product->get_id(), '_product_return_policy', true)) {?>
                <p><?php echo get_post_meta($product->get_id(), '_product_return_policy', true); ?></p>
            <?php } else {?>
                <p> No return Policy </p>
            <?php }?>


             <p><b>Expected Delivery Date</b></p>
                <?php if (get_post_meta($product->get_id(), '_product_expected_delivery_date', true)) {?>
                <p><?php echo get_post_meta($product->get_id(), '_product_expected_delivery_date', true); ?></p>
            <?php } else {?>
                <p> No expected delivery date information </p>
            <?php }?>


            </div>
        </div>

        <div id="tab-3">
            <div class="reviews">

                <div class="total-rating">
                    <header class="rating-header">
                        <div class="num-rating">
                            <span class="rating"><?php echo $product->get_average_rating(); ?></span>
                            <div class="stars" data-score="<?php echo $product->get_average_rating(); ?>"></div>
                        </div>
                        <div class="rating-widget">
                            <div class="tag-descriptor"><span
                                        class="total-reviews"><?php echo $product->get_review_count(); ?> Reviews</span>
                            </div>
                        </div>
                    </header>
                </div>

                <div class="section-inner-wrapper">

					<?php $reviews = get_approved_comments($product->get_id());?>

					<?php foreach ($reviews as $review) {?>

                        <div class="item-review">
                            <!--
							<div class="image">
								<img src="img/review/adult-bed-bedroom-breakfast-364362.png"
									 srcset="img/review/adult-bed-bedroom-breakfast-364362@2x.png 2x, img/review/adult-bed-bedroom-breakfast-364362@3x.png 3x"
									 class="adult-bed-bedroom-breakfast-364362">
							</div>
							-->
                            <div class="review">
                                <div class="inner">
                                    <h3><?php echo $review->comment_author; ?></h3>
                                    <!--<p>When will the discount be?</p>-->
                                    <p><?php echo $review->comment_content; ?></p>
                                </div>
                                <div class="date-time"><span
                                            class="icon-clock-outline"></span><span><?php echo $review->comment_date; ?></span>
                                </div>
                            </div>

                        </div>

					<?php }?>


                    <!-- <div class="review-textarea">
                        <form method="post">
                            <div class="form-input">


                                <textarea rows="4" class="post-review" placeholder="Write a review"></textarea>
                            </div>

                            <div class="submit-review">
                                <button type="button" class="ui button"><span class="icon-paper-plane-outline"/>
                                </button>
                            </div>
                        </form>
                    </div> -->

                    <div id="review_form" style="display: none;">
                        <div id="respond" class="comment-respond review-textarea">
                            <!--                            <span id="reply-title" class="comment-reply-title">Add a review</span>-->

                            <form action="<?php echo get_site_url() . '/wp-comments-post.php'; ?>" method="post"
                                  id="commentform" class="comment-form ui form">

                                <div class="field">

                                    <div class="comment-form-rating field">
                                        <label for="rating">Your rating</label>
                                        <select name="rating" id="rating" required="">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>
                                    </div>

                                    <div class="two fields">
                                        <div class="field">
                                            <label for="author">Name&nbsp;<span class="required">*</span></label>
                                            <input id="author" name="author" type="text" value="" size="30"
                                                   placeholder="Name" required="">
                                        </div>
                                        <div class="field">
                                            <label for="email">Email&nbsp;<span class="required">*</span></label>
                                            <input id="email" name="email" type="email" value="" size="30"
                                                   placeholder="Email" required="">
                                        </div>
                                    </div>
                                </div>


                                <div class="comment-form-comment form-input">
                                    <!--                                    <label for="comment">Your review&nbsp;<span class="required">*</span></label>-->
                                    <textarea id="comment" name="comment" cols="45" rows="8"
                                              placeholder="Write a review" required=""></textarea>
                                </div>


                                <div class="form-submit">

                                    <input type="hidden" name="comment_post_ID"
                                           value="<?php echo $product->get_id(); ?>" id="comment_post_ID">
                                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">

                                    <input type="submit" id="submit" class="submit button" value="Submit">
                                </div>
                            </form>
                        </div><!-- #respond -->
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


