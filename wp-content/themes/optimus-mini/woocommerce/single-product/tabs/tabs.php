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

	if ( ! defined( 'ABSPATH' ) ) {
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

	$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

	if ( ! $short_description ) {
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
                <p><?php echo $product->get_short_description(); // WPCS: XSS ok.                                    ?></p>
            </div>
        </div>
        <div id="tab-2">
            <div class="styled-text section-inner-wrapper">

                <p><?php echo $product->get_description(); // WPCS: XSS ok.                                    ?></p>


            </div>
        </div>
        <div id="tab-3">
            <div class="reviews">


                <div class="total-rating">
                    <header class="rating-header">
                        <div class="num-rating">
                            <span class="rating"><?php echo $product->get_average_rating(); ?></span>
                            <div class="stars" data-score="0"></div>
                        </div>
                        <div class="rating-widget">
                            <div class="tag-descriptor"><span
                                        class="total-reviews"><?php echo $product->get_review_count(); ?> Reviews</span>
                            </div>
                        </div>
                    </header>
                </div>

                <div class="section-inner-wrapper">

					<?php $reviews = get_approved_comments( $product->get_id() ); ?>

					<?php foreach ( $reviews as $review ) { ?>

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

					<?php } ?>


                    <div class="review-textarea">
                        <form method="post">
                            <div class="form-input">
                                <!--<input id="postReview" class="post-review" placeholder="Write a review">-->

                                <textarea rows="4" class="post-review" placeholder="Write a review"></textarea>
                            </div>

                            <div class="submit-review">
                                <button type="button" class="ui button"><span class="icon-paper-plane-outline"/>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" defer>

    // $( document ).ready(function() {
    //     $('.stars').raty({
    //             starType: 'i',
    //             score: function () {
    //                 return $(this).attr('data-score');
    //             },
    //             click: function(score, evt) {
    //                 console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
    //             }
    //         });
    // });


    // (function ($) {
    // })();


</script>