<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            "Electrónica",
            "Ropa y Accesorios",
            "Hogar y Jardín",
            "Alimentos y Bebidas",
            "Salud y Belleza",
            "Deportes y Aire Libre",
            "Juguetes y Juegos",
            "Libros y Revistas",
            "Música",
            "Películas y TV",
            "Videojuegos",
            "Automotriz",
            "Herramientas y Mejoras para el Hogar",
            "Suministros para Mascotas",
            "Arte y Artesanía",
            "Bebés y Niños",
            "Computación",
            "Teléfonos y Comunicaciones",
            "Oficina y Papelería",
            "Viajes",
            "Servicios",
            "Educación",
            "Inmobiliaria",
            "Finanzas",
            "Mascotas",
            "Jardinería",
            "Decoración",
            "Muebles",
            "Iluminación",
            "Cocina",
            "Electrodomésticos",
            "Limpieza",
            "Bricolaje",
            "Mantenimiento",
            "Seguridad",
            "Moda",
            "Joyería",
            "Calzado",
            "Maquillaje",
            "Cuidado Personal",
            "Perfumes",
            "Nutrición",
            "Fitness",
            "Camping",
            "Senderismo",
            "Pesca",
            "Ciclismo",
            "Correr",
            "Natación",
            "Yoga",
            "Pilates",
            "Gimnasio",
            "Fútbol",
            "Baloncesto",
            "Tenis",
            "Golf",
            "Manga",
            "Cómics",
            "Novelas",
            "Biografías",
            "Historia",
            "Ciencia",
            "Cocina Internacional",
            "Vinos y Licores",
            "Café y Té",
            "Panadería",
            "Vegetales",
            "Frutas",
            "Carnes",
            "Pescados y Mariscos",
            "Lácteos",
            "Dulces y Postres",
            "Cámaras y Óptica",
            "Audio y Video",
            "Redes",
            "Software",
            "Hardware",
            "Gadgets",
            "Software Empresarial",
            "Consultoría",
            "Eventos",
            "Fotografía",
            "Diseño Gráfico",
            "Desarrollo Web",
            "Marketing Digital",
            "Hostelería",
            "Restaurantes",
            "Transporte",
            "Logística",
            "Energía",
            "Medio Ambiente",
            "Reciclaje",
            "Agricultura",
            "Ganadería",
            "Minería",
            "Manufactura",
            "Construcción",
            "Ingeniería",
            "Medicina",
            "Derecho"
        ];

        foreach ($categorias as $key => $value) {
            Categoria::create(['nombre' => $value]);
        }
    }
}
