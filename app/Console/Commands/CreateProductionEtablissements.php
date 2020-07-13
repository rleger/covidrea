<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Etablissement;
use App\User;

class CreateProductionEtablissements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate-production-db {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates database using csv file';

    // mapping names to columns indices
    private $COLUMN_MAPPINGS = [
        "CITY" => 0,
        "NAME" => 1,
        "ADDRESS" => 2,
        "LAT" => 3,
        "LON" => 4,
        "MAIL_DIRECTION" => 6,
        "MAIL_DIRECTION_2" => 7,
        "TEL_DIRECTION" => 11,
        "TEL_DIRECTION_2" => 12,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    // pour les regions https://www.regions-et-departements.fr/departements-francais
    function findRegion($geoMapping, $zipCode)
    {
        return array_values(array_filter($geoMapping, function ($item) use ($zipCode) {
            return strpos($zipCode, $item->department) !== false;
        }))[0]->region;
    }

    function parseAddress($addressAsString)
    {
        // remove commas
        $str = str_replace(',', '', $addressAsString);

        // capture groups
        preg_match('/(.*)([0-9]{5})(.*)/', $str, $address);

        // map to new array by trimming whitespaces
        return array_map(function ($s) {
            return trim($s);
        }, $address);
    }

    function getColumn($row, $columnName)
    {
        return $row[$this->COLUMN_MAPPINGS[$columnName]];
    }


    // handle various checks before actually processing the file
    function sanityCheck()
    {
        $csvFile = $this->argument('file');

        // check that the file exists
        if (!file_exists($csvFile)) {
            die("File " . $csvFile . " does not exist");
        }

        // get file rows
        $rows = $this->rows();

        // check that all emails are actually specified
        foreach ($rows as $index => $row) {
            if (empty($this->getEmailFromRow($row))) {
                die("Missing email from row " . ($index + 2)); // +2 for headers and 0 indexed
            }
        }
    }

    // map the csv file into an array
    function rows()
    {
        $handle = fopen($this->argument('file'), "r");
        // skip headers
        fgetcsv($handle, 1000, ",");
        $rows = [];
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            array_push($rows, $row);
        }

        fclose($handle);
        return $rows;
    }

    function getEmailFromRow($row)
    {
        return   empty($this->getColumn($row, "MAIL_DIRECTION"))
            ? $this->getColumn($row, "MAIL_DIRECTION_2")
            : $this->getColumn($row, "MAIL_DIRECTION");
    }

    function getMobileFromRow($row)
    {
        return    empty($this->getColumn($row, "TEL_DIRECTION"))
            ? $this->getColumn($row, "TEL_DIRECTION_2")
            : $this->getColumn($row, "TEL_DIRECTION");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->sanityCheck();

        $csvFile = $this->argument('file');

        // we get the mapping department <-> regions
        $geoMapping = json_decode(file_get_contents("resources/database/departements.json"));

        // we create all the etablissements using the csv spreadsheet
        $rows = $this->rows();
        foreach ($rows as $index => $row) {
            $address = $this->parseAddress($row[2]);
            $user = User::firstOrcreate(
                ["email" => $this->getEmailFromRow($row)],
                [
                    "name" => $this->getColumn($row, "NAME"),
                    "email" => $this->getEmailFromRow($row),
                    "password" => Hash::make("password"), // TODO: what is the strategy here ?
                    "phone_mobile" => $this->getMobileFromRow($row),
                    // "token" => Str::random(5) . time() TODO: do we need that for the import ???
                ]
            );
            print("User::firstOrcreate with user => " . $user . "\n");
            $etablissement = Etablissement::firstOrCreate(
                [
                    "lat" => $this->getColumn($row, "LAT"),
                    "long" => $this->getColumn($row, "LON"),
                ],
                [
                    "name" => $this->getColumn($row, "NAME"),
                    "type" => "public", // TODO: get this value from csv whenever available
                    "adresse" => $address[1],
                    "codepostal" => $address[2],
                    "region" => $this->findRegion($geoMapping, $address[2]),
                    "ville" => $this->getColumn($row, "CITY"),
                    "lat" => $this->getColumn($row, "LAT"),
                    "long" => $this->getColumn($row, "LON"),
                    "user_id" => $user->id,
                ]
            );
            print("Etablissement::firstOrcreate with etablissement => " . $etablissement . "\n");
        }
    }
}
