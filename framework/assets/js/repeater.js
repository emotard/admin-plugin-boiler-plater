jQuery(document).ready(function ($) {
   
   $('.add-row').on('click', function(index){
     
        var table_id = $(this).parents('table').attr('id');

        var tBody = $('#' + table_id).find('tbody'),
            trLast = tBody.find('tr:last'),
            trNew = trLast.clone();

        trLast.after(trNew);

        reinit_colour_picker();

   });

   function reinit_colour_picker(){

      $('.rl-colour-picker').each(function(index){
        
        var input = $(this);
        
            input.ColorPicker({
            
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            
            onChange: function (hsb, hex, rgb) {
                input.css('backgroundColor', '#' + hex);
                input.val('#' + hex);
            }
              
        });
          
    });
      
  }

   
   
});