<?php
    require 'vendor/autoload.php';

    use Moip\Moip;
    use Moip\Auth\BasicAuth;
    
    
    try {
        $token = 'UTVPZ8GKLMPBFBPR3RID7HRKENCJU07P';
        $key = 'KTQHOVTWF7HGJEJR3QYSMR0UPJJLXQKVJNKMYLEK';
        $moip = new Moip(new BasicAuth($token, $key), Moip::ENDPOINT_PRODUCTION);

        $custumer_id = uniqid();
        $customer = $moip->customers()
            ->setOwnId($custumer_id)
            ->setFullname('Fulano de Tal')
            ->setEmail('fulano@email.com')
            ->setBirthDate('1988-12-30')
            ->setTaxDocument('22222222222')
            ->setPhone(11, 66778899)
            ->addAddress('BILLING',
                'Rua de teste', 123,
                'Bairro', 'Sao Paulo', 'SP',
                '01234567', 8)
            ->addAddress('SHIPPING',
                'Rua de teste do SHIPPING', 123,
                'Bairro do SHIPPING', 'Sao Paulo', 'SP',
                '01234567', 8)
            ->create();

        $order = $moip->orders()
            ->setOwnId(uniqid())
            ->addItem("Teste de transação", 1, "sku1", 1)
            ->setShippingAmount(0)
            ->setAddition(0)
            ->setDiscount(0)
            ->setCustomer($customer)
            ->create();
        
        $holder = $moip->holders()
            ->setFullname('JESSICA A L VIEIRA')
            ->setBirthDate("1991-06-20")
            ->setTaxDocument('13688083792', 'CPF')
            ->setPhone(24, 988497423, 55)
            ->setAddress('BILLING', 'Avenida Faria Lima', '2927', 'Itaim', 'Sao Paulo', 'SP', '01234000', 'Apt 101');


    } catch (\Exception $th) {
        print_r( $th->getMessage() );
    }

    echo "Passou";
    