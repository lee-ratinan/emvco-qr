<?php
include_once '../project/library/EmvcoQr.php';

$emv = new \EmvcoQr\EmvcoQr();
if ($emv->decoder('000201010211520475315303702540512.23550201560512.34570512.345802SG5908SEX SHOP6009SINGAPORE610612345662230105X12340903AEM110312264340002TH0110KHUAI SHOP0210KRUNG THEP6304A4EB'))
{
    echo 'DECODED SUCCESSFULLY';
} else
{
    echo 'DECODED FAILED';
}
echo '<hr><pre>';
print_r($emv->content);
echo '</pre>';

$emv2 = new \EmvcoQr\EmvcoQr();
$emv2->generator_sg('SEX SHOP', '828748', 123.45, '0000');
echo '<hr><pre>';
print_r($emv2->content);
echo '</pre>';