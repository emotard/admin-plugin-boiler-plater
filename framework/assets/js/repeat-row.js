jQuery(document).ready(function ($) {
   
   $('.add-row').on('click', function(index){
     
        var table_id = $(this).parents('table').attr('id');

        count = $('#' + table_id + ' tbody tr').size();

        var tBody = $('#' + table_id).find('tbody'),
            trLast = tBody.find('tr:last'),
            trNew = trLast.clone();
            trNew.find('input, select, textarea').each(function(){

                $(this).val('');
                $(this).css('background-color', '#fff');

                var currentNameAttr = $(this).attr('name');

                var newName = currentNameAttr + count;

                $(this).attr('name', newName); 

            });

           

        trLast.after(trNew);

        reinit_colour_picker_remove();

   });


   function reinit_colour_picker_remove(){

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

    $('.remove-row').each(function(index){
        
        $(this).on('click', function(){

            $(this).parent().remove();

        });
        
    });
      
  }

   
   
});