<?php

class BigCommerceSideOutConfig
{
    const BIG_COMMERCE_SO_STORE_ID = 'your_credentials';

    const BIG_COMMERCE_SO_TOKEN = 'your_credentials';

    const BIG_COMMERCE_SO_CLIENT_ID = 'your_credentials';


    public function getStoreId()
    {
        return self::BIG_COMMERCE_SO_STORE_ID;
    }

    public function getToken()
    {
        return self::BIG_COMMERCE_SO_TOKEN;
    }

    public function getClientId()
    {
        return self::BIG_COMMERCE_SO_CLIENT_ID;
    }
}
