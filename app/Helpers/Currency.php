<?php
namespace App\Helpers;

class Currency
{
    public static function format($amount, $currency =Null)  //currency de el 3omla 
    {

        $formatter = new \NumberFormatter(config('app.locale'), \NumberFormatter::CURRENCY);
        if($currency == Null){
            $currency = config('app.currency', 'USD');
        }
        return $formatter->formatCurrency($amount, $currency);
    }
}