jQuery(document).ready(function($) {
 
    $('.stars').raty({
        starType: 'i',
        score: function () {
            //return $(this).attr('data-score');
            return $('stars').raty('score');
        },
        click: function (score, evt) {


            $('#product_rating-form').modal();

            //set the value of the form rating
            document.getElementById("shop_rating_score").value = score;
            
            //generate a cookieId and post the score via ajax


            /* $.ajax({
                url: rating_ajax_obj.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                data: {
                    'action': 'rate_shop_ajax',
                    'rating' : score
                },
                success:function(data) {
                    // This outputs the result of the ajax request
                    console.log(data);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });  */

            console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
            document.getElementById("submit_shop_rating").click(); 
        }
    });

              
});