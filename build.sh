#!/bin/bash

# Step 1: Refresh the site directory
(cd crawler; php generate.php)

# Step 2: Build the site
(cd site; jekyll build)

echo "Done!";