<?php

namespace App\Exports;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array{
        return [
            '#',
            'Valor',
            'Troco',
            'Criação',
            'Status',
            'Pagamento'
        ];
    }

    public function collection()
    {
        return DB::table('pedidos')->select('id', 'valor', 'troco', 'created_at', DB::raw('CASE WHEN status = 0 THEN "Aguardando" WHEN status = 1 THEN "Preparando" WHEN status = 2 THEN "Saiu para entrega" WHEN status = 3 THEN "Entregue" WHEN status = 4 THEN "Cancelado" ELSE "Devolvido" END AS status'), DB::raw('CASE WHEN pagamento = 1 THEN "Cartão de Crédito" WHEN pagamento = 2 THEN "Dinheiro sem troco" ELSE "Dinheiro com troco" END AS pagamento'))->get();
    }
}
