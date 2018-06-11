jQuery(document).ready(function ($) {

    var baseUrl = location.hostname;
    
    /* Init tinymce */

    tinymce.init({ 
        selector:'.tinymce-textarea',
        images_upload_base_path: '/some/basepath',
        relative_urls: false,
        convert_urls: false,   
        remove_script_host : false,
        plugins: 'textcolor table code',
        toolbar1: 'forecolor backcolor table tabledelete alignjustify alignright aligncenter alignleft underline italic bold mybutton',
        toolbar2: "code fontselect fontsizeselect formatselect",
        
         /* Add an upload button to tinymce so we can use the built in wordpress media libery to upload and insert the image to the textarea */

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
                    var image_url = uploaded_image.changed.url;
                    console.log(image_url);
                    // Let's assign the url value to the input field
                    editor.insertContent('<img alt="'+ uploaded_image.attributes.alt +'" title="'+ uploaded_image.attributes.title +'" src=' + image_url + '>');
                    
                });
             
              }
            });
          }
    });

    /* On submit run function save_input_text_fields */

    $('#submit-page').on('click', function(){

        $('#saving_settings').fadeIn('slow');

        save_input_text_fields();
       
    });


   

    function save_input_text_fields(){

         /* Get the current tab from the form */
        var current_tab = $('form').attr('id');

        var data = [];

        /* if there is a tab make this current else make it general-settings */ 

        if(current_tab){
            current_tab = current_tab;
        }else{
            current_tab = 'general-settings';
        }

        /* Push all inputs and selects from current tab into an array */ 

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

        /* Push all textares into the data array */ 

        $('.normal-textarea').each(
            function(index){

            var textarea = $(this);
            var id = textarea.attr('id');

            /* if the textarea has a class of tinymce get the data using there helper function getContent */ 
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

        /* Send the data via ajax then run save_repeater_fields */ 
    
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

        /* Creating a mapped array which makes each name of the repater a key and pushers values into that array  */ 

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

        /* push object into single array to send via ajax */ 

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

    /* Init colour picker on doc ready */ 

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
    
    function getUrlVars(){
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






        
        

    
    
});
