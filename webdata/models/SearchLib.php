<?php

class SearchLib
{
    public function searchCompaniesByAddress($address)
    {
        $curl = curl_init();
        $q = urlencode('公司所在地:"' . $address. '"');
        curl_setopt($curl, CURLOPT_URL, getenv('SEARCH_URL') . '/company/_search?q=' . $q);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);
        return json_decode($ret);
    }

    public function searchCompaniesByName($name, $page = 1)
    {
        $curl = curl_init();
        $q = urlencode('商業名稱:"' . $name . '" OR 公司名稱:"' . $name. '"');
        $from = 10 * ($page - 1);
        curl_setopt($curl, CURLOPT_URL, getenv('SEARCH_URL') . '/company/_search?q=' . $q . '&from=' . $from);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($curl);
        return json_decode($ret);
    }
}