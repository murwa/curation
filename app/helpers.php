<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 4/3/2015
 * Time: 2:16 AM
 */

/**
 * A basic form to send a delete request
 *
 * @param $params
 * @param array $options
 * @return string
 */
function delete_form($params, $options = []){
    # Fetch label
    $label = array_get($options, 'label', '<i class="fa fa-remove mg5r"></i>');

    # Add method to params
    $params['method'] = 'DELETE';

    # Add button classes
    $options = array_merge($options, [
        'class' => 'pg0a mg0lr mg3t nobg boxs0 crgiga4 pr',
        'type' => 'submit'
    ]);

    # Add default classes
    $params = array_merge($params, ['class' => 'pr mg3lr hgt_form_delete']);

    # Open the file
    $form = Form::open($params);

    # Add submit button to the form
    $form .= Form::button($label, $options);

    return $form .= Form::close();
}


function getPageSize () {
    return intval(env('PAGE_SIZE', 12));
}