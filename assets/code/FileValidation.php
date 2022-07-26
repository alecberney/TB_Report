<?php

public static function is_valid_file($file, $accepted_file_types): bool
{
    if ($file == null) {
        Log::Info("File is null");
        return false;
    }

    if ($file->getSize() > File::MAX_FILE_SIZE) {
        Log::Info("File is too big");
        return false;
    }

    // Verify file type matching with file type detected from content
    // Some types are detected false and we know them, a correspondence function is used
    // Some other, we don't know yet the correspondence and go further
    $file_type_matching_ok = true;
    if (self::is_file_type_not_detected_with_correspondence(
        $file->getClientOriginalExtension())) {
        $file_type_correspondence = self::get_file_type_correspondence($file->getClientOriginalExtension());
        $file_type_matching_ok = $file_type_correspondence == $file->extension();
    } else if (!self::is_file_type_not_detected_without_correspondence($file->getClientOriginalExtension())
        && $file->getClientOriginalExtension() != $file->extension()) {
        $file_type_matching_ok = false;
    }

    if (!$file_type_matching_ok) {
        log::Info("Original extension and extension detected by mime type mismatch");
        return false;
    }

    // Verify if file type exists in BD
    $file_type = FileType::where('name', '=', $file->getClientOriginalExtension())->first();
    if ($file_type == null) {
        log::Info("File type not found in BD");
        return false;
    }

    // $file->extension() = Determine the file's extension based on the file's MIME type
    // Check matching file type with file extension
    if (!self::is_file_type_not_detected($file->getClientOriginalExtension())
        && $file_type->name != $file->extension()) {
        log::Info("File type mismatch");
        return false;
    }

    // Verify if in accepted types
    if (!in_array($file->getClientOriginalExtension(), $accepted_file_types)) {
        log::Info("File type not accepted for this job category");
        return false;
    }

    return true;
}
