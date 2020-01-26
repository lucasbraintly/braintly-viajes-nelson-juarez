<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('iata_code');
            $table->string('location');
            $table->string('province');
        });

        DB::table('airports')->insert([
            ['province' => 'Buenos Aires', 'location' => 'Bahía Blanca', 'name' => 'Comandante Espora', 'iata_code' => 'BHI'],
            ['province' => 'Buenos Aires', 'location' => 'Ciudad de Buenos Aires', 'name' => 'Jorge Newbery', 'iata_code' => 'AEP'],
            ['province' => 'Buenos Aires', 'location' => 'Ezeiza', 'name' => 'Ministro Pistarini', 'iata_code' => 'EZE'],
            ['province' => 'Buenos Aires', 'location' => 'Junín', 'name' => 'Junin', 'iata_code' => 'JNI'],
            ['province' => 'Buenos Aires', 'location' => 'La Plata', 'name' => 'La Plata', 'iata_code' => 'LPG'],
            ['province' => 'Buenos Aires', 'location' => 'Mar del Plata', 'name' => 'Astor Piazzolla', 'iata_code' => 'MDQ'],
            ['province' => 'Buenos Aires', 'location' => 'Necochea', 'name' => 'Necochea', 'iata_code' => 'NEC'],
            ['province' => 'Buenos Aires', 'location' => 'San Fernando', 'name' => 'San Fernando', 'iata_code' => 'FDO'],
            ['province' => 'Buenos Aires', 'location' => 'Santa Teresita', 'name' => 'Santa Teresita', 'iata_code' => 'STT'],
            ['province' => 'Buenos Aires', 'location' => 'Tandil', 'name' => 'Tandil', 'iata_code' => 'TDL'],
            ['province' => 'Buenos Aires', 'location' => 'Villa Gesell', 'name' => 'Villa Gesell', 'iata_code' => 'VGL'],
            ['province' => 'Catamarca', 'location' => 'Bahía Blanca', 'name' => 'Comandante Espora', 'iata_code' => 'BHI'],
            ['province' => 'Chaco', 'location' => 'Ciudad de Buenos Aires', 'name' => 'Jorge Newbery', 'iata_code' => 'AEP'],
            ['province' => 'Chubut', 'location' => 'Ezeiza', 'name' => 'Ministro Pistarini', 'iata_code' => 'EZE'],
            ['province' => 'Chubut', 'location' => 'Junín', 'name' => 'Junín', 'iata_code' => 'JNI'],
            ['province' => 'Chubut', 'location' => 'La Plata', 'name' => 'La Plata', 'iata_code' => 'LPG'],
            ['province' => 'Chubut', 'location' => 'Mar del Plata', 'name' => 'Astor Piazzolla', 'iata_code' => 'MDQ'],
            ['province' => 'Córdoba', 'location' => 'Necochea', 'name' => 'Necochea', 'iata_code' => 'NEC'],
            ['province' => 'Córdoba', 'location' => 'San Fernando', 'name' => 'San Fernando', 'iata_code' => 'FDO'],
            ['province' => 'Corrientes', 'location' => 'Santa Teresita', 'name' => 'Santa Teresita', 'iata_code' => 'STT'],
            ['province' => 'Corrientes', 'location' => 'Tandil', 'name' => 'Tandil', 'iata_code' => 'TDL'],
            ['province' => 'Corrientes', 'location' => 'Villa Gesell', 'name' => 'Villa Gesell', 'iata_code' => 'VGL'],
            ['province' => 'Entre Ríos', 'location' => 'Catamarca', 'name' => 'Cnel. Felipe Varela', 'iata_code' => 'CTC'],
            ['province' => 'Entre Ríos', 'location' => 'Resistencia', 'name' => 'Jose de San Martín', 'iata_code' => 'RES'],
            ['province' => 'Formosa', 'location' => 'Comodoro Rivadavia', 'name' => 'Intern.Gral. E. Mosconi', 'iata_code' => 'CRD'],
            ['province' => 'Jujuy', 'location' => 'Esquel', 'name' => 'Brig. Gral. Antonio Parodi', 'iata_code' => 'EQS'],
            ['province' => 'La Pampa', 'location' => 'Puerto Madryn', 'name' => 'El Tehuelche', 'iata_code' => 'PMY'],
            ['province' => 'La Pampa', 'location' => 'Trelew', 'name' => 'Alte. Marcos A. Zar', 'iata_code' => 'REL'],
            ['province' => 'La Rioja', 'location' => 'Córdoba', 'name' => 'A.Taravella/Pajas Blancas', 'iata_code' => 'COR'],
            ['province' => 'Mendoza', 'location' => 'Río Cuarto', 'name' => 'Area Material Río Cuarto', 'iata_code' => 'RCU'],
            ['province' => 'Mendoza', 'location' => 'Corrientes', 'name' => 'Dr. Piragine Niveyro', 'iata_code' => 'CNQ'],
            ['province' => 'Mendoza', 'location' => 'Goya', 'name' => 'Diego N. Díaz Colodrero', 'iata_code' => 'OYA'],
            ['province' => 'Misiones', 'location' => 'Paso de los Libres', 'name' => 'Paso de los Libres', 'iata_code' => 'AOL'],
            ['province' => 'Misiones', 'location' => 'Concordia', 'name' => 'Comodoro Pierrestegui', 'iata_code' => 'COC'],
            ['province' => 'Neuquén', 'location' => 'Paraná', 'name' => 'Gral. Justo J.de Urquiza', 'iata_code' => 'PRA'],
            ['province' => 'Neuquén', 'location' => 'Formosa', 'name' => 'El Pucú', 'iata_code' => 'FMA'],
            ['province' => 'Neuquén', 'location' => 'San Salvador de Jujuy', 'name' => 'Gob. Horacio Guzmán', 'iata_code' => 'JUJ'],
            ['province' => 'Río Negro', 'location' => 'General Pico', 'name' => 'General Pico', 'iata_code' => 'GPO'],
            ['province' => 'Río Negro', 'location' => 'Santa Rosa', 'name' => 'Santa Rosa', 'iata_code' => 'RSA'],
            ['province' => 'Río Negro', 'location' => 'La Rioja', 'name' => 'Cap. Vicente A. Almonacid', 'iata_code' => 'IRJ'],
            ['province' => 'Salta', 'location' => 'Malargue', 'name' => 'Cdro. Ricardo Salomon', 'iata_code' => 'LGS'],
            ['province' => 'Mendoza', 'location' => 'Mendoza', 'name' => 'Gob. Gabrielli/El Plumerillo', 'iata_code' => 'MDZ'],
            ['province' => 'San Juan', 'location' => 'San Rafael', 'name' => 'Santiago Germano', 'iata_code' => 'AFA'],
            ['province' => 'San Luis', 'location' => 'Posadas', 'name' => 'Lib. Gral. J. de San Martín', 'iata_code' => 'PSS'],
            ['province' => 'San Luis', 'location' => 'Puerto Iguazú', 'name' => 'My. Carlos E. Krause', 'iata_code' => 'IGR'],
            ['province' => 'San Luis', 'location' => 'Cutral-Co', 'name' => 'Cutral-Co', 'iata_code' => 'CUT'],
            ['province' => 'Santa Cruz', 'location' => 'Neuquén', 'name' => 'Presidente Perón', 'iata_code' => 'NQN'],
            ['province' => 'Santa Cruz', 'location' => 'San Martín de los Andes', 'name' => 'Aviador .Campos/Chapelco', 'iata_code' => 'CPC'],
            ['province' => 'Santa Cruz', 'location' => 'Bariloche', 'name' => 'Tte. Luis Candelaria', 'iata_code' => 'BRC'],
            ['province' => 'Santa Fe', 'location' => 'General Roca', 'name' => 'Arturo Humberto Illia', 'iata_code' => 'GNR'],
            ['province' => 'Santa Fe', 'location' => 'Viedma', 'name' => 'Gobernador Castello', 'iata_code' => 'VDM'],
            ['province' => 'Santa Fe', 'location' => 'Salta', 'name' => 'Gral. Guemes', 'iata_code' => 'SLA'],
            ['province' => 'Santiago del Estero', 'location' => 'Tartagal', 'name' => 'Gral. E. Mosconi', 'iata_code' => 'TTG'],
            ['province' => 'Santiago del Estero', 'location' => 'San Juan', 'name' => 'Domingo Faustino Sarmiento', 'iata_code' => 'UAQ'],
            ['province' => 'Tierra del Fuego', 'location' => 'Merlo', 'name' => 'Valle del Conlara', 'iata_code' => 'RLO'],
            ['province' => 'Tierra del Fuego', 'location' => 'San Luis', 'name' => 'Brig. May. Cesar Raúl Ojeda', 'iata_code' => 'LUQ'],
            ['province' => 'Tucumán', 'location' => 'Villa Reynolds', 'name' => 'Villa Reynolds', 'iata_code' => 'VME'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
