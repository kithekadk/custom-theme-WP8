<?php
/**
 *   @package Cohort8
 */

 namespace C8\Base;

 class ExternalApi{
    public function register(){
        add_shortcode('users', [$this, 'getDataApi']);
    }

    public function getDataApi(){
        $url = 'https://jsonplaceholder.typicode.com/users';

        $arguments = [
            'method'=>'GET'
        ];

        $response = wp_remote_get($url, $arguments);

        if(200 == wp_remote_retrieve_response_code($response)){
            $file_link = WP_PLUGIN_DIR.'/cohort-8/data.json';

            $message = wp_remote_retrieve_body($response);

            $this->write_to_file($message, $file_link);
        }

        if(200 !== wp_remote_retrieve_response_code($response) || is_wp_error($response)){
            $file_link = WP_PLUGIN_DIR.'/cohort-8/error-log.txt';

            $error_message = $response->get_error_message();

            $error_message = date('d m Y g:i:a') . ' '.$error_message;

            $this->write_to_file($error_message, $file_link);

        }
        
        // if(is_wp_error($response)){
        //     $error_message = $response->get_error_message();
        //     return "Something went wrong: $error_message";
        // }

        //prettify the json
        echo '<pre>';
            // var_dump(wp_remote_retrieve_body($response));
        echo '</pre>';

        //converting to object
        echo '<pre>';
        $users = (json_decode(wp_remote_retrieve_body($response)));
        echo '</pre>';
        error_log(var_dump($users));


       
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Name</th>';
        $html .= '<th>Username</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Address</th>';
        $html .= '</tr>';

        foreach( $users as $user){
        $html .= '<tr>';
        $html .= '<td>'.$user->id.'</td>';
        $html .= '<td>'.$user->name.'</td>';
        $html .= '<td>'.$user->username.'</td>';
        $html .= '<td>'.$user->email.'</td>';
        $html .= '<td>'.$user->address->street.'</td>';
        $html .= '</tr>';
        }

        $html .= '</table';

        return $html;
    }

    function write_to_file($message, $file_link){
        if(file_exists($file_link)){
            $writing = fopen($file_link, 'a');
            fwrite($writing, $message. "\n");
        }else{
            $writing = fopen($file_link, 'w');
            fwrite($writing, $message. "\n");
        }
        fclose($writing);
    }
 }