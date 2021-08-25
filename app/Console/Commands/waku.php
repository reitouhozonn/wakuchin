<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\Storage;

class waku extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:waku';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'wakutchn aki';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();

        // クッキーをファイル保存しておく
        $cookies = $client->getCookieJar()->all();
        // file_put_contents(self::COOKIE_FILE, serialize($cookies));
        // $client->updateFromSetCookie($cookies);
        // // ファイル保存してたクッキーをセットする
        // $cookies = unserialize(file_get_contents(self::COOKIE_FILE));
        // if (!empty($cookies)) $client->getCookieJar()->updateFromSetCookie($cookies);
        $client->setMaxRedirects(3);
        // $client->getRequest()->getUri();
        // $client->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
        $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
        // $crawler = $client->request('GET', 'https://yokohama.v-yoyaku.jp/reservation/calendar');

        $crawler = $client->request('GET', 'https://yokohama.v-yoyaku.jp/login');
        sleep(5);
        $crawler->filter('*')->each(function ($node) {
            dump($node->text());
        });
        $gsp = $client->getServerParameter('HTTP_USER_AGENT');
        dump($gsp);
        $getCrawler = $client->getCrawler();
        dump($getCrawler);
        // $resBody = $client->getScript();
        // dump($resBody);

        // $response_headers = $client->getInternalResponse()->getHeaders();
        // dump($response_headers);

        // $json = json_decode($client->getInternalResponse()->getContent());
        // dump($json);
        // return 0;
    }
}
