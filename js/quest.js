// Campos de formulário
var parte1 = document.getElementById("parte1")
var parte2 = document.getElementById("parte2")
var parte3 = document.getElementById("parte3")
var parte4 = document.getElementById("parte4")

// Função para esconder itens, e mostrar outros
function proximo(n) {

    if(n === 1){
        parte1.style.display = 'none';
        parte2.style.display = 'flex';
        progessBar('50%')
        subir()
    }else if(n === 2){
        const need = document.getElementsByClassName("need2"); //Campos normais
        const radio = document.getElementsByClassName("need_sex2"); //Campos radio
        const select_parentesco = document.getElementById("select"); //primeiro select

        console.log()

 

        if(verificar(2) == need.length){
            if(radio[0].checked != false || radio[1].checked != false){
            
                if(select_parentesco.selectedIndex != 0){
                    parte2.style.display = 'none';
                    parte3.style.display = 'flex';
                    progessBar('75%')
                    subir()
                }else{
                    alert("Selecione o parentesco entre a vitima e o denunciado")
                }
            }else{
                alert("Selecione o sexo do denunciado")
            }
        }
  
    }else if(n === 3){
        const need = document.getElementsByClassName("need3");
        const radio = document.getElementsByClassName("need_sex3"); //Campos radio
        
        if(verificar(3) == need.length){
            if(radio[0].checked != false || radio[1].checked != false){

                parte3.style.display = 'none';
                parte4.style.display = 'flex';
                progessBar('100%')
                subir()
            }else{
                alert("Selecione o sexo da vitima")
            }
        }
    } 
}

function voltar(n) {
    if(n === 2){
        parte2.style.display = 'none';
        parte1.style.display = 'flex';
        progessBar('25%')
        subir()
    }else if(n === 3){
        parte3.style.display = 'none';
        parte2.style.display = 'flex';
        progessBar('50%')
        subir()
    }else if(n === 4 ){
        parte4.style.display = 'none';
        parte3.style.display = 'flex';
        progessBar('75%')
        subir()
    }
    
}

// Função para verificar campos obrigatórios
function verificar(n){
    var need = [];
    var ok = false
    var c = 0;
    need = document.getElementsByClassName("need"+n);

    
        for(var i = 0; i < need.length; i++){
            need[i] = document.getElementsByClassName("need2")[i];
            
            if(need[i].value === ""){
                alert("Preencha todos os campos obrigatórios corretamente")
                need[i].focus()
                i = need.length;
            }else{
                c++
            }
        }

        return c;
}


function progessBar(porcentagem){
    var bar = document.getElementById("progress_bar");
    bar.style.width = porcentagem;
}

function subir(){
    $("html, body").animate({scrollTop : "80"}, 0);
}