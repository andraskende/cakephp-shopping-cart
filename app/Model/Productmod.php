<?php
App::uses('AppModel', 'Model');
class Productmod extends AppModel {

////////////////////////////////////////////////////////////

    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

////////////////////////////////////////////////////////////

    public function getAllProductMods($id, $price) {

        $productmods = $this->find('all', array(
            'conditions' => array(
                'Productmod.product_id' => $id
            ),
            'order' => array(
                'Productmod.sku' => 'ASC',
                'Productmod.name' => 'ASC',
            ),
        ));

        $product_mods = '';
        if(!empty($productmods)) {
            $productmodshtml = '<select name="mods" id="modselector" class="form-control">';
            $productmodshtml .= '<option value="" data-price="' . $price . '"></option>';
            foreach ($productmods as $productmod) {
                $productmodshtml .= '<option value="' . $productmod['Productmod']['id'] . '" data-price="' . $productmod['Productmod']['price'] . '">' . $productmod['Productmod']['name'] . ' - ($'. $productmod['Productmod']['price'] . ')</option>';
            }
            $productmodshtml .= '</select>';

            // foreach ($productmods as $productmod) {
            //  $unserialized_mod_data = unserialize($productmod['Productmod']['serialized_mod_data']);
            //  foreach ($unserialized_mod_data as $label => $values) {

            //      // Save jSON for use on the detail.ctp price deviation calculations.
            //      // NOTE: This feature is purely for aesthetics, and the backend must recalculate the price.
            //      $deviation_json[$values['sku']]['sku'] = $values['sku'];
            //      $deviation_json[$values['sku']]['direction'] = $values['direction'];
            //      $deviation_json[$values['sku']]['retail_deviation'] = $values['retail_deviation'];
            //      $deviation_json[$values['sku']]['wholesale_deviation'] = $values['wholesale_deviation'];

            //      // Save the options of a dropdown as HTML, ordered by label
            //      $options[$label][] = '<option value="' . $values['sku'] . '">' . $values['name'] . '</option>';
            //  }
            // }

            // debug($options);
            // debug($deviation_json);

            // $deviation_json = json_encode($deviation_json); // Encode this for use in JS on the front-end.

            // // debug($deviation_json);

            // //Structure HTML for display on detail.ctp.
            // foreach($options as $label => $values){
            //  $product_mods .= '<div class="mod_display"><strong>' . $label . '</strong><br/>';
            //  $product_mods .= '<select class="mod_selector" name="data[Product][mod]['.$label.']">';
            //  $product_mods .= join($values);
            //  $product_mods .= '</select></div>';
            // }

            return array(
                'productmodshtml' => $productmodshtml,
                // 'productmods' => $product_mods,
                // 'deviation_json' =>  $deviation_json,
            );

        }


    }

////////////////////////////////////////////////////////////

}
