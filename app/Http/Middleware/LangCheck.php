<?php
/**
 * Created by PhpStorm.
 * User: Arturas
 * Date: 6/7/2017
 * Time: 3:11 PM
 */

namespace App\Http\Middleware;


use Closure;

class LangCheck
{
    /**
     * Redirecting non existing language to english
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $availableLanguages = ['lt', 'en'];
        $language = request()->segment(1);

        if(in_array($language, $availableLanguages))
        {
            app()->setLocale($language);
            return $next($request);
        }

        return redirect('en');
    }
}