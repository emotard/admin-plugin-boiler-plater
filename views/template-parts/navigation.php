<?php

?>

<div class="tabs is-boxed">
    <ul>
        <?php

            // Slug must be the same name as your view --- general-settings is pre loaded as the main plugin route

            // Add New Route ---> $route_make_route('slug', 'page/tab name);

            $route->make_route('general-settings',  PLUGIN_NAME .' Settings');

        ?>
    </ul>
</div>