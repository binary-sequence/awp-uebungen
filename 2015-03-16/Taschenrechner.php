<?php
	session_start('calculator');

	if (!isset($_SESSION['CALCULATOR_RESULT_HISTORY'])) {
		$_SESSION['CALCULATOR_RESULT_HISTORY'] = array();
	}

	if (isset($_POST['txtN1'])) {
		$txtN1 = $_POST['txtN1'];
	} else {
		$txtN1 = 0;
	}

	if (isset($_POST['txtN2'])) {
		$txtN2 = $_POST['txtN2'];
	} else {
		$txtN2 = 0;
	}

	if (isset($_POST['txtResult'])) {
		$result = $_POST['txtResult'];
	} else {
		$result = 0;
	}

	if (isset($_POST['btnCalculate'])) {
		switch ($_POST['cmbOperator']) {
			case '+':
				$result = $txtN1 + $txtN2;
				break;
			case '-':
				$result = $txtN1 - $txtN2;
				break;
			case '*':
				$result = $txtN1 * $txtN2;
				break;
			case '/':
				$result = $txtN1 / $txtN2;
				break;
			case 'x^y':
				$result = pow($txtN1, $txtN2);
				break;
		}

		array_push($_SESSION['CALCULATOR_RESULT_HISTORY'], $result);
	}

	if (isset($_POST['btnClearScreen'])) {
		$txtN1 = 0;
		$txtN2 = 0;
		$result = 0;
	}

	if (isset($_POST['btnSaveValue'])) {
		$_SESSION['CALCULATOR_MEMORY_RESULT'] = $result;
	}

	if (isset($_POST['btnLoadValue'])) {
		$txtN1 = $_SESSION['CALCULATOR_MEMORY_RESULT'];
	}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Taschenrechner</title>
	<link rel="stylesheet" type="text/css" href="Taschenrechner.css" />
</head>
<body>

<h1>Taschenrechner</h1>

<form method="POST">
	<table>
		<tbody>
			<tr>
				<td>Operand 1</td>

				<td>Operator</td>

				<td>Operand 2</td>

				<td> </td>

				<td>Ergebnis</td>

				<td rowspan="3">
					<label for="txtResultHistory">Letzten Ergebnisse</label>

					<br/>

					<textarea name="txtResultHistory" id="txtResultHistory" cols="16" rows="10" disabled><?php
						foreach ($_SESSION['CALCULATOR_RESULT_HISTORY'] as $value) {
							echo $value . "\n";
						}
					?></textarea>
				</td>
			</tr>

			<tr>
				<td>
					<input type="text" name="txtN1" value="<?php echo $txtN1; ?>" />
				</td>

				<td>
					<select name="cmbOperator">
						<?php
							$operators = array('+', '-', '*', '/', 'x^y');

							foreach ($operators as $value) {
								if (isset($_POST['cmbOperator']) and $_POST['cmbOperator'] == $value) {
									$selected = 'selected';
								} else {
									$selected = '';
								}

								echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
							}
						?>
					</select>
				</td>

				<td>
					<input type="text" name="txtN2" value="<?php echo $txtN2; ?>" />
				</td>

				<td>=</td>

				<td>
					<input type="text" name="txtResult" value="<?php echo $result; ?>" />
				</td>
			</tr>

			<tr>
				<td colspan="5">
					<input type="submit" name="btnCalculate" value="Berechnen" class="wide" />

					<input type="submit" name="btnClearScreen" value="C" class="wide" />

					<input type="submit" name="btnSaveValue" value="M+" class="wide" />

					<input type="submit" name="btnLoadValue" value="MR" class="wide" />
				</td>
			</tr>
		</tbody>
	</table>
</form>

</body>
</html>
