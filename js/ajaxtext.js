function iniciaAjax()
{
	var objetoAjax = false;
	
	if(window.XMLHttpRequest)
	{
		objetoAjax = new XMLHttpRequest();				
	}
	else				
	
	if(window.ActiveXObjetc)
	{
		try
		{
			objetoAjax = new ActiveXObjetc("Msxml2.XMLHTTP");
		} catch(e)
		{
			try
			{
				objetoAjax = new ActiveXObjetc("Microsoft.XMLHTTP");
			} catch(ex)
			{
				objetoAjax = false;
			}
		}
	}
	
	return objetoAjax;
}

function requisitar(arquivo)
{
	var requisicaoAjax = iniciaAjax();
	
	if(requisicaoAjax)
	{
		requisicaoAjax.onreadystatechange = function()
		{
			mostraResposta(requisicaoAjax); //Função definida a seguir
		};
		requisicaoAjax.open("GET", arquivo, true);
		requisicaoAjax.send(null);
	}
}

function mostraResposta(requisicaoAjax)
{
	if(requisicaoAjax.readyState == 4)
	{
		if(requisicaoAjax.status == 200 || requisicaoAjax.status == 304)
		{
			//alert(requisicaoAjax.responseText);
			alert("Cheguei aqui");
			var insere_aqui = document.getElementById("insere_aqui");
			insere_aqui.innerHTML 
		}
		else
		{
			alert("Problema na comunicação com o servidor");
		}
	}
}
