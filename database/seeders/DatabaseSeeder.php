<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Categorías fijas (se crean solo si no existen)
        $fruta = Category::firstOrCreate(['name' => 'Frutas']);
        $lacteos = Category::firstOrCreate(['name' => 'Lácteos']);
        $verduras = Category::firstOrCreate(['name' => 'Verduras']);
        $carnes = Category::firstOrCreate(['name' => 'Carnes']);
        $panaderia = Category::firstOrCreate(['name' => 'Panadería']);
        $chocolates = Category::firstOrCreate(['name' => 'Azúcar, chocolates y caramelos']);
        $platos = Category::firstOrCreate(['name' => 'Pizzas y platos preparados']);
        $agua = Category::firstOrCreate(['name' => 'Agua, refrescos y zumos']);

        //Productos reales (se actualizan o crean según el nombre)
        $productos = [
            // Frutas
            [
                'name'        => 'Manzana Golden',
                'description' => 'Una variedad dulce y crujiente, con piel fina y color amarillo dorado.
                    Ideal para comer fresca, en ensaladas o para hacer postres como tartas.
                    Su textura firme la hace perfecta para cocinar sin que se deshaga. Peso promedio: 150g',
                'price'       => 0.35,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $fruta->id,
                'image'       => 'products/manzana.jpg',
            ],
            [
                'name'        => 'Plátano de Canarias',
                'description' => 'Más dulce y aromático que los plátanos convencionales, 
                    con distintivas motas negras cuando está en su punto óptimo. 
                    Excelente fuente de potasio natural. Peso promedio: 200g.',
                'price'       => 0.36,
                'sale_price'  => null,
                'times_sold'  => 91,
                'category_id' => $fruta->id,
                'image'       => 'products/platano.jpg',
            ],
            [
                'name'        => 'Naranja Valencia',
                'description' => 'Jugosa y con perfecto balance ácido-dulce, 
                    su piel gruesa la protege durante el transporte. 
                    Contiene hasta 50ml de zumo por pieza. Peso promedio: 250g',
                'price'       => 0.40,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $fruta->id,
                'image'       => 'products/naranja.jpg',
            ],
            [
                'name'        => 'Fresas',
                'description' => 'Cultivadas localmente para garantizar frescura, 
                    su color rojo intenso y aroma característico las hace perfectas para mermeladas o decoración de postres. Bandeja 250g',
                'price'       => 1.00,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $fruta->id,
                'image'       => 'products/fresas.jpg',
            ],
            [
                'name'        => 'Uva blanca sin semillas',
                'description' => 'Dulces como caramelos naturales, 
                    estas uvas son ideales para snacks saludables. 
                    La variedad sin pepitas facilita su consumo.Bolsa 500g',
                'price'       => 2.10,
                'sale_price'  => null,
                'times_sold'  => 80,
                'category_id' => $fruta->id,
                'image'       => 'products/uva.jpg',
            ],
            // Lácteos
            [
                'name'        => 'Leche entera',
                'description' => 'Pasteurizada a 72°C para conservar nutrientes como el calcio y vitamina D, 
                    esenciales para huesos fuertes. Brick 1L',
                'price'       => 0.90,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $lacteos->id,
                'image'       => 'products/leche_entera.jpg',
            ],
            [
                'name'        => 'Yogur natural',
                'description' => 'Fermentado durante 8 horas para lograr textura cremosa. 
                    Contiene cultivos vivos que favorecen la flora intestinal. Vaso 125g',
                'price'       => 0.30,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $lacteos->id,
                'image'       => 'products/yogur_natural.jpg',
            ],
            [
                'name'        => 'Queso Gouda',
                'description' => 'Versión joven (4 meses de curación) con notas lácteas suaves. 
                    Perfecto para sándwiches o tablas de quesos. Loncha 20g',
                'price'       => 0.25,
                'sale_price'  => null,
                'times_sold'  => 59,
                'category_id' => $lacteos->id,
                'image'       => 'products/queso_gouda.jpg',
            ],
            [
                'name'        => 'Mantequilla sin sal',
                'description' => 'Elaborada con nata fresca, su versión sin sal permite controlar el sodio en la cocina. Tableta 250g',
                'price'       => 1.80,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $lacteos->id,
                'image'       => 'products/mantequilla.jpg',
            ],
            [
                'name'        => 'Natillas de vainilla',
                'description' => 'Receta tradicional con vainilla bourbon de Madagascar y huevo fresco. 
                    Textura sedosa al paladar. Vasito 125g',
                'price'       => 0.40,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $lacteos->id,
                'image'       => 'products/natillas.jpg',
            ],

            // Verduras
            [
                'name'        => 'Zanahoria',
                'description' => 'Raíz crujiente con alto contenido en betacaroteno. 
                    Su forma alargada y uniforme facilita el pelado. Unidad aprox. 100g',
                'price'       => 0.15,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $verduras->id,
                'image'       => 'products/zanahoria.jpg',
            ],
            [
                'name'        => 'Brócoli',
                'description' => 'Cultivado en campos abiertos, sus ramilletes compactos y de color verde intenso indican frescura. 
                    Rico en sulforafano. Unidad aprox. 400g',
                'price'       => 0.70,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $verduras->id,
                'image'       => 'products/brocoli.jpg',
            ],
            [
                'name'        => 'Tomate pera',
                'description' => 'Forma alargada que facilita el corte en láminas para ensaladas. 
                    Menos acuoso que el tomate redondo. Unidad aprox. 120g',
                'price'       => 0.30,
                'sale_price'  => null,
                'times_sold'  => 19,
                'category_id' => $verduras->id,
                'image'       => 'products/tomate_pera.jpg',
            ],
            [
                'name'        => 'Cebolla blanca',
                'description' => 'Capas gruesas y jugosas, con compuestos azufrados que se suavizan al cocinarse. 
                    Base fundamental de la cocina mediterránea. Unidad aprox. 150g',
                'price'       => 0.20,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $verduras->id,
                'image'       => 'products/cebolla.jpg',
            ],
            [
                'name'        => 'Lechuga iceberg',
                'description' => 'Hojas superpuestas en forma de bola que protegen el corazón. 
                    Aporta crocancia a ensaladas y tacos. Unidad completa',
                'price'       => 1.00,
                'sale_price'  => null,
                'times_sold'  => 77,
                'category_id' => $verduras->id,
                'image'       => 'products/lechuga.jpg',
            ],

            // Carnes
            [
                'name'        => 'Pechuga de pollo',
                'description' => 'Corte magro sin piel ni hueso. 
                    Su fibra muscular corta la hace tierna cuando se cocina correctamente. Filete 200g',
                'price'       => 1.30,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $carnes->id,
                'image'       => 'products/pechuga_pollo.jpg',
            ],
            [
                'name'        => 'Filete de ternera',
                'description' => 'Corte del lomo alto con vetas de grasa intramuscular que aportan jugosidad al cocinarse. Pieza 200g',
                'price'       => 2.60,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $carnes->id,
                'image'       => 'products/filete_ternera.jpg',
            ],
            [
                'name'        => 'Chuleta de cerdo',
                'description' => 'Con hueso para realzar el sabor. La grasa periférica se derrite durante la cocción. Unidad 150g',
                'price'       => 1.35,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $carnes->id,
                'image'       => 'products/chuleta_cerdo.jpg',
            ],
            [
                'name'        => 'Hamburguesa de pavo',
                'description' => 'Mezcla de carne magra con un 15% de grasa para mantener jugosidad. Sin conservantes. Unidad 125g',
                'price'       => 1.50,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $carnes->id,
                'image'       => 'products/hamburguesa_pavo.jpg',
            ],
            [
                'name'        => 'Salchichas frescas',
                'description' => 'Embutido tradicional con 85% carne de cerdo seleccionada y especias naturales. Pack de 6 unidades',
                'price'       => 3.80,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $carnes->id,
                'image'       => 'products/salchichas.jpg',
            ],

            // Panadería
            [
                'name'        => 'Pan de barra',
                'description' => 'Masa fermentada 24 horas para desarrollar sabores complejos. 
                    Corteza dorada al horno de leña. Barra 250g',
                'price'       => 1.20,
                'sale_price'  => null,
                'times_sold'  => 9,
                'category_id' => $panaderia->id,
                'image'       => 'products/pan_barra.jpg',
            ],
            [
                'name'        => 'Baguette',
                'description' => 'Tradicional receta francesa con hidratación del 70% para alveolos grandes en la miga. Unidad completa',
                'price'       => 1.50,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $panaderia->id,
                'image'       => 'products/baguette.jpg',
            ],
            [
                'name'        => 'Croissant',
                'description' => 'Laminado manual con mantequilla pura (82% MG) que crea 81 capas distintivas. Unidad individual',
                'price'       => 0.45,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $panaderia->id,
                'image'       => 'products/croissant.jpg',
            ],
            [
                'name'        => 'Pan integral',
                'description' => 'Harina molida a piedra que conserva el germen del trigo. 
                    Con semillas de lino y girasol. Pieza 400g',
                'price'       => 2.00,
                'sale_price'  => null,
                'times_sold'  => 33,
                'category_id' => $panaderia->id,
                'image'       => 'products/pan_integral.jpg',
            ],
            [
                'name'        => 'Donut de azúcar',
                'description' => 'Masa esponjosa frita y recubierta con glasé brillante. 
                    Versión clásica sin relleno. Unidad individual',
                'price'       => 0.40,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $panaderia->id,
                'image'       => 'products/donut.jpg',
            ],

            // Chocolates (Azúcar, chocolates y caramelos)
            [
                'name'        => 'Azúcar blanco',
                'description' => 'Cristales uniformes de sacarosa pura, refinado para disolución inmediata. Bolsa 1kg',
                'price'       => 1.10,
                'sale_price'  => null,
                'times_sold'  => 12,
                'category_id' => $chocolates->id,
                'image'       => 'products/azucar.jpg',
            ],
            [
                'name'        => 'Chocolate negro 70%',
                'description' => 'Blend de granos de cacao Arriba y Trinitario. Notas a frutos secos tostados. Tableta 100g',
                'price'       => 2.20,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $chocolates->id,
                'image'       => 'products/chocolate_negro.jpg',
            ],
            [
                'name'        => 'Gominolas',
                'description' => 'Textura masticable lograda con pectina cítrica. 
                    Colores naturales de extractos vegetales. Bolsa 100g',
                'price'       => 1.80,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $chocolates->id,
                'image'       => 'products/gominolas.jpg',
            ],
            [
                'name'        => 'Caramelos de menta',
                'description' => 'Con aceite esencial de menta piperita. Efecto refrescante prolongado. Bolsa 50g',
                'price'       => 1.50,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $chocolates->id,
                'image'       => 'products/caramelos_menta.jpg',
            ],
            [
                'name'        => 'Crema de cacao',
                'description' => 'Elaborada con avellanas Piamonte tostadas. 30% de frutos secos en la receta. Bote 350g',
                'price'       => 3.50,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $chocolates->id,
                'image'       => 'products/crema_cacao.jpg',
            ],

            // Platos (Pizzas y platos preparados)
            [
                'name'        => 'Pizza Margarita',
                'description' => 'Masa madre reposada 48h. Salsa de tomate San Marzano DOP y mozzarella fior di latte. 400g',
                'price'       => 3.50,
                'sale_price'  => null,
                'times_sold'  => 491,
                'category_id' => $platos->id,
                'image'       => 'products/pizza_margarita.jpg',
            ],
            [
                'name'        => 'Lasagna',
                'description' => 'Capas alternas de pasta al huevo casera, ragú de ternera y bechamel con nuez moscada. 500g',
                'price'       => 4.90,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $platos->id,
                'image'       => 'products/lasagna.jpg',
            ],
            [
                'name'        => 'Ensalada César',
                'description' => 'Lechuga romana fresca, croutons artesanales, láminas de parmesano Reggiano y dressing original. 300g',
                'price'       => 3.20,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $platos->id,
                'image'       => 'products/ensalada_cesar.jpg',
            ],
            [
                'name'        => 'Empanadillas',
                'description' => 'Masa hojaldrada rellena de atún claro del Cantábrico con pimiento del piquillo. Pack 6 unidades',
                'price'       => 2.80,
                'sale_price'  => null,
                'times_sold'  => 203,
                'category_id' => $platos->id,
                'image'       => 'products/empanadillas.jpg',
            ],
            [
                'name'        => 'Sushi variado',
                'description' => 'Arroz de grano corto avinagrado con salmón noruego y aguacate Hass. 
                    Incluye wasabi y jengibre. Bandeja 12 piezas',
                'price'       => 8.90,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $platos->id,
                'image'       => 'products/sushi.jpg',
            ],

            // Agua (Agua, refrescos y zumos)
            [
                'name'        => 'Agua mineral',
                'description' => 'Mineralización débil (residuo seco 180mg/l). pH 7.8 ideal para consumo diario. Botella 1.5L',
                'price'       => 0.60,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $agua->id,
                'image'       => 'products/agua.jpg',
            ],
            [
                'name'        => 'Refresco de cola',
                'description' => 'Receta original con extractos naturales de nuez de cola y vainilla. 
                    Versión regular con azúcar. Botella 2L',
                'price'       => 1.80,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $agua->id,
                'image'       => 'products/refresco_cola.jpg',
            ],
            [
                'name'        => 'Zumo de naranja',
                'description' => 'Prensa en frío para conservar vitamina C. Sin concentrados ni aditivos. Brick 1L',
                'price'       => 2.20,
                'sale_price'  => null,
                'times_sold'  => 186,
                'category_id' => $agua->id,
                'image'       => 'products/zumo_naranja.jpg',
            ],
            [
                'name'        => 'Bebida isotónica',
                'description' => 'Formulación con electrolitos (sodio, potasio) y 6% de hidratos de carbono. Botella 500ml',
                'price'       => 1.50,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $agua->id,
                'image'       => 'products/bebida_isotonica.jpg',
            ],
            [
                'name'        => 'Té helado limón',
                'description' => 'Infusión de té Ceilán con zumo de limón natural (12%). Bajo en calorías. Lata 330ml',
                'price'       => 1.40,
                'sale_price'  => null,
                'times_sold'  => 0,
                'category_id' => $agua->id,
                'image'       => 'products/te_helado.jpg',
            ]
        ];

        foreach ($productos as $data) {
            Product::updateOrCreate(
                ['name' => $data['name']],
                array_merge($data, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
