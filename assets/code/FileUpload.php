<?php

[...]

// File Storage Service
public const PRIVATE_FILE_STORAGE_PATH = 'private/file-storage/';
public const PUBLIC_FILE_STORAGE_PATH = 'public/';
public const HASH_ALGORITHM = 'sha256';
public const MAX_FILE_SIZE = 10_000_000; // Size is in bytes 10'000'000 B = 10 Mo

public static function store_file($req_file, $job_id, bool $is_public = false): File
{
    // File infos
    $hash = hash_file(File::HASH_ALGORITHM, $req_file);
    $dir = substr($hash, 0, 2);
    $file_type = FileType::where('name', '=', 
        $req_file->getClientOriginalExtension())->firstOrFail();

    // Create file for DB
    $file = File::create([
        'name' => $req_file->getClientOriginalName(),
        'hash' => $hash,
        'directory' => $dir,
        'file_type_id' => $file_type->id,
        'job_id' => $job_id,
    ]);

    if ($job_id != null) {
        File::create_event_and_mail($job_id, $file);
    }

    // Add to filestorage
    // Create a directory with 2 first letter of hashed_name
    // It's a Laravel trick to not be stopped after x files in directory
    $file_storage_path = $is_public ? File::PUBLIC_FILE_STORAGE_PATH :
        File::PRIVATE_FILE_STORAGE_PATH;
    $req_file->storeAs($file_storage_path . $dir, $hash);

    return $file;
}

[...]