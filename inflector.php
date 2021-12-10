<?php
class Inflector{
    /**
      *    Regras de singularização/pluralização
      */
    static public $rules = array(
    //singular     plural
        'ão'    => 'ões', 
        'ês'    => 'eses', 
        'm'     => 'ns', 
        'l'     => 'is', 
        'r'     => 'res', 
        'x'     => 'xes', 
        'z'     => 'zes', 
    );

    /**
      *    Exceções às regras
      */
    static public $exceptions = array(
        'cidadão' => 'cidadãos',
        'mão'     => 'mãos',
        'qualquer'=> 'quaisquer',
        'campus'  => 'campi',
        'lápis'   => 'lápis',
        'ônibus'  => 'ônibus',
        'TokenRedefinirSenha' => 'tokens_redefinir_senha',
        'cotação'  => 'cotações',
        'cotacao'  => 'cotacoes',
        'condicao' => 'condicoes',
        'condição' => 'condições',
        'leilão'  => 'leilões'
    );

    /**
     *    Adiciona uma exceção às regras
     *
     *    @version
     *      1.0 13/02/2013 Initial
     *
     *    @param  string $singularWord Palavra no singular
     *    @param  string $pluralWord Palavra no plural
     *    @return bool
     */
    public static function addException($singularWord, $pluralWord){
      self::$exceptions[$singularWord] = $pluralWord;

      return true;
    }

    /**
     *    Adiciona uma regra
     *
     *    @version
     *      1.0 13/02/2013 Initial
     *
     *    @param  string $singularSufix Terminação da palavra no singular
     *    @param  string $pluralSufix Terminação da palavra no plural
     *    @return bool
     */
    public static function addRule($singularWord, $pluralWord){
      self::$rules[$singularSufix] = $pluralSufix;

      return true;
    }

    /**
     *    Passa uma palavra para o plural
     *
     *    @version
     *      1.0 Initial
     *      1.1 15/04/2010 Substituição do str_replace() pelo preg_replace()
     *          como função de substituição
     *
     *    @param  string $word A palavra que deseja ser passada para o plural
     *    @return string
     */
    public static function pluralize($word){
        //Pertence a alguma exceção?
        if(array_key_exists($word, self::$exceptions)){
            return self::$exceptions[$word];
        }

        //Não pertence a nenhuma exceção. Mas tem alguma regra?
        else{
            foreach(self::$rules as $singular=>$plural){
                if(preg_match("({$singular}$)", $word)){
                    return preg_replace("({$singular}$)", $plural, $word);
                }
            }
        }

        //Não pertence às exceções, nem às regras.
        //Se não terminar com "s", adiciono um.
        if(substr($word, -1) !== 's'){
            return $word . 's';
        }
        else{
          return $word;
        }
    }
    
    /**
     *    Passa uma palavra para o singular
     *    
     *    @version
     *      1.0 Initial
     *      1.1 15/04/2010 Substituição do str_replace() pelo preg_replace()
     *          como função de substituição
     *
     *    @param  string $word A palavra que deseja ser passada para o singular
     *    @return string
     */
    public static function singularize($word){
        //Pertence às exceções?
        if(in_array($word, self::$exceptions)){
            $invert = array_flip(self::$exceptions);
            return $invert[$word];
        }
        //Não é exceção.. Mas pertence a alguma regra?
        else{
            foreach(self::$rules as $singular => $plural){
                if(preg_match("({$plural}$)",$word)){
                    return preg_replace("({$plural}$)", $singular, $word);
                }
            }
        }

        //Nem é exceção, nem tem regra definida. 
        //Apaga a última somente se for um "s" no final
        if(substr($word, -1) == 's'){
            return substr($word, 0, -1);
        }
        else{
          return $word;
        }
    }

    public static function tabela($classe){
		// $str = 'TipoServidor';
		if(!$classe){
			return false;
		}


		$str = $classe;
		$new_str = '';
		$Inflector = new Inflector(); 

		if(!empty($Inflector::$exceptions[$classe])){
			return $Inflector->pluralize($classe);
		}else{
			for ($i=0; $i < strlen($str); $i++) { 
				
				if(ctype_upper($str[$i])){
					if($i){
						$new_str .= '_'.strtolower($str[$i]);
					}else{
						$new_str .= strtolower($str[$i]);
					}
				}else{
					$new_str .= $str[$i];
				}
			}
			
			$palavras = explode('_', $new_str);

			foreach ($palavras as $key => $palavra) {

				if(!$key){
					$new_str = self::formata_str_simples($Inflector->pluralize($palavra));
				}else{
					$new_str .= '_'.self::formata_str_simples($Inflector->pluralize($palavra));
				}
			}

			return str_replace('-', '_', $new_str);
		}
	}

	private static function formata_str_simples($str){
        // $str = utf8_decode($str);

    // Colocando a string toda em minúscula
        $str = strtolower($str);
    
    // Removendo os acentos
        $str = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($str));
    
    // Trocando espaços por underline
        $str = str_replace(" ", "_", $str);

    // removendo simbolos menos o ponto
        // $str = preg_replace("/[^a-zA-Z0-9-_\s]/", "", $str);
        $str = preg_replace("/[^a-zA-Z0-9-.-_\s]/", "", $str);
 
        return $str;

    }
}