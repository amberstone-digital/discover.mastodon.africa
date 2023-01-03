<?php
/**
 * Supporting functions for the instance crawler
 */

 function getCountryForDomain(string $domain) : string
 {
     $reader = new \GeoIp2\Database\Reader('/workspaces/discover.mastodon.africa/crawler/GeoLite2-City.mmdb');
 
     try
     {
         $location = $reader->city(gethostbyname($domain));
         return strtolower($location->country->isoCode);
     }
     catch(\Exception $ex)
     {
         return "xx"; // "unknown"
     }
 }

 function getContinentForDomain(string $domain) : string
{
    $reader = new \GeoIp2\Database\Reader('/workspaces/discover.mastodon.africa/crawler/GeoLite2-City.mmdb');

    try
    {
        $location = $reader->city(gethostbyname($domain));
        return strtolower($location->continent->names['en']);
    }
    catch(\Exception $ex)
    {
        return "unknown";
    }
}

function parseInstancesFile() : array
{
    $file = "/workspaces/discover.mastodon.africa/instances.txt";
    return array_map('trim', file($file));
}

function registerInstance(int $n, string $filepath, array $options) : int|bool
{
    // Sorts the posts in order - if we go past 60 servers, this has to be refactored to add minutes.
    $sec = str_pad($n, 2, "0", STR_PAD_LEFT);

    return file_put_contents($filepath, "---
layout: server
title:  {$options['domain']}
date:   2023-01-03 00:00:{$sec} +0000
country: {$options['country']}
continent: {$options['continent']}
description: {$options['short_description']}
banner: {$options['thumbnail']}
users: {$options['user_count']}
statuses: {$options['status_count']}
---");

}