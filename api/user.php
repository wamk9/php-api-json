<?php
require_once "database.php";

class User
{
	public static function get($show = "all") 
	{
		$conn = Database::Connect();
		$tempArray = json_decode($conn);
		$newArray = array();

		if ($show == "all")
		{
			for ($i=0; $i < count($tempArray); $i++) 
			{
				$newArray[$i]->id = $tempArray[$i]->id;
				$newArray[$i]->name = $tempArray[$i]->name;
				$newArray[$i]->mail = $tempArray[$i]->mail;
				$newArray[$i]->username = $tempArray[$i]->username;
			}

			return json_encode($newArray);

		}
		else
		{			
			for ($i=0; $i < count($tempArray); $i++) 
			{
				if($tempArray[$i]->id == intval($show))
				{
					$newArray[$i]->id = $tempArray[$i]->id;
					$newArray[$i]->name = $tempArray[$i]->name;
					$newArray[$i]->mail = $tempArray[$i]->mail;
					$newArray[$i]->username = $tempArray[$i]->username;
					
					return json_encode($newArray[$i]);
				}
			}
		}
		
		if(!array_key_exists(intval($show), $conn)){
			return '[]';
		}
	}
	
	
	public static function insert($data) 
	{	
		$conn = Database::Connect();
		$error = '{"error":"';
		
		if (strlen($data['password']) <= 5)
		{
			return '[{"error":"Senha deve conter ao menos 6 dígitos."}]';
		}
		
		$tempArray = json_decode($conn);
		
		for ($i=0; $i < count($tempArray); $i++) 
		{
			if($tempArray[$i]->username == $data['username'])
			{
				$error .= 'Usuário já cadastrado';
			}
			
			if($tempArray[$i]->mail == $data['mail'])
			{
				if ($error != '{"error":"')
				{
					$error .= " / Email já cadastrado";
				}
				else
				{
					$error .= 'Email já cadastrado';
				}
			}
		}
		
		if ($error != '{"error":"')
		{
			return '['.$error.'"}]';
		}
		
		$newId = $tempArray[count($tempArray)-1]->id;
		$newId++;
		$data = array('id'=>$newId)+$data;
		
		array_push($tempArray, $data);
		
		$jsonData = json_encode($tempArray);
		
		file_put_contents('db.json', $jsonData);
		
		return $jsonData;
	}
	
	
	public static function delete($id)
	{
		$conn = Database::Connect();
	
		$tempArray = json_decode($conn);
		
		for ($i=0; $i < count($tempArray); $i++) 
		{
			if($tempArray[$i]->id == $id)
			{
				array_splice($tempArray, $i, 1);
			   
			   
				$jsonData = json_encode($tempArray);
				file_put_contents('db.json', $jsonData);
				
				return '[{"message": "ID '.$id.' removido com sucesso."}]';
			}
		}
		
		return '[{"error": "ID não encontrado."}]';
	}
	
	
	public static function edit($data) 
	{	
		$conn = Database::Connect();
		$error = '{"error":"';
		$objectFound = false;

		if (strlen($data['password']) <= 5)
		{
			return '[{"error":"Senha deve conter ao menos 6 dígitos."}]';
		}
		
		$tempArray = json_decode($conn);
		
		
		for ($i=0; $i < count($tempArray); $i++) 
		{
			if($tempArray[$i]->id == $data['id'])
			{
				$objectFound = true;
				
				for ($j=0; $j < count($tempArray); $j++) 
				{
					if ($i != $j)
					{
						if($tempArray[$j]->username == $data['username'] && $tempArray[$j]->id != $tempArray->id)
						{
							$error .= 'Usuário já cadastrado';
						}
						
						if($tempArray[$j]->mail == $data['mail'] && $tempArray[$j]->id != $data['id'])
						{
							
							if ($error != '{"error":"')
							{
								$error .= " / Email já cadastrado";
							}
							else
							{
								$error .= 'Email já cadastrado';
							}
						}
					}
				}
				
				if ($error != '{"error":"')
				{
					return '['.$error.'"}]';
				}
				
				$tempArray[$i]->name = $data['name'];
				$tempArray[$i]->mail = $data['mail'];
				$tempArray[$i]->username = $data['username'];
				$tempArray[$i]->password = $data['password'];
			
				$jsonData = json_encode($tempArray);
				file_put_contents('db.json', $jsonData);
			}
		}
		
		if ($error != '{"error":"')
		{
			return '['.$error.'"}]';
		}
		else if ($objectFound)
		{
			return '[{"message": "ID '.$data["id"].' editado com sucesso."}]';
		}
		else
		{
			return '[{"error": "ID '.$data["id"].' não encontrada."}]';
		}
	}
}