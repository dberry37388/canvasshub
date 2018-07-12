<?php

namespace App\Exports;

use App\Voter;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class CountyExport implements FromQuery, WithMapping, WithHeadings, Responsable, WithEvents, ShouldAutoSize
{
    use Exportable;
    
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;
    
    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Coffee-County-TN-Republican-Voter-List.xlsx';
    
    /**
     * Total number of voters in our list.
     * @var int
     */
    protected $totalRows = 0;
    
    /**
     * CountyExport constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Query that will be used for the export.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        $voters = Voter::query()
        ->where('total_votes', '>=', 1);
        
        if ($this->request->has('propensity')) {
            $voters->where('propensity', $this->request->get('propensity'));
        }
    
        if ($this->request->has('precinct')) {
            $voters->where('precinct', $this->request->get('precinct'));
        }
    
        if ($this->request->has('mostRecent')) {
            $voters->whereNotNull('e_1');
        }
        
        $voters->orderBy('precinct', 'asc')
            ->orderBy('registered_street_address', 'asc')
            ->orderBy('registered_house_number');
        
        $this->totalRows = $voters->count() + 1;
        
        return $voters;
    }
    
    /**
     * Maps the data we want to columns.
     *
     * @param $voter
     * @return array
     */
    public function map($voter): array
    {
        return [
            $voter->first_name,
            $voter->last_name,
            $voter->registered_address,
            $voter->registered_city,
            $voter->registered_zip_5,
            $voter->phone,
            $voter->age,
            $voter->gender,
            $voter->pct_nbr,
            mapElectionCode($voter->e_1),
            mapElectionCode($voter->e_4),
            mapElectionCode($voter->e_5),
            mapElectionCode($voter->e_8),
            mapElectionCode($voter->e_9),
            mapElectionCode($voter->e_13),
            mapElectionCode($voter->e_14),
        ];
    }
    
    /**
     * Maps the column headings.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'FNAME',
            'LNAME',
            'ADDRESS',
            'CITY',
            'ZIP',
            'PHONE',
            'AGE',
            'M/F',
            'PCT',
            getElectionYearFromCode('e_1'),
            getElectionYearFromCode('e_4'),
            getElectionYearFromCode('e_5'),
            getElectionYearFromCode('e_8'),
            getElectionYearFromCode('e_9'),
            getElectionYearFromCode('e_13'),
            getElectionYearFromCode('e_14'),
        ];
    }
    
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function (BeforeExport $event) {
                $event->writer->getProperties()
                    ->setCreator("Daniel Berry")
                    ->setCompany('Coffee County GOP')
                    ->setManager('Daniel Berry')
                    ->setLastModifiedBy("Daniel Berry")
                    ->setTitle("Master Walk List")
                    ->setSubject("Coffee County, TN Voter List")
                    ->setDescription(
                        "This is the master voter walk list, containing all precincts and all election years."
                    )
                    ->setCategory("Campaign Material - Lists");
            },
            
            AfterSheet::class => function (AfterSheet $event) {
                
                $event->sheet->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->setMargins('0.25', '0.25', '0.25', '0.25');
                $event->sheet->setRepeatRows(1, 1);
                $event->sheet->getPageSetup()->setFitToWidth(1);
                $event->sheet->getPageSetup()->setFitToHeight(0);
                $event->sheet->freezePane("A2");
                $event->sheet->setAllBorders("A1:P{$this->totalRows}");
                $event->sheet->setFirstRowBorders("A1:P1");
                $event->sheet->alignHorizontalCenter("D1:P" . $this->totalRows);
            },
        ];
    }
}
