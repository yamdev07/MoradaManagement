<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SPAContent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Si c'est une requête AJAX pour le SPA, retourner uniquement le contenu principal
        if ($request->ajax() && $request->header('X-Requested-With') === 'XMLHttpRequest') {
            $content = $response->getContent();
            
            // Extraire uniquement le contenu principal
            $dom = new \DOMDocument();
            @$dom->loadHTML($content);
            
            $xpath = new \DOMXPath($dom);
            $mainContent = $xpath->query('//div[@id="page-content-wrapper"]//div[@class="p-3"]');
            
            if ($mainContent->length > 0) {
                $mainHtml = '';
                foreach ($mainContent as $node) {
                    $mainHtml .= $dom->saveHTML($node);
                }
                
                return response($mainHtml)
                    ->header('Content-Type', 'text/html')
                    ->header('X-SPA-Content', 'true');
            }
        }
        
        return $response;
    }
}
