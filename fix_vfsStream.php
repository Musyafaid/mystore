<?php
// Path to the file
$filePath = 'vendor/mikey179/vfsstream/src/main/php/org/bovigo/vfs/vfsStream.php';

// Check if the file exists
if (file_exists($filePath)) {
    // Read the content of the file
    $content = file_get_contents($filePath);

    // Perform the replacement (from 'name{0}' to 'name[0]')
    $updatedContent = str_replace('name{0}', 'name[0]', $content);

    // Write the updated content back to the file
    file_put_contents($filePath, $updatedContent);

    echo "File updated successfully!";
} else {
    echo "File not found!";
}
