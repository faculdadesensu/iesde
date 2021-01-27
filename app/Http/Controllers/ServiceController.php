<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    private $api_server = 'http://ead.portalava.com.br/web_service';
    private $api_http_user = '1590e99c63d124e374345de71205ddb7c63a0b8d';
    private $api_http_pass = 'afb94979f63f3038b84344d7ac37febe39748167';
    private $chave_acesso = '7913463604cb98568ccfefe484f66f37';
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

        print_r($output); // Resposta do WebService
        
    }

    public function cadastroMatricula($nome, $cpf, $email, $cep, $numero, $compl){
        $this->paramsReturn(array(

            'CursoID' => $this->cursoID,
            'PoloID' => $this->poloID,
            'Nome' => $nome,
            'CPF' => $cpf,
            'Email' => $email,
            'CEP' => $cep,
            'Numero' => $numero,
            'Compl' => $compl,
            
        ), 'cadastro');
    }

    public function alterarMatricula($value){
        $this->paramsReturn(array(
            
            'MatriculaID' => $this->matricula,
            'Situacao' => $value            
            
        ), 'situacao');
    }

    public function getNotas($disciplinaID){
        $this->paramsReturn(array(
            
            'MatriculaID' => $this->matricula,
            'CursoID' => $this->cursoID,
            'DisciplinaID' => $disciplinaID           
            
        ), 'notas');
    }


    public function getCourses(){
        $this->paramsReturn(array(), 'getCursos');
    }
    public function getMatriculas(){
        $this->paramsReturn(array(), 'getMatriculas');
    }
    
    public function getGrades(){
        $this->paramsReturn(array(), 'getGrades');
    }

    public function getBancoQuestoes(){
        $this->paramsReturn(array(), 'getBancoQuestoes');
    }

    public function getAlternativas(){
        $this->paramsReturn(array(), 'getAlternativas');
    }

    public function getDisciplinas(){
        $this->paramsReturn(array(), 'getDisciplinas');
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

    public function getAulas($disciplinaID){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,
            'DisciplinaID' => $disciplinaID,

        ), 'getAulas');
    }

    public function cadastroProfessor($nome, $cpf, $email, $sexo, $orientadorTCC, $todosCursos, $situacao){
        $this->paramsReturn(array(

            'Nome' => $nome,
            'CPF' => $cpf,
            'Sexo' => $sexo,
            'Email' => $email,
            'OrientadorTCC' => $orientadorTCC,
            'TodosCursos' => $todosCursos,
            'Situacao' => $situacao,

        ), 'cadastroProfessor');
    }

    public function alterarProfessor($professorID, $nome, $cpf, $email, $sexo, $orientadorTCC, $todosCursos, $situacao){
        $this->paramsReturn(array(

            'ProfessorID' => $professorID,
            'Nome' => $nome,
            'CPF' => $cpf,
            'Sexo' => $sexo,
            'Email' => $email,
            'OrientadorTCC' => $orientadorTCC,
            'TodosCursos' => $todosCursos,
            'Situacao' => $situacao,

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
            'CursoID' => $cursoID,
            'PoloID' => $poloID,
            'Situacao' => null,

        ), 'getInscritos');
    }

    public function getVideoAula($aulaID){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,
            'AulaID' => $aulaID,

        ), 'getVideoAula');
    }

    public function getPdfsDisciplina($disciplinaID){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,
            'DisciplinaID' => $disciplinaID,

        ), 'getPdfsDisciplina');
    }

    public function getPdf($livroDisciplinaID){
        $this->paramsReturn(array(

            'MatriculaID' => $this->matricula,
            'LivroDisciplinaID' => $livroDisciplinaID,

        ), 'getPdf');
    }
    
    public function index(){

    }
}
