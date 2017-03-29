<?
class Figures{
	public $figures;
	public $currentPlayer = 'w';
	public $opositePlayer = 'b';
	public $vainMoves = 0;
	public $moves = 0;
	public $castling = array(
		'w' => 0,
		'b' => 0
	);
	
	function __construct() {
		$this->setFigures();
	}
	function setFigures() {
		$figures = array();
		
		$figures['b'][1][1] = 'r';
		$figures['b'][1][2] = 'n';
		$figures['b'][1][3] = 'b';
		$figures['b'][1][4] = 'k';
		$figures['b'][1][5] = 'q';
		$figures['b'][1][6] = 'b';
		$figures['b'][1][7] = 'n';
		$figures['b'][1][8] = 'r';
		$figures['b'][2][1] = 'p';
		$figures['b'][2][2] = 'p';
		$figures['b'][2][3] = 'p';
		$figures['b'][2][4] = 'p';
		$figures['b'][2][5] = 'p';
		$figures['b'][2][6] = 'p';
		$figures['b'][2][7] = 'p';
		$figures['b'][2][8] = 'p';

		$figures['w'][7][1] = 'p';
		$figures['w'][7][2] = 'p';
		$figures['w'][7][3] = 'p';
		$figures['w'][7][4] = 'p';
		$figures['w'][7][5] = 'p';
		$figures['w'][7][6] = 'p';
		$figures['w'][7][7] = 'p';
		$figures['w'][7][8] = 'p';
		$figures['w'][8][1] = 'r';
		$figures['w'][8][2] = 'n';
		$figures['w'][8][3] = 'b';
		$figures['w'][8][4] = 'k';
		$figures['w'][8][5] = 'q';
		$figures['w'][8][6] = 'b';
		$figures['w'][8][7] = 'n';
		$figures['w'][8][8] = 'r';

		$this->figures = $figures;
		
	}
	
	function getFigures() {
		return $this->figures;
	}
	
	function switchPlayer() {
		 list( $this->currentPlayer, $this->opositePlayer) = array( $this->opositePlayer, $this->currentPlayer );
	}
	
	function getPossibleMoves( $x, $y, $f ) {
		$possibleMoves = array();
			switch ( $f ) {
				case 'p':
					if ( $this->currentPlayer === 'w' ) {
						$xn1 = $x-1;
						if ( $xn1 >=1 ) {
							$possibleMoves[] = array( $xn1, $y );
						}
						if ( $x === 7 ) {
							$possibleMoves[] = array( $x-2, $y );
						}
						
						if ( @$this->figures[$this->opositePlayer][$x-1][$y-1] ) {
							$possibleMoves[] = array( $x-1, $y-1 );
						}	
						
						if ( @$this->figures[$this->opositePlayer][$x-1][$y+1] ) {
							$possibleMoves[] = array( $x-1, $y+1 );
						}	
						
					} else {
						$xn1 = $x+1;
						if ( $xn1 <=8 ) {
							$possibleMoves[] = array( $x, $y );
						}
						
						if ( $x === 2 ) {
							$possibleMoves[] = array( $x+2, $y );
						}
						
						if ( @$this->figures[$this->opositePlayer][$x+1][$y+1] ) {
							$possibleMoves[] = array( $x+1, $y+1 );
						}	
						
						if ( @$this->figures[$this->opositePlayer][$x+1][$y-1] ) {
							$possibleMoves[] = array( $x+1, $y-1 );
						}	
					}
					break;
				case 'r':
					for( $i = 1; $i <= 8; $i++ ) {
						if ( $i !== $y) {
							$possibleMoves[] = array( $x, $i );
						}
						if ( $i !== $x) {
							$possibleMoves[] = array( $i, $y );
						}
					}

					break;
					
				case 'n':
					
					$possibilitiesXY = array(
						array( $x - 2, $y - 1 ),
						array( $x - 1, $y - 2 ),
						array( $x - 2, $y + 1 ),
						array( $x - 1, $y + 2 ),
						array( $x + 1, $y - 2 ),
						array( $x + 2, $y + 1 ),
						array( $x + 1, $y + 2 ),
						array( $x - 2, $y - 1 )
					);

					foreach ( $possibilitiesXY as $pXY ) {
						if ( $pXY[0] >= 1 && $pXY[1] >= 1 && $pXY[0] <= 8 && $pXY[1] <= 8 ) {
							$possibleMoves[] = array( $pXY[0], $pXY[1] );
						}
					}

					
					break;
					
				case 'k':
						$possibleMoves_tmp[] = array( $x-1, $y-1 );
						$possibleMoves_tmp[] = array( $x-1, $y+1 );
						$possibleMoves_tmp[] = array( $x+1, $y+1 );
						$possibleMoves_tmp[] = array( $x+1, $y-1 );
						$possibleMoves_tmp[] = array( $x+1, $y );
						$possibleMoves_tmp[] = array( $x-1, $y );
						$possibleMoves_tmp[] = array( $x, $y+1 );
						$possibleMoves_tmp[] = array( $x, $y-1 );
						
						foreach( $possibleMoves as $pm ) {
							if ( $pm[0] >= 1 && $pm[0] <= 8 && $pm[1] >= 1 && $pm[1] <= 8) {
								$possibleMoves[] = $pm;
							}
						}

					break;
					
				case 'q':
					$possibleMoves[] = $this->getPossibleMoves( $x, $y, 'b' );
					$possibleMoves[] = $this->getPossibleMoves( $x, $y, 'r' );

					break;
				
				case 'b':
					$i=1;
					$xn1 = $x;
					$xn2 = $x;
					$yn1 = $y;
					$yn2 = $y;
					$end = false;
					$end1 = false;
					$end2 = false;
					$end3 = false;
					$end4 = false;
					while( $end !== true ) {
						$xn1 = $x-$i;
						$yn1 = $y-$i;
						
						$xn2 = $x+$i;
						$yn2 = $y+$i;
						
						if ( $xn1 >= 1 && $yn1 >= 1 ) {
							$possibleMoves[] = array( $xn1, $yn1 );
						} else {
							$end1 = true;
						}
						
						if ( $xn2 <= 8 && $yn2 <= 8 ) {
							$possibleMoves[] = array( $xn2, $yn2 );
						} else {
							$end2 = true;
						}
						
						if ( $xn1 >= 1 && $yn2 <= 8 ) {
							$possibleMoves[] = array( $xn1, $yn2 );
						} else {
							$end3 = true;
						}
					
						if ( $xn2 <= 8 && $yn1 >= 1 ) {
							$possibleMoves[] = array( $xn2, $yn1 );
						} else {
							$end4 = true;
						}
						
						if ( $end1 && $end2 && $end3 && $end4 ) {
							$end = true;
						}
						
						$i++;
					}
					
				default:
					break;
			}
			
			return $possibleMoves;
	}
	
	function checkMove( $x, $y, $f ) {
		
	}
	
	function canMove( $x, $y, $f ) {
		
	}

	function move( $x, $y, $f ) {
		$possibleMoves = $this->getPossibleMoves( $x, $y, $f );
		print_r($possibleMoves);
		
			switch ( $f ) {
				case 'r':

					break;

				default:
					break;
			}

	}
	
	function makeMove() {
		
		$f_array = $this->figures[ $this->currentPlayer ];
		
		$x = array_rand($f_array, 1);
		$y = array_rand( $f_array[$x], 1 );
		$f = $f_array[$x][$y];

//		print_r( $rand_f );
//		return $rand_f;
		

//		$this->move( $x, $y, $f );
//		$this->move( 8, 1, 'r' );
		$this->move( 7, 4, 'p' );
//		return 'b';
		
		
		$this->switchPlayer();
		
	}

}


//pawn пешка
//bishop слон
//rook ладья
//knight конь
//king король
//queen ферзь