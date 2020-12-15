<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id';

    public function get_cursos($request)
    {
        return DB::table('categoria')
            ->join('valores', 'categoria.id', '=', 'valores.categoria_id')
            ->join('turma_valor', 'valores.id', '=', 'turma_valor.valor_id')
            ->join('turma', 'turma_valor.turma_id', '=', 'turma.id')
            ->join('curso', 'turma.curso_id', '=', 'curso.id')
            ->join('disciplina', 'curso.disciplina_id', '=', 'disciplina.id')
            ->join('package_disciplinas', 'disciplina.id', '=', 'package_disciplinas.disciplina_id')
            ->join('package', 'package_disciplinas.package_id', '=', 'package.id')
            ->select(
                'curso.id',
                'curso.title',
                'valores.valor',
                'categoria.title AS categoria')
            ->where('categoria.id', '=', $request->categoria_id)
            ->where('package.id', '=', $request->disciplina_id)
            ->groupBy('turma.curso_id')
            ->get();
    }

    public function get_turmas($request)
    {
        return Turma::where('curso_id', $request->curso_id)->get();
    }
}
