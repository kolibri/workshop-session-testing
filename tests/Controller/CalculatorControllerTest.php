<?php

namespace App\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCanUseCalculator(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/', [], [], []);
        self::assertResponseIsSuccessful();

        static::assertCount(1, $crawler->filter('form'));

        $button = $crawler->selectButton('calc');
        $form = $button->form();

        $crawler = $client->submit($form, [
           'calculator[numberA]' => 'x',
           'calculator[numberB]' => 'y',
           'calculator[modifier]' => '+',
        ]);

        self::assertResponseIsSuccessful();
        static::assertCount(2, $crawler->filter('li'));

        $button = $crawler->selectButton('calc');
        $form = $button->form();

        $crawler = $client->submit($form, [
            'calculator[numberA]' => '3',
            'calculator[numberB]' => '7',
            'calculator[modifier]' => '+',
        ]);

        self::assertResponseRedirects('/result/10');

        $crawler = $client->followRedirect();
        static::assertSame('10', $crawler->filter('#result')->text());
    }
}