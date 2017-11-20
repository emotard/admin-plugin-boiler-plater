jQuery(document).ready(function ($) {
   
   $('.add-row').on('click', function(index){
     
        var table_id = $(this).parents('table').attr('id');

        count = $('#' + table_id + ' tbody tr').size();

        var tBody = $('#' + table_id).find('tbody'),
            trLast = tBody.find('tr:last'),
            trNew = trLast.clone();
            trNew.find('input, select, textarea').each(function(){

                var currentNameAttr = $(this).attr('name');

                var noNum = currentNameAttr.replace(/\d+/g, '');
                
                var newNameAttr = noNum + count;

                $(this).attr('name', newNameAttr); 

            });

           

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