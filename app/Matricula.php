<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Matricula extends Model
{
    use SoftDeletes;

    protected $table = 'matricula';
    protected $primaryKey = 'id';

    private $token = 'E7A02A70C5E64DB3A1534BB50AC1ACBD';
    private $email = 'codismapb@gmail.com';

    public $timestamps = true;

    protected $fillable = [
        'nome',
        'email',
        'contato',
        'whatsapp',
        'datanascimento',
        'cpf',
        'rg',
        'nacionalidade',
        'estadocivil',
        'cep',
        'estado',
        'cidade',
        'rua',
        'numero',
        'bairro',
        'nomemae',
        'nomepai',
        'nomeresponsavel',
        'cpfresponsavel',
        'rgresponsavel',
        'categoria_id',
        'codigo_categoria',
        'turma_id',
    ];

    public function saveMatricula($request)
    {
        $required = [];

        foreach ($this->fillable as $key => $field) {
            $required[$field] = "required";
        }

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
        ];

        $validator = Validator::make($request->all(), $required, $messages);

        $errors = $validator->errors();

        if ($errors) {
            foreach ($errors->all() as $message) {
                return response()->json([
                    'swl_alert' => true,
                    'title' => "Oops!",
                    'text' => $message,
                    'icon' => "error",
                    'button' => "Ok!",
                ]);
            }
        }


        $matricula = new Matricula($request->all());

        $matricula->save();


        $cobranca = $this->geraCobrancaPagSeguro($matricula);

        DB::table('matricula')->where('id', $matricula->id)->update(['code' => $cobranca]);

        return [
            'success' => true,
            'code' => $cobranca
        ];
    }

    public function geraCobrancaPagSeguro($matricula)
    {
        $turma = Turma::find($matricula->turma_id);
        $produto = $this->getProduct($matricula);
        $valor = $this->getProductPrice($matricula);

//        $data['token'] = 'e949f72b-e154-467d-a1ac-7abd040edffcfea8bc0d4695a2f131506cbeecbcc2c84be3-7885-4537-9a33-48efacbfd85c';
        $data['token'] = 'E7A02A70C5E64DB3A1534BB50AC1ACBD';
        $data['email'] = 'codismapb@gmail.com';
        $data['currency'] = 'BRL';
        $data['itemId1'] = $matricula->turma_id;
        $data['itemQuantity1'] = '1';
        $data['itemDescription1'] = $produto->title . " | " . $produto->horario;
        $data['itemAmount1'] = $valor->valor;

        $data = http_build_query($data);

//        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $xml = curl_exec($curl);

        curl_close($curl);

        $xml = simplexml_load_string($xml);

        return current($xml->code);

    }

    public function getProduct($matricula)
    {
        return DB::table('turma')
            ->join('curso', 'curso.id', '=', 'turma.curso_id')
            ->select('curso.title', 'turma.horario')
            ->where('turma.id', '=', $matricula->turma_id)->first();
    }

    public function getProductPrice($matricula)
    {
        return DB::table('valores')
            ->join('turma_valor', 'turma_valor.valor_id', '=', 'valores.id')
            ->join('turma', 'turma.id', '=', 'turma_valor.turma_id')
            ->select('valores.valor')
            ->where('turma.id', '=', $matricula->turma_id)
            ->where('valores.categoria_id', '=', $matricula->categoria_id)->first();
    }

    public function registerCallback($request)
    {
        if(!empty($request['notificationType']) && $request->notificationType == 'transaction'){
            $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/' . $request->notificationCode . '?email=' . $this->email . '&token=' . $this->token;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            $transaction = curl_exec($curl);
            curl_close($curl);



            if($transaction == 'Unauthorized'){
                exit;//Mantenha essa linha
            }else{
                try{
                    $transaction = simplexml_load_string($transaction);
                    $fp = fopen("log.txt", "a");
                    $escreve = fwrite($fp, print_r($transaction, 1));
                    fclose($fp);

                    if(current($transaction->status) == '3'){
                        $update = DB::table('matricula')->where('transaction', '=', current($transaction->code))->update(['status_pagamento' => 'paid']);
                        if($update){
                            $success = true;
                        }else{
                            $success = false;
                        }
                    }else{
                        $success = false;
                    }
                }catch(\Exception $e){
                    $fp = fopen("log.txt", "a");
                    $escreve = fwrite($fp, print_r($e->getMessage(), 1));
                    fclose($fp);
                    $success = false;
                }
            }
            return response()->json(['success' => $success]);
        }
    }
}
