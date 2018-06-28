<?php 

class Validation {
	private $field;
	private $value;
	private $msg;


	private function messages($num, $field, $max, $min ){
		$this->msg[0] = "Email invalido";
		$this->msg[1] = "CPF inválido (Ex: 999.999.999-99)";
		$this->msg[2] = "Telefone inválido (Ex: (99) 9999-9999)";
		$this->msg[3] = "$field invalido";
		$this->msg[4] = "campo ".$field." Obrigatorio";
		$this->msg[5] = $field." deve ter no máximo ".$max." caracteres"; // MÁXIMO DE CARACTERES
		$this->msg[6] = $field." deve ter no mínimo ".$min." caracteres"; // MÍNIMO DE CARACTERES
		


		return $this->msg[$num];
	}

	// validation Email
	public function emailValidation($email) {

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $this->messages(0, 'email', null, null);
		}

		return false;
	}
	

function cpfValidation( $cpf = false ) {
    // Exemplo de CPF: 025.462.884-23
    $status=false;
    
    if ( ! function_exists('calc_digitos_posicoes') ) {
        function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
            // Faz a soma dos dígitos com a posição
            // Ex. para 10 posições: 
            //   0    2    5    4    6    2    8    8   4
            // x10   x9   x8   x7   x6   x5   x4   x3  x2
            //   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
            for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
                $soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
                $posicoes--;
            }
     
            // Captura o resto da divisão entre $soma_digitos dividido por 11
            // Ex.: 196 % 11 = 9
            $soma_digitos = $soma_digitos % 11;
     
            // Verifica se $soma_digitos é menor que 2
            if ( $soma_digitos < 2 ) {
                // $soma_digitos agora será zero
                $soma_digitos = 0;
            } else {
                // Se for maior que 2, o resultado é 11 menos $soma_digitos
                // Ex.: 11 - 9 = 2
                // Nosso dígito procurado é 2
                $soma_digitos = 11 - $soma_digitos;
            }
     
            // Concatena mais um dígito aos primeiro nove dígitos
            // Ex.: 025462884 + 2 = 0254628842
            $cpf = $digitos . $soma_digitos;
            
            // Retorna
            return $cpf;
        }
    }
    
    // Verifica se o CPF foi enviado
    if ( ! $cpf ) {
         $status=false;
    }
 
    // Remove tudo que não é número do CPF
    // Ex.: 025.462.884-23 = 02546288423
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
 
    // Verifica se o CPF tem 11 caracteres
    // Ex.: 02546288423 = 11 números
    if ( strlen( $cpf ) != 11 ) {
         $status=false;
    }   
 
    // Captura os 9 primeiros dígitos do CPF
    // Ex.: 02546288423 = 025462884
    $digitos = substr($cpf, 0, 9);
    
    // Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
    $novo_cpf = calc_digitos_posicoes( $digitos );
    
    // Faz o cálculo dos 10 dígitos do CPF para obter o último dígito
    $novo_cpf = calc_digitos_posicoes( $novo_cpf, 11 );
    
    // Verifica se o novo CPF gerado é idêntico ao CPF enviado
    if ( $novo_cpf === $cpf ) {
        // CPF válido
        $status=true;
    } else {
        // CPF inválido
         $status=false;
    }

      # Se houver erro
		if (!$status) {
			return $this->messages(1, 'cpf', null, null);
		}
}


	
	// validation phone (01432363810) //erro
	public function phoneValidation($phone) {
		/*if (!eregi("^[0-9]{11}$", $phone)) { 
			return $this->messages(2, 'telefone', null, null);
		}*/
		/*if (!preg_match('/^\([0-9]{2}\)?\s?[0-9]{4,5}-[0-9]{4}$/', $phone)){
			return $this->messages(2, 'telefone', null, null);

		*/
		

			if (!preg_match('#^\(\d{2}\) (9|)[6789]\d{3}-\d{4}$#', $phone) > 0) {
				return $this->messages(2, 'telefone', null, null);
				
			}
	}


	// validation number
			public function numberValidation($field, $number) {
				if(!is_numeric($number)) {
					return $this->messages(3, $field, null, null);
				}
			}


	// simple verification (field empty, max/min of character)
			function simpleValidation($field, $value, $max, $min) {
				$this->field = $field;
				if (empty($value)) {
					return $this->messages(4, $field, $max, $min);
				} 

				elseif (strlen($value) < $min) {
					return $this->messages(6, $field, $max, $min);	
				//return $max;
				}
				elseif (strlen($value) > $max) {
					return $this->messages(5, $field, $max, $min);
				//return "ola  $min";
				} 
			}


	// Verifica se há erros
	public function status() {
		if (empty($this->msg)) {
			return true;
		} else {
			return false;
		}
	}

}



?>
