<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AppServices
{

    public function getValidator($string) { 
        $validator = Validator::make(
            ['text' => $string],
            ['text' => 'required']
        );
        if ($validator->fails())
        return null;
        else
        return true;
        
    }
    public static function getPhrase($string='ups') { 
        
        $new_text = '';
        $phrase = $string;
        $phrase = mb_strtolower($phrase);
        $phrase = preg_replace('/[^ a-zа-яё\d]/ui', '',$phrase );
        $phrase = preg_replace('/ /', '', $phrase);
        for ($i = mb_strlen($phrase); $i>=0; $i--) {
            $new_text .= mb_substr($phrase, $i, 1);
        }
        return ($phrase==$new_text)?"Фраза является палиндромом!!!":"Фраза не является палиндромом!!!";
        
    }
    public function getIP($ip) { 
        $color=(($ip >= 167772160 && $ip <= 184549375)||($ip >= 2886729728 && $ip <= 2887778303)||($ip >= 3232235520 && $ip <= 3232301055))?"Серый":"Белый";
        return 'Ваш IP:'.$ip.'<br>'.'IP:'.$color.'<br>';
    }
    
}