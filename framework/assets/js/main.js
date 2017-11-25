jQuery(document).ready(function ($) {

   var baseUrl = location.hostname;
    
    tinymce.init({ 
        selector:'.tinymce-textarea',
        images_upload_base_path: '/some/basepath',
        plugins: 'textcolor table code',
        toolbar1: 'forecolor backcolor table tabledelete alignjustify alignright aligncenter alignleft underline italic bold mybutton',
        toolbar2: "code fontselect fontsizeselect formatselect",
        setup: function (editor) {
            editor.addButton('mybutton', {
              text: 'Upload Image',
              icon: false,
              onclick: function () {
                var image = wp.media({ 
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                .on('select', function(e){
                    // This will return the selected image from the Media Uploader, the result is an object
                    var uploaded_image = image.state().get('selection').first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    var image_url = uploaded_image.toJSON().url;
                    
                    // Let's assign the url value to the input field
                    editor.insertContent('<img alt="'+ uploaded_image.attributes.alt +'" title="'+ uploaded_image.attributes.title +'" src=' + image_url + '>');
                    
                });
             
              }
            });
          }
    });


    $('#submit-page').on('click', function(){

        $('#saving_settings').fadeIn('slow');

        save_input_text_fields();
       
    });

    function save_input_text_fields(){
        var current_tab = getUrlVars()["current_tab"];
        var data = [];

        if(current_tab){
            current_tab = current_tab;
        }else{
            current_tab = 'general-settings';
        }


        $('#' + current_tab + ' .normal-input, #' + current_tab + ' .normal-select').each(
            function(index){  
                var input = $(this);

                data.push({
                    'name': input.attr('name'),
                    'value': input.val()
                });
              //  alert('Type: ' + input.attr('type') + 'Name: ' + input.attr('name') + 'Value: ' + input.val());
            }
        );

        $('.normal-textarea').each(
            function(index){

            var textarea = $(this);
            var id = textarea.attr('id');

            if(textarea.hasClass('tinymce-textarea')){
                
                data.push({
                    'name': id,
                    'value': tinymce.get(id).getContent()
                  });
     
            }else{

                data.push({
                    
                    'name': textarea.attr('name'),
                    'value': textarea.val()

                });
            }
            
            }
        );
    
        $.ajax({
            url : myAjax.ajaxurl,
            type : 'post',
            data : {action: "process_boiler_plate_page_fields", current_tab: current_tab, data: data},
            success: function(response) {
                save_repeater_fields();
            }
         })   
       
    }

    function save_repeater_fields(){

        var current_tab = getUrlVars()["current_tab"];

        if(current_tab){
            current_tab = current_tab;
        }else{
            current_tab = 'general-settings';
        }

        var data = [];

        $('.plugin-repeater').each(function(index){
            var id = $(this).attr('id');

            data.push(id);

        });


        var results = [];
        var obj = {}
        $.map(data, function(el, i){
            
            obj[el] = [];

            $('#' + el + ' tbody tr').each(
                function(index){  

                  obj[el][index] = [];

                  $(this).find('.repeater-input, .repeater-select').each(function(){
                        var input = $(this);

                        obj[el][index].push({
                            'label': input.data('label'),
                            'fields': {
                                'type': input.data('type'),
                                'name': input.attr('name'),
                                'value': input.val()
                            }
                        });
                  });
                }
            );

        });

        results.push(obj);

        $.ajax({
            url : myAjax.ajaxurl,
            type : "post",
            ontentType: "application/json; charset=utf-8",
            data : {action: "process_boiler_plate_repeater_fields", "current_tab": current_tab, 'data': results},
            dataType: "json",
            success: function(response) {
              location.reload();
            }
        });

        
    }

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

  

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




        
        

    
    
});