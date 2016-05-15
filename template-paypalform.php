<?php
/**
 * Template Name: Paypal Form Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<script type="text/javascript">
    var option_items = {'mon' : 30, 'men' : 10, 'wed' : 15, 'women_adv' : 10, 'women_rec' : 10, 'disc' : 10, 'lights' : 5};
    var option_item_names = {'mon' : "Monday Night Advanced",  'men' : "Men's League",  'wed' : "Wednesday Night Recreational",  'women_adv' : "Women's Advanced League",  'women_rec' : "Women's Rec League",  'disc' : "CMUA Disc",  'lights' : "Lights fee"};

jQuery(document).ready(function($){
    
    function set_optional_paypal() {
        var total = 0;
        var women_total = 0;
        var items_array = []
        for (i in option_items) {
            if ( $('#' + i).is(":checked") ) {
                if (i != 'women_adv' && i != 'women_rec') {
                    total = total + option_items[i];
                }
                else {
                    women_total = 10;
                }
                items_array.push(option_item_names[i]);
            }
        }
        total = total + women_total;
        items = items_array.join(', ');
        $("#dynamic_content").html('<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_xclick"> <input type="hidden" name="business" value="CRPC.pp@gmail.com"> <input type="hidden" name="currency_code" value="USD"> <input type="hidden" name="item_name" value="' + items + '"> <input type="hidden" name="amount" value="' + total + '"> <input type="hidden" name="return" value="http://cmuadisc.org/summer-league-finish-registration"> <input type="hidden" name="cancel_return" value="http://cmuadisc.org/summer-league-finish-registration"> <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it is fast, free and secure!"> </form>');
        $("#optional_cost").html(total);
    }

    $('.opt_check').change(function() {
        set_optional_paypal();
    });
    
    <?php
    foreach ( explode(", ", FrmProEntriesController::get_field_value_shortcode(array('field_id' => 127, 'user_id' => 'current'))) as $val) {
        if ($val == "Monday Night Advanced") {
            echo ("$('#mon').prop('checked', true);");
        }
        elseif ($val == "Men's League") {
            echo ("$('#men').prop('checked', true);");
        }
        elseif ($val == "Wednesday Night Recreational") {
            echo ("$('#wed').prop('checked', true);");
        }
        elseif ($val == "Women's Advanced League") {
            echo ("$('#women_adv').prop('checked', true);");
        }
        elseif ($val == "Women's Rec League") {
            echo ("$('#women_rec').prop('checked', true);");
        }
    }
    if (FrmProEntriesController::get_field_value_shortcode(array('field_id' => 154, 'user_id' => 'current')) == 'Yes' ) {
        echo ("$('#disc').prop('checked', true);");
    }
    echo ("$('#lights').prop('checked', true);");
    ?>

    set_optional_paypal();
});
</script>
