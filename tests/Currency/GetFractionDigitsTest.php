<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;
use PHPUnit_Framework_TestCase;

/**
 * @covers KubaWerlos\Money\Currency::getFractionDigits
 */
class GetFractionDigitsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getFractionDigitsProvider
     * @param int $expectedFractionDigits
     * @param string $code
     * @test
     */
    public function getFractionDigits($expectedFractionDigits, $code)
    {
        $currency = new Currency($code);

        $actualFractionDigits = $currency->getFractionDigits();

        $this->assertSame($expectedFractionDigits, $actualFractionDigits);
    }

    /**
     * @return array
     */
    public function getFractionDigitsProvider()
    {
        return array(
            array( 0, 'ADP' ),
            array( 2, 'AED' ),
            array( 2, 'AFA' ),
            array( 0, 'AFN' ),
            array( 2, 'ALK' ),
            array( 0, 'ALL' ),
            array( 0, 'AMD' ),
            array( 2, 'ANG' ),
            array( 2, 'AOA' ),
            array( 2, 'AOK' ),
            array( 2, 'AON' ),
            array( 2, 'AOR' ),
            array( 2, 'ARA' ),
            array( 2, 'ARL' ),
            array( 2, 'ARM' ),
            array( 2, 'ARP' ),
            array( 2, 'ARS' ),
            array( 2, 'ATS' ),
            array( 2, 'AUD' ),
            array( 2, 'AWG' ),
            array( 2, 'AZM' ),
            array( 2, 'AZN' ),
            array( 2, 'BAD' ),
            array( 2, 'BAM' ),
            array( 2, 'BAN' ),
            array( 2, 'BBD' ),
            array( 2, 'BDT' ),
            array( 2, 'BEC' ),
            array( 2, 'BEF' ),
            array( 2, 'BEL' ),
            array( 2, 'BGL' ),
            array( 2, 'BGM' ),
            array( 2, 'BGN' ),
            array( 2, 'BGO' ),
            array( 3, 'BHD' ),
            array( 0, 'BIF' ),
            array( 2, 'BMD' ),
            array( 2, 'BND' ),
            array( 2, 'BOB' ),
            array( 2, 'BOL' ),
            array( 2, 'BOP' ),
            array( 2, 'BOV' ),
            array( 2, 'BRB' ),
            array( 2, 'BRC' ),
            array( 2, 'BRE' ),
            array( 2, 'BRL' ),
            array( 2, 'BRN' ),
            array( 2, 'BRR' ),
            array( 2, 'BRZ' ),
            array( 2, 'BSD' ),
            array( 2, 'BTN' ),
            array( 2, 'BUK' ),
            array( 2, 'BWP' ),
            array( 2, 'BYB' ),
            array( 0, 'BYR' ),
            array( 2, 'BZD' ),
            array( 2, 'CAD' ),
            array( 2, 'CDF' ),
            array( 2, 'CHE' ),
            array( 2, 'CHF' ),
            array( 2, 'CHW' ),
            array( 2, 'CLE' ),
            array( 4, 'CLF' ),
            array( 0, 'CLP' ),
            array( 2, 'CNX' ),
            array( 2, 'CNY' ),
            array( 0, 'COP' ),
            array( 2, 'COU' ),
            array( 0, 'CRC' ),
            array( 2, 'CSD' ),
            array( 2, 'CSK' ),
            array( 2, 'CUC' ),
            array( 2, 'CUP' ),
            array( 2, 'CVE' ),
            array( 2, 'CYP' ),
            array( 2, 'CZK' ),
            array( 2, 'DDM' ),
            array( 2, 'DEM' ),
            array( 0, 'DJF' ),
            array( 2, 'DKK' ),
            array( 2, 'DOP' ),
            array( 2, 'DZD' ),
            array( 2, 'ECS' ),
            array( 2, 'ECV' ),
            array( 2, 'EEK' ),
            array( 2, 'EGP' ),
            array( 2, 'ERN' ),
            array( 2, 'ESA' ),
            array( 2, 'ESB' ),
            array( 0, 'ESP' ),
            array( 2, 'ETB' ),
            array( 2, 'EUR' ),
            array( 2, 'FIM' ),
            array( 2, 'FJD' ),
            array( 2, 'FKP' ),
            array( 2, 'FRF' ),
            array( 2, 'GBP' ),
            array( 2, 'GEK' ),
            array( 2, 'GEL' ),
            array( 2, 'GHC' ),
            array( 2, 'GHS' ),
            array( 2, 'GIP' ),
            array( 2, 'GMD' ),
            array( 0, 'GNF' ),
            array( 2, 'GNS' ),
            array( 2, 'GQE' ),
            array( 2, 'GRD' ),
            array( 2, 'GTQ' ),
            array( 2, 'GWE' ),
            array( 2, 'GWP' ),
            array( 0, 'GYD' ),
            array( 2, 'HKD' ),
            array( 2, 'HNL' ),
            array( 2, 'HRD' ),
            array( 2, 'HRK' ),
            array( 2, 'HTG' ),
            array( 0, 'HUF' ),
            array( 0, 'IDR' ),
            array( 2, 'IEP' ),
            array( 2, 'ILP' ),
            array( 2, 'ILR' ),
            array( 2, 'ILS' ),
            array( 2, 'INR' ),
            array( 0, 'IQD' ),
            array( 0, 'IRR' ),
            array( 2, 'ISJ' ),
            array( 0, 'ISK' ),
            array( 0, 'ITL' ),
            array( 2, 'JMD' ),
            array( 3, 'JOD' ),
            array( 0, 'JPY' ),
            array( 2, 'KES' ),
            array( 2, 'KGS' ),
            array( 2, 'KHR' ),
            array( 0, 'KMF' ),
            array( 0, 'KPW' ),
            array( 2, 'KRH' ),
            array( 2, 'KRO' ),
            array( 0, 'KRW' ),
            array( 3, 'KWD' ),
            array( 2, 'KYD' ),
            array( 2, 'KZT' ),
            array( 0, 'LAK' ),
            array( 0, 'LBP' ),
            array( 2, 'LKR' ),
            array( 2, 'LRD' ),
            array( 2, 'LSL' ),
            array( 2, 'LTL' ),
            array( 2, 'LTT' ),
            array( 2, 'LUC' ),
            array( 0, 'LUF' ),
            array( 2, 'LUL' ),
            array( 2, 'LVL' ),
            array( 2, 'LVR' ),
            array( 3, 'LYD' ),
            array( 2, 'MAD' ),
            array( 2, 'MAF' ),
            array( 2, 'MCF' ),
            array( 2, 'MDC' ),
            array( 2, 'MDL' ),
            array( 0, 'MGA' ),
            array( 0, 'MGF' ),
            array( 2, 'MKD' ),
            array( 2, 'MKN' ),
            array( 2, 'MLF' ),
            array( 0, 'MMK' ),
            array( 0, 'MNT' ),
            array( 2, 'MOP' ),
            array( 0, 'MRO' ),
            array( 2, 'MTL' ),
            array( 2, 'MTP' ),
            array( 0, 'MUR' ),
            array( 2, 'MVP' ),
            array( 2, 'MVR' ),
            array( 2, 'MWK' ),
            array( 2, 'MXN' ),
            array( 2, 'MXP' ),
            array( 2, 'MXV' ),
            array( 2, 'MYR' ),
            array( 2, 'MZE' ),
            array( 2, 'MZM' ),
            array( 2, 'MZN' ),
            array( 2, 'NAD' ),
            array( 2, 'NGN' ),
            array( 2, 'NIC' ),
            array( 2, 'NIO' ),
            array( 2, 'NLG' ),
            array( 2, 'NOK' ),
            array( 2, 'NPR' ),
            array( 2, 'NZD' ),
            array( 3, 'OMR' ),
            array( 2, 'PAB' ),
            array( 2, 'PEI' ),
            array( 2, 'PEN' ),
            array( 2, 'PES' ),
            array( 2, 'PGK' ),
            array( 2, 'PHP' ),
            array( 0, 'PKR' ),
            array( 2, 'PLN' ),
            array( 2, 'PLZ' ),
            array( 2, 'PTE' ),
            array( 0, 'PYG' ),
            array( 2, 'QAR' ),
            array( 2, 'RHD' ),
            array( 2, 'ROL' ),
            array( 2, 'RON' ),
            array( 0, 'RSD' ),
            array( 2, 'RUB' ),
            array( 2, 'RUR' ),
            array( 0, 'RWF' ),
            array( 2, 'SAR' ),
            array( 2, 'SBD' ),
            array( 2, 'SCR' ),
            array( 2, 'SDD' ),
            array( 2, 'SDG' ),
            array( 2, 'SDP' ),
            array( 2, 'SEK' ),
            array( 2, 'SGD' ),
            array( 2, 'SHP' ),
            array( 2, 'SIT' ),
            array( 2, 'SKK' ),
            array( 0, 'SLL' ),
            array( 0, 'SOS' ),
            array( 2, 'SRD' ),
            array( 2, 'SRG' ),
            array( 2, 'SSP' ),
            array( 0, 'STD' ),
            array( 2, 'SUR' ),
            array( 2, 'SVC' ),
            array( 0, 'SYP' ),
            array( 2, 'SZL' ),
            array( 2, 'THB' ),
            array( 2, 'TJR' ),
            array( 2, 'TJS' ),
            array( 0, 'TMM' ),
            array( 2, 'TMT' ),
            array( 3, 'TND' ),
            array( 2, 'TOP' ),
            array( 2, 'TPE' ),
            array( 0, 'TRL' ),
            array( 2, 'TRY' ),
            array( 2, 'TTD' ),
            array( 2, 'TWD' ),
            array( 0, 'TZS' ),
            array( 2, 'UAH' ),
            array( 2, 'UAK' ),
            array( 2, 'UGS' ),
            array( 0, 'UGX' ),
            array( 2, 'USD' ),
            array( 2, 'USN' ),
            array( 2, 'USS' ),
            array( 0, 'UYI' ),
            array( 2, 'UYP' ),
            array( 2, 'UYU' ),
            array( 0, 'UZS' ),
            array( 2, 'VEB' ),
            array( 2, 'VEF' ),
            array( 0, 'VND' ),
            array( 2, 'VNN' ),
            array( 0, 'VUV' ),
            array( 2, 'WST' ),
            array( 0, 'XAF' ),
            array( 2, 'XCD' ),
            array( 2, 'XEU' ),
            array( 2, 'XFO' ),
            array( 2, 'XFU' ),
            array( 0, 'XOF' ),
            array( 0, 'XPF' ),
            array( 2, 'XRE' ),
            array( 2, 'YDD' ),
            array( 0, 'YER' ),
            array( 2, 'YUD' ),
            array( 2, 'YUM' ),
            array( 2, 'YUN' ),
            array( 2, 'YUR' ),
            array( 2, 'ZAL' ),
            array( 2, 'ZAR' ),
            array( 0, 'ZMK' ),
            array( 2, 'ZMW' ),
            array( 2, 'ZRN' ),
            array( 2, 'ZRZ' ),
            array( 0, 'ZWD' ),
            array( 2, 'ZWL' ),
            array( 2, 'ZWR' ),
        );
    }
}
