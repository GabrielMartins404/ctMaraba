    //Parte 1 da funcção abaixo
    $("#cep").blur(function(e){ //Esse blur é quando eu clico na caixa e depois saio
        var cep = $("#cep").val(); //o val pega qual valor foi digitado
        
        
        console.log(cep)
        var validar = true
        
        if(validar){ 
            pesquisar(cep)
        }else{
            $("#mensagem p").html("CEP inválido")
        }
        }
    )

    //Era para pesquisar e preencher o endereço de acordo com o cep digitado
    function pesquisar(endereco){
            if(endereco.length != 0){
            $.ajax({
                type:"GET",
                url:"https://viacep.com.br/ws/"+ endereco +"/json/",
                async:false
            }).done(function(data){
                //console.log(data)

                $("#endereco").val(data.logradouro)
                $("#cidade").val(data.localidade)
                $("#estado").val(data.uf)
                $("#bairro").val(data.bairro)
            
            }).fail(function(){
                console.log("Falha")
            })
        }
    }

    function falha(){
        console.log("Falha")
    }

    //Funcção que adciona novos campo de contato de acordo com o click
    var contador = 0
    $("#add").click(function(){
        contador++
        $( "#contato" ).append( '<div class="mb-3 div_remove" id="cont'+contador+'" >  <button type="button" class="btn btn-danger btn_remove" id="'+contador+'" style="height: 40px;"> X </button></label> <input type="text" class="form-control mb-3 tel" name="contato[]" id="teste'+contador+'" aria-describedby="emailHelp"></div>' )
    })

    //função para excluir itens
    $( "form" ).on( "click", ".btn_remove", function() {
        var button_id = $(this).attr("id");
        $('#cont'+button_id+'').remove()
    });

      //Função pra adicionar campos php
    

    //   Função de bloquar conselheiro
    function bloquear(id, senha_user){
        var conf = confirm("Deseja realmente mudar o acesso desse conselheiro?")
        if(conf){
            var senha = prompt("Para sua segurança, digite sua senha de login")
            if(senha == senha_user){
                $.ajax({
                type: "POST",
                url: "bloquear.php?id="+id, //local onde será ,amdado os dados
                async:false
                }).done(function(data){
                    alert(data)
                    window.location.reload()
                })
            }else{
                alert("Senha incorreta")
            }
        }
    }