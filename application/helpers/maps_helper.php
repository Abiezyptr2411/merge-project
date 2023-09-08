<?php

// application/helpers/maps_helper.php

if (!function_exists('generateGoogleMapsLink')) {
   function generateGoogleMapsLink($location)
   {
      // Mencari koordinat Latitude dan Longitude dalam string
      preg_match('/Latitude: ([-\d.]+), Longitude: ([-\d.]+)/', $location, $matches);

      if (count($matches) == 3) {
         // Ambil nilai Latitude dan Longitude
         $latitude = trim($matches[1]);
         $longitude = trim($matches[2]);

         // URL Google Maps dengan koordinat Latitude dan Longitude
         $mapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";

         return $mapsUrl;
      }

      return '#'; // Tautan tidak valid jika format tidak sesuai
   }
}
