<style>
    @font-face {
        font-family: 'LEMONMILK-Medium';
        src: url('../fontes/LEMONMILK-Medium.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'hello honey';
        src: url('../fontes/hello honey.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'futura-nd-light-scosf';
        src: url('../fontes/futura-nd-light-scosf.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    * {
        user-select: none;
        padding: 0;
        margin: 0;

        font-family: 'futura-nd-light-scosf', sans-serif;
    }


    ::-webkit-scrollbar {
        width: 0px;
    }

    html {
        overflow: hidden;
        overflow-x: hidden;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-image: url('../fontes/Frame23.png');
        background-repeat: no-repeat;
        background-position: center top;
        background-size: auto;
        overflow-y: hidden;
    }

    body {
        position: fixed;
        height: 100%;
        width: 100%;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    main {
        background-image: url('../fontes/Frame21.png');
        background-repeat: no-repeat;
        background-position: center top;
        background-size: auto;
        padding-left: 7%;
        padding-right: 7%;
        width: 86%;
        max-width: 500px;
        height: 100%;
        overflow-x: hidden;
        overflow-y: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 20px;

    }

    .excluir {
        width: 30px;
        height: 30px;
        background-color: red;
        position: relative;
        top: -15px;
        left: 91%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        cursor: pointer;
    }

    .corpo {
        width: 100%;
        height: 100%;
        padding: 2px;
        overflow-y: scroll;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    main,
    body {
        display: flex;
        align-items: center;
        flex-direction: column;
    }



    select {
        width: 100%;
        margin-top: 2px;
        margin-bottom: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        height: 50px;
        font-size: 140%;
        border: none;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
    }

    .input {
        margin-top: 2px;
        margin-bottom: 20px;
        width: 98%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        height: 50px;
        font-size: 140%;
        border: none;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
    }

    textarea:focus {
        outline: 1px solid rgba(240, 68, 33, 1);
    }

    input[type='file'] {
        display: none;
    }

    #form {
        font-family: 'futura-nd-light-scosf', sans-serif;
    }

    .selecionar_imagem {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        outline: 1px solid rgba(117, 117, 117, 1);
        display: flex;
        justify-content: center;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .selecionar_imagem>label {
        font-size: 120%;
        cursor: pointer;
        color: rgba(117, 117, 117, 1);
    }

    #footer {
        width: 100%;
        height: 100px;
        background-color: rgba(255, 113, 84, 1);
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
    }

    .h1 {
        width: 100%;
        text-align: center;
        font-size: 400%;
        font-family: 'hello honey';
        margin-top: 5%;
        margin-bottom: 5%;
        color: rgba(241, 68, 33, 1);
    }

    #adicionar_bebida,
    #adicionar_lanche,
    #adicionar_combo {
        font-family: 'hello honey';
        color: rgba(241, 68, 33, 1);
        font-size: 370%;
        display: flex;
        text-align: -webkit-center;
        justify-content: center;
        align-items: center;
        width: 100%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        margin-top: 20px;

    }

    #adicionar_bebida,
    #adicionar_lanche {
        cursor: pointer;
        outline: 1px solid rgba(241, 68, 33, 1);
    }

    .enviar,
    .voltar {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .enviar {
        background-color: rgba(25, 135, 84, 1) !important;
    }

    #pdf,
    #form>input,
    .card-title,
    .enviar,
    .submit,
    input[type='submit'],
    label {
        font-family: 'LEMONMILK-Medium';
    }

    #pdf,
    #form>input,
    .enviar,
    .voltar,
    .submit,
    input[type='submit'] {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        width: 100%;
        height: 50px;
        font-size: 150%;
        border: none;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        background-color: rgba(32, 34, 39, 1);
        color: #fff;
        cursor: pointer;
        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
        text-align: center;
    }

    #pdf {
        margin-bottom: 20px;
        margin-top: 20px;
    }

    #pdf,
    #form>input,
    .enviar:hover,
    .voltar:hover,
    .submit:hover,
    input[type='submit']:hover {
        padding-top: 2px;
        font-size: 170%;
    }

    .adc {
        margin-top: 20px;
        width: 100%;
        text-align: center;
        font-size: 140%;
        border: none;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        background-image: linear-gradient(rgba(255, 113, 84, 1), rgba(241, 68, 33, 1));
        cursor: pointer;
    }


    #textarea {
        display: flex;
        flex-direction: column;
    }

    .blocos {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
    }

    textarea {
        padding-left: 2%;
        border: none;
        width: 98%;
        height: 200px;
        outline: none;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        outline: 1px solid rgba(117, 117, 117, 1);
        resize: none;
        font-size: 140%;
    }



    label {
        font-size: 250%;
    }


    .pesquisa {
        display: flex;
        flex-direction: row;
    }

    .pesquisa>svg {
        cursor: pointer;
        width: 45px;
        padding: 5px;
        height: 40px;
        margin: 0;
        outline: 3px solid black;
        background-color: rgba(240, 68, 33, 1);
    }


    /*Cartão*/
    #cartao {
        width: 100%;
        min-height: 590px;
        margin-top: 20px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        margin-bottom: 20px;
        outline: 1px solid rgba(191, 191, 191, 1);
    }

    .atencao {
        background-color: rgba(255, 197, 197, 1);
        outline: 1px solid rgba(255, 0, 0, 1);
        padding: 5%;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 10px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        width: 90%;
        max-height: 800px;
    }

    .sucesso {
        background-color: rgba(197, 255, 209, 1);
        outline: 1px solid rgba(0, 194, 8, 1);
        padding: 5%;
        text-align: center;
        margin-bottom: 10px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        width: 90%;
        max-height: 800px;
    }

    .card {
        padding: 2%;
        background-color: #fff;
        outline: 1px solid rgba(191, 191, 191, 1);
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        width: 96%;
    }

    .cardadicional {
        padding-left: 2%;
        padding-right: 2%;
        background-color: #fff;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        width: 96%;
        max-height: 800px;
        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
    }

    .combos,
    .lanches {
        cursor: pointer;
        width: 100%;
        display: flex;
    }

    .combos>.card,
    .lanches>.card {
        width: 70%;
        justify-content: center;
        align-items: center;
        border-radius: 0 10px 10px 0;
    }

    .card-img-top {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 30%;
        border-radius: 10px 0 0 10px;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .card-body {
        width: 98%;
        display: flex;
        align-items: center;
    }

    .card-title {
        font-size: 17px;
        margin-left: 10px;
        width: 70%;
    }

    .title {
        font-family: 'LEMONMILK-Medium';
        width: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .direita {
        width: 30%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: right;
    }

    .btn {
        margin-right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 100%;
        -webkit-border-radius: 100%;
        background-color: rgba(241, 68, 33, 1);
        color: white;

    }

    .btn>sup {
        font-family: 'LEMONMILK-Medium';
        font-size: 10px;
        margin-bottom: 10px;
    }

    .btn>p {
        font-family: 'LEMONMILK-Medium';
        font-size: 15px;

    }

    .btn>input {
        margin: 2px;
        width: 100%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        font-size: 25px;

    }

    .card-text {
        font-size: 80%;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    /*Adicionais*/

    .adicional {
        padding: 5%;
        width: 90%;
        display: flex;
        align-items: center;
    }

    .adicional>.pontos {
        border-bottom: 1px dashed black;
        height: 15px;
    }

    .adicional>.nome {
        margin-right: 5px;
    }

    .adicional>.preco {
        text-align: right;
        margin-left: 5px;
    }

    #somar2,
    #somar1 {
        padding: 2px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;

        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
        height: 0;
        overflow: hidden;
    }

    .adicionaradicional {
        font-family: 'futura-nd-light-scosf', sans-serif;
        font-size: 100%;
        width: 100%;
        height: 30px;
        background-color: rgba(241, 68, 33, 1);
        border-radius: 5px;
        -webkit-border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        margin-bottom: 5px;
    }

    #somar3 {
        padding: 2px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;

        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
        overflow: hidden;
    }

    .card>.informa_quantidade {
        margin-top: 15px;
        margin-bottom: 5px;
    }

    .informa_quantidade {
        display: flex;
        margin-top: 5px;
        margin-bottom: 15px;
        min-height: 50px;
    }

    .informa_quantidade>p {
        background-color: #fff;
        width: 88%;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
        font-size: 140%;
        display: flex;
        align-items: center;
        height: 50px;
        border-radius: 5px 0px 0px 5px;
        -webkit-border-radius: 5px 0px 0px 5px;
    }

    .informa_quantidade>.valor {
        display: flex;
        align-items: center;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        font-size: 140%;
        border: none;
        background-color: #fff;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
        width: 10%;
        height: 50px;
        border-radius: 0px 5px 5px 0px;
        -webkit-border-radius: 0px 5px 5px 0px;
    }

    .informa_preco {
        display: flex;
        margin-top: 15px;
        margin-bottom: 15px;
        align-items: center;
    }

    #taxa {
        margin: 0;
    }

    .cardlista {
        width: 95%;
        padding: 2.5%;
        background-color: #fff;
        outline: 1px solid rgba(191, 191, 191, 1);
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        max-height: 800px;
    }

    .informa_preco>p {
        background-color: #fff;
        width: 75%;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
        font-size: 110%;
        display: flex;
        align-items: center;
        height: 50px;
        border-radius: 5px 0px 0px 5px;
        -webkit-border-radius: 5px 0px 0px 5px;
    }


    .informa_preco>.valor {
        display: flex;
        align-items: center;
        height: 50px;
        font-size: 130%;
        border: none;
        background-color: #fff;
        outline: 1px solid rgba(117, 117, 117, 1);
        padding-left: 2%;
        display: flex;
        width: 25%;
        border-radius: 0px 5px 5px 0px;
        -webkit-border-radius: 0px 5px 5px 0px;
    }

    .lista {
        width: 100%;
        display: flex;
        margin-top: 15px;
        align-items: center;
    }

    .lista>p {
        background-color: #fff;
        width: 70%;
        border: 1px solid rgba(117, 117, 117, 1);
        border-right: 0;
        padding-left: 2%;
        font-size: 110%;
        display: flex;
        align-items: center;
        height: 50px;
        border-radius: 5px 0px 0px 5px;
        -webkit-border-radius: 5px 0px 0px 5px;
    }

    .lista>.linhatracejada {
        flex-grow: 1;
        background-color: #fff;
        border: 1px solid rgba(117, 117, 117, 1);
        border-right: 0;
        border-left: 0;
        align-items: center;
        height: 50px;
    }

    .lista>.valor {
        display: flex;
        align-items: center;
        justify-content: right;
        padding-right: 5px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        height: 50px;
        font-size: 110%;
        border: none;
        background-color: #fff;
        border: 1px solid rgba(117, 117, 117, 1);
        border-left: 0;
        padding-left: 2%;
        display: flex;
        width: 30%;
        border-radius: 0px 5px 5px 0px;
        -webkit-border-radius: 0px 5px 5px 0px;
    }

    .valor>input {
        font-size: 100%;
        width: 100%;
        border: none;
    }

    input:focus {
        outline: 1px solid rgba(241, 68, 33, 1);
    }

    .valor>input:focus {
        outline: none;
    }


    .sumiu {
        visibility: hidden;
        position: absolute;
    }

    #adicionar_pedido1,
    #adicionar_pedido2,
    #adicionar_pedido3 {
        border-radius: 5px;
        -webkit-border-radius: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .informa_adicionais>.accordions {
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        font-size: 140%;
        border: none;
        outline: 1px solid rgba(117, 117, 117, 1);
    }

    .adicionais>label {
        font-size: 20px;
        margin: 2%;
    }

    .restaurar>label {
        font-size: 20px;
        font-family: 'futura-nd-light-scosf', sans-serif;
    }

    .restaurar {
        overflow: hidden;
    }

    input[type="checkbox"]:focus {
        outline: none;
        border: none;
    }

    .entrega {
        height: 40px;
        margin-top: 20px;
        white-space: 100%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        outline: 1px solid rgba(117, 117, 117, 1);
        display: flex;
        background-color: #fff;
        margin-bottom: 10px;
    }

    .entrega>label {
        cursor: pointer;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        padding: 2%;
        text-align: center;
        width: 46%;
        font-size: 17px;
        font-family: 'futura-nd-light-scosf', sans-serif;
    }

    #entregaativada:checked~#lentregaativada,
    #entregadesativada:checked~#lentregadesativada,
    #pedidoativada:checked~#lpedidoativada,
    #pedidodesativada:checked~#lpedidodesativada {
        background-color: rgba(241, 68, 33, 1);
    }


    #textpedido,
    #taxa,
    #textentrega,
    #informa_telefone {
        overflow: hidden;
        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
        padding: 1px;

    }

    .informa_telefone {
        display: flex;
        align-items: center;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        height: 50px;
        border: none;
        background-color: #fff;
        display: flex;
        width: 100%;
    }

    .informa_telefone>input[name='pais'] {
        font-size: 140%;
        text-align: center;
        border: none;
        width: 20%;
        height: 50px;
        border-radius: 5px 0px 0px 5px;
        -webkit-border-radius: 5px 0px 0px 5px;
        outline: 1px solid rgba(117, 117, 117, 1);
    }

    .informa_telefone>input[name='ddd'] {
        font-size: 140%;
        text-align: center;
        border: none;
        width: 20%;
        height: 50px;
        outline: 1px solid rgba(117, 117, 117, 1);
    }

    .informa_telefone>input[name='telefone'] {
        font-size: 140%;
        text-align: center;
        border: none;
        width: 60%;
        height: 50px;
        border-radius: 0px 5px 5px 0px;
        outline: 1px solid rgba(117, 117, 117, 1);
    }

    .pedido {
        overflow-y: scroll;
        margin-top: 20px;
        padding-left: 2%;
        padding-right: 2%;
        border: none;
        width: 96%;
        outline: none;
        border-radius: 5px 5px 0 0;
        outline: 1px solid rgba(241, 68, 33, 1);
        background-color: #fff;
        resize: none;
        font-size: 140%;
        max-height: 400px;
    }

    .valorpedido {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'LEMONMILK-Medium';
        width: 100%;
        height: 50px;
        font-size: 150%;
        outline: 1px solid rgba(241, 68, 33, 1);
        border-radius: 0 0 5px 5px;
        background-color: rgba(241, 68, 33, 1);
        color: #fff;
    }


    .valorpedido>sup {
        font-family: 'LEMONMILK-Medium';
        font-size: 12px;
        margin-bottom: 10px;
        margin-left: 10px;
    }

    .valorpedido>p {
        font-family: 'LEMONMILK-Medium';

    }

    .endereco {
        display: flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        flex-direction: column;
    }

    .checkbox>label {
        font-size: 90%;
        font-family: 'futura-nd-light-scosf', sans-serif;
    }

    .fechar {
        position: relative;
        top: 45px;
        left: 10px;
        width: 20px;
        height: 20px;
        border-radius: 20%;
        background-image: url(../fontes/closed.png);
        background-repeat: no-repeat;
        background-position: center top;
        background-size: cover;
        cursor: pointer;
    }

    .listacomplementos {
        display: flex;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .listacomplementos>.checkbox {
        position: relative;
        left: 0;
    }

    .listacomplementos>.precolista {
        font-size: 90%;
        text-align: right;
        position: relative;
        right: -1;
    }

    .listacomplementos>.linhatracejada {
        flex-grow: 1;
        border: none;
        border-bottom: 1px solid black;
        border-bottom-style: dotted;
    }

    .data {
        text-align: center;
        font-family: 'hello honey';
        color: rgba(241, 68, 33, 1);
        font-size: 370%;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        margin-top: 20px;
    }

    .pedidos {
        width: 100%;
    }

    tr {
        padding-top: 10px;
    }

    th {
        width: 50%;
        background-color: rgba(241, 68, 33, 1);
        color: #fff;
        border-radius: 5px 5px 0px 0px;
    }

    td {
        width: 50%;
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 0px 0px 5px 5px;
        border: 1px solid rgba(117, 117, 117, 1);
    }

    .grafico {
        width: 98%;
    }

    #lucro {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 500%;
        font-family: 'hello honey';
        color: rgba(241, 68, 33, 1);
    }

    #informa_telefone {
        height: 300px;
    }

    #textpedido {
        height: 0px;
    }

    #pedidodesativada:checked~#textpedido,
    #pedidoativada:checked~#informa_telefone {
        height: 300px;
    }

</style>