# admin-plugin-boiler-plate

This plugin is just a normal boiler plate with some handy set up functions built in. 


Step 1 - Change file plugin_name.php to what every file name you would like. 

Step 2 - In this file define your PLUGIN_NAME 

Step 3 - The plugin comes with a default view with a couple of this in, to change the default view name change the name of this file and then search
and replace in the plugin for general-settings with what ever you have just called the new file.

Step 4 - Add to navigation -- vist the views folder and template parts in the file navigation you can use the helper $route->make_route().
$route->make_route() -- Excepts the name of the route slug example general-settings and then the navigation name.,

Step 5 - Once you have added a route you then need to create a view file and name it the same name as your route slug. 

Step 6 - Once you have create a new route and file you are free to create any design you wont please take note of some helper functions in
the general-settings.php view. 

$input->make_input_text -- Creates a simple text input, Params; 

$input->make_input_textarea -- Creates simple text area 

To be continued...
