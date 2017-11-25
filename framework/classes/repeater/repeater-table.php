<table class="table plugin-repeater" id="<?php echo $table_id;  ?>">
    <thead><tr><th><h3><?php echo $repeater_name ?> </h3></th></tr></thead>
    <tfoot><tr><th><button type="button" id="add-row" class="button is-primary add-row">Add Row</button></th></tr></tfoot>
    <tbody>

        <?php if($repeater_options['headers']) : ?>
             <tr class="header-row">
                <?php foreach($repeater_options['headers'] as $header) : ?>
                        <td><?php echo $header; ?></td>
                <?php endforeach; ?>
             </tr>
        <?php endif; ?>

        <?php if($count1 === $count2 && $saved_options) : ?>
                <?php foreach($saved_options as $key => $row) : ?>
                    <tr>
                        <?php foreach($row as $key => $field): 
                            $run = $field['fields']['type'];
                            echo $this->$run($field['fields']);
                         endforeach; ?>
                    <td class="remove-row">X</td>
                    </tr>
                <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <?php foreach ($repeater_options['fields'] as $key => $options) :
                    $run = $options['type'];
                    echo $this->$run($options);         
                endforeach; ?>
            <td class="remove-row">X</td>
            </tr>   
        <?php endif; ?>
    </tbody>
</table>