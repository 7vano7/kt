<?php

namespace app\commands;

use yii\console\Controller;
use Yii;

class GenerateController extends Controller
{
    public $city_url = 'https://digital.kt.ua/api/test/cities';
    public $street_url = 'https://digital.kt.ua/api/test/streets?city_ref=';
    public $token = '854E982F9BE2ADD7CCD1E79B86FD3';
    /**
     * get list of cities
     */
    public function actionCity()
    {
        $ch = curl_init();
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        $header[] = 'secret-token: '.$this->token;

        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_URL, $this->city_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpCode == 200 && $result) {
            $response = json_decode($result);
            if(empty($response)) {
                return false;
            }
            $count = count($response);
            $connection = Yii::$app->db;
            for ($i = 0; $i < $count; $i++) {
                $connection->createCommand("INSERT INTO city SET `city` = :city, ref = :ref ON DUPLICATE KEY UPDATE `city` = :city, ref = :ref")
                    ->bindValue(':city', $response[$i]->name)
                    ->bindValue(':ref', $response[$i]->ref)
                    ->execute();

                $ch = curl_init();
                $header = array();
                $header[] = 'Content-length: 0';
                $header[] = 'Content-type: application/json';
                $header[] = 'secret-token: '.$this->token;

                curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_URL, $this->street_url.$response[$i]->ref);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if($httpCode == 200 && $result) {
                    $streetList = json_decode($result);
                    if(empty($streetList)) {
                        return 'No items';
                    }
                    $count = count($streetList);
                    $connection = Yii::$app->db;
                    for ($i = 0; $i < $count; $i++) {
                        $connection->createCommand("INSERT INTO street SET `street` = :street, city_ref = :ref ON DUPLICATE KEY UPDATE `street` = :street, city_ref = :ref")
                            ->bindValue(':street', $streetList[$i]->name)
                            ->bindValue(':ref', $streetList[$i]->ref)
                            ->execute();
                    }
                }
            }
        }
    }
}