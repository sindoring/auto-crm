<?php

namespace App\Console\Commands;

use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Console\Command;
use App\Marks;
use App\Cars;

class CarsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cars:import {path} {limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path');
        $limit = $this->argument('limit');

        $csv = Reader::createFromPath(base_path().$path, 'r');
        $csv->setDelimiter(';');
        $csv->addStreamFilter('convert.iconv.windows-1251/UTF-8');
        $csv->setHeaderOffset(0);
        
        $stmt = (new Statement())
                ->offset(0)
                ->limit($limit);
        
        $records = $stmt->process($csv);

        foreach ($records as $record) {
            $mark = Marks::where('name', $record['mark'])->first();
            if($mark!=null){
                (new Cars(['markID'=>$mark->markID, 'model'=>$record['model'], 'year'=>$record['year']]))->save();
            }
            else{
                $newMark = new Marks(['name'=>$record['mark']]);
                $newMark->save();
                (new Cars(['markID'=>$newMark->markID, 'model'=>$record['model'], 'year'=>$record['year']]))->save();
            }
        }
    }
}
