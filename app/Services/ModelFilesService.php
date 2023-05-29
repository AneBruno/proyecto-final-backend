<?php

namespace App\Services;

use App\Helpers\Base64File;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

/**
 * Esta clase gestiona el almacenamiento de archivos
 * relacionados a registros de base de datos.
 * Se utiliza una carpeta por tabla/entidad, y el nombre del archivo
 * corresponde con el id del registro.
 */
class ModelFilesService
{

    private FilesystemManager $filesystemManager;
    private FilesystemAdapter $disk;
    private string            $folder = '';
    private string            $suffix = 'public';

    /**
     * FilesService constructor.
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(string $folder, string $diskName = 'public')
    {
        $this->filesystemManager = App::make(FilesystemManager::class);
        $this->disk              = $this->filesystemManager->disk($diskName);
        $this->folder            = $folder;
    }
    
    public function setSuffix(string $suffix) {
        $this->suffix = $suffix;
    }
    
    /**
     * El método resuelve la ruta al archivo, partiendo el id cada 2 dígitos
     * con una / para que los listados de directorios no sean enormes cuando
     * hay muchos registros.
     *
     * Ejemplo para el usuario id 216599 la ruta será la siguiente:
     *
     * nombre_carpeta/21/65/99/216599
     *
     * @param int $id
     * @return string
     */
    public function getStorePath(int $id): string
    {
        return $this->folder .
                DIRECTORY_SEPARATOR .
                implode(DIRECTORY_SEPARATOR, str_split("{$id}", 2)) .
                DIRECTORY_SEPARATOR .
                $id . '_' . $this->suffix;
    }

    public function storeUploadedFile(int $id, UploadedFile $source)
    {
        $pathName = $this->getStorePath($id);
        $this->disk->put($pathName, $source->get());
    }
    
    public function storeBase64(int $id, Base64File $file)
    {
        $pathName = $this->getStorePath($id);
        $this->disk->put($pathName, $file->getBinaryContent());
    }
    
    public function storeContent(int $id, string $content) {
        $pathName = $this->getStorePath($id);
        $this->disk->put($pathName, $content);
        
    }
    
    public function storeFromBase64Content(int $id, string $base64Content, array $allowedMimeTypes = [])
    {
        $file = new Base64File($base64Content);
        if (!empty($allowedMimeTypes)) {
            $mimeType = $file->getMimeType();
            if (!in_array($mimeType, $allowedMimeTypes)) {
                throw new \Exception("Tipo de archivo {$mimeType} no permitido");
            }
        }
        
        $this->storeBase64($id, $file);
    }
    
    public function getFullPath(int $id): string
    {
        return $this->disk->path($this->getStorePath($id));
    }
    
    public function getUrl(int $id): string
    {
        $filePath = $this->getStorePath($id);
        if (!$this->disk->exists($filePath)) {
            return '';
        }
        $timestamp = $this->disk->getTimestamp($filePath);
        return $this->disk->url($filePath) . "?ts={$timestamp}";
    }
}
