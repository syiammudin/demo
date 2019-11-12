<?php

use Illuminate\Database\Seeder;
use App\User ;
use App\MasterRequest ;
use App\App ;
use App\Hangar ;
use App\ForRating ;
use App\Questionnaire ;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'id_number' => 'admin',
            'role' => 1
        ]);

        $masterRequest = array(
            [
                'title' => 'Aircraft Capability Request',
                'description' => 'This is a description about title' ,
                'picture' => 'pesawat.jpeg',
                'link' => 'form_aircraft'
            ],
            [
                'title' => 'Component Capability Request',
                'description' => 'This is a description about title' ,
                'picture' => 'InShot_20180303_104120991.jpg',
                'link' => 'form_component'
            ],
            [
                'title' => 'Aircraft Capability Request',
                'description' => 'This is a description about title' ,
                'picture' => 'InShot_20180303_104120991.jpg',
                'link' => 'form_special'
            ],
            [
                'title' => 'Aircraft Capability Request',
                'description' => 'This is a description about title' ,
                'picture' => 'InShot_20180303_104120991.jpg',
                'link' => 'form_special'
            ]
        );
        MasterRequest::insert($masterRequest);

        App::create([
            'app_name' => 'GMF AEROASIA',
            'logo' => 'gmf.png' ,
            'background' => '1556090098.jpg',
            'street' => 'Soekarno Hatta International Airport ',
            'city' => 'Cengkareng',
            'country' => 'Indonesia',
            'po_box' => '1303',
            'zip_code' => '19100',
            'fax' => '+62 21 550 8609 ',
            'phone' => '+62 21 550 2489',
            'email' => 'marketing@gmf-aeroasia.co.id'
        ]);

        $for_rating = array(
            [
                'name_of_rating'=> 'DGCA RATING',
                'desciption'=> 'Radio, Instrument, Accessories, Emergency Equipment, Landing Gear Components'
            ],
            [
                'name_of_rating'=> 'FAA RATING',
                'desciption'=> 'Radio, Instrument, Accessories, Emergency Equipment, Landing Gear Components'
            ],
            [
                'name_of_rating' => 'EASA RATING',
                'desciption' => 'C1 - Air Conditioning & Pressurization, C2 - Auto Flight,C3 - Communication and Navigation,C4 - Doors & Hatches,C5 - Electrical Power & Lights,C6 - Emergency Equipment,C7 - Engine & APU,C8 - Flight Control,C9 - Fuel,C12 - Hydraulic Power,C13 - Indicating / Recording System,C14 - Landing Gear,Wheel & Brake,C15 - Oxygen,C17 - Pneumatic & Vacuum,C18 - Protection Ice/Rain/Fire,C19 - Windows'
            ],
            [
                'name_of_rating' => 'CAAM RATING',
                'desciption' => 'C1 - Air Conditioning & Pressurization,C4 - Doors & Hatches,C5 - Electrical Power & Lights,C6 - Emergency Equipment,C7 - Engine & APU,C8 - Flight Control,C14 - Landing Gear,C15 - Oxygen,C17 - Pneumatic & Vacuum, C18 - Protection Ice/Rain/Fire'
            ],
            [
                'name_of_rating' => 'CAAC RATING',
                'desciption' => 'ATA 22,ATA 23,ATA 24,ATA 25,ATA 26,ATA 31,ATA 32,ATA 33,ATA 34,ATA 35,ATA 36,ATA 45'
            ]

        );
        ForRating::insert($for_rating) ;

        $hangar= array(['hangar_name' => 'Hangar 1'],
        ['hangar_name' => 'Hangar 2'],
        ['hangar_name' => 'Hangar 3'],
        ['hangar_name' => 'Hangar 4']);
        Hangar::insert($hangar);

        $questionnaires = array(
            ['master_request_id' => 1, 'questionare' => "[]"],
            ['master_request_id' => 2, 'questionare' => "[]"],
            ['master_request_id' => 3, 'questionare' => "[]"],
            ['master_request_id' => 4, 'questionare' => "[]"],
            ['master_request_id' => 5, 'questionare' => "[]"],
        );
        Questionnaire::insert($questionnaires);

        $issue = array(['issue' => 'A'],['issue' => 'B'],['issue' => 'C'],['issue' => 'D'],['issue' => 'E'],['issue' => 'F'],
                   ['issue' => 'G'],['issue' => 'H'],['issue' => 'I'],['issue' => 'J'],['issue' => 'K'],['issue' => 'L'],
                   ['issue' => 'M'],['issue' => 'N'],['issue' => 'O'],['issue' => 'P'],['issue' => 'Q'],['issue' => 'R'],
                   ['issue' => 'S'],['issue' => 'T'],['issue' => 'U'],['issue' => 'V'],['issue' => 'W'],['issue' => 'X'],
                   ['issue' => 'Y'],['issue' => 'Z'],['issue' => 'AA'],['issue' => 'AB'],['issue' => 'AC'],['issue' => 'AD'],
                   ['issue' => 'AE'],['issue' => 'AF'],['issue' => 'AG'],['issue' => 'AH'],['issue' => 'AI'],['issue' => 'AJ'],
                   ['issue' => 'AK'],['issue' => 'AL'],['issue' => 'AM'],['issue' => 'AN'],['issue' => 'AO'],['issue' => 'AP'],
                   ['issue' => 'AQ'],['issue' => 'AR'],['issue' => 'AS'],['issue' => 'AT'],['issue' => 'AU'],['issue' => 'AV'],
                   ['issue' => 'AW'],['issue' => 'AX'],['issue' => 'AY'],['issue' => 'AZ']
                 );
        \App\Issue::insert($issue) ;
    }
}
