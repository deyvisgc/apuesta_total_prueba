<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait SearchApiTrait
{

    public function searchDocument(string $numberDocument) {
      $TOKEN = "b8ad2c81aa4576048b21f8651dd2f54aad147684b673cde185aa6f74ddd8bbd3";
        $url = 'https://apiperu.dev/api/dni/'.$numberDocument;
        $response = Http::withHeaders([
            'Content-Type' => "application/json",
            'Authorization' => "Bearer ".$TOKEN // Accede a la constante TOKEN con self::
        ])->get($url);
        
        Log::info("FIN => Send Message Whatsapp");
        
        return $response->json();
    }
}
