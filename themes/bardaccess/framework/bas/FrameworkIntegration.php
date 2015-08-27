<?php
/*--------------------------------------*/
/* Integrate with a Framework
/* In this case, Titan Framework
/*--------------------------------------*/

    /**
     * Returns the value
     *
     * @return var
     */
	if ( !function_exists('bas_get_from_titan_framework') ) {
		function bas_get_from_titan_framework($value) 
		{
			$titan = TitanFramework::getInstance( 'bas-intranet' );
			return $titan->getOption( $value );
		}
	}


    /**
     * Returns the value
     *
     * @return var
     */
	if ( !function_exists('get') ) {
		function get($value) 
		{
			return bas_get_from_titan_framework($value);
		}
	}


