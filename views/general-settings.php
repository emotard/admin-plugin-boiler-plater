<?php 

$repeater->make_repeater([
    'name' => 'Repeater Name',
    'id' => 'Repeater',
    'fields' => [
            'text' => [
                'name' => 'custom-name',
                'placeholder' => 'Enter Text Here'
            ],
            'colour_picker' => [
                'name' => 'colour-picker',
                'default' => '#000000'
            ],
        ],
]);


$repeater->make_repeater([
    'name' => 'Repeater 2',
    'id' => 'Repeater-2',
    'fields' => [
            'text' => [
                'name' => 'second-repeat',
                'placeholder' => 'Enter Text Here'
            ],
            'colour_picker' => [
                'name' => 'colour-picker',
                'default' => '#000000'
            ],
        ],
]);

$input->make_input_text('text-input');
$input->make_input_textarea('single-textarea');
$input->make_input_select('single-select', array('options 1', 'options 2'));
$input->make_input_colour_picker('single-colour-picker');
$input->make_input_tinymce('tiny-mce');
