<?

class Board{
	public $deck;
	public $f_symbols = array(
		'w' => array(
			'r' => '&#9814;',
			'n' => '&#9816;',
			'b' => '&#9815;',
			'q' => '&#9813;',
			'k' => '&#9812;',
			'p' => '&#9817;'
		),
		'b' => array(
			'r' => '&#9820;',
			'n' => '&#9822;',
			'b' => '&#9821;',
			'q' => '&#9819;',
			'k' => '&#9818;',
			'p' => '&#9823;'
		)
	);

	function __construct() {

	}
	
	function create() {
		$Figures = new Figures; 
		$fs = $Figures->getFigures();
		print_r( $fs );
		
		$out = '<table class="card">';
		
		for( $i=1; $i<=8; $i++ ) {
			$out .= '<tr>';
			
			for( $i2=1; $i2<=8; $i2++ ) {

				if ( @$fs['w'][$i][$i2] ) {
					$f = $this->f_symbols['w'][ $fs['w'][$i][$i2] ];
				} elseif ( @$fs['b'][$i][$i2] ) {
					$f = $this->f_symbols['b'][ $fs['b'][$i][$i2] ];
				} else {
					$f = "&nbsp;";
				}

				if ( $i % 2 ) {
					if ( $i2 % 2 ) {
						$class = 'checked';
					} else {
						$class = '';
					}
				} else {
					if ( $i2 % 2 ) {
						$class = '';
					} else {
						$class = 'checked';
					}
				}
				$out .= '<td class='.$class.'>'.$f.'</td>';
			}
		}
		
		echo $out;
	}

}
