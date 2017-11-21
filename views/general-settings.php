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

$input->make_input_text('hello');
$input->make_input_text('helloanother');
$input->make_input_textarea('hello-textanother');

$input->make_input_select('select-options', array('options 1', 'options 2'));

?>

<div id="main-color"><h3>Main Color : </h3>
<?php $input->make_input_colour_picker('picker a color');?>
</div>



<?php 

$input->make_input_tinymce('hello-textanother-2');
