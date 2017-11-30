jQuery(document).ready(function ($) {

  /* On add row button this finds the parents table id 
   * Count the size of the current table 
   * take the last tr and repeat it underneath clearing the data
  */
   
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
        if(!trLast.find('td:last').hasClass('remove-row')){
            trNew.append('<td class="remove-row">X</td>');
        }
        reinit_colour_picker_remove();

   });

  /* Re init the colour picker for the added row */

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


    /* On remove click remove this row */

    $('.remove-row').each(function(index){
        
        $(this).on('click', function(){

            $(this).parent().remove();

        });
        
    });
      
  }

   
   
});