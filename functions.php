<?php

function formatPrice(float $price)
{
  return number_format($price, 2, ",",".");
}
function corStatus($valor)
{
	if($valor == "ESTOQUE")
	{
		return "style='background-color: GREEN'";
	}
	else if($valor == "MANUTENÇÂO")
	{
		return "style='background-color: red'";
	}
	else
	{
		return "style='background-color: coral'";
	}
}
?>