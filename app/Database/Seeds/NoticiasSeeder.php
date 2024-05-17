<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticiasSeeder extends Seeder
{
    public function run()
    {
        $baseURL = rtrim(config('app.baseURL'), '/');
        $data = [
            [
                'titulo' => 'UNICEF advierte sobre el impacto devastador de la crisis climática en la infancia: Acción urgente es necesaria',
                'descripcion' => 'UNICEF alerta sobre las consecuencias alarmantes del cambio climático en los niños de todo el mundo. La organización enfatiza la creciente vulnerabilidad de los menores ante fenómenos climáticos extremos, escasez de alimentos y agua potable, así como el aumento de enfermedades relacionadas con el clima. La falta de acción inmediata podría llevar a millones de niños a la pobreza extrema, malnutrición y desplazamiento forzado. UNICEF hace un llamado a la comunidad internacional para tomar medidas urgentes y significativas en la lucha contra el cambio climático, asegurando un futuro sostenible y seguro para las generaciones venideras.',
                'estado' => 'publicada',
                'categoria' => 'politicas',
                'id_editor' => 1, 
                'id_validador' => 1, 
                'activo' => false,
                'fecha_creacion' => '2024-05-14 14:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => '2024-05-14 21:12:10',
                'imagenes' => $baseURL . '/unicef.jpg,' . $baseURL . '/UNICEF2.jpg', 
            ],
            [
                'titulo' => 'Expertos advierten sobre la rápida pérdida de biodiversidad en los ecosistemas marinos.',
                'descripcion' => 'Científicos destacan la urgencia de proteger los océanos frente a la creciente amenaza de la pérdida de especies marinas debido a la contaminación y el cambio climático. Advierten que sin acciones drásticas, podríamos enfrentar la extinción masiva de vida marina en las próximas décadas.',
                'estado' => 'borrador',
                'categoria' => 'politicas',
                'id_editor' => 4, 
                'id_validador' => null, 
                'activo' => false,
                'fecha_creacion' => '2024-05-10 10:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => null,
                'imagenes' => $baseURL . '/bio.jpg,' . $baseURL . '/bio2.jpg',  
            ],
            [
                'titulo' => ' Informe alarmante: aumento dramático de enfermedades respiratorias debido a la contaminación del aire.',
                'descripcion' => 'Un nuevo informe revela un aumento dramático en las enfermedades respiratorias en todo el mundo, atribuido principalmente a la contaminación del aire. Se necesitan medidas urgentes para abordar esta crisis de salud pública y proteger a las poblaciones más vulnerables.',
                'estado' => 'lista_para_validar',
                'categoria' => 'culturales',
                'id_editor' => 4, 
                'id_validador' => null, 
                'activo' => false,
                'fecha_creacion' => '2024-05-12 21:02:14',
                'fecha_modificacion' => null,
                'fecha_publicacion' => null,
                'imagenes' => $baseURL . '/enfermedad.jpeg', 
            ],
            [
                'titulo' => 'Desplazamiento masivo en Asia: comunidades enteras obligadas a abandonar sus hogares por inundaciones.',
                'descripcion' => 'Las inundaciones repentinas y devastadoras en varias regiones de Asia han provocado un desplazamiento masivo de comunidades enteras, dejando a miles de personas sin hogar y en situación de extrema vulnerabilidad. Se necesitan acciones inmediatas para brindar ayuda humanitaria y mitigar los impactos a largo plazo.',
                'estado' => 'descartado',
                'categoria' => 'culturales',
                'id_editor' => 7, 
                'id_validador' => 1, 
                'activo' => false,
                'fecha_creacion' => '2024-04-26 14:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => null,
                'imagenes' => null, 
            ],
            [
                'titulo' => 'Crisis climática en América Latina: agricultores enfrentan pérdidas catastróficas de cultivos',
                'descripcion' => 'La crisis climática en América Latina ha llevado a una serie de eventos climáticos extremos, causando pérdidas catastróficas de cultivos y afectando gravemente la seguridad alimentaria de la región. Se requieren medidas urgentes para apoyar a los agricultores y garantizar la sostenibilidad de la producción de alimentos.',
                'estado' => 'publicada',
                'categoria' => 'sociales',
                'id_editor' => 2, 
                'id_validador' => 5, 
                'activo' => false,
                'fecha_creacion' => '2024-05-14 20:12:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => '2024-05-15 11:12:10',
                'imagenes' => $baseURL . '/inundaciones.jpg', 
            ],
            [
                'titulo' => 'Alerta en Oceanía: aumento del nivel del mar amenaza la existencia de islas vulnerables',
                'descripcion' => 'El aumento del nivel del mar en la región de Oceanía está poniendo en peligro la existencia de varias islas vulnerables, obligando a sus habitantes a enfrentar la posibilidad de desplazamiento forzado. Se necesita una respuesta global para abordar esta crisis climática inminente.',
                'estado' => 'borrador',
                'categoria' => 'politicas',
                'id_editor' => 2, 
                'id_validador' => null, 
                'activo' => false,
                'fecha_creacion' => '2024-05-14 14:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => null,
                'imagenes' => null, 
            ],
            [
                'titulo' => 'Copa America 2024',
                'descripcion' => 'La Copa América 2024 será la 48.ª edición de este torneo, la principal competencia futbolística entre las selecciones nacionales de América del Sur y la más antigua del mundo, será coorganizada por la Confederación Sudamericana de Fútbol (Conmebol) y la Confederación de Norteamérica, Centroamérica y el Caribe de Fútbol (Concacaf).2​ Por segunda vez el torneo se realizará en Estados Unidos desde la última vez en la edición centenario de 2016, será disputada del 20 de junio al 14 de julio de 2024.',
                'estado' => 'lista_para_validar',
                'categoria' => 'deportivas',
                'id_editor' => 5, 
                'id_validador' => null, 
                'activo' => false,
                'fecha_creacion' => '2024-05-13 23:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => null,
                'imagenes' => $baseURL . '/copaAmerica.jpg', 
            ],
            [
                'titulo' => 'Lionel Messi lidera al equipo nacional en una victoria histórica en la Copa del Mundo',
                'descripcion' => 'Lionel Messi, el legendario delantero argentino, llevó a su equipo nacional a una victoria histórica en la final de la Copa del Mundo, demostrando una vez más su genio en el campo de juego. Con un desempeño estelar, Messi anotó un hat-trick impresionante que aseguró la victoria de Argentina sobre su oponente en un emocionante partido que será recordado durante años. La victoria de Argentina marca un hito en la carrera de Messi y consagra su lugar en la historia del fútbol como uno de los mejores jugadores de todos los tiempos.',
                'estado' => 'finalizada',
                'categoria' => 'deportivas',
                'id_editor' => 5, 
                'id_validador' => 5, 
                'activo' => false,
                'fecha_creacion' => '2024-04-14 14:32:54',
                'fecha_modificacion' => null,
                'fecha_publicacion' => '2024-04-16 21:12:10',
                'imagenes' => $baseURL . '/messi.jpg', 
            ],

            
        ];

        $this->db->table('noticias')->insertBatch($data);
    }
}
