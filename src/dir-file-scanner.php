<?php

function scanMarkdownFiles($dir, callable $extractCallback) {
    $files = glob($dir . '/*.md');
    $results = [];

    foreach ($files as $file) {
        $contents = file_get_contents($file);

        // Match front matter block
        if (preg_match('/^---\s*(.*?)\s*---/s', $contents, $matches)) {
            $block = $matches[1];

            // Let callback extract metadata
            $metadata = $extractCallback($block, $file);
            if ($metadata !== null) {
                $results[] = $metadata;
            }
        }
    }

    return $results;
}


function scanMarkdownFilesInDir($dir_path, $filter_callback, $sort_callback) {

    $files_with_dates = scanMarkdownFiles($dir_path, $filter_callback);
    usort($files_with_dates, $sort_callback);

    $results = [];
    foreach ($files_with_dates as $entry) {
        $results[] = $entry['file'];
    }

    return $results;
}