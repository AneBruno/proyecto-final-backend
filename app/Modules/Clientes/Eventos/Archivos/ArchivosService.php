<?php
/*

namespace App\Modules\Clientes\Eventos\Archivos;

use Illuminate\Support\Facades\DB;
use Kodear\Laravel\ModelStorage\ModelStorage;
use Kodear\Laravel\ModelStorage\ModelStorageFactory;
use Illuminate\Http\UploadedFile;

class ArchivosService {

    static public function getStorage(): ModelStorage {
        return app()->make(ModelStorageFactory::class)->createFromModel(new Archivo, Archivo::SUFFIX);
    }

    static public function obtenerRuta(int $id) {
        return static::getStorage()->getFullPath($id);
    }

    static public function agregarNuevos($eventoId, array $archivos): void {
        foreach ($archivos as $archivo) {
            static::agregar($eventoId, $archivo);
        }
    }

    static public function agregar(int $eventoId, UploadedFile $archivo): Archivo {
        $row = Archivo::crear($eventoId, $archivo->getClientOriginalName());
        static::getStorage()->storeUploadedFile($row->id, $archivo);
        
        return $row;
    }
    
    static public function sincronizar($eventoId, array $archivos): void {
        $archivosId = array_map(function($row) { return $row['id']; }, $archivos);
        
        $rs = Archivo::listarTodos([
            'evento_id' => $eventoId,
        ]);
        
        foreach($rs as $row) {
            if (!in_array($row->id, $archivosId)) {
                static::borrar($row);
            }
        }
    }

    static public function borrar(Archivo $row): void {
        DB::transaction(function() use ($row) {
            $id = $row->id;
            $row->borrar();
            
            $rutaArchivo = static::obtenerRuta($id);
           // unlink($rutaArchivo); //borrado del servidor
        });
    }
}*/