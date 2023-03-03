<div id="menu" class="menu">
    <svg id="menu1" style="top: 0;" class="menupointer" width="116" height="14" viewBox="0 0 116 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7 7H109" stroke="white" stroke-width="14" stroke-linecap="round" />
    </svg>
    <svg id="menu2" style="top: 10px;" class="menupointer" width="116" height="14" viewBox="0 0 116 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7 7H109" stroke="white" stroke-width="14" stroke-linecap="round" />
    </svg>
    <svg id="menu3" style="top: 20px;" class="menupointer" width="116" height="14" viewBox="0 0 116 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7 7H109" stroke="white" stroke-width="14" stroke-linecap="round" />
    </svg>
</div>
<script>
    var site = document.querySelector("body");


    //botão de menu e seus traços
    menu1 = document.querySelector('#menu1');
    menu2 = document.querySelector('#menu2');
    menu3 = document.querySelector('#menu3');


    //criando barra lateral do menu
    menuBox = document.createElement('div');
    menuBox.classList.add('menubox');
    accordions = document.createElement('div');
    accordions.classList.add('accordions');
    menulogo = document.createElement('div');
    menulogo.setAttribute('class', 'imagemmenu');
    menuBox.appendChild(menulogo);
    menudivisoria = document.createElement('div');
    menudivisoria.setAttribute('class', 'menudivisoria');
    menuBox.appendChild(menudivisoria);
    nossomagnifico = document.createElement('div');
    nossomagnifico.setAttribute('class', 'nossomagnifico');
    nossomagnifico.innerHTML = 'Nosso Magnífico';
    menuBox.appendChild(nossomagnifico);
    cardapio = document.createElement('div');
    cardapio.setAttribute('class', 'cardapio');
    cardapio.innerHTML = '<b>CARDÁPIO</b>';
    menuBox.appendChild(cardapio);



    menuBox.appendChild(accordions);

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-pedidos' checked='checked'></input>";
    accordion_label_bebidas = document.createElement('label');
    accordion_label_bebidas.setAttribute('for', 'accordion-pedidos');
    accordion_label_bebidas.innerHTML = 'Pedidos';
    accordions_item.appendChild(accordion_label_bebidas);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-pedidos');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);
    accordion_content.innerHTML += '<a class="link" href="historico_de_pedidos.php">Historico de pedidos</a>';
    accordion_content.innerHTML += '<a class="link" href="dados_pedidos.php">Dados pedidos</a>';

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-lanche'></input>";
    accordion_label_lanche = document.createElement('label');
    accordion_label_lanche.setAttribute('for', 'accordion-lanche');
    accordion_label_lanche.innerHTML = 'Lanches';
    accordions_item.appendChild(accordion_label_lanche);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-lanche');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);
    accordion_content.innerHTML += '<a class="link" href="lanches.php">Visualizar lanches</a>';
    accordion_content.innerHTML += '<a class="link" href="criar_lanche.php">Criar lanche</a>';
    accordion_content.innerHTML += '<a class="link" href="excluir_lanche.php">Excluir lanche</a>';

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-adicionais'></input>";
    accordion_label_adicionais = document.createElement('label');
    accordion_label_adicionais.setAttribute('for', 'accordion-adicionais');
    accordion_label_adicionais.innerHTML = 'Ingredientes';
    accordions_item.appendChild(accordion_label_adicionais);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-adicionais');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);
    accordion_content.innerHTML += '<a class="link" href="adicionais.php">Visualizar ingredientes</a>';
    accordion_content.innerHTML += '<a class="link" href="criar_adicional.php">Criar ingrediente</a>';
    accordion_content.innerHTML += '<a class="link" href="excluir_adicional.php">Excluir ingrediente</a>';

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-bebidas'></input>";
    accordion_label_bebidas = document.createElement('label');
    accordion_label_bebidas.setAttribute('for', 'accordion-bebidas');
    accordion_label_bebidas.innerHTML = 'Bebidas';
    accordions_item.appendChild(accordion_label_bebidas);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-bebidas');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);
    accordion_content.innerHTML += '<a class="link" href="bebidas.php">Visualizar bebidas</a>';
    accordion_content.innerHTML += '<a class="link" href="criar_bebida.php">Criar bebida</a>';
    accordion_content.innerHTML += '<a class="link" href="excluir_bebida.php">Excluir bebida</a>';

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-combos'></input>";
    accordion_label_combos = document.createElement('label');
    accordion_label_combos.setAttribute('for', 'accordion-combos');
    accordion_label_combos.innerHTML = 'Combos';
    accordions_item.appendChild(accordion_label_combos);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-combos');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);
    accordion_content.innerHTML += '<a class="link" href="combos.php">Visualizar combos</a>';
    accordion_content.innerHTML += '<a class="link" href="criar_combo.php">Criar combo</a>';
    accordion_content.innerHTML += '<a class="link" href="excluir_combo.php">Excluir combo</a>';


    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-combos'></input>";
    accordion_label_combos = document.createElement('label');
    accordion_label_combos.setAttribute('for', 'accordion-combos');
    accordion_label_combos.innerHTML = '<a href="index.php">Config</a>';
    accordions_item.appendChild(accordion_label_combos);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-combos');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);

    accordions_item = document.createElement('div');
    accordions_item.classList.add('accordions-item');
    accordions.appendChild(accordions_item);
    accordions_item.innerHTML = "<input type='radio' name='menu' id='accordion-combos'></input>";
    accordion_label_combos = document.createElement('label');
    accordion_label_combos.setAttribute('for', 'accordion-combos');
    accordion_label_combos.innerHTML = '<a href="lixeira.php">Lixeira</a>';
    accordions_item.appendChild(accordion_label_combos);
    accordion_content = document.createElement('div');
    accordion_content.setAttribute('id', 'content-combos');
    accordion_content.classList.add('accordion-content');
    accordions_item.appendChild(accordion_content);

    //variável que indica se o menu esta ou não ativado
    m = false;
    var menu = document.querySelector('#menu');

    //adicionando evendo pra chamar o menu
    menu.addEventListener("click", function() {
        //se ti ver apertado o botão X, ele tira a barra lateral e transforma o botão X em de menu
        if (m) {
            j = site.lastChild;
            setTimeout(function() {
                //colocando o botão de menu como filho do body
                site.appendChild(menu);
            }, 1000)
            gerar_Menu();
            menuBox.style = "box-shadow: 0px 0px 0vw black;";
            setTimeout(function() {
                site.removeChild(j);
            }, 1000)


            //transforma o botão X de volta para botão de menu
            setTimeout(function() {
                menu2.style.width = "30px";
                menu2.style.top = '10px';
                menu1.style.transform = "rotate(0)";
                menu1.style.top = "0";
                menu3.style.transform = "rotate(0)";
                menu3.style.top = "20px";
                m = false;
            }, 100)
        }

        //se tiver apertado o botão de menu, ele cria a barra lateral e transforma o botão de menu em X
        else {
            //colocando o botão de menu como filho da barra lateral

            site.appendChild(menuBox);
            setTimeout(function() {
                menuBox.style = "box-shadow: 100px 0px 100vw black;"
            }, 300);
            setTimeout(gerar_Menu(), 300);

            //transforma o botão de menu em X
            setTimeout(function() {
                menu2.style.width = "0";
                menu1.style.transform = "rotate(45deg)";
                menu1.style.top = "10px";
                menu3.style.transform = "rotate(-45deg)";
                menu3.style.top = "10px";
                m = true;
            }, 100)
        }
    })



    //animação de menu andando
    function gerar_Menu() {
        //esta função faz o deslocamento que vemos no menu
        if (m) {
            menuBox.style.transform = 'translateX(-350px)'
        } else {
            setTimeout(function() {
                menuBox.style.transform = 'translateX(0)'
            }, 300);
        }

    }


    function enviar(id) {
        form = document.querySelector(id);
        form.submit();
    }
</script>