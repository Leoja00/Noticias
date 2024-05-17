<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\NoticiasModel;
use App\Models\NoticiasHistorialModel;

class Usuarios extends BaseController
{

    public function __construct(){
        $this->UsuariosModel= new UsuariosModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return view('plantilla');
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        helper('form');
        return view('registro/registro');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        helper(['form']);
        $validation = $this->validate([
            'usuario' => [
                'label' => 'usuario',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo "{field}" es obligatorio.',
                    
                ],
            ],
            
            'correo' => [
                'label' => 'correo',
                'rules' => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_email' => 'El campo "{field}" no es correcto.',
                    'is_unique' => 'Correo ya existente']
                ],        
            'contrasena' => [
                'label' => 'contrasena',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'El campo "{field}" es obligatorio.',
                    'min_length'=>'El campo {field} no puede tener menos de 8 caracteres.'],
            ],
            'confirmar_contrasena' => [
                'label' => 'confirmar_contrasena',
                'rules' => 'required|matches[contrasena]',
                'errors' => [
                    'required'=>'El campo "confirmar contraseña" es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'],
                ],
                'rol' => [
                    'label' => 'rol',
                    'rules' => 'required|in_list[editor,validador,editor_validador]',
                    'errors' => [
                        'required' => 'Debe seleccionar un rol.',
                        'in_list' => 'El valor seleccionado para el campo {field} no es válido.',
                    ],
                ],
            
        ]);

        // Si hay errores
        if (!$validation) {
            return view('registro/registro');
        }

        // Si no hay errores
        $usuario = $this->request->getPost('usuario');
        $correo = $this->request->getPost('correo');
        $contrasena = $this->request->getPost('contrasena');
        $rol = $this->request->getPost('rol');

        // Hashear la contraseña
        $contrasenaHasheada = password_hash($contrasena, PASSWORD_DEFAULT);

        $usuarioModel = new UsuariosModel();

        $datosUsuario = [
            'usuario' => trim($usuario),
            'email' => $correo,
            'contrasena' => $contrasenaHasheada, // Utilizar la contraseña hasheada
            'rol' => $rol
        ];


        // Agregar datos a la BD
        $usuarioModel->insert($datosUsuario);

        $this->session->setFlashdata('mensaje','Registrado correctamente');

        // Iniciar sesión
        $session = session();
        $session->set('usuario', $usuario);
        $session->set('correo', $correo);
        $session->set('rol', $rol);


    return view('cuerpo/index', ['usuario' => $usuario]);   

    }

    public function view()
    {
        $rol = $this->session->get('rol');

        if ($rol !== 'editor' && $rol !== 'editor_validador') {
            return redirect()->to(base_url());
        }

        $id_editor = $this->session->get('id');

        $noticiasModel = new NoticiasModel();
        $data['noticias'] = $noticiasModel->where('id_editor', $id_editor)->findAll();
        $data['rol'] = $rol; 
        return view('noticias/view', $data);
    }

    public function finish()
    {
        $rol = $this->session->get('rol');

        if ($rol !== 'validador' && $rol !== 'editor_validador') {
            return redirect()->to(base_url());
        }

        $noticiasModel = new NoticiasModel();
        $data['noticias'] = $noticiasModel->where('estado', 'finalizada')->findAll();
        $data['rol'] = $rol; 
        return view('noticias/finish', $data);
    }

    public function publicated()
{
    $rol = $this->session->get('rol');

    if ($rol !== 'validador') {
        return redirect()->to(base_url());
    }

    $noticiasModel = new NoticiasModel();
    $historialModel = new NoticiasHistorialModel();
    $noticiasPublicadas = $noticiasModel->where('estado', 'publicada')->findAll();

    $noticiasParaValidar = $historialModel->where('estado', 'para_validar')->findAll();
    $noticiasValidar = [];

    foreach ($noticiasParaValidar as $noticia) {
        $fechaModificacionHistorial = new \DateTime($noticia['fecha_modificacion_historial']);
        $fechaActual = new \DateTime();
        $intervalo = $fechaModificacionHistorial->diff($fechaActual);

        if ($intervalo->days > 5) {
            $noticia['puede_descartar'] = true;
        } else {
            $noticia['puede_descartar'] = false;
        }
        $noticiasValidar[] = $noticia;
    }

    $data['noticias'] = array_merge($noticiasPublicadas, $noticiasValidar);
    $data['rol'] = $rol; 
    return view('noticias/publicated', $data);
}




    public function validation() {
        if ($this->session->get('rol') !== 'validador' && $this->session->get('rol') !== 'editor_validador') {
            return redirect()->to(base_url());
        }
    
        $noticiasModel = new NoticiasModel();
        $noticiasHistorialModel = new NoticiasHistorialModel();
    
        $noticias = $noticiasModel->where('estado', 'lista_para_validar')->findAll();
    
        if (!empty($noticias)) {
            foreach ($noticias as $noticia) {
                // Check if the news has been in 'para_correccion' in the history
                $previoParaCorreccion = $noticiasHistorialModel->where('noticia_id', $noticia->id)
                                                               ->where('estado', 'para_correccion')
                                                               ->first();
                $correccion = $noticiasHistorialModel->where('noticia_id', $noticia->id)
                                                     ->where('estado', 'para_correccion')
                                                     ->first();
    
                $noticia->puede_publicar = ($correccion !== null || $noticia->estado !== 'para_correccion');
                $noticia->puede_descartar = ($previoParaCorreccion === null); // Can discard if never in 'para_correccion'
                $noticia->puede_corregir = true;
            }
        }
    
        $data['noticias'] = $noticias;
    
        return view('noticias/validar', $data);
    }
    




    public function news()
    {
        
     helper(['form']);
     $session  = session();

    if (!$session->has('usuario')) {
        return view('cuerpo/index');

    }else{
    return view('noticias/crear');}
    }


    public function perfil()
    {
        $session = session();

        if (!$session->has('usuario')) {

            return redirect()->to(base_url('login'));
        }

        $usuario = [
            'usuario' => $session->get('usuario'),
            'correo' => $session->get('correo'),
            'rol' => $session->get('rol')
        ];

        return view('cuerpo/perfil', $usuario);
    }


    public function log()
    {
        helper('form');
        return view('login/login');
        

    }
    public function login()
    {
        helper('form');
        $session = session();
        $email = $this->request->getPost('correo');
        $contrasena = $this->request->getPost('password');

        // VALIDAR
        $userModel = new UsuariosModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($contrasena, $user->contrasena)) {
            // Iniciar sesión
            $session->set([
                'id' => $user->id,
                'usuario' => $user->usuario, 
                'correo' => $user->email,
                'rol' => $user->rol,
                'id_editor' => $user->id // Establecer el id_editor en la sesión
            ]);
        
            return view('cuerpo/index');
        } else {
            $session->setFlashdata('error', 'Correo o contraseña incorrecto');
            return view('login/login');
        }
    }

    

    public function logout()
    {
        $session = session();
        $session->destroy(); 
        return redirect()->to(base_url('')); 
    }
    
    

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
