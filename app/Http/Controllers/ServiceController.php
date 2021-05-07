<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{

    private $api_server = 'http://ead.portalava.com.br/web_service';
    private $api_http_user = '1590e99c63d124e374345de71205ddb7c63a0b8d';
    private $api_http_pass = 'afb94979f63f3038b84344d7ac37febe39748167';
    private $chave_acesso = '1a3e879fb888613f313d5e0ee22bca7f';
    private $chave_name = 'EAD-API-KEY';
    private $format = 'json';

    private $matricula;
    private $cursoID;
    private $poloID;

    public function paramsQuery($array){
        $params = $array;
        return $params;
    }

    public function  paramsReturn($array, $route){
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "{$this->api_server}/{$route}/format/{$this->format}");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($curl, CURLOPT_USERPWD, "{$this->api_http_user}:{$this->api_http_pass}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("{$this->chave_name}:{$this->chave_acesso}"));
        curl_setopt($curl, CURLOPT_NOBODY, 1);
        curl_exec($curl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->paramsQuery($array)));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($curl);

        $response = json_decode($output);

        //dd($response);
        return $response; // Resposta do WebService

        
    }

    public function cadastroMatricula($nome, $cpf, $email, $cep, $numero, $compl){
        $this->paramsReturn(array(

            'CursoID'   => $this->cursoID,
            'PoloID'    => $this->poloID,
            'Nome'      => $nome,
            'CPF'       => $cpf,
            'Email'     => $email,
            'CEP'       => $cep,
            'Numero'    => $numero,
            'Compl'     => $compl,
            
        ), 'cadastro');
    }

    public function alterarMatricula($value){
        $this->paramsReturn(array(
            
            'MatriculaID'   => $this->matricula,
            'Situacao'      => $value            
            
        ), 'situacao');
    }

    public function getNotas($disciplinaID){
        $this->paramsReturn(array(
            
            'MatriculaID'   => $this->matricula,
            'CursoID'       => $this->cursoID,
            'DisciplinaID'  => $disciplinaID           
            
        ), 'notas');
    }

    public function getCourses(){
        $this->paramsReturn(array(

            'DtInicio' => '01/01/2000',
            'DtFim' => '01/01/2022',
            'registros_pagina' => 10,
            'pagina' => 1

        ), 'getCursos');
    }
    public function getMatriculas(){
        $this->paramsReturn(array(
            'registros_pagina' => 10,
            'pagina' => 1
        ), 'getMatriculas');
    }
    
    public function getGrades(){
        $this->paramsReturn(array(
            'DtInicio' => '01/01/2000',
            'DtFim' => '01/01/2022',
            'registros_pagina' => 10,
            'pagina' => 1
        ), 'getGrades');
    }

    public function getBancoQuestoes(){
        $this->paramsReturn(array(), 'getBancoQuestoes');
    }

    public function getAlternativas(){
        $this->paramsReturn(array(), 'getAlternativas');
    }

    public function getDisciplinas(){
        $this->paramsReturn(array(
            'registros_pagina' => 10,
            'pagina' => 1
        ), 'getDisciplinas');
    }

    public function login(){

        $email = 'teste@teste';
        $senha = 'teste';

        return "<a href='http://apresentacao.portalava.com.br/loginAjax/?email='.$email.'?senha='.$senha.'>teste</a>";
    }

    public function getAcessos($loginID){
        $this->paramsReturn(array(

            'LoginID' => $loginID,

        ), 'getDisciplinas');
    }

    public function cadastroProfessor($nome, $cpf, $email, $sexo, $orientadorTCC, $todosCursos, $situacao){
        $this->paramsReturn(array(

            'Nome'          => $nome,
            'CPF'           => $cpf,
            'Sexo'          => $sexo,
            'Email'         => $email,
            'OrientadorTCC' => $orientadorTCC,
            'TodosCursos'   => $todosCursos,
            'Situacao'      => $situacao,

        ), 'cadastroProfessor');
    }

    public function alterarProfessor($professorID, $nome, $cpf, $email, $sexo, $orientadorTCC, $todosCursos, $situacao){
        $this->paramsReturn(array(

            'ProfessorID'   => $professorID,
            'Nome'          => $nome,
            'CPF'           => $cpf,
            'Sexo'          => $sexo,
            'Email'         => $email,
            'OrientadorTCC' => $orientadorTCC,
            'TodosCursos'   => $todosCursos,
            'Situacao'      => $situacao,

        ), 'cadastroProfessor');
    }

    public function getProfessorDisciplinas($professorID){
        $this->paramsReturn(array(

            'ProfessorID' => $professorID

        ), 'getProfessorDisciplinas');
    }

    public function getProfessor($professorID){
        $this->paramsReturn(array(

            'ProfessorID' => $professorID

        ), 'getProfessor');
    }

    public function getProfessorCursos($professorID){
        $this->paramsReturn(array(

            'ProfessorID' => $professorID

        ), 'getProfessorCursos');
    }

    public function getProcSeletivos(){
        $this->paramsReturn(array(), 'getProcSeletivos');
    }

    public function getInscritos($procSeletivoID, $cursoID, $poloID){
        $this->paramsReturn(array(

            'ProcSeletivoID' => $procSeletivoID,
            'CursoID'   => $cursoID,
            'PoloID'    => $poloID,
            'Situacao'  => null,

        ), 'getInscritos');
    }

    public function getInfoPessoa(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getInfoPessoa');
    }

    public function getNotaTCC(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'cadastro');
    }

    
    public function getAulas($disciplinaID, $matricula){
        $objeto = $this->paramsReturn(array(

            'MatriculaID'   => $matricula,
            'DisciplinaID'  => $disciplinaID,

        ), 'getAulas');

        return $objeto;
    }

    public function getVideoAula($aulaID, $matricula){
        $objeto = $this->paramsReturn(array(

            'MatriculaID'   => $matricula,
            'AulaID'        => $aulaID,

        ), 'getVideoAula');

        return $objeto;
    }

    public function getPdfsDisciplina($disciplinaID, $matricula){
        $objeto =  $this->paramsReturn(array(

            'MatriculaID'   => $matricula,
            'DisciplinaID'  => $disciplinaID,
            'registros_pagina' => 10,
            'pagina' => 1

        ), 'getPdfsDisciplina');
        return  $objeto;
    }

    public function getPdf($livroDisciplinaID, $matricula){
        $objeto = $this->paramsReturn(array(

            'MatriculaID'       => $matricula,
            'LivroDisciplinaID' => $livroDisciplinaID,

        ), 'getPdf');

        return $objeto;
    }

    public function getAlunosAlterados($dataDE, $dataAte){
        $this->paramsReturn(array(

            'dataDe'    => $dataDE,
            'dataAte'   => $dataAte,

        ), 'getAlunosAlterados');
    }

    public function getDocumentosAluno(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getDocumentosAluno');
    }

    public function getPoloAluno(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getPoloAluno');
    }

    public function getContratoAluno(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getContratoAluno');
    }

    public function getRequisicoesAluno(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getRequisicoesAluno');
    }

    public function getProvasAluno(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getRequisicoesAluno');
    }

    public function getAulasAssistidas(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getRequisicoesAluno');
    }
    
    public function getMaterialLidos(){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,

        ), 'getMaterialLidos');
    }
    
    public function pdf($idcurso, $matricula){

        $livroDisciplinaID = $this->getPdfsDisciplina($idcurso, $matricula);
        $listLinksPdf = $this->getPdf($livroDisciplinaID[0]->LivroDisciplinaID, $matricula);

        return Redirect::to($listLinksPdf);
    }

    public function aulasVideo($idcurso, $matricula){
        $aulas = $this->getAulas($idcurso, $matricula);

        foreach ($aulas as $value) {
            echo "<span>Matricula: ".$value->MatriculaID."</span><br>";
            echo "<span>Aula ID: ".$value->AulaID."</span><br>";
            echo "<span>Titulo: ".$value->Tema."</span><br><br><hr>";
        }
    }

    public function video($idaula, $matricula){
        $video = $this->getVideoAula($idaula, $matricula);
        return Redirect::to($video);
    }
}