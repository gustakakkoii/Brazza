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
        font-family: 'harigu-sans';
        src: url('../fontes/harigu-sans.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;

    }

    .menu {
        cursor: pointer;
        position: absolute;
        background-image: linear-gradient(90deg, rgba(26, 27, 32, 1), rgba(32, 34, 39, 1), rgba(26, 27, 32, 1));
        border-radius: 5px;
        top: 10px;
        right: 10px;
        padding: 5px;
        width: 30px;
        height: 25px;

        -moz-transition: all 0.9s;
        -webkit-transition: all 0.9s;
        transition: all 0.9s;
    }

    .menupointer {
        position: absolute;
        margin-top: 1px;
        width: 30px;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .box {
        top: 0;
        position: absolute;
        width: 100%;
        height: 100%;

        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
    }

    .menubox {
        position: absolute;
        width: 310px;
        height: 100vh;
        background-image: linear-gradient(90deg, rgba(26, 27, 32, 1), rgba(32, 34, 39, 1), rgba(26, 27, 32, 1));

        transition: transform 1s ease-in-out;
        transform: translateX(-350px);
        -moz-transition: all 1.5s;
        -webkit-transition: all 1.5s;
        transition: all 1.5s;

        left: 0;

        display: flex;
        align-items: center;
        flex-direction: column;

    }

    .imagemmenu {
        margin-top: 30px;
        width: 150px;
        height: 150px;
        background-image: url('../fontes/Logo.png');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .menudivisoria {
        margin-top: 30px;
        width: 70%;
        border: 1px solid #fff;
    }

    .nossomagnifico {
        width: 90%;
        font-size: 45px;
        font-family: 'hello honey';
        color: rgba(241, 68, 33, 1);
    }

    .cardapio {
        position: relative;
        top: -10px;
        text-align: right;
        width: 90%;
        font-size: 56px;
        color: #fff;
    }

    /*accordions*/
    .accordions {
        overflow-y: scroll;
        width: 290px;
        padding: 10px;
    }

    .accordions-item {
        padding-bottom: 10px;
    }

    .accordions-item>label>a,
    .accordions-item>label {
        cursor: pointer;
        font-family: 'harigu-sans';
        color: #fff;
        font-size: 25px;
        text-decoration: none;
    }

    .accordions-item>input {
        display: none;
    }

    .accordion-content {
        overflow: auto;
        height: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(117, 117, 117, 1);

        display: flex;
        flex-direction: column;


        -moz-transition: all 1s;
        -webkit-transition: all 1s;
        transition: all 1s;
    }

    .accordion-content>.link {
        text-decoration: none;
        color: rgba(117, 117, 117, 1);
        margin-left: 20px;
        margin-top: 5px;
        padding-bottom: 5px;
        margin-right: 20px;
        font-size: 20px;
        width: 100%;
        border-bottom: 1px solid rgba(117, 117, 117, 1);
        font-family: 'harigu-sans', sans-serif;
    }

    #accordion-combos:checked~#content-combos,
    #accordion-adicionais:checked~#content-adicionais,
    #accordion-bebidas:checked~#content-bebidas,
    #accordion-lanche:checked~#content-lanche {
        height: 127px;
    }

    #accordion-pedidos:checked~#content-pedidos {
        height: 80px;
    }
</style>