<?php
/**
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2014 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use phpseclib\File\ASN1;
use phpseclib\File\ASN1\Element;
use phpseclib\File\X509;

class Unit_File_X509_X509Test extends PhpseclibTestCase
{
    public function testLoadUnsupportedExtension()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIG1jCCBL6gAwIBAgITUAAAAA0qg8bE6DhrLAAAAAAADTANBgkqhkiG9w0BAQsF
ADAiMSAwHgYDVQQDExcuU2VjdXJlIEVudGVycHJpc2UgQ0EgMTAeFw0xNTAyMjMx
NTE1MDdaFw0xNjAyMjMxNTE1MDdaMD8xFjAUBgoJkiaJk/IsZAEZFgZzZWN1cmUx
DjAMBgNVBAMTBVVzZXJzMRUwEwYDVQQDEwxtZXRhY2xhc3NpbmcwggEiMA0GCSqG
SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDMdG1CzR/gTalbLN9J+2cvMGeD7wsR7S78
HU5hdwE+kECROjRAcjFBOR57ezSDrkmhkTzo28tj0oAHjOh8N9vuXtASfZSCXugx
H+ImJ+E7PA4aXBp+0H2hohW9sXNNCFiVNmJLX66O4bxIeKtVRq/+eSNijV4OOEkC
zMyTHAUbOFP0t6KoJtM1syNoQ1+fKdfcjz5XtiEzSVcp2zf0MwNFSeZSgGQ0jh8A
Kd6YVKA8ZnrqOWZxKETT+bBNTjIT0ggjQfzcE4zW2RzrN7zWabUowoU92+DAp4s3
sAEywX9ISSge62DEzTnZZSf9bpoScAfT8raRFA3BkoJ/s4c4CgfPAgMBAAGjggLm
MIIC4jAdBgNVHQ4EFgQULlIyJL9+ZwAI/SkVdsJMxFOVp+EwHwYDVR0jBBgwFoAU
5nEIMEUT5mMd1WepmviwgK7dIzwwggEKBgNVHR8EggEBMIH+MIH7oIH4oIH1hoG5
bGRhcDovLy9DTj0uU2VjdXJlJTIwRW50ZXJwcmlzZSUyMENBJTIwMSxDTj1hdXRo
LENOPUNEUCxDTj1QdWJsaWMlMjBLZXklMjBTZXJ2aWNlcyxDTj1TZXJ2aWNlcyxD
Tj1Db25maWd1cmF0aW9uLERDPXNlY3VyZT9jZXJ0aWZpY2F0ZVJldm9jYXRpb25M
aXN0P2Jhc2U/b2JqZWN0Q2xhc3M9Y1JMRGlzdHJpYnV0aW9uUG9pbnSGN2h0dHA6
Ly9jcmwuc2VjdXJlb2JzY3VyZS5jb20vP2FjdGlvbj1jcmwmY2E9ZW50ZXJwcmlz
ZTEwgccGCCsGAQUFBwEBBIG6MIG3MIG0BggrBgEFBQcwAoaBp2xkYXA6Ly8vQ049
LlNlY3VyZSUyMEVudGVycHJpc2UlMjBDQSUyMDEsQ049QUlBLENOPVB1YmxpYyUy
MEtleSUyMFNlcnZpY2VzLENOPVNlcnZpY2VzLENOPUNvbmZpZ3VyYXRpb24sREM9
c2VjdXJlP2NBQ2VydGlmaWNhdGU/YmFzZT9vYmplY3RDbGFzcz1jZXJ0aWZpY2F0
aW9uQXV0aG9yaXR5MBcGCSsGAQQBgjcUAgQKHggAVQBzAGUAcjAOBgNVHQ8BAf8E
BAMCBaAwKQYDVR0lBCIwIAYKKwYBBAGCNwoDBAYIKwYBBQUHAwQGCCsGAQUFBwMC
MC4GA1UdEQQnMCWgIwYKKwYBBAGCNxQCA6AVDBNtZXRhY2xhc3NpbmdAc2VjdXJl
MEQGCSqGSIb3DQEJDwQ3MDUwDgYIKoZIhvcNAwICAgCAMA4GCCqGSIb3DQMEAgIA
gDAHBgUrDgMCBzAKBggqhkiG9w0DBzANBgkqhkiG9w0BAQsFAAOCAgEAKNmjYh+h
cObJEM0CWgz50jOYKZ4M5iIxoAWgrYY9Pv+0O9aPjvPLzjd5bY322L8lxh5wy5my
DKmip+irzjdVdxzQfoyy+ceODmCbX9L6MfEDn0RBzdwjLe1/eOxE1na0sZztrVCc
yt5nI91NNGZJUcVqVQsIA/25FWlkvo/FTfuqTuXdQiEVM5MCKJI915anmTdugy+G
0CmBJALIxtyz5P7sZhaHZFNdpKnx82QsauErqjP9H0RXc6VXX5qt+tEDvYfSlFcc
0lv3aQnV/eIdfm7APJkQ3lmNWWQwdkVf7adXJ7KAAPHSt1yvSbVxThJR/jmIkyeQ
XW/TOP5m7JI/GrmvdlzI1AgwJ+zO8fOmCDuif99pDb1CvkzQ65RZ8p5J1ZV6hzlb
VvOhn4LDnT1jnTcEqigmx1gxM/5ifvMorXn/ItMjKPlb72vHpeF7OeKE8GHsvZAm
osHcKyJXbTIcXchmpZX1efbmCMJBqHgJ/qBTBMl9BX0+YqbTZyabRJSs9ezbTRn0
oRYl21Q8EnvS71CemxEUkSsKJmfJKkQNCsOjc8AbX/V/X9R7LJkH3UEx6K2zQQKK
k6m17mi63YW/+iPCGOWZ2qXmY5HPEyyF2L4L4IDryFJ+8xLyw3pH9/yp5aHZDtp6
833K6qyjgHJT+fUzSEYpiwF5rSBJIGClOCY=
-----END CERTIFICATE-----';

        $x509 = new X509();

        $cert = $x509->loadX509($test);

        $this->assertEquals('MDUwDgYIKoZIhvcNAwICAgCAMA4GCCqGSIb3DQMEAgIAgDAHBgUrDgMCBzAKBggqhkiG9w0DBw==', $cert['tbsCertificate']['extensions'][8]['extnValue']);
    }

    public function testSaveUnsupportedExtension()
    {
        $x509 = new X509();
        $cert = $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIQT52W2WawmStUwpV8tBV9TTANBgkqhkiG9w0BAQUFADBM
MQswCQYDVQQGEwJaQTElMCMGA1UEChMcVGhhd3RlIENvbnN1bHRpbmcgKFB0eSkg
THRkLjEWMBQGA1UEAxMNVGhhd3RlIFNHQyBDQTAeFw0xMTEwMjYwMDAwMDBaFw0x
MzA5MzAyMzU5NTlaMGgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlh
MRYwFAYDVQQHFA1Nb3VudGFpbiBWaWV3MRMwEQYDVQQKFApHb29nbGUgSW5jMRcw
FQYDVQQDFA53d3cuZ29vZ2xlLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkC
gYEA3rcmQ6aZhc04pxUJuc8PycNVjIjujI0oJyRLKl6g2Bb6YRhLz21ggNM1QDJy
wI8S2OVOj7my9tkVXlqGMaO6hqpryNlxjMzNJxMenUJdOPanrO/6YvMYgdQkRn8B
d3zGKokUmbuYOR2oGfs5AER9G5RqeC1prcB6LPrQ2iASmNMCAwEAAaOB5zCB5DAM
BgNVHRMBAf8EAjAAMDYGA1UdHwQvMC0wK6ApoCeGJWh0dHA6Ly9jcmwudGhhd3Rl
LmNvbS9UaGF3dGVTR0NDQS5jcmwwKAYDVR0lBCEwHwYIKwYBBQUHAwEGCCsGAQUF
BwMCBglghkgBhvhCBAEwcgYIKwYBBQUHAQEEZjBkMCIGCCsGAQUFBzABhhZodHRw
Oi8vb2NzcC50aGF3dGUuY29tMD4GCCsGAQUFBzAChjJodHRwOi8vd3d3LnRoYXd0
ZS5jb20vcmVwb3NpdG9yeS9UaGF3dGVfU0dDX0NBLmNydDANBgkqhkiG9w0BAQUF
AAOBgQAhrNWuyjSJWsKrUtKyNGadeqvu5nzVfsJcKLt0AMkQH0IT/GmKHiSgAgDp
ulvKGQSy068Bsn5fFNum21K5mvMSf3yinDtvmX3qUA12IxL/92ZzKbeVCq3Yi7Le
IOkKcGQRCMha8X2e7GmlpdWC1ycenlbN0nbVeSv3JUMcafC4+Q==
-----END CERTIFICATE-----');

        $asn1 = new ASN1();

        $value = $this->encodeOID('1.2.3.4');
        $ext = chr(ASN1::TYPE_OBJECT_IDENTIFIER) . $asn1->_encodeLength(strlen($value)) . $value;
        $value = 'zzzzzzzzz';
        $ext.= chr(ASN1::TYPE_OCTET_STRING) . $asn1->_encodeLength(strlen($value)) . $value;
        $ext = chr(ASN1::TYPE_SEQUENCE | 0x20) . $asn1->_encodeLength(strlen($ext)) . $ext;

        $cert['tbsCertificate']['extensions'][4] = new Element($ext);

        $result = $x509->loadX509($x509->saveX509($cert));

        $this->assertCount(5, $result['tbsCertificate']['extensions']);
    }

    function encodeOID($oid)
    {
        if ($oid === false) {
            user_error('Invalid OID');
            return false;
        }
        $value = '';
        $parts = explode('.', $oid);
        $value = chr(40 * $parts[0] + $parts[1]);
        for ($i = 2; $i < count($parts); $i++) {
            $temp = '';
            if (!$parts[$i]) {
                $temp = "\0";
            } else {
                while ($parts[$i]) {
                    $temp = chr(0x80 | ($parts[$i] & 0x7F)) . $temp;
                    $parts[$i] >>= 7;
                }
                $temp[strlen($temp) - 1] = $temp[strlen($temp) - 1] & chr(0x7F);
            }
            $value.= $temp;
        }
        return $value;
    }
}
