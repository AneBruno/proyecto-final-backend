<?php


namespace App\Modules\Clientes\Empresas\Archivos;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Kodear\Laravel\ModelStorage\ModelStorageFactory;
use Kodear\Laravel\ModelStorage\ModelStorage;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class ArchivosService
{
    protected ModelStorage $archivosStorageService;

    public function __construct(ModelStorageFactory $storageFactory)
    {
        $this->archivosStorageService = $storageFactory->createFromModel(new Archivo(), 'archivos', 'local');
    }

    /**
     * @param int $empresaId
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function listar(
        int   $empresaId,
        int   $page      = 1,
        int   $limit     = 0,
        array $filtros   = [],
        array $ordenes   = [],
        array $opciones  = []
    ) {
        $archivos = Archivo::listar($page, $limit, array_merge($filtros, [
            'empresa_id' => $empresaId
        ]), $ordenes, $opciones);

        return $archivos;
    }

    /**
     * @param int $archivoId
     * @param array $relations
     * @return Archivo
     * @throws RepositoryException
     */
    public function getOne(int $archivoId, array $options)
    {
        $archivo = Archivo::getById($archivoId, [], $options);
        $archivo->path = $this->archivosStorageService->getFullPath($archivoId);

        return $archivo;
    }

    /**
     * @param int $empresaId
     * @param $fechaVencimiento
     * @param int $tipoArchivoId
     * @param $archivoAdjunto
     * @return Archivo
     * @throws Exception
     */
    public function create(
        int $empresaId,
        $fechaVencimiento,
        int $tipoArchivoId,
        $archivoAdjunto
    ): Archivo {

        DB::beginTransaction();

        $archivo = Archivo::crear($empresaId, $fechaVencimiento, $tipoArchivoId);

        $archivoId = $archivo->getKey();

        $this->archivosStorageService->storeUploadedFile($archivoId, $archivoAdjunto);
        $archivo->path = $this->archivosStorageService->getUrl($archivoId);

        DB::commit();
        return $archivo;
    }

    /**
     * @param Archivo $archivo
     * @param string $fechaVencimiento
     * @param int $tipoArchivoId
     * @param null $archivoAdjunto
     * @return Archivo
     * @throws Exception
     */
    public function update(Archivo $archivo, string $fechaVencimiento, int $tipoArchivoId, $archivoAdjunto = null)
    {

        DB::beginTransaction();
        $archivo->actualizar($fechaVencimiento, $tipoArchivoId);

        $archivoId = $archivo->getKey();

        if ($archivoAdjunto !== null) { //Verifica que si se subió el archivo se actualice
            $this->archivosStorageService->storeUploadedFile($archivoId, $archivoAdjunto);
        }
        $archivo->path = $this->archivosStorageService->getUrl($archivoId);

        DB::commit();

        return $archivo;
    }

    /**
     * @param int $archivoId
     * @return bool|null
     * @throws RepositoryException
     */
    public function delete(int $archivoId) {
        return Archivo::getById($archivoId)->delete();
    }

    /**
     * @param int $archivoId
     * @return string
     */
    public function obtenerRutaArchivo(int $archivoId)
    {
        return $this->archivosStorageService->getFullPath($archivoId);
    }

    /**
     * @param int $empresaId
     * @return bool
     */
    public function completos(int $empresaId): bool
    {
        $archivos = ArchivosHelper::ARCHIVOS;

        $archivosDeEmpresa = $this->obtenerArrayTiposArchivos($empresaId);

        $value = true;
        foreach ($archivos as $archivo) {
            if (!in_array($archivo, $archivosDeEmpresa)) {
                $value = false;
            };
        }
        return $value;
    }

    /**
     * @param int $empresaId
     * @return array
     */
    private function obtenerArrayTiposArchivos(int $empresaId)
    {
        $archivosDeEmpresa = Archivo::listarTodos(['empresa_id' => $empresaId]);

        $arrayIds = [];
        foreach ($archivosDeEmpresa as $archivo => $attribute) {
            $arrayIds[] = $attribute['tipo_archivo_id'];
        }

        return $arrayIds;
    }
}
