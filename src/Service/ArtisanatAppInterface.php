<?php


namespace App\Service;


class ArtisanatAppInterface
{
     public static function capitalize(string $chaine)
     {
         return ucwords(mb_strtolower(trim($chaine)));
     }

     public static function lowercase(string $chaine)
     {
         return mb_strtolower(trim($chaine));
     }
}
