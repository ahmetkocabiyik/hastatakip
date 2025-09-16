<?php

namespace Database\Seeders;

use App\Enums\PatientGender;
use App\Enums\PatientSource;
use App\Models\City;
use App\Models\Country;
use App\Models\Diagnosis;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Sgk;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Mustafa Göztok Klinik',
            'email' => 'bilgi@mustafagoztok.com',
            'password' => bcrypt("mustafa1881"),
        ]);

        Sgk::insert([
            ["name" => "ÜCRETLİ"],
            ["name" => "ALLİANZ"],
            ["name" => "ANADOLU SİGORTA"],
            ["name" => "İŞ BANKASI"],
            ["name" => "ACIBADEM SİGORTA"],
            ["name" => "YABANCI SİGORTA"],
            ["name" => "AXA"],
            ["name" => "MAPFRE"],
            ["name" => "AK SİGORTA"],
            ["name" => "TÜRKİYE SİGORTA"],
            ["name" => "ANKARA SİGORTA"],
            ["name" => "VAKIFBANK"],
            ["name" => "HALKBANKASI"],

        ]);

        Country::insert([
            ["name" => "TÜRKİYE"],
            ["name" => "ALMANYA"],
            ["name" => "AMERİKA"],
            ["name" => "AVUSTURYA"],
            ["name" => "AZERBAYCAN"],
            ["name" => "HOLLANDA"],
            ["name" => "İNGİLTERE"],
            ["name" => "IRAK"],
            ["name" => "PORTEKİZ"],
            ["name" => "KIRGIZİSTAN"],
            ["name" => "KIBRIS"],
        ]);

        City::insert([

                ["name" => "İZMİR"],
                ["name" => "AFYON"],
                ["name" => "ANKARA"],
                ["name" => "ANTALYA"],
                ["name" => "AYDIN"],
                ["name" => "BALIKESİR"],
                ["name" => "BURSA"],
                ["name" => "ÇANAKKALE"],
                ["name" => "DENİZLİ"],
                ["name" => "EDİRNE"],
                ["name" => "ISPARTA"],
                ["name" => "İSTANBUL"],
                ["name" => "KAYSERİ"],
                ["name" => "KOCAELİ"],
                ["name" => "KONYA"],
                ["name" => "KÜTAHYA"],
                ["name" => "MALATYA"],
                ["name" => "MANİSA"],
                ["name" => "MUĞLA"],
                ["name" => "ŞIRNAK"],
                ["name" => "TOKAT"],
                ["name" => "UŞAK"],
            ["name" => "YOZGAT"]

        ]);

        Hospital::create(["name" => "İzmir Özel Medicana"]);
        Hospital::create(["name" => "Özel Tınaztepe Galen"]);


        $dg1 = Diagnosis::create(["name" => "PERİANAL APSE", "icd" => "K61.0"]);
        $dg2 = Diagnosis::create(["name" => "PERİANAL FİSTÜL", "icd" => "K60.3"]);
        $dg3 = Diagnosis::create(["name" => "ANAL FİSSÜR", "icd" => "K60.0"]);
        $dg4 = Diagnosis::create(["name" => "HİDRADENİTİS SUPPURATİVA", "icd" => "L73.2"]);
        $dg6 = Diagnosis::create(["name" => "GENİTAL SİĞİL", "icd" => "B07"]);
        $dg7 = Diagnosis::create(["name" => "HEMOROİD", "icd" => "I84"]);
        $dg8 = Diagnosis::create(["name" => "REKTAL PROLAPSUS", "icd" => "K62.3"]);
        $dg9 = Diagnosis::create(["name" => "TROMBOZE HEMOROİD", "icd" => "I87"]);
        $dg10 = Diagnosis::create(["name" => "ANAL PİLİ", "icd" => "K62"]);
        $dg11 = Diagnosis::create(["name" => "İNGUİNAL HERNİ", "icd" => "K40"]);
        $dg12 = Diagnosis::create(["name" => "PİLONİDAL SİNÜS", "icd" => "L05"]);
        $dg13 = Diagnosis::create(["name" => "KUYRUK SOKUMUNDA AĞRI", "icd" => "M54.18"]);
        $dg14 = Diagnosis::create(["name" => "KOLESİSTİT", "icd" => "K80"]);
        $dg15 = Diagnosis::create(["name" => "SİGMOİD KOLON CA", "icd" => "C18.7"]);
        $dg16 = Diagnosis::create(["name" => "ASİT BİRİKİMİ", "icd" => "R10.4"]);
        $dg17 = Diagnosis::create(["name" => "BARTHOLİN KİST", "icd" => "N75.0"]);



        Transaction::insert([
            ["name" => "MUAYENE"],
            ["name" => "AMELİYAT"],
            ["name" => "PERİANAL APSE DRENAJI"],
            ["name" => "PERİANAL FİSTÜL SETON UYGULAMA"],
            ["name" => "PERİANAL FİSTÜL LAZER UYGULAMA"],
            ["name" => "ANAL BOTOX"],
            ["name" => "LATERAL İNTERNAL SFİNKTEROTOMİ"],
            ["name" => "HİDRADENİTİS SUPPURATİVA LAZER UYGULAMA"],
            ["name" => "HİDRADENİTİS SUPPURATİVA APSE DRENAJI"],
            ["name" => "GENİTAL SİĞİL KOTERİZASYONU"],
            ["name" => "HEMOROİDEKTOMİ"],
            ["name" => "HEMOROİDEKTOMİ LAZER UYGULAMA"],
            ["name" => "HEMOROİDEKTOMİ BAND LİGASYON"],
            ["name" => "HEMOROİDEKTOMİ ARTER LİGASYON"],
            ["name" => "REKTAL PROLAPSUS ONARIMI"],
            ["name" => "REKTOPEKSİ"],
            ["name" => "TROMBEKTOMİ"],
            ["name" => "ANAL PİLİ EKSİZYONU"],
            ["name" => "İNGUİNAL HERNİ ONARIMI"],
            ["name" => "LAPAROSKOPİK İNGUİNAL HERNİ ONARIMI"],
            ["name" => "BİLATERAL LAPAROSKOPİK İNGUİNAL HERNİ ONARIMI"],
            ["name" => "PİLONİDAL SİNÜS EKSİZYONU"],
            ["name" => "PİLONİDAL SİNÜS LAZER UYGULAMA"],
            ["name" => "PİLONİDAL SİNÜS APSE DRENAJI"],
            ["name" => "PUDENDAL SİNİR BLOKAJI"],
            ["name" => "LAPAROSKOPİK KOLESİSTEKTOMİ"],
            ["name" => "SİGMOİD KOLON REZEKSİYONU"],
            ["name" => "ASİT DRENAJI"],
            ["name" => "BARTHOLİN KİST EKSİZYONU"]
        ]);



        $path = public_path("data.json");
        $json = json_decode(file_get_contents($path));

        foreach ($json as $prop) {
            print_r($prop->name."-");
            $city = City::where("name",'like', trim($prop->city))->first();
            print_r($prop->sgk."-");
            if($city) {
                $country = Country::where("name", "TÜRKİYE")->first();
            }
            else {
                $country = Country::where("name",trim($prop->city))->first();
            }
            $source = PatientSource::Unknown;
            if($prop->channel === "TELEFON")
                $source = PatientSource::Phone;
            if($prop->channel === "REKLAM")
                $source = PatientSource::GoogleAds;
            if($prop->channel === "HASTA ÖNERİSİ")
                $source = PatientSource::RecommendPatient;
            if($prop->channel === "İNSTAGRAM")
                $source = PatientSource::Instagram;

            $patient = Patient::create([
                "number" => $prop->number,
                "name" => mb_convert_case($prop->name, MB_CASE_TITLE_SIMPLE, "UTF-8"),
                "id_no" => $prop->id_no,
                "city_id" => $city ? $city->id : null,
                "country_id" => $country->id,
                "phone" => $prop->phone,
                "gender" => $prop->gender == "ERKEK" ? PatientGender::Man : PatientGender::Woman,
                "registration_date" => Carbon::createFromFormat("d.m.Y", $prop->registration_date),
                "birth_date" => $prop->birth_date ? Carbon::createFromFormat("d.m.Y", $prop->birth_date) : null,
                "sgk_id" => Sgk::where('name','like', '%' . trim($prop->sgk) . '%')->first()->id,
                "source" => $source,
            ]);

            if(str_contains($prop->diagnosis,"-")) {
                $diagnoses = explode("-", $prop->diagnosis);
                $icds = explode("-", $prop->icd);
                $i = 0;
                foreach ($diagnoses as $item) {
                    $diagnosis = Diagnosis::where("name","like","%".trim($item)."%")->firstOrCreate(
                        ['icd' =>  $icds[$i]],
                        ['name' => $item]
                    );
                    $patient->diagnoses()->attach($diagnosis);
                    $i++;
                }
            }
            else {
                $diagnosis = Diagnosis::where("name","like","%".trim($prop->diagnosis)."%")->firstOrCreate(
                    ['icd' =>  $prop->icd],
                    ['name' => $prop->diagnosis]
                );
                $patient->diagnoses()->attach($diagnosis);
            }

            if(str_contains($prop->transaction,"-")) {
                foreach (explode("-", $prop->transaction) as $item) {
                    $transaction = Transaction::where("name","like","%".trim($item)."%")->first();
                    $patient->transactions()->attach($transaction);
                }
            }
            else {
                $transaction = Transaction::where("name","like","%".trim($prop->transaction)."%")->first();
                $patient->transactions()->attach($transaction);
            }


            //$patient->transactions();
            //$patient->transactions()->attach();
        }

    }
}
