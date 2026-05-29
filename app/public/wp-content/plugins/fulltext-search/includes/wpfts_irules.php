<?php

class WPFTS_Indexing_Rules
{
	function parseParam($k, $v)
	{
		$ops_allowed_str_num = array(
			'=' => '=',
			'<' => '<', 
			'>' => '>', 
			'>=' => '>=', 
			'<=' => '<=', 
			'!=' => '!=', 
			'eq' => '=', 
			'not_eq' => '!=', 
			'<>' => '!=', 
			'==' => '=', 
			'gt' => '>', 
			'lt' => '<', 
			'gte' => '>=', 
			'lte' => '<=',
		);
		$ops_allowed_array = array(
			'in' => 'in', 
			'not_in' => 'not_in',
		);
	
		$err = array();
		$kk = explode('__', (string)$k);
	
		$op = '';
		$ptype = 0;
		if (is_string($v) || is_numeric($v)) {
			$op = '=';
			$ptype = 1;
		} elseif (is_array($v)) {
			$op = 'in';
			$ptype = 2;
		} else {
			// Error, invalid value (only array or string is accepted)
			$err[] = 'Invalid parameter value: "'.((string)$v).'", type = "'.gettype($v).'", only array, string or numeric are allowed';
		}
	
		if (count($kk) > 1) {
			// Custom operand
			$op = mb_strtolower($kk[1]);
		}
	
		if ($ptype == 1) {
			// Check allowed operands
			if (isset($ops_allowed_str_num[$op])) {
				// Dealiasing
				$op = $ops_allowed_str_num[$op];
			} else {
				$err[] = 'Invalid operation type "'.((string)$op).'" for value of type string or number: "'.$v.'"';
			}
		} elseif ($ptype == 2) {
			// Check allowed operands
			if (isset($ops_allowed_array[$op])) {
				// Dealiasing
				$op = $ops_allowed_array[$op];
			} else {
				$err[] = 'Invalid operation type "'.((string)$op).'" for value of type array: "'.print_r($v, true).'"';
			}
		} else {
			// Wrong operand or value
		}
	
		return array(
			$err, 
			array(
				'__' => $op, 
				$kk[0] => $v,
		));
	}
	
	function parseExpr($expr)
	{
		$allowed_operators = array(
			'&&' => 'and',
			'and' => 'and',
			'||' => 'or',
			'or' => 'or',
			'not' => 'not',
		);
	
		$err = array();
	
		if (!is_array($expr)) {
			$err[] = 'The expressions of type array are only allowed, type = "'.gettype($expr).'", expr = "'.print_r($expr, true).'"';
		} else {
			$op = '';	// Op = 'and' by default
			$plist = array();
			foreach ($expr as $k => $d) {
				if (is_numeric($k)) {
					// Operand or group
					if (is_array($d)) {
						// Group parameter
						$gp = $this->parseExpr($d);
						$plist[] = $gp[1];
						$err = array_merge($gp[0], $err);
					} else {
						if (is_string($d)) {
							if (strlen($op) > 0) {
								// Error, only one operator is allowed, ignore.
								$err[] = 'Only one operator is allowed per expression, ignored. Operator = "'.((string)$op).'"';
							} else {
								// Check if this is valid operator
								$t = strtolower($d);
								if (isset($allowed_operators[$t])) {
									// Dealiasing
									$op = $allowed_operators[$t];
								} else {
									// Operator is not valid
									$err[] = 'Invalid operator "'.((string)$d).'" for expression';
									$op = '';
								}
							}
						} else {
							// Not array or string - error, ignore.
							$err[] = 'Only string/number or array values are allowed, parameter of type "'.gettype($d).'", value = "'.print_r($d, true).'"';
						}
					}
				} else {
					// Parameter
					$t = $this->parseParam($k, $d);
					$plist[] = $t[1];
					$err = array_merge($t[0], $err);
				}
			}
		
			if (strlen($op) < 1) {
				$op = 'and';
			}
			if (count($plist) < 1) {
				// Error - no parameters provided!
				$err[] = 'No valid parameters detected, each expression should have two parameters or more';
			} elseif (count($plist) == 1) {
				// Only one parameter, let's check if $op is unary
				if ($op != 'not') {
					// We should optimize the output by removing unary items that is not "not" items
					return array($err, $plist[0]);
				}
			}
		
			return array($err, array_merge(array($op), $plist));
		}
	
		return array($err, array());
	}
	
	function makeSQL($expr = array(), $prefix = 'p')
	{
		$err = array();

		if (is_array($expr)) {
			if (isset($expr[0])) {
				// Expression
				$opr = strtolower((string)$expr[0]);

				$sql_opr = '';
				$is_unitary = false;
				switch ($opr) {
					case '||':
					case 'or':
						$sql_opr = 'or';
						break;
					case '&&':
					case 'and':
						$sql_opr = 'and';
						break;
					case 'not':
						$sql_opr = 'not';
						$is_unitary = true;
					default:
						// Unknown operator, error
						$err[] = 'Unsupported operator "'.$opr.'"';
				}
	
				// Decode each parameter
				$pars = array();
				for ($i = 1; $i < count($expr); $i ++) {
					if (isset($expr[$i])) {
						$t = $this->makeSQL($expr[$i]);
						if (count($t[0]) < 1) {
							$pars[] = '('.$t[1].')';
						} else {
							// Error in subtree
							$pars[] = '(0)';
							$err = array_merge($t[0], $err);
						}
					}
				}
	
				$sql_expr_kv = '';
				if ($is_unitary) {
					// We only use first value
					if (count($pars) > 0) {
						$sql_expr_kv = $sql_opr.' '.$pars[0];
					} else {
						// Not enough parameters, error
						$err[] = 'Unitary operator "'.((string)$opr).'" requires exactly one parameter, none found.';
					}
	
				} else {
					if (count($pars) > 1) {
						$sql_expr_kv = implode(' '.$sql_opr.' ', $pars);
					} else {
						// Not enough parameters, error
						$err[] = 'Binary operator "'.((string)$opr).'" requires two or more parameters, '.count($pars).' found.';
					}
				}
	
				return array($err, $sql_expr_kv);
	
			} else {
				// Parameter
				$sql_op = '';
				$is_req_single = false;
				$is_req_date = false;
				$is_req_array = false;
	
				$op = '';
				if (isset($expr['__'])) {
					$op = $expr['__'];
				}
				switch ($op) {
					case '=':
					case 'eq':
					case '==':
						// Equal
						$sql_op = '=';
						$is_req_single = true;
						break;
					case '!=':
					case '!==':
					case 'not_eq':
						// Not equal
						$sql_op = '<>';
						$is_req_single = true;
						break;
					case 'in':
						// In array
						$sql_op = 'in';
						$is_req_array = true;
						break;
					case 'not_in':
						// Not in array
						$sql_op = 'not in';
						$is_req_array = true;
						break;
					default:
						$sql_op = '';
						$err[] = 'Unsupported operator "'.$op.'" found';
				}
	
				$sql_kv = array();
				foreach ($expr as $kk => $dd) {
					if ($kk == '__') {
						// Operator, do not process it here
					} else {
						if (strlen($kk) > 0) {
							// Validate key, value and create SQL form
	
							$sql_k = '';
							switch ($kk) {
								case 'post_type':
								case 'post_status':
									$sql_k = $prefix.'.`'.$kk.'`';
									break;
								case 'id':
								case 'ID':
									$sql_k = $prefix.'.`ID`';
									break;
								default:
									// Not supported
									$err[] = 'Unsupported parameter "'.$kk.'" found.';
							}
						}
	
						// Formalize value for MySQL
						$sql_v = '';
						$v = $dd;
						if ($is_req_array) {
							if (!is_array($dd)) {
								// No error, convert single to array silently
								$v = array($dd);
							}
							$ww = array();
							foreach ($v as $k2 => $d2) {
								$ww[] = '"'.addslashes((string)$d2).'"';
							}
							if (count($ww) > 0) {
								$sql_v = '('.implode(',', $ww).')';
							}
						} elseif ($is_req_single) {
							if (is_string($dd) || is_numeric($dd)) {
								// Ok
								$sql_v = '"'.addslashes((string)$dd).'"';
							} else {
								// Error, string or number required
								$err[] = 'This operator "'.$op.'" supports only string or number, type = "'.gettype($dd).'" found';
							}
						}
	
						// Collect
						if ((strlen($sql_op) > 0) && (strlen($sql_k) > 0) && (strlen($sql_v) > 0)) {
							$sql_kv[] = ''.$sql_k.' '.$sql_op.' '.$sql_v.'';
						} else {
							// Something went wrong, error
							
						}
					}
				}
	
				if (count($sql_kv) > 0) {
					return array($err, implode(' and ', $sql_kv));	// Having > 1 values in this array is a strange case, btw
				}
	
				return array($err, '0');	// Safe for MySQL
			}
		} else {
			// We require array here!
			$err[] = 'The expression required to be an array, but type = "'.gettype($expr).'" given. Value = "'.print_r($expr, true).'"';
			return array($err, false);
		}
	}
	
	public function makeHtml($expr = array(), $class_prefix = 'wpfts_expr_')
	{
		$err = array();

		if (is_array($expr)) {
			if (isset($expr[0])) {
				// Expression
				$opr = strtolower((string)$expr[0]);

				$html_opr = '';
				$is_unitary = false;
				switch ($opr) {
					case '||':
					case 'or':
						$html_opr = 'OR';
						break;
					case '&&':
					case 'and':
						$html_opr = 'AND';
						break;
					case 'not':
						$html_opr = 'NOT';
						$is_unitary = true;
					default:
						// Unknown operator, error
						$err[] = 'Unsupported operator "'.$opr.'"';
				}
	
				// Decode each parameter
				$pars = array();
				for ($i = 1; $i < count($expr); $i ++) {
					if (isset($expr[$i])) {
						$t = $this->makeHtml($expr[$i], $class_prefix);
						if (count($t[0]) < 1) {
							$pars[] = '<span class="'.$class_prefix.'param">( '.$t[1].' )</span>';
						} else {
							// Error in subtree
							$pars[] = '(0)';
							$err = array_merge($t[0], $err);
						}
					}
				}
	
				$html_expr_kv = '';
				if ($is_unitary) {
					// We only use first value
					if (count($pars) > 0) {
						$html_expr_kv = '<span class="'.$class_prefix.'op">'.$html_opr.'</span> '.$pars[0];
					} else {
						// Not enough parameters, error
						$err[] = 'Unitary operator "'.((string)$opr).'" requires exactly one parameter, none found.';
					}
	
				} else {
					if (count($pars) > 1) {
						$html_expr_kv = implode(' <span class="'.$class_prefix.'op">'.$html_opr.'</span> ', $pars);
					} else {
						// Not enough parameters, error
						$err[] = 'Binary operator "'.((string)$opr).'" requires two or more parameters, '.count($pars).' found.';
					}
				}
	
				return array($err, $html_expr_kv);
	
			} else {
				// Parameter
				$html_op = '';
				$is_req_single = false;
				$is_req_date = false;
				$is_req_array = false;
	
				$op = '';
				if (isset($expr['__'])) {
					$op = $expr['__'];
				}
				switch ($op) {
					case '=':
					case 'eq':
					case '==':
						// Equal
						$html_op = '=';
						$is_req_single = true;
						break;
					case '!=':
					case '!==':
					case 'not_eq':
						// Not equal
						$html_op = '!=';
						$is_req_single = true;
						break;
					case 'in':
						// In array
						$html_op = 'IN';
						$is_req_array = true;
						break;
					case 'not_in':
						// Not in array
						$html_op = 'NOT IN';
						$is_req_array = true;
						break;
					default:
						$html_op = '';
						$err[] = 'Unsupported operator "'.$op.'" found';
				}
	
				$html_kv = array();
				foreach ($expr as $kk => $dd) {
					if ($kk == '__') {
						// Operator, do not process it here
					} else {
						if (strlen($kk) > 0) {
							// Validate key, value and create SQL form
	
							$html_k = '';
							switch ($kk) {
								case 'post_type':
								case 'post_status':
									$html_k = ''.$kk.'';
									break;
								case 'id':
								case 'ID':
									$html_k = 'ID';
									break;
								default:
									// Not supported
									$err[] = 'Unsupported parameter "'.$kk.'" found.';
							}
						}
	
						// Beautify for HTML
						$html_v = '';
						$v = $dd;
						if ($is_req_array) {
							if (!is_array($dd)) {
								// No error, convert single to array silently
								$v = array($dd);
							}
							$ww = array();
							foreach ($v as $k2 => $d2) {
								$ww[] = '"'.htmlspecialchars((string)$d2).'"';
							}
							if (count($ww) > 0) {
								$html_v = '('.implode(',', $ww).')';
							}
						} elseif ($is_req_single) {
							if (is_string($dd) || is_numeric($dd)) {
								// Ok
								$html_v = '"'.htmlspecialchars((string)$dd).'"';
							} else {
								// Error, string or number required
								$err[] = 'This operator "'.$op.'" supports only string or number, type = "'.gettype($dd).'" found';
							}
						}
	
						// Collect
						if ((strlen($html_op) > 0) && (strlen($html_k) > 0) && (strlen($html_v) > 0)) {
							$html_kv[] = '<span class="'.$class_prefix.'var">'.$html_k.'</span> <span class="'.$class_prefix.'op">'.$html_op.'</span> <span class="'.$class_prefix.'value">'.$html_v.'</span>';
						} else {
							// Something went wrong, error
							
						}
					}
				}
	
				if (count($html_kv) > 0) {
					return array($err, implode(' <span class="'.$class_prefix.'op">AND</span> ', $html_kv));	// Having > 1 values in this array is a strange case, btw
				}
	
				return array($err, '0');	// Safe for MySQL
			}
		} else {
			// We require array here!
			$err[] = 'The expression required to be an array, but type = "'.gettype($expr).'" given. Value = "'.print_r($expr, true).'"';
			return array($err, false);
		}

	}
	
}
