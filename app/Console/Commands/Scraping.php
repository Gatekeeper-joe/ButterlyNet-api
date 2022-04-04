<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use App\Models\Site;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Log;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Access to the specified URL.';

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
    public function handle(Site $site)
    {
        $col = $site->get(['user_id', 'host', 'url']);
        $path = storage_path('app\source');

        if (!empty($col)) {
            foreach ($col as $obj) {
                $url = $obj->url;

                try {
                    $client = new Client(HttpClient::create(array(
                        'headers' => array(
                            'Referer' => 'https://www.google.com/',
                        ),
                    )));
                    $client->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36'); //Due to be forced using 'Symfony BrowserKit' in executing, set user-agent manually in this line.;
                    $client = $client->request('GET', $url);
                } catch (Exception $e) {
                    $message = $e->getMessage();
                    Log::info($message);
                    throw new Exception();
                }

                //Create a html file based on the scraped data.
                $create = app()->make('App\Http\Controllers\CreateController');
                $fnp = $create->execute($client, $obj, $path);

                //Relevant filepath is stored in an array.
                $fnp = $path . '\\' . $fnp;
                $full_path =  $fnp . '*';
                $files = glob($full_path);
                Log::info($files);
                $arr_count = count($files);

                if ($arr_count > 1) {
                    $date_str = [];

                    //Extract the date part of the file name.
                    for ($i = 0; $i < $arr_count; $i++) {
                        $file = $files[$i];
                        $separated = explode('_', $file);
                        $crumb = array_pop($separated);
                        $hashed = explode('.', $crumb);
                        $date_str[$i] = $hashed[0];
                    }

                    // Check whether the page was updated.
                    $a = file_get_contents($files[0]);
                    $b = file_get_contents($files[1]);
                    if (strcmp($a, $b) !== 0) {
                        $site->saveNow($obj);
                    }

                    //Delete the file more older.
                    $target_date = min($date_str);
                    $pattern = '/' . '.*' . $target_date . '.*' . '/';
                    foreach ($files as $file) {
                        $bool = preg_match($pattern, $file);
                        if ($bool === 1) {
                            $hashed_path = explode('\\', $file);
                            $file_name = array_pop($hashed_path);
                            Storage::delete($file_name);
                        }
                    }
                }
            }
            return;
        }
    }
}
