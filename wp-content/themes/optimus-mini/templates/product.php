                            <div class="item card">
                                <div class="image">
                                    
                                    <span class="caol-ila_1984"><?php echo $product->get_image(); ?></span>

                                
                                    
                                </div>
                                <div class="content price-discount">
                                    <div class="header price"><?php echo wc_price($product->get_price()); ?></div>
                                    
                                    <?php if($product->is_on_sale()) { ?> 
                                        <div class="header price" style="text-decoration:line-through"><?php echo wc_price($product->get_regular_price()); ?></div>
                                        <div class="discount"><?php echo get_percentage_discount($product); ?> Off</div>
                                    <?php } ?>
                                    
                                </div>
                                <div class="content">
                                    <div class="header"><?php echo $product->get_name(); ?></div>
                                    <div class="description">
                                    <?php echo $product->get_description(); ?>
                                    </div>
                                </div>

                                

                                <a href="<?php echo $product->add_to_cart_url(); ?>" class="ui bottom attached button">
                                    buy
                                </a>
                            </div>