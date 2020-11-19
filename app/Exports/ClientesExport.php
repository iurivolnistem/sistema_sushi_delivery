<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array{
        return [
            '#',
            'Nome',
            'E-mail',
            'CPF',
            'Status',
            'Criação'
        ];
    }

    public function collection()
    {
        return DB::table('clientes')->select('id', 'nome', 'email', 'cpf', DB::raw('CASE WHEN status = 0 THEN "Inativo" ELSE "Ativo" END AS status'), 'created_at')->get();
    }
}
