<?php

namespace Modules\Media\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\Media\Helpers\FileHelper;
use Modules\Media\Models\MediaFile;

class MediaController extends Controller
{
    public function preview($id, $size = 'thumb')
    {
        return redirect(FileHelper::url($id, $size));
    }


    public function privateFileStore(Request $request)
    {
        if (!$user_id = Auth::id()) {
            return $this->sendError(__("Por favor, faça login"));
        }

        $file = $request->file('file');

        try {
            $this->validatePrivateFile($file, $request->input('type', 'default'));
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }

        // Pasta privada
        $folder = 'private/' . $user_id . '/' . date('Y/m/d');

        // Gerar nome único
        $newFileName = md5(microtime(true) . rand(0, 999));

        // Extensão
        $ext = strtolower($file->getClientOriginalExtension());
        $isImage = in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'bmp']);

        // Procurar nome livre
        $i = 0;
        do {
            $newFileName2 = $newFileName . ($i ? $i : '');
            $finalPath = $folder . '/' . $newFileName2 . '.' . $ext;
            $i++;
        } while (Storage::disk('local')->exists($finalPath));


        /*
    |--------------------------------------------------------------------------
    | PROCESSAMENTO DE IMAGEM (RESIZE + ORIENTATE)
    |--------------------------------------------------------------------------
    */
        if ($isImage) {

            $originalPath = $file->getRealPath();

            $img = Image::make($originalPath)
                ->orientate()
                ->resize(2500, 2500, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });

            // Salvar no disco privado
            Storage::disk('local')->put($finalPath, (string) $img->encode($ext, 90));

            $finalStored = $finalPath;
        } else {
            /*
        |--------------------------------------------------------------------------
        | ARQUIVO NORMAL (PDF, ZIP, DOC...)
        |--------------------------------------------------------------------------
        */
            $finalStored = $file->storeAs($folder, $newFileName2 . '.' . $ext, 'local');
        }


        /*
    |--------------------------------------------------------------------------
    | RESPOSTA FINAL
    |--------------------------------------------------------------------------
    */

        if ($finalStored) {
            try {

                $path = str_replace('private/', '', $finalStored);

                return $this->sendSuccess([
                    'data' => [
                        'path'          => $path,
                        'name'          => Str::slug($file->getClientOriginalName()),
                        'size'          => $file->getSize(),
                        'file_type'     => $file->getMimeType(),
                        'file_extension' => $ext,
                        'download'      => route('media.private.view', ['path' => $path]),
                    ]
                ]);
            } catch (\Exception $exception) {

                Storage::disk('local')->delete($finalStored);
                return $this->sendError($exception->getMessage());
            }
        }

        return $this->sendError(__("Não foi possível enviar o arquivo"));
    }


    /**
     * @param $file UploadedFile
     * @param $group string
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validatePrivateFile($file, $group = "default")
    {
        $allowedExts = [
            'jpg',
            'jpeg',
            'bmp',
            'png',
            'gif',
            'zip',
            'rar',
            'pdf',
            'xls',
            'xlsx',
            'txt',
            'doc',
            'docx',
            'ppt',
            'pptx',
            'webm',
            'mp4',
            'mp3',
            'flv',
            'vob',
            'avi',
            'mov',
            'wmv',
        ];
        $allowedExtsImage = [
            'jpg',
            'jpeg',
            'bmp',
            'png',
            'gif',
        ];
        $allowedMimeTypes  = [];
        $uploadConfigs = [
            'default' => [
                'types'    => $allowedExts,
                "max_size" => 20000000,
                "max_width" => 5000,
                "max_height" => 2500,
                // 20MB
            ],
            'image' => [
                'types'    => $allowedExtsImage,
                "max_size" => 20000000,
                "max_width" => 2500,
                "max_height" => 2500
            ]
        ];
        $config = isset($uploadConfigs[$group]) ? $uploadConfigs[$group] : $uploadConfigs['default'];

        if (!in_array(strtolower($file->getClientOriginalExtension()), $config['types'])) {
            throw new \Exception(__("Tipo de arquivo não permitido"));
        }
        if ($file->getSize() > $config['max_size']) {
            throw new \Exception(__("O tamanho máximo do arquivo para upload é :max_size B", ['max_size' => $config['max_size']]));
        }

        if (in_array($file_extension = strtolower($file->getClientOriginalExtension()), $allowedExtsImage)) {

            if (!empty($config['max_width']) or !empty($config['max_width'])) {
                $imagedata = getimagesize($file->getPathname());
                if (empty($imagedata)) {
                    throw new \Exception(__("Não foi possível obter as dimensões da imagem"));
                }
            }
        }

        return true;
    }

    public function privateFileView()
    {

        $path = 'private/' . \request()->get('path');

        if (Storage::disk('local')->exists($path)) {

            header('Content-Type: ' . mime_content_type(Storage::disk('local')->path($path)));

            echo Storage::disk('local')->get($path);
            exit;
        }

        abort(404);
    }

    public function editImage(Request $request)
    {
        $validate = [
            'image'     => 'required',
            'image_id'  => 'required',
        ];
        $request->validate($validate);

        if (!Auth::user()->hasPermission("media_upload")) {
            $result = [
                'message' => __('403'),
                'status' => 0
            ];
            return $result;
        }

        $image_id = $request->input('image_id');
        $image_data = $request->input('image');

        $file = MediaFile::find($image_id);
        $res = $file->editImage($image_data);
        return $this->sendSuccess($res);
    }
}
