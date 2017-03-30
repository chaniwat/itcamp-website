<?php

namespace App\Services;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\File;

class FileService
{

    /**
     * Maximum upload size, in bytes<br>
     * Because of each web server have its own maximum size (look in php.info)
     */
    const DEFAULT_FILE_UPLOADED_MAX_SIZE = 2097152;

    /**
     * Accept file type
     */
    const ACCEPTS_FILE_TYPE = ['picture', 'document', 'any', 'all'];

    /**
     * File mime-type maps<br>
     * Map type to file mimes
     */
    const FILE_MIME_TYPE_MAP = [
        "picture" => [
            "image/jpeg",   // .jpg
            "image/gif",    // .gif
            "image/png"     // .png
        ],
        "document" => [
            "application/pdf",      // .pdf
            "application/msword",   // .doc
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document" // .docx
        ]
    ];

    /**
     * Check if file mime is accepted (by type)
     * @param string $setting JSON string -> field_setting
     * @param File $file Uploaded file or any file that related to form setting
     * @return bool
     */
    public function checkFileMimeAccepted($setting, File $file)
    {
        $settingJson = json_decode($setting, True);

        if(in_array($settingJson['acceptTypes'], ['any', 'all'])) {
            $accepts = [];
            foreach(self::FILE_MIME_TYPE_MAP as $type => $values)
            {
                $accepts = array_merge($accepts, $values);
            }
        } else {
            $accepts = self::FILE_MIME_TYPE_MAP[$settingJson['acceptTypes']];
        }

        return in_array($file->getMimeType(), $accepts);
    }

    /**
     * Check if file size is accepted (check in byte)
     * @param File $file
     * @return bool
     */
    public function checkFileSizeAccepted(File $file)
    {
        return $file->getSize() <= env('FILE_UPLOADED_MAX_SIZE', self::FILE_UPLOADED_MAX_SIZE);
    }

    /**
     * Store the file
     * @param File $file
     * @param $destination
     * @return string Path to file, relative to public folder
     */
    public function storeFile(File $file, $destination) {
        $filename = Carbon::now()->format('mdYHis').md5($file->getClientOriginalName()).".".strtolower($file->getClientOriginalExtension());
        $file->move("storage/".$destination, $filename);

        return $destination."/".$filename;
    }

}