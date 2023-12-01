<?php

namespace Blazemedia\App\Utilities;

use Carbon\Carbon;

class DataAdapter {
    function __construct() {
    }

    public function getData($data) {

        $categories = explode("/", $data['subcategoryPath1']);

        $dateStart= Carbon::createFromFormat('Y-m-d H:i:s O', $data['dealStartTime'])->format('d/m/Y H:i:s');
        $dateEnd =  Carbon::createFromFormat('Y-m-d H:i:s O', $data['dealEndTime'])->format('d/m/Y H:i:s');

        if(env('APPEND_CONNECTION','api') == 'mysql'){
            $dateStart= Carbon::createFromFormat('Y-m-d H:i:s O', $data['dealStartTime'])->format('Y-m-d H:i:s');
            $dateEnd =  Carbon::createFromFormat('Y-m-d H:i:s O', $data['dealEndTime'])->format('Y-m-d H:i:s');
        }

        return [
            'ASIN' => $data['asin'],
            'Titolo' => $data['dealTitle'],
            'Prezzo' => $data['dealPrice'],
            'Sconto' => $data['discountString'],
            'Prezzo di Referenza' => $data['referencePrice'],
            'Tipo Referenza' => $data['referencePriceType'],
            'Data Inizio' => $dateStart,
            'Data Fine' => $dateEnd,
            'Categoria' => isset($categories[0]) ? $categories[0] : '',
            'Sub Categoria' => isset($categories[1]) ? $categories[1] : '',
            'Sub Categoria 2' => isset($categories[2]) ? $categories[2] : '',
            'URL' => $data['dealURL'],
            'DealID' => $data['dealID'],
            'DealType' =>  $data['dealType'],
            'DealState' =>  $data['dealState']

        ];
    }

    public function getHeader() {
        return [
            'ASIN', 'Titolo',
            'Prezzo', 'Sconto',
            'Prezzo di Referenza', 'Tipo Referenza',
            'Data Inizio', 'Data Fine', 'Categoria', 'Sub Categoria',
            'Sub Categoria 2', 'URL', 'DealID', 'DealType', 'DealState'
        ];
    }
}
