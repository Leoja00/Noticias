<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\NoticiasModel;
use App\Models\NoticiasHistorialModel;

class Noticias extends BaseController
{
    protected $noticiasModel;
    protected $noticiasHistorialModel;

    public function __construct()
    {
        $this->noticiasModel = new NoticiasModel();
        $this->noticiasHistorialModel = new NoticiasHistorialModel();
    }

    public function index()
{
    //10 DIAS A FINALIZADA
    $noticias = $this->noticiasModel->where('estado', 'publicada')->findAll();
    foreach ($noticias as $noticia) {
        $fechaPublicacion = strtotime($noticia->fecha_publicacion);
        $fechaFinalizacion = strtotime('+10 days', $fechaPublicacion);
        $fechaActual = strtotime('now');

        if ($fechaActual > $fechaFinalizacion) {
            $this->noticiasModel->update($noticia->id, ['estado' => 'finalizada']);
        }
    }

    // 5 DIAS DE VALIDAD A PUBLICADA
    $noticiasParaValidar = $this->noticiasModel->where('estado', 'lista_para_validar')->findAll();
    foreach ($noticiasParaValidar as $noticia) {
        $fechaValidacion = strtotime($noticia->fecha_modificacion ?? $noticia->fecha_creacion);
        $fechaLimite = strtotime('+5 days', $fechaValidacion);
        $fechaActual = strtotime('now');

        if ($fechaActual > $fechaLimite) {
            $this->noticiasModel->update($noticia->id, [
                'estado' => 'publicada',
                'fecha_publicacion' => date('Y-m-d H:i:s', $fechaActual)
            ]);
        }
    }

    
    $data['noticias'] = $this->noticiasModel
        ->where('estado', 'publicada')
        ->orderBy('fecha_publicacion', 'DESC')
        ->findAll();

    return view('index', $data);
}


    
    public function show($id)
    {
        $noticia = $this->noticiasModel->find($id);

        if (!$noticia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró la noticia con ID: ' . $id);
        }

        session()->set('previous_url', $_SERVER['HTTP_REFERER']);

        $data['noticia'] = $noticia;
        return view('noticias/show', $data);
    }

    public function activar($id)
    {
        $noticia = $this->noticiasModel->find($id);

        if ($noticia->activo == 1) {
            return redirect()->back()->with('alert', 'warning')->with('message', 'La noticia ya está activada.');
        }

        $cantidadNoticiasActivas = $this->noticiasModel->countActiveNoticias();

        if ($cantidadNoticiasActivas >= 3) {
            return redirect()->back()->with('alert', 'danger')->with('message', 'No se puede activar la noticia porque ya hay tres noticias activas.');
        } else {
            $this->noticiasModel->update($id, ['activo' => 1]);
            $this->logHistorial($id, 'activada');
            return redirect()->back()->with('alert', 'success')->with('message', 'Noticia activada exitosamente.');
        }
    }

    public function desactivar($id)
    {
        $noticia = $this->noticiasModel->find($id);

        if ($noticia->activo == 0) {
            return redirect()->back()->with('alert', 'warning')->with('message', 'La noticia ya está desactivada.');
        }

        $this->noticiasModel->update($id, ['activo' => 0]);
        $this->logHistorial($id, 'desactivada');
        return redirect()->back()->with('alert', 'success')->with('message', 'Noticia desactivada exitosamente.');
    }


    public function descart($id)
    {
        
        $historial = $this->noticiasHistorialModel->where('noticia_id', $id)->findAll();

        $haEstadoParaCorreccion = false;
        foreach ($historial as $registro) {
            if ($registro['estado'] === 'para_correccion') {
                $haEstadoParaCorreccion = true;
                break;
            }
        }

        //NO TUVO EN 'para_correccion', PUEDE CAMBIAR A 'descartado'
        if (!$haEstadoParaCorreccion) {
            $this->noticiasModel->update($id, ['estado' => 'descartado']);
            $this->logHistorial($id, 'descartada');
            return redirect()->back()->with('alert', 'success')->with('message', 'Noticia descartada exitosamente.');
        } else {
            return redirect()->back()->with('alert', 'danger')->with('message', 'La noticia no puede ser descartada porque estuvo en estado de corrección.');
        }
    }


    public function publication($id)
    {
        $this->noticiasModel->update($id, [
            'estado' => 'publicada', 
            'fecha_publicacion' => date('Y-m-d H:i:s')
        ]);
        $this->logHistorial($id, 'publicada');
        return redirect()->back()->with('alert', 'success')->with('message', 'Noticia publicada exitosamente.');
    }

    public function correction($id)
    {
        $this->noticiasModel->update($id, ['estado' => 'para_correccion']);
        $this->logHistorial($id, 'enviada para corrección');
        return redirect()->back()->with('alert', 'success')->with('message', 'Noticia mandada a corrección.');
    }

    public function new()
    {
        helper('form');
        return view('noticias/crear');
    }

    public function create()
{
    helper(['form']);
    $id_editor = session()->get('id');

    $validationRules = [
        'titulo' => [
            'label' => 'Título',
            'rules' => 'required',
            'errors' => [
                'required' => 'El campo "{field}" es obligatorio.'
            ]
        ],
        'descripcion' => [
            'label' => 'Descripción',
            'rules' => 'required',
            'errors' => [
                'required' => 'El campo "{field}" es obligatorio.'
            ]
        ],
        'categoria' => [
            'label' => 'Categoría',
            'rules' => 'required|in_list[politicas,deportivas,economicas,culturales,sociales]',
            'errors' => [
                'required' => 'Debe seleccionar una categoría.',
                'in_list' => 'La categoría seleccionada no es válida.'
            ]
        ]
    ];

    if ($this->request->getFileMultiple('archivo')) {
        $validationRules['archivo'] = [
            'label' => 'Archivo',
            'rules' => 'max_size[archivo,10240]',
            'errors' => [
                'max_size' => 'El tamaño máximo permitido es 10MB.'
            ]
        ];
    }

    $validation = $this->validate($validationRules);

    if (!$validation) {
        return view('noticias/crear');
    }

    $titulo = $this->request->getPost('titulo');
    $descripcion = $this->request->getPost('descripcion');
    $categoria = $this->request->getPost('categoria');

    $archivos = $this->request->getFileMultiple('archivo');
    $archivosNombres = [];

    foreach ($archivos as $archivo) {
        if ($archivo->isValid()) {
            $nombreArchivo = $archivo->getName();
            $archivo->move(ROOTPATH . 'public/uploads', $nombreArchivo);
            $archivosNombres[] = $nombreArchivo;
        }
    }

    $fecha_creacion = date('Y-m-d H:i:s');
    $estado = ($this->request->getPost('accion') == 'crear_validar') ? 'lista_para_validar' : 'borrador';

    $datosNoticia = [
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'categoria' => $categoria,
        'imagenes' => implode(',', $archivosNombres),
        'id_editor' => $id_editor,
        'fecha_creacion' => $fecha_creacion,
        'fecha_modificacion' => $fecha_creacion, 
        'estado' => $estado
    ];

    $noticiaModel = new NoticiasModel();
    $noticiaModel->insert($datosNoticia);

    $this->logHistorial($noticiaModel->getInsertID(), 'creada');

    return redirect()->to(base_url('usuarios/view'));
}


    public function edit($id = null)
    {
        helper(['form']);

        if (!session()->has('id')) {
            return redirect()->to(base_url(''))->with('error', 'Debes iniciar sesión para editar noticias.');
        }

        if ($id === null) {
            return redirect()->to(base_url(''))->with('error', 'No se proporcionó un ID de noticia válido.');
        }

        $noticiasModel = new \App\Models\NoticiasModel();
        $noticia = $noticiasModel->find($id);

        if ($noticia === null) {
            return redirect()->to(base_url(''))->with('error', 'No se encontró la noticia especificada.');
        }

        $userId = session('id');
        if ($noticia->id_editor !== $userId) {
            return redirect()->to(base_url(''))->with('error', 'No tienes permiso para editar esta noticia.');
        }

        return view('noticias/edit', ['noticia' => $noticia]);
    }

    public function update($id = null)
    {
        helper(['form']);
        if ($id === null) {
            return redirect()->to(base_url(''))->with('error', 'No se proporcionó un ID de noticia válido.');
        }

        $noticia = $this->noticiasModel->find($id);

        if ($noticia === null) {
            return redirect()->to(base_url(''))->with('error', 'No se encontró la noticia especificada.');
        }

        $userId = session('id');
        if ($noticia->id_editor !== $userId) {
            return redirect()->to(base_url(''))->with('error', 'No tienes permiso para editar esta noticia.');
        }

        $validationRules = [
            'titulo' => [
                'label' => 'Título',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo "{field}" es obligatorio.'
                ]
            ],
            'descripcion' => [
                'label' => 'Descripción',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo "{field}" es obligatorio.'
                ]
            ],
            'categoria' => [
                'label' => 'Categoría',
                'rules' => 'required|in_list[politicas,deportivas,economicas,culturales,sociales]',
                'errors' => [
                    'required' => 'Debe seleccionar una categoría.',
                    'in_list' => 'La categoría seleccionada no es válida.'
                ]
            ]
        ];

        // Validar si se han subido archivos
        if ($this->request->getFileMultiple('archivo')) {
            $validationRules['archivo'] = [
                'label' => 'Archivo',
                'rules' => 'max_size[archivo,10240]',
                'errors' => [
                    'max_size' => 'El tamaño máximo permitido es 10MB.'
                ]
            ];
        }

        $validation = $this->validate($validationRules);

        if (!$validation) {
            return view('noticias/edit', ['noticia' => $noticia]);
        }

        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
        $categoria = $this->request->getPost('categoria');

        $archivos = $this->request->getFileMultiple('archivo');
        $archivosNombres = [];

        foreach ($archivos as $archivo) {
            if ($archivo->isValid()) {
                $nombreArchivo = $archivo->getName();
                $archivo->move(ROOTPATH . 'public/uploads', $nombreArchivo);
                $archivosNombres[] = $nombreArchivo;
            }
        }

        if (!empty($archivosNombres)) {
            if (!empty($noticia->imagenes)) {
                $imagenesAntiguas = explode(',', $noticia->imagenes);
                foreach ($imagenesAntiguas as $imagenAntigua) {
                    $rutaImagenAntigua = ROOTPATH . 'public/uploads/' . $imagenAntigua;
                    if (file_exists($rutaImagenAntigua)) {
                        unlink($rutaImagenAntigua);
                    }
                }
            }
            $imagenesNuevas = implode(',', $archivosNombres);
        } else {
            $imagenesNuevas = $noticia->imagenes;
        }

        $fecha_modificacion = date('Y-m-d H:i:s');
        $estado = ($this->request->getPost('accion') == 'editar_validar') ? 'lista_para_validar' : 'borrador';

        $datosNoticia = [
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'imagenes' => $imagenesNuevas,
            'fecha_modificacion' => $fecha_modificacion,
            'estado' => $estado
        ];

        $this->noticiasModel->update($id, $datosNoticia);


        $this->logHistorial($id, 'actualizada');

        return redirect()->to(base_url('usuarios/view'))->with('fecha_modificacion', $fecha_modificacion);
    }


    protected function logHistorial($id, $accion)
    {
        $noticia = $this->noticiasModel->find($id);
        $this->noticiasHistorialModel->insert([
            'noticia_id' => $noticia->id,
            'titulo' => $noticia->titulo,
            'descripcion' => $noticia->descripcion,
            'estado' => $noticia->estado,
            'categoria' => $noticia->categoria,
            'id_editor' => $noticia->id_editor,
            'id_validador' => $noticia->id_validador,
            'activo' => $noticia->activo,
            'fecha_creacion' => $noticia->fecha_creacion,
            'fecha_modificacion' => $noticia->fecha_modificacion,
            'fecha_publicacion' => $noticia->fecha_publicacion,
            'imagenes' => $noticia->imagenes,
            'accion' => $accion,
            'fecha_modificacion_historial' => date('Y-m-d H:i:s')
        ]);
    }
    
    public function deshacer($id = null)
    {
    if ($id === null) {
        return redirect()->to(base_url('noticias'))->with('error', 'No se proporcionó un ID de noticia válido.');
    }

    $accionAnterior = $this->noticiasHistorialModel->revertLastAction($id);

    if ($accionAnterior === null) {
        return redirect()->to(base_url('noticias'))->with('error', 'No se encontró la acción anterior para la noticia especificada.');
    }

    $datosNoticia = [
        'titulo' => $accionAnterior['titulo'],
        'descripcion' => $accionAnterior['descripcion'],
        'categoria' => $accionAnterior['categoria'],
        'imagenes' => $accionAnterior['imagenes'],
        'fecha_modificacion' => $accionAnterior['fecha_modificacion'],
        'estado' => $accionAnterior['estado']
    ];

    $this->noticiasModel->update($id, $datosNoticia);

   
    $this->logHistorial($id, 'deshacer');

    return redirect()->to(base_url('usuarios/view'))->with('success', 'La última acción ha sido revertida exitosamente.');
}

public function views()
{
    $model = new NoticiasHistorialModel();


    $historial = $model->orderBy('noticia_id', 'asc')
                       ->orderBy('fecha_modificacion_historial', 'asc')
                       ->findAll();

    $agrupadoPorNoticia = [];
    foreach ($historial as $registro) {
        $agrupadoPorNoticia[$registro['noticia_id']][] = $registro;
    }

    return view('noticias/historial', ['historialAgrupado' => $agrupadoPorNoticia]);
}
    

}