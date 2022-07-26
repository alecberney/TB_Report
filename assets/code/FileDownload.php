<?php
// File Storage Service
public const PRIVATE_FILE_STORAGE_PATH = 'private/file-storage/';
public const PUBLIC_FILE_STORAGE_PATH = 'public/';
public const HASH_ALGORITHM = 'sha256';

public static function download_file($file)
{
    if ($file != null) {
        return Storage::download(File::PRIVATE_FILE_STORAGE_PATH
        . $file->directory . '/' . $file->hash, $file->name);
    } else {
        return null;
    }
}

public static function get_file_url($file)
{
    if ($file != null) {
        return asset(Storage::url(File::PUBLIC_FILE_STORAGE_PATH
        . $file->directory . '/' . $file->hash));
    } else {
        return null;
    }
}