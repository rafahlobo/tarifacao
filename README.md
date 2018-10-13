## Tarifação - telefonia
Script que calcula o valor de dada ligação considerando a tarifa (por minuto - **float**), duração (em segundos - **int** ) e cadência (formato "a+b+c" - **string**), onde a = tempo inicial, b = tempo mínimo e c =incremento. 

 Exemplo de cadência:
	 "3+30+6"
	 Ou seja, comece a tarificar após **3 segundos**. Antes dos 3 segundos o tarifa é zero. Após, cobre o valor referente a **30 segundos**. Quando completar os 30 segundos, incremente o tempo em 6 segundos.

Exemplo prático :
	Joãozinho ligou  para Maria. Joãozinho falou 31 segundos e desligou. Joãozinho pagará uma tarifa proporcional a 36 segundos, considerando a cadência de "3+30+6".

Debug :	
Valor da tarifca por minuto = R$ 1,00;

 1. Joãozinho ligou. ( Tempo cobrado : 0 s) - (Tempo real em linha : 0 s )
 2. Maria atendeu. ( Tempo cobrado : 0 s) - (Tempo real em linha : 0 s )
 3. Completou 3 segundos.  ( Tempo cobrado : 30 s) - (Tempo real em linha : 3 s )
 4.  Falou, falou .  ( Tempo cobrado : 30 s) - (Tempo real em linha : 15 s )
 5. Falou mais.  ( Tempo cobrado : 30 s) - (Tempo real em linha : 20 s )
 6. E mais.  ( Tempo cobrado : 30 s) - (Tempo real em linha : 25 s )
 7. ...  ( Tempo cobrado : 30 s) - (Tempo real em linha : 30 s )
 8. Joãozinho deu tchau.  ( Tempo cobrado : 36 s) - (Tempo real em linha : 31 s )
 9. Se Maria gastasse mais alguns segundos para se despedir.  ( Tempo cobrado : 36 s) - (Tempo real em linha : 35 s )
 10. Maria lembrou de algo..  ( Tempo cobrado : 42 s) - (Tempo real em linha : 38 s )  

	 
## Código
    <?php
	    include "tarifacao.php";
	    $valor_ligacao  = calc_tarifa(1.0 , 38, "3+30+6");
	    echo "Joaozinho pagará   $valor_ligacao  reais";
	    
