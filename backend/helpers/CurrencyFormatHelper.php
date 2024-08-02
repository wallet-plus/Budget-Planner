<?php
// CurrencyFormatHelper.php
namespace app\helpers;

class CurrencyFormatHelper
{
    public static function formatCurrency($amount, $currency = 'Rs.')
    {
        // Format the amount
        $formattedAmount = number_format((float)$amount, 2, '.', '');
        
        // Remove decimals if they are .00
        if (substr($formattedAmount, -3) === '.00') {
            $formattedAmount = substr($formattedAmount, 0, -3);
        }

        // Format the amount with commas for thousands
        $formattedAmount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $formattedAmount);

        return $currency . ' ' . $formattedAmount;
    }
}
?>