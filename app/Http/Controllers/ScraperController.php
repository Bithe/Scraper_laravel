<?php
namespace App\Http\Controllers;

    use App\Models\Scraper;
    use Illuminate\Http\Request;
    use Goutte\Client;

class ScraperController extends Controller
{
    private $results = array();
    public function scraper()
    {
        $client = new Client();
        $url = 'https://vidnext.net/';
        $page = $client->request('GET', $url);

        // echo $page->filter('.video-block a')->attr('href');
        // echo "<pre>";
        // print_r($page);
        // return view('scraper');

        $page->filter('.video-block')->each(function ($node) {
            $video_url = $node->filter('a')->attr('href');
            $video_name = $node->filter('.name')->text();

            echo 'Video Name: ' . $video_name;
            echo '<br> ' . 'Video URL: ' . 'https://vidnext.net' . $video_url;
            echo "<br>";

                Scraper::create([
                    'video_name'=>$video_name,
                    'video_url' =>$video_url,
                ]);
        });
    }
}
