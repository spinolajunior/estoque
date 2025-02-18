$('form').on('submit',(e)=>{
		metodo = $(e.target).attr('method').toLowerCase();
		action = $(e.target).attr('action');
		dados = $(e.target).serialize();
		href = $(e.target).attr('data-href');
		if (metodo == "delete" || metodo == "put")
		{
			e.preventDefault();
			$.ajax({
			  data: dados,
			  type: metodo,
			  url: action,
			  success: (data) => {
				if (href=="")
					location.reload();
				else
					location.href = href;
			  }
			});
		}
});
