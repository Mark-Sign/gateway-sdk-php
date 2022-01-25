# Mark Sign Gateway PHP Client

## How to start?

1. Run composer install
2. ```php
       /**
         * @var Client
         */
       private $markSignClient;

       // <...>
       /**
         * @param Client $markSignClient
         */
       public function __construct(
           Client $markSignClient
       ) {
           $this->markSignClient = $markSignClient;
       }

       // <...>
       $this->markSignClient->postRequest($requestBuilder->createRequest());
       ```



Powered by: [Mark Sign](https://marksign.lt/)
