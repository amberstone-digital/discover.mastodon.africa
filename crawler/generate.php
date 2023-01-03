<?php
/**
 * Index Generator
 * 
 * Iterates all included Mastodon domains, gathers public statistics and updates the _posts folder
 */

require "vendor/autoload.php";
require "functions.php";

$instances = parseInstancesFile();

$n = 0;

foreach($instances as $domain)
{
    $filename = "2023-01-03-" . str_replace(".", "-", $domain) . ".markdown";
    $filepath = "/workspaces/discover.mastodon.africa/site/_posts/{$filename}";

    // If there's an existing post for this instance, remove it. It will be added back if:
    // 1. The instance API is accessible over HTTPS and returns valid JSON
    // 2. The instance is set to allow registrations
    // If either of those fail, no new file will be written, effectively de-listing the instance
    if (file_exists($filepath)) unlink($filepath);    

    // Get the /instance endpoint - can only proceed if this works
    // If this is unreachable over https:// don't proceed: HTTPS is a minimum requirement.

    $ch = curl_init("https://{$domain}/api/v1/instance");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $json = curl_exec($ch);
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($responseCode == 200)
    {
        // We could reach the instance API, so create/update a listing for this instance
        $country = getCountryForDomain($domain);
        $continent = getContinentForDomain($domain);

        $object = json_decode($json);

        if (is_object($object)) {
            if ($object->registrations === TRUE){
                // The instance is accepting registrations, eligible for listing
                registerInstance($n, $filepath, [
                    'domain' => $domain,
                    'country' => $country,
                    'continent' => $continent,
                    'short_description' => $object->short_description,
                    'thumbnail' => $object->thumbnail,
                    'user_count' => $object->stats->user_count,
                    'status_count' => $object->stats->status_count,
                ]);

                echo "Registered $domain\n";

                $n++;
            }
        }

    }
    else
    {
        echo "Failed to register $domain\n";
    }

}