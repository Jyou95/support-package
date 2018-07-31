<?php

return [

    'faq_limit' => 3,

    'prefix' => [
        'prefix' => 'support',
    ],

    'middleware-account' => [
        'middleware' => [],
    ],

    'middleware-admin' => [
        'middleware' => [],
    ],

	'faq' => [
        'Deposit/Withdraw' => [
            'Withdraw to wrong address' => 'session',
            'Cannot receive Email' => '1.Customer can click "Funds" —"My Funds" then choose "Exchange into BNB".Later they will be redirected to "Pending Exchange Funds" page.',
        ],

        'Trading' => [
            'How to convert your small amount balance to BNB' => 'We will try best to solve it as soon as possible.By the way,priority would be low if tickets lack of above screenshots.',
            'How to handle Order Exceptions' => 'If you would like to expedite it, you can consider canceling the open order and submit a new order with a more competitive price.',
        ],
    ],

];