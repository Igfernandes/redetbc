@extends('errors.illustrated-layout',['title'=>__('Página não encontrada')])
@section('title',__('Página não encontrada'))
@section('message',$exception->getMessage()??__("Desculpe, não conseguimos encontrar a página que você está procurando."))
@section('code',404)