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
            //document.getElementById("shop_rating_score").value = score;
            
            //generate a cookieId and post the score via ajax



            

            console.log('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
            //document.getElementById("submit_shop_rating").click(); 
        }
    });

              
});