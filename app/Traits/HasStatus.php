<?php


namespace App\Traits;


trait HasStatus
{
    public function getStatusBadgeAttribute(){
        switch ($this->status){
            case "publish": return "success";
            case "completed": return "success";
            case "draft":  return "secondary";
            case "pending":  return "secondary";
            case "processing":  return "warning";
        }
    }
    public function getStatusTextAttribute(){
        switch ($this->status){
            case "publish": return __("Publicado");
            case "draft":  return __("Rascunho");
            case "pending":  return __("Pendente");
        }
    }
}
