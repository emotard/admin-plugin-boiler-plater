<?php 


$option = rl_get_option('general-settings', 'single-textarea');

$repeater->make_repeater([
    'name' => 'Repeater Name',
    'id' => 'Repeater',
    'headers' => ['Text input', 'Colour 1 input', 'Colour 2 input'],
    'fields' => [
        '0' => [
            'type' => 'text',
            'label' => 'custom-test-field',
            'name' => 'second-repeat',
            'placeholder' => 'Enter Text Here'
        ],
        '1' => [
            'type' => 'colour_picker',
            'label' => 'custom-color-picker',
            'name' => 'colour-picker',
            'value' => '#000000'
        ],
        '2' => [
            'type' => 'colour_picker',
            'label' => 'custom-color-picker-2',
            'name' => 'colour-picker-2',
            'value' => '#000000'
        ],
    ],
]);

$repeater->make_repeater([
    'name' => 'Repeater 2',
    'id' => 'Repeater-2',
    'headers' => ['Colour 1 input'],
    'fields' => [
            '0' => [
                'type' => 'colour_picker',
                'name' => 'colour-picker',
                'value' => '#000000'
            ],
        ],
]);

$input->make_input_text('text-input');
$input->make_input_textarea('single-textarea');
$input->make_input_select('single-select', array('options 1', 'options 2'));
$input->make_input_colour_picker('single-colour-picker');
$input->make_input_tinymce('tiny-mce');
