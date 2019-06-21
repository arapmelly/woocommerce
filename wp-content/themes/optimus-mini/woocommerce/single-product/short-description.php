<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if (!$short_description) {
	return;
}

?>


<div id="tabs" class="tabs">

        <ul class="tab-items">
            <li><a href="#tab-1">Overview</a></li>
            <li><a href="#tab-2">Details</a></li>
            <li><a href="#tab-3">Reviews</a></li>
        </ul>

        <div id="tabs_container" class="tabs-container">
            <div id="tab-1">
                <div class="styled-text section-inner-wrapper">

                    <h2>Product description</h2>
                    <p><?php echo $short_description; // WPCS: XSS ok.   ?></p>
                </div>
            </div>
            <div id="tab-2">
                <div class="styled-text section-inner-wrapper">
                    <h3>Tasting notes <span class="sub-heading">By Billy Abbott, The Whisky Exchange</span></h3>

                    <p>
                        <strong>Nose:</strong> Vanilla pods, gummi sweets, salted caramel, pineapple cubes, hay and
                        straw. Fruit
                        follows, along with
                        candy necklaces, meadow flowers, green apple skins and freshly-cut pears. Anise and menthol
                        notes hide
                        at
                        the back.</p>

                    <p>
                        <strong>Palate:</strong> Oatcakes and digestive biscuits to start, with sultana-studded
                        shortbread
                        biscuits following on
                        behind. Pineapple, and apple and pear pie notes develop, topped with a pinch of white pepper
                        spice.
                        Citrus
                        notes wash over the pie: lemon zest and fleshy oranges. There's a late appearance icing sugar
                        sweetness
                        over
                        the top and a touch of cocoa and raisin underneath.
                    </p>

                    <p><strong>Finish:</strong> Hay, butter, caramel and gentle spice.</p>
                    <p>
                        <strong>Comment:</strong> A perfect balance between Bunnahabhain's weighty, buttery spirit and
                        long-aged
                        fruity notes. The
                        spice provides a contrast, but doesn't get too much.
                    </p>
                </div>
            </div>
            <div id="tab-3">
                <div class="reviews">
                    <div class="total-rating">
                        <header class="rating-header">
                            <div class="num-rating">
                                <span class="rating">4.25</span>
                                <div class="stars" data-score="4.5"></div>
                            </div>
                            <div class="rating-widget">
                                <div class="tag-descriptor"><span class="total-reviews">560 Reviews</span></div>
                            </div>
                        </header>
                    </div>

                    <div class="section-inner-wrapper">
                        <div class="item-review">
                            <div class="image">
                                <img src="img/review/adult-bed-bedroom-breakfast-364362.png"
                                     srcset="img/review/adult-bed-bedroom-breakfast-364362@2x.png 2x, img/review/adult-bed-bedroom-breakfast-364362@3x.png 3x"
                                     class="adult-bed-bedroom-breakfast-364362">
                            </div>
                            <div class="review">
                                <div class="inner">
                                    <h3>Jane Doe</h3>
                                    <!--<p>When will the discount be?</p>-->
                                    <p>Nose: Vanilla pods, gummi sweets, salted caramel, pineapple cubes, hay and straw. Fruit
                                        follows, along with candy necklaces, meadow flowers, green apple skins and freshly-cut
                                        pears. Anise and menthol notes hide at the back.</p>
                                </div>
                                <div class="date-time"><span class="icon-clock-outline"></span><span>01:34 PM</span></div>
                            </div>

                        </div>
                        <div class="item-review">
                            <div class="image">
                                <img src="img/review/adult-bed-bedroom-breakfast-364362.png"
                                     srcset="img/review/adult-bed-bedroom-breakfast-364362@2x.png 2x, img/review/adult-bed-bedroom-breakfast-364362@3x.png 3x"
                                     class="adult-bed-bedroom-breakfast-364362">
                            </div>
                            <div class="review">
                                <div class="inner">
                                    <h3>Jane Doe</h3>
                                    <p>When will the discount be?</p>
                                </div>
                                <div class="date-time"><span class="icon-clock-outline"></span><span>01:34 PM</span></div>
                            </div>

                        </div>
                        <div class="item-review">
                            <div class="image">
                                <img src="img/review/adult-bed-bedroom-breakfast-364362.png"
                                     srcset="img/review/adult-bed-bedroom-breakfast-364362@2x.png 2x, img/review/adult-bed-bedroom-breakfast-364362@3x.png 3x"
                                     class="adult-bed-bedroom-breakfast-364362">
                            </div>
                            <div class="review">
                                <div class="inner">
                                    <h3>Jane Doe</h3>
                                    <p>When will the discount be?</p>
                                </div>
                                <div class="date-time"><span class="icon-clock-outline"></span><span class="time">01:34 PM</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-textarea">
                            <form method="post">
                                <div class="form-input">
                                    <!--<input id="postReview" class="post-review" placeholder="Write a review">-->

                                    <textarea rows="4" class="post-review" placeholder="Write a review"></textarea>
                                </div>

                                <div class="submit-review">
                                    <button type="button" class="ui button"><span class="icon-paper-plane-outline"/></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
