if(!empty($basketIds)){
    $basketPropRes = \Bitrix\Sale\Internals\BasketPropertyTable::getList(array(
        'filter' => [
            "BASKET_ID" => $basketIds,
            "CODE" => 'MARKET'
        ],
        'select' => [
                'BASKET_ID',
        ] 
        )); 
    $basketProps = [];
    while ($item = $basketPropRes->fetch()) {
        $basketProps[$item['BASKET_ID']] = $item['BASKET_ID'];
    }
    foreach ($arBasket as $key => $value) {
        if($_REQUEST['DORDOY']){
            if(!empty($basketProps[$key])){
                \Bitrix\Sale\Internals\BasketTable::update($key, ['ORDER_ID' => $orderId]);
                $basketIdSuccess[] = $key;
            }
        }else{
            if(empty($basketProps[$key])){
                \Bitrix\Sale\Internals\BasketTable::update($key, ['ORDER_ID' => $orderId]);
                $basketIdSuccess[] = $key;
            }
        }
    }
}
