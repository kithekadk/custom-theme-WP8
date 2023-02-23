<?php
/**
 *   @package Cohort8
 */

 namespace C8\Base;

 class ShortCode{
    public function register(){
        add_shortcode('cohort10', [$this, 'displayTable']);
    }

    public function displayTable($atts){

        $defaults = [
            'title'=>'This is a Table',
            'subtitle'=>'Generated using Short code'
        ];

        $atts= shortcode_atts(
            $defaults, $atts, 'cohort10'
        );
        
        $html = '';
        $html .= '<h2>'.$atts['title'].'</h2>';
        $html .= '<h4>'.$atts['subtitle'].'</h4>';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<th>Column 1</th>';
        $html .= '<th>Column 2</th>';
        $html .= '<th>Column 3</th>';
        $html .= '<th>Column 4</th>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Column1 row1 </td>';
        $html .= '<td>Column2 row1</td>';
        $html .= '<td>Column3 row1</td>';
        $html .= '<td>Column4 row1</td>';
        $html .= '</tr>';

        $html .= '</table>';

        return $html;
    }
 }