<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoryCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(count(Category::all()) == 0){
            session()->flash('error' , 'You need to create a category to create a post!!');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
