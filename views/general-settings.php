<?php 

$repeater->make_repeater([
    'name' => 'Repeater Name',
    'id' => 'Repeater',
    'headers' => ['Country', 'Address', 'Post Code', 'Color'],
    'fields' => [
        '0' => [
            'type' => 'text',
            'label' => 'country',
            'name' => 'second-repeat',
            'placeholder' => 'Enter Country'
        ],
        '1' => [
            'type' => 'text',
            'label' => 'address',
            'name' => 'location-address',
            'placeholder' => 'Enter Address'
        ],
        '2' => [
            'type' => 'text',
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
