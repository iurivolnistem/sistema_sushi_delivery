<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array{
        return [
            '#',
            'Nome',
            'Descrição',
            'Valor',
            'Status',
            'Criação'
        ];
    }

    public function collection()
    {
        return DB::table('produtos')->select('id', 'nome', 'descricao', 'valor', DB::raw('CASE WHEN status = 0 THEN "Inativo" ELSE "Ativo" END AS status'), 'created_at')->get();
    }
}
