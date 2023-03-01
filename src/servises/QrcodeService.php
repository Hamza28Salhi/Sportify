<?php
namespace App\services;
use App\Entity\Resteau;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;




class QrcodeService
{ /**
 * @var BuilderInterface
 */
    protected $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }
    public function stringg($quer)
    {

        foreach ($quer as $value) {
            return $value;
        }




    }

    public function qrcode( $query)
    {
        //  $url = 'https://www.google.com/search?q=';

        $objDateTime = new \DateTime('NOW');
        $dateString = $objDateTime->format('d-m-Y H:i:s');

        $path = dirname(__DIR__, 2).'/public/assets/';


        // set qrcode
        $result = $this->builder
            ->data($query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(200)
            ->margin(10)
            ->labelText($dateString)
            ->labelAlignment(new LabelAlignmentCenter())
            ->labelMargin(new Margin(15, 5, 5, 8))
            ->build()
        ;

        //generate name
        $namePng = uniqid('', '') . '.png';

        //Save img png
        $result->saveToFile($path.'images/'.$namePng);

        return $result->getDataUri();
    }

}