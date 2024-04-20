<template>
  <div envelope="ProdutoBanner">
    <div
      class="bg_solucoes relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#006038]"
    >
      <div
        class="container relative top-20 mx-auto text-center text-3xl font-normal tracking-[.3em] text-white md:text-6xl"
      >
        SOLUÇÕES
      </div>
    </div>
    <div class="bg-[#006038] pb-[60px]">
      <div class="space-y-4 pt-[130px] text-center">
        <p class="text-3xl text-[#70df3f]">PARA O SEU DIA A DIA</p>
        <p class="text-4xl font-bold text-white">CONFIRA NOSSAS SOLUÇÕES</p>
      </div>
      <div id="faixaHorzEmp" class="z-[50]"></div>

      <!-- GRID DE PRODUTOS -->

      <div class="container mx-auto flex flex-row pb-32 pt-32">
        <div class="h-[1000px] w-1/3">
          <div class="pt-3 text-center text-xl font-bold uppercase text-white">
            <h1>Nossas linhas</h1>
          </div>
          <div class="flex flex-col space-y-3 px-6 pr-14 pt-10">
            <div
              class="border-b-[1px] border-t-[1px] border-transparent py-3 text-lg font-bold uppercase text-white hover:border-b-[1px] hover:border-t-[1px] hover:border-[#70df3f] hover:text-[#70df3f]"
              v-for="(linha, index) in menuLinhas"
              :key="index"
            >
              <a v-bind:href="linha.link">{{ linha.texto }}</a>
            </div>
          </div>
        </div>

        <div
          class="flex h-auto w-[960px] flex-col flex-nowrap items-center justify-center"
        >
          <!-- Seletor de linhas
          <label
            for="linhas"
            class="block mb-2 text-xl font-semibold text-white"
            >Selecione a Linha</label
          >
          <select
            id="linhasSelect"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option v-for="(linha, index) in menuLinhas" :key="index">
              {{ linha.texto }}
            </option>
          </select> -->
          <div class="gridProdutos w-full">
            <!-- PRODUTO -->
            <div
              v-for="(item, index) in produtosDestaque"
              :key="index"
              class="prodHome z-50 mb-0 h-full w-full lg:mb-12"
            >
              <div
                :class="{
                  '-ml-[1px] -mt-[2px] h-[620px] items-center border-[1px] border-[#c3d3cb] text-white hover:text-[#b7d22b]':
                    item.titulo,
                }"
                class="relative flex flex-col items-center pt-12 hover:bg-[#004425]"
              >
                <div class="mw-100% h-90% h-80 w-48">
                  <img :src="item.img" alt="" width="195" height="320" />
                </div>
                <div class="space-y-5 px-10 pt-7 text-center">
                  <h1 class="text-3xl font-semibold uppercase">
                    {{ item.titulo }}
                  </h1>
                  <h3 class="text-lg">
                    {{ item.descricao }}
                  </h3>
                </div>
                <div class="items-center pb-14 pt-6 lg:bottom-10">
                  <div class="flex flex-row space-x-12 space-y-3">
                    <div @click="teste()" class="pt-1 text-[1.425rem]">
                      Saiba mais
                    </div>
                    <div>
                      <div id="seta">
                        <div></div>
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            class="text-g mb-[8.5rem] mt-28 flex h-[3rem] w-[450px] cursor-pointer flex-col items-center justify-center bg-[#b7d22b] text-[1.2rem] text-[#115125]"
          >
            Carregar mais produtos
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const menuLinhas = ref([
  { texto: "LINHA RAPID", link: "/RAPID" },
  { texto: "LINHA PRISMA", link: "/PRISMA" },
  { texto: "LINHA PETRA", link: "/PETRA" },
]);

onMounted(() => {});

const produtosDestaque = ref([
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
  {
    img: "/img/tomada.png",
    titulo: "Linha Petra",
    descricao: "Código 00000",
  },
]);
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
#faixaHorzEmp {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0;
  width: 3px;
  height: 220px;
  background-color: #70df3f;
}

.gridProdutos {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}

.gridProdutos > div:hover {
  cursor: pointer;
}

#seta {
  position: relative;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 9px;
  top: 1px;
  left: -11px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0px 0 1px 1px;
  transform: rotate(225deg);
}
#seta > div:nth-child(2) {
  position: absolute;
  top: 9px;
  left: -37px;
  width: 45px;
  height: 2px;
  background-color: #fff;
}
.prodHome {
  text-align: center;
  color: #fff;
}

.prodHome:hover {
  --background-color: #24462b;
  cursor: pointer;
  color: #71df43;
}
.prodHome:hover > div > div:nth-child(2) > h3 {
  text-decoration: underline;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 1px #9ade53 inset;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #9ade53;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #9ade53;
}

.bg_solucoes {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}
</style>
