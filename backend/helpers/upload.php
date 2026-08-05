<?php

/**
 * -----------------------------------------
 * FashionHub Image Upload Helper
 * -----------------------------------------
 */

function uploadImage($file, $targetDir = "../../uploads/products/")
{
    // Check if file exists
    if (!isset($file) || $file['error'] != 0) {
        return [
            "success" => false,
            "message" => "No file uploaded."
        ];
    }

    // Allowed image types
    $allowedTypes = ["jpg", "jpeg", "png", "webp"];

    // Get file extension
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedTypes)) {
        return [
            "success" => false,
            "message" => "Only JPG, JPEG, PNG and WEBP images are allowed."
        ];
    }

    // Maximum file size (5 MB)
    $maxSize = 5 * 1024 * 1024;

    if ($file["size"] > $maxSize) {
        return [
            "success" => false,
            "message" => "Image size must be less than 5 MB."
        ];
    }

    // Create folder if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Generate unique filename
    $newFileName = uniqid("product_", true) . "." . $extension;

    $destination = $targetDir . $newFileName;

    if (move_uploaded_file($file["tmp_name"], $destination)) {
        return [
            "success" => true,
            "filename" => $newFileName,
            "path" => $destination
        ];
    }

    return [
        "success" => false,
        "message" => "Image upload failed."
    ];
}

?>