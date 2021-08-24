<?php

/**
 * Plugin Name: Lenon api red alert
 * Plugin URI: http://lenonleite.com.br
 * Description: Record user likes on each post.
 * Version: 1.0
 * Author: Lenon Leite
 * Author URI: http://lenonleite.com.br
 */

class check_api
{
//    CONST URL = 'https://static-feed.tomorrowland.com/settings-production.json';
    CONST URL = 'https://covid19.min-saude.pt/pedido-de-agendamento/';
    CONST NUMBER_TICKETS_TYPE = 4;

    public function run(){
//        add_action('wp_ajax_nopriv_check', array($this, 'check'));
//        add_action('wp_ajax_check', array($this, 'check'));
    }

    public function check(){
        $result = $this->get_json();
        if(empty($result)){
            wp_send_json('ok');
        }

        $resultText = $this->checkTextData($result);
        if(empty($resultText)){
            $this->send_mail('Provavelmente página em branco, deve estar mudando.');
            wp_send_json('ok');
        }

        $tickets = get_option('covid_age');
        if($tickets == false){
            update_option('covid_age',md5($resultText));
        }
        if($tickets != md5($resultText)){
            $this->send_mail($resultText);
            update_option('covid_age',md5($resultText));
        }
        wp_send_json('ok');
    }
    public function get_json(){

//        return         $result =  file_get_contents(self::URL);
        $ch = curl_init();
        $timeout = 0; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, self::URL);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        // display file
        return $file_contents;
    }

    public function checkTextData($result){

        $regex = '/<strong>.*Tem.*ou mais anos e ainda.*<\/strong>/i';
        preg_match_all($regex,
                       $result,
                       $out);
        return strip_tags($out[0][0]);
    }

    public function get_text($string){
        return 'O novo texto é =================> \n '.$string;
    }

    public function send_mail($text){
        $emails = $this->get_emails();
        foreach ($emails as $email){
//            wp_mail($email,'Site tml mudou, Dreams e a farofa', $this->get_text($text) );
            wp_mail($email,'Site do covid mudou, checa lá arrombado', $this->get_text($text) );
        }
        echo 'pow pow pei!';
    }
    public function get_emails(){
        return [
            'lenonleite@gmail.com',
            'leonardo.moreira1987@hotmail.com',
            'Jefferson.francoo@gmail.com',
            'Gustavohonorato@msn.com',
            'Victors.pinheiro86@gmail.com',
            'Filipeandrejorge@gmail.com',
//            'jhey.santos10@gmail.com',
//            'lipiedra@gmail.com',
//            'gabrielobradovich86@gmail.com',
//            'kriska5522@hotmail.com',
//            'fa.lacerda@hotmail.com.br',
//            'geambrosio@yahoo.com.br',
//            'andreipardinho@gmail.com',

        ];
    }
}
(new check_api())->run();