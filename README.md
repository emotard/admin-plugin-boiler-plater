# admin-plugin-boiler-plate

This plugin is just a normal boiler plate with some handy set up functions built in. 

Please feel free to comment and add any sugestions I know there is alot of work todo but this is a start.

STARTER STEP once downloaded unzip and run composer install at it uses composer psr 4 autloader then zip and install 

Step 1 - Change file plugin_name.php to what every file name you would like. 

Step 2 - In this file define your PLUGIN_NAME 

Step 3 - The plugin comes with a default view with a couple of things in, to change the default view, change the name of this file and then search replace in the plugin for general-settings with what ever you have just called the new file.

Step 4 - Add to navigation -- vist the views folder / template parts and in the file navigation you can use the helper $route->make_route().
$route->make_route('general-settings', 'General Settings') -- Excepts the name of the route slug example general-settings and then the navigation name.,

Step 5 - Once you have added a route you then need to create a view file and name it the same name as your route slug. 
general-settings.php

Step 6 - Once you have create a new route and file you are free to create any design you wont please take note of some helper functions in
the general-settings.php view. 

$input->make_input_text('name') -- Creates a simple text input, Params -- name of input field; 

$input->make_input_textarea('name') -- Creates simple text area, Params -- name of text field 

$input->make_input_select('name', array(''), Create dropdown select, Params -- name of select and then array of options. 

$input->make_input_colour_picker('name'),  Create colour picker, Params -- name of input

$input->make_input_tinymce('name'), Create textarea with tinymce, Params -- name of textarea

$repeater->make_repeater([
    'name' => 'Repeater Name',
    'id' => 'Repeater',
    'headers' => ['Text', 'Textarea', 'Select', 'ColorPicker],
    'fields' => [
        '0' => [
            'type' => 'text',
            'label' => 'country',
            'name' => 'second-repeat',
            'placeholder' => 'Enter Country'
        ],
        '1' => [
            'type' => 'textarea',
            'label' => 'address',
            'name' => 'location-address',
            'placeholder' => 'Enter Address'
        ],
        '2' => [
            'type' => 'select',
            'label' => 'post-code',
            'name' => 'location-post-code',
            'placeholder' => 'Enter Post Code'
        ],
        '3' => [
            'type' => 'colour_picker',
            'label' => 'custom-color-picker-2',
            'name' => 'colour-picker-2',
            'value' => '#000000'
        ]
    ],
]);



To be continued.......
