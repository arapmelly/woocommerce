<?php if (is_front_page()): ?>
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

                            <?php endif;?>