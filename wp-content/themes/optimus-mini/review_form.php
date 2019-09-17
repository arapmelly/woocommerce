<?php

if (isset($_GET['order_id'])) {

	$order_id = $_GET['order_id'];
	//$order = get_order_details($order_id);
	$order = wc_get_order($order_id);

	if ($order) {

		$products = $order->get_items();

		?>

         <table class="table">

		<?php foreach ($products as $product) {
			?>



            <form action="<?php echo get_site_url() . '/wp-comments-post.php'; ?>" method="post"  class="" id="reviewForm">



            <div class="two fields">
                                        <div class="field">
                                           <!--  <label for="author">Name&nbsp;<span class="required">*</span></label> -->
                                            <input id="prod_author" name="author" type="hidden" value="<?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?>" size="30" placeholder="Name" required="">
                                        </div>
                                        <div class="field">
                                            <!-- <label for="email">Email&nbsp;<span class="required">*</span></label> -->
                                            <input id="prod_email" name="email" type="hidden" value="<?php echo $order->get_billing_email(); ?>" size="30" placeholder="Email" required="">
                                        </div>
                                    </div>

                                    <div class="form-submit">
                                       <input type="hidden" id="prod_rating" name="rating" value="">
                                        <input type="hidden" id="comment_content" name="comment_content" value="">

                                       <input type="hidden" name="comment_post_ID" value="<?php echo $product->get_id(); ?> "id="comment_post_ID">
            <input type="hidden" name="comment_parent" id="comment_parent" value="0">

                                      <input type="hidden" id="rating_submit" class="submit button" value="Submit">
                                </div>



        </form>



                <tr>
                    <td>
                        <?php

			$image = get_product_primary_image($product);
			if (!is_null($image)) {
				$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
			}
			?>
                            <div class="image" style="background-image: url(<?php echo isset($image->medium) ? $image->medium : "https://via.placeholder.com/600x600.png?text=No+Image" ?>)">

                            </div> <!-- end of image div -->
                        <?php echo $product->get_name(); ?>

                        </td>
                    <td>
                         <div class="rating-widget">
            <div class="stars"  id="prod_stars" data-score="" onclick="submit_rating()"></div>
        </div>
                    </td>
                </tr>


            <?php
}

		?>
    </table>
        <?php

	} else {

		?>
        <p>Sorry! we could not find your order.</p>

        <?php

	}

}

?>





<script type="text/javascript">

    function submit_rating(){

        document.getElementById('prod_rating').value = $('#prod_stars').raty('score');


            var frm = $('#reviewForm');
            var url = frm.attr("action");
            var formData = frm.serialize();

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function(d) {
                    console.log(d);
                }
            });



    }
</script>






