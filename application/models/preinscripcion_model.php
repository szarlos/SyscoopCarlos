<?php
class Preinscripcion_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
 
    function cursos_disponibles(){
        $query='SELECT Cursos.Cur_Id ,[Cur_NroResolucion],[Cur_Nombre],[Cur_Metodologia],[Cur_Destinatarios],[Cur_Duracion],[Cur_Temario],[Cur_Certificacion],[Cur_Prerequisitos],[Int_Id]
                 FROM Cursos,Dictados WHERE Cursos.Cur_Id=Dictados.Cur_Id AND Dictados.Dic_InicioPreinscripcion < GETDATE() AND Dictados.Dic_FinPreinscripcion > GETDATE()';
        return $this->db->query($query);     
    }
    
    function dictados_disponibles($curso){
        $query=' SELECT Dictados.Dic_Id
,Dictados.Cur_Id 
,[Dic_InicioClases]
      ,[Dic_FinClases]
      ,[Dic_LugarDictado]
      ,[Dic_CupoMax]
      ,Profesores.Pro_ApeNom
  FROM Dictados,Profesores
  WHERE Dictados.Cur_Id= ? AND Dictados.Pro_Id=Profesores.Pro_Id ';
        return $this->db->query($query,array($curso));
    }     
     function horarios($cur_id,$dic_id){
         $query='SELECT [DiaHora_Id]
      ,[Dia]
      ,[HoraDesde]
      ,[HoraHasta]
  FROM [Cooperadora].[dbo].[DiasyHorasDictado]
WHERE Cur_Id= ? AND Dic_Id= ? ';
         return $this->db->query($query,array($cur_id,$dic_id));
     }
    function nombre_curso($curso_id){
        $query='SELECT Cur_Nombre FROM Cursos WHERE Cur_Id= ? ';
        $result=$this->db->query($query,array($curso_id));
        return $result->row_array();
    }
    function preinscribir($cur_id,$dic_id,$dni,$fuente){
        $query='INSERT INTO [Cooperadora].[dbo].[Preinscripciones]
           ([Cur_Id]
           ,[Dic_Id]
           ,[Pre_DNI]
           ,[Pre_Fuente]
           ,[Pre_Fecha])
          VALUES
           ( ? , ? , ?, ? , GETDATE())';
        $this->db->query($query,array($cur_id,$dic_id,$dni,$fuente));
    }
    
    function obtener_ultima_preinscripcion($curso,$dictado,$dni){
        $query='SELECT [Cur_Id]
      ,[Dic_Id]
      ,[Pre_Id]
      ,[Pre_DNI]
      ,[Pre_Usr_ApeNom] 
      ,[Pre_Usr_Direccion] 
      ,[Pre_Usr_Telefono] 
      ,[Pre_Usr_Mail] 
      ,[Pre_Fuente]
      ,[Pre_Fecha]
  FROM [Cooperadora].[dbo].[Preinscripciones], PreinscripcionUsuario
WHERE Cur_Id= ? AND Dic_Id= ? AND Pre_DNI= ? AND Pre_Usr_DNI= ? ORDER BY Pre_Fecha DESC';
     return $this->db->query($query,array($curso,$dictado,$dni,$dni));
    }
    function crear_usuario($dni,$ayn,$direccion,$tel,$mail,$clave){
        $query='INSERT INTO [Cooperadora].[dbo].[PreinscripcionUsuario]
           ([Pre_Usr_DNI]
           ,[Pre_Usr_ApeNom]
           ,[Pre_Usr_Direccion]
           ,[Pre_Usr_Telefono]
           ,[Pre_Usr_Mail]
           ,[Pre_Usr_Clave])
     VALUES
           (? ,? , ? ,?,? ,?)';
    $this->db->query($query,array($dni,$ayn,$direccion ,$tel ,$mail ,$clave));
    }
    function guardar_usuario($dni,$ayn,$direccion,$tel,$mail,$clave){
       //da error por el odbc la siguiente consulta -.-
        //se divide en 3 metodos existe_usuario y crear_usuario
       /* $query='IF EXISTS (SELECT * FROM PreinscripcionUsuario WHERE Pre_Usr_DNI='.$dni.')
    UPDATE PreinscripcionUsuario SET ([Pre_Usr_ApeNom] = '.$ayn.' ,[Pre_Usr_Direccion] = '.$direccion.'
      ,[Pre_Usr_Telefono] = '.$tel.' ,[Pre_Usr_Mail] = '.$mail.' ,[Pre_Usr_Clave] = '.$clave.' ) WHERE Pre_Usr_DNI= '.$dni.'
ELSE
INSERT INTO [Cooperadora].[dbo].[PreinscripcionUsuario]
           ([Pre_Usr_DNI]
           ,[Pre_Usr_ApeNom]
           ,[Pre_Usr_Direccion]
           ,[Pre_Usr_Telefono]
           ,[Pre_Usr_Mail]
           ,[Pre_Usr_Clave])
     VALUES
           ('.$dni.' ,'.$ayn.' , '.$direccion.' ,'.$tel.' ,'.$mail.' ,'.$clave.')
          ';*/
     if($this->existe_usuario($dni)){
          $query='UPDATE PreinscripcionUsuario SET ([Pre_Usr_ApeNom] = ? ,[Pre_Usr_Direccion] = ? ,[Pre_Usr_Telefono] = ? ,[Pre_Usr_Mail] = ? ,[Pre_Usr_Clave] = ? )';
     $this->db->query($query,array($ayn,$direccion,$tel,$mail,$clave));
     }  else {
         $this->crear_usuario($dni, $ayn, $direccion, $tel, $mail, $clave);
     }
       
    }
    function existe_usuario($dni){
        $query='SELECT [Pre_Usr_DNI] , [Pre_Usr_Clave] FROM [Cooperadora].[dbo].[PreinscripcionUsuario] WHERE Pre_Usr_DNI= ?';
        $result=$this->db->query($query,array($dni));
        if (sizeof($result->row_array())==0){
            return FALSE;
        }else{return TRUE;}
    }
    function check_usuario($dni,$clave){
        $query='SELECT [Pre_Usr_DNI]
      ,[Pre_Usr_ApeNom]
      ,[Pre_Usr_Direccion]
      ,[Pre_Usr_Telefono]
      ,[Pre_Usr_Mail]
      ,[Pre_Usr_Clave]
  FROM [Cooperadora].[dbo].[PreinscripcionUsuario] WHERE Pre_Usr_DNI= ? AND Pre_Usr_Clave=?';
        $result=$this->db->query($query,array($dni,$clave));
        return $result->row_array();
    }
      }
?>