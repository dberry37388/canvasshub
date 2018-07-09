<?php

namespace App\Console\Commands;

use App\Voter;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportVotersCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:import-voters-csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( ! $reader = $this->readCsv()) {
            $this->error('We could not file the file you specified.');
            exit;
        }
    
        foreach ($reader as $index => $row) {
            if ($index > 2) {
                $voter = $this->fillVoterData($row);
    
                $this->fillElectionData($voter, $row);
            }
        }
    }
    
    /**
     * @return bool|\League\Csv\Reader
     */
    protected function readCsv()
    {
        try {
            $file = Storage::get('data/' . $this->argument('file'));
        } catch (FileNotFoundException $e) {
            return false;
        }
        
        return Reader::createFromString($file);
    }
    
    /**
     * Fills the voter data.
     *
     * @param $row
     * @return \App\Voter
     */
    protected function fillVoterData($data)
    {
        $voter = new Voter;
        
        $this->info($data[55]);
        
        $voter->county_id = (int) $data[1];
        $voter->state_id = (int) $data[2];
        $voter->first_name = $data[3];
        $voter->last_name = $data[4];
        $voter->title = $data[5];
        $voter->registered_house_number = $data[6];
        $voter->registered_street_address = $data[7];
        $voter->registered_unit_type = $data[8];
        $voter->registered_unit_number = $data[9];
        $voter->registered_address = $data[10];
        $voter->registered_address2 = $data[11];
        $voter->registered_city = $data[12];
        $voter->registered_state = $data[13];
        $voter->registered_zip5 = $data[14];
        $voter->registered_zip4 = $data[15];
        $voter->mailing_house_number = $data[25];
        $voter->mailing_street_address = $data[26];
        $voter->mailing_address = $data[20];
        $voter->mailing_address2 = $data[21];
        $voter->mailing_city = $data[22];
        $voter->mailing_state = $data[23];
        $voter->mailing_zip5 = $data[24];
        $voter->phone = $data[16];
        $voter->precinct_number = $data[17];
        $voter->precinct = $data[18];
        $voter->precinct_sub = $data[19];
        $voter->dob = $data[27] != 'NULL' ? $data[27] : null;
        $voter->gender = $data[29];
        $voter->longitude = $data[55] != 'NULL' ? $data[55] : null;
        $voter->latitude = $data[56] != 'NULL' ? $data[56] : null;
        
        $voter->save();
        
        return $voter->fresh();
    }
    
    /**
     * @param \App\Voter $voter
     * @param $data
     */
    protected function fillElectionData(Voter $voter, $data)
    {
        for ($i=30; $i <= 54; $i++) {
            $record = $data[$i];
            
            if ($record != 'NULL') {
                $election = $this->getElectionYearInfo()[$i];
                $mappedVoteCode = $this->mapVoteCodes()[$record];
                
                //$this->info("{$voter->id} - {$election['date']}");
                
                if (empty($mappedVoteCode)) {
                    $this->error('Could not map the code' . $mappedVoteCode);
                    exit;
                }
                
                $voter->elections()->create([
                    'election_date' => $election['date'],
                    'voted_early' => $mappedVoteCode['early'],
                    'party' => $mappedVoteCode['party'],
                    'original_data' => $data[$i],
                ]);
            }
        }
    }
    
    protected function mapVoteCodes()
    {
        return [
            'YRY' => [
                'early' => true,
                'party' => 'R'
            ],
            
            'NRY' => [
                'early' => false,
                'party' => 'R'
            ],
            'YRN' => [
                'early' => false,
                'party' => 'R'
            ],
            'NRN' => [
                'early' => false,
                'party' => 'R'
            ],
            'YDY' => [
                'early' => true,
                'party' => 'D'
            ],
            'NDY' => [
                'early' => false,
                'party' => 'D'
            ],
            'YDN' => [
                'early' => false,
                'party' => 'D'
            ],
            'NDN' => [
                'early' => false,
                'party' => 'D'
            ],
            'YY' => [
                'early' => true,
                'party' => null
            ],
            'NY' => [
                'early' => false,
                'party' => null
            ],
            'YN' => [
                'early' => false,
                'party' => null
            ],
            'NN' => [
                'early' => false,
                'party' => null
            ],
        ];
    }
    
    /**
     * Array containing election year data.
     *
     * @return array
     */
    protected function getElectionYearInfo()
    {
        return [
            30 => [
                'code' => 'e_1',
                'date' => '2018-05-01',
                'type' => 'P'
            ],
            31 => [
                'code' => 'e_2',
                'date' => '2017-08-03',
                'type' => 'M'
            ],
            32 => [
                'code' => 'e_3',
                'date' => '2016-11-08',
                'type' => 'G'
            ],
            33 => [
                'code' => 'e_4',
                'date' => '2016-08-04',
                'type' => 'PGMM'
            ],
            34 => [
                'code' => 'e_5',
                'date' => '2016-03-01',
                'type' => 'P'
            ],
            35 => [
                'code' => 'e_6',
                'date' => '2015-08-06',
                'type' => 'M'
            ],
            36 => [
                'code' => 'e_7',
                'date' => '2014-11-04',
                'type' => 'GR'
            ],
            37 => [
                'code' => 'e_8',
                'date' => '2014-08-07',
                'type' => 'PGM'
            ],
            38 => [
                'code' => 'e_9',
                'date' => '2014-05-06',
                'type' => 'P'
            ],
            39 => [
                'code' => 'e_10',
                'date' => '2013-08-01',
                'type' => 'GGG'
            ],
            40 => [
                'code' => 'e_11',
                'date' => '2012-11-06',
                'type' => 'GG'
            ],
            41 => [
                'code' => 'e_12',
                'date' => '2012-08-02',
                'type' => 'PP'
            ],
            42 => [
                'code' => 'e_13',
                'date' => '2012-08-02',
                'type' => 'GG'
            ],
            43 => [
                'code' => 'e_14',
                'date' => '2012-03-06',
                'type' => 'P'
            ],
            44 => [
                'code' => 'e_15',
                'date' => '2011-08-04',
                'type' => 'GGG'
            ],
            45 => [
                'code' => 'e_16',
                'date' => '2010-11-02',
                'type' => 'GG'
            ],
            46 => [
                'code' => 'e_17',
                'date' => '2010-08-05',
                'type' => 'PP'
            ],
            47 => [
                'code' => 'e_18',
                'date' => '2010-08-05',
                'type' => 'GG'
            ],
            48 => [
                'code' => 'e_19',
                'date' => '2010-05-04',
                'type' => 'PPP'
            ],
            49 => [
                'code' => 'e_20',
                'date' => '2009-08-06',
                'type' => 'GGG'
            ],
            50 => [
                'code' => 'e_21',
                'date' => '2008-11-04',
                'type' => 'GG'
            ],
            51 => [
                'code' => 'e_22',
                'date' => '2008-08-07',
                'type' => 'PP'
            ],
            52 => [
                'code' => 'e_23',
                'date' => '2008-08-07',
                'type' => 'GG'
            ],
            53 => [
                'code' => 'e_24',
                'date' => '2008-02-05',
                'type' => 'P'
            ],
            54 => [
                'code' => 'e_25',
                'date' => '2008-02-05',
                'type' => 'GG'
            ],
        ];
    }
}
