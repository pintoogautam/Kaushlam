<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gornymedia\Shortcodes\Facades\Shortcode;
use App\Post;
class ShortSSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //die('Hello i am here');
        Shortcode::add('widget', function($atts, $content, $name)
        {
            $posts = Post::latest()->get();
         $a = Shortcode::atts([
          'name' => $name,
          'posts' => $posts
          ], $atts);

         $file = '' . $a['name']; // ex: resource/views/partials/ $atts['name'] .blade.php

         if (view()->exists($file)) {
          return view($file, $a);
         }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
