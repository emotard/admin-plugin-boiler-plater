<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


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
