<template>
  <div envelope="topo">
    <!-- MENU PC -->
    <div
      id="mnuTopoDeskID"
      class="border_bottom_menu absolute z-[999] w-full text-[10pt] text-white"
    >
      <!-- PTBR-EN -->
      <div
        id="mnuIdiomDeskID"
        class="container relative top-5 mx-auto hidden flex-row justify-end space-x-2 px-[70px] pb-6 lg:flex"
      >
        <div class="hover:text-[#00b1ef]">
          <button
            ref="lPT"
            @click="($i18n.locale = 'pt'), setStoreLocale('pt')"
            :class="{ underline: lang === 'pt' }"
          >
            PT
          </button>
        </div>
        <div class="hover:text-[#00b1ef]">
          <button
            ref="lEN"
            @click="($i18n.locale = 'en'), setStoreLocale('en')"
            :class="{ underline: lang === 'en' }"
          >
            EN
          </button>
        </div>
        <div class="hover:text-[#00b1ef]">
          <button
            ref="lES"
            @click="($i18n.locale = 'es'), setStoreLocale('es')"
            :class="{ underline: lang === 'es' }"
          >
            ES
          </button>
        </div>
      </div>

      <div class="container mx-auto hidden grid-cols-4 px-10 py-6 lg:grid">
        <a
          href="/home"
          target="_top"
          id="logoMect"
          class="top-[60px] col-span-1 h-[90px] w-[345px] cursor-pointer py-4"
        >
          LOGO
        </a>

        <div
          id="mnuTopoDeskLinksID"
          class="relative col-span-3 flex flex-row items-center justify-end pr-6"
        >
          <ul
            class="font-inter flex flex-row items-center text-white lg:space-x-6 lg:text-[8pt] xl:space-x-8 2xl:text-[10.6pt]"
          >
            <li>
              <a :href="MNU_TOPO_lang[0].rota" class="py-2 hover:text-[#00b1ef]"
                >{{ MNU_TOPO_lang[0].titulo }}
              </a>
            </li>
            <li>
              <!-- <a
                @mouseover="mnuDeskx('mnuDeskSolucao')"
                :href="MNU_TOPO_lang[1].rota"
                class="py-2 hover:text-[#99DF52]"
                >{{ MNU_TOPO_lang[1].titulo }}
              </a> -->
              <a :href="MNU_TOPO_lang[1].rota" class="dropdown z-[99999]">
                <button class="dropbtn py-2 hover:text-[#00b1ef]">
                  {{ MNU_TOPO_lang[1].titulo }}
                </button>

                <div class="dropdown-content w-[800px] p-10">
                  <div class="flex flex-col">
                    <a
                      v-for="(link, index) in menuLinhasCol1"
                      :key="index"
                      :href="'/solucoes/?linha=' + link.id"
                      class="py-2 pr-4 text-[11pt] text-[#1b3346] hover:pr-3 hover:font-bold hover:text-[#00b1ef] hover:underline"
                      >{{ link.titulo }}</a
                    >
                  </div>
                  <div class="flex flex-col">
                    <a
                      v-for="(link, index) in menuLinhasCol2"
                      :key="index"
                      :href="'/solucoes/?linha=' + link.id"
                      class="py-2 pr-4 text-[11pt] text-[#1b3346] hover:pr-3 hover:font-bold hover:text-[#00b1ef] hover:underline"
                      >{{ link.titulo }}</a
                    >
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a :href="MNU_TOPO_lang[2].rota" class="py-2 hover:text-[#00b1ef]"
                >{{ MNU_TOPO_lang[2].titulo }}
              </a>
            </li>
            <li>
              <a
                :href="MNU_TOPO_lang[3].rota"
                class="py-2 hover:cursor-pointer hover:text-[#00b1ef]"
              >
                {{ MNU_TOPO_lang[3].titulo }}
              </a>
            </li>
            <li>
              <!-- <a
                @mouseover="mnuDeskOndeComprar('mnuDeskOndeComprarID')"
                id="ondeComprarLinkID"
                :href="MNU_TOPO_lang[4].rota"
                class="py-2 hover:cursor-pointer hover:text-[#99DF52]"
                >{{ MNU_TOPO_lang[4].titulo }}
              </a> -->
              <a :href="MNU_TOPO_lang[4].rota" class="dropdown" target="_blank">
                <button class="dropbtn py-2 hover:text-[#00b1ef]">
                  {{ MNU_TOPO_lang[4].titulo }}
                </button>

                <!-- <div class="dropdown-content-onde-comprar">
                  <a
                    href="https://loja.mectronic-eletromar.com.br/"
                    target="_blank"
                    class="py-2 pr-4 text-[11pt] text-[#1b3346] hover:pr-3 hover:font-bold hover:text-[#00b1ef] hover:underline"
                    >LOJA MEC-TRONIC / ELETROMAR</a>
                  
                </div> -->
              </a>
            </li>
            <li>
              <a
                :href="MNU_TOPO_lang[5].rota"
                class="py-2 hover:cursor-pointer hover:text-[#00b1ef]"
                >{{ MNU_TOPO_lang[5].titulo }}
              </a>
            </li>
            <li
              class="rounded-br-2xl rounded-tl-2xl bg-[#9ade52] px-4 py-2 text-white"
            >
              <a
                href="https://www.mectronic.com.br/"
                target="_blank"
                class="cursor-pointer font-bold"
                >MEC-TRONIC
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- MENU PC -->

    <!-- MENU MOBILE -->
    <div
      class="absolute right-0 top-0 z-[99999] h-36 w-full overflow-auto lg:hidden xl:h-52"
      :class="{
        'flex min-h-screen flex-col bg-[#00b1ef] ': mnuMovelAberto,
      }"
    >
      <!-- LOGO, MENU FECHAR/ABRIR -->
      <div
        class="container mx-auto flex h-28 flex-row items-center justify-between px-10"
      >
        <!-- ABRE E FECHA MENU-->
        <div class="">
          <a
            to="/"
            href="/"
            target="_top"
            v-if="mnuMovelAberto"
            id="logoMect-mob"
            class=""
          ></a>
          <a
            to="/"
            href="/"
            target="_top"
            v-if="!mnuMovelAberto"
            id="logoMect-mobFechado"
            class=""
          ></a>
        </div>
        <!-- class="absolute right-7 top-[45px] z-50 sm:right-11 sm:top-[60px]" -->
        <div class="">
          <input @click="mnuMovel()" id="menu-toggle" type="checkbox" />
          <label class="menu-button-container" for="menu-toggle">
            <div class="menu-button"></div>
          </label>
          <div
            v-if="!mnuMovelAberto"
            class="block text-[#1b3346]"
            @click="mnuMovel()"
          >
            <!-- <ph-list :size="32" />X -->
          </div>
          <div
            v-if="mnuMovelAberto"
            @click="mnuMovel()"
            class="block text-white"
          >
            <!-- <ph-x :size="32" />XY -->
          </div>
        </div>
      </div>

      <!-- SOCIAL -->
      <div v-if="mnuMovelAberto" class="h-20 px-6">
        <div
          class="flex flex-row justify-end space-x-4 py-4 text-lg font-semibold text-white"
        >
          <!-- LINGUAGEM -->
          <div class="hover:text-[#1b3346]">
            <button
              ref="lPT"
              @click="($i18n.locale = 'pt'), setStoreLocale('pt')"
              :class="{ underline: lang === 'pt' }"
            >
              PT
            </button>
          </div>
          <div class="hover:text-[#1b3346]">
            <button
              ref="lEN"
              @click="($i18n.locale = 'en'), setStoreLocale('en')"
              :class="{ underline: lang === 'en' }"
            >
              EN
            </button>
          </div>
          <div class="hover:text-[#1b3346]">
            <button
              ref="lES"
              @click="($i18n.locale = 'es'), setStoreLocale('es')"
              :class="{ underline: lang === 'es' }"
            >
              ES
            </button>
          </div>
        </div>
        <!-- SOCIAL -->
        <div
          class="mx-auto flex h-[80px] flex-row items-center justify-around border-b-[1px] border-t-[1px] border-[#1b3346]"
        >
          <div
            id="logoInstagram"
            class="flex h-11 w-11 flex-row items-center justify-center rounded-full border border-[#1b3346] font-black text-[#1b3346]"
          ></div>

          <div
            id="logoFacebook"
            class="flex h-11 w-11 flex-row items-center justify-center rounded-full border border-[#1b3346] font-black text-[#1b3346]"
          ></div>
          <div
            class="flex h-11 w-11 flex-row items-center justify-center rounded-full border border-[#1b3346] p-3 text-2xl font-bold text-[#1b3346]"
          >
            in
          </div>
        </div>
      </div>

      <!-- MENUS DE OPCOES -->
      <div v-if="mnuMovelAberto" style="height: calc(100vh - 350px)">
        <ul class="mt-16 px-6 pb-10 pt-4 text-white">
          <li class="cursor-pointer">
            <div class="flex h-[55px] w-full items-center pl-8 text-[#1b3346]">
              <a
                :href="MNU_TOPO_lang[0].rota"
                target="_top"
                class="router_link_active_movel"
                >{{ MNU_TOPO_lang[0].titulo }}
              </a>
            </div>
          </li>
          <!-- rounded-tl-3xl rounded-br-3xl bg-[#004425] -->
          <li id="solucao" class="MNUCategoria h-full cursor-pointer space-y-2">
            <div
              @click="mnuMovelSub('solucao')"
              class="flex h-[55px] w-full items-center border-t-[1px] border-[#004425] pl-8 text-[#1b3346]"
            >
              <button>{{ MNU_TOPO_lang[1].titulo }} +</button>
            </div>
            <div
              class="flex flex-col space-y-3 border-[#004425] text-[#1b3346]"
            >
              <li class="flex min-w-[300px] flex-col">
                <a
                  v-for="(link, index) in menuLinhas"
                  :key="index"
                  :href="'/solucoes/?linha=' + link.id"
                  class="py-2 pl-8 pr-4 text-[11pt] text-[#0c5938]"
                  :class="{
                    'border-b border-b-[#308040] ': index < menuLinhas.length,
                  }"
                  >{{ link.titulo }}</a
                >
              </li>
            </div>
          </li>
          <li id="catalogo" class="MNUCategoria cursor-pointer">
            <div
              @click="mnuMovelSub('catalogo')"
              class="flex h-[55px] w-full items-center border-t-[1px] border-[#004425] pl-8 text-[#1b3346]"
            >
              <button>{{ MNU_TOPO_lang[2].titulo }} +</button>
            </div>
            <div class="flex flex-col border-[#004425] text-[#1b3346]">
              <div
                @click="clickDownload(index)"
                class="py-2"
                :class="{
                  'border-b border-b-[#308040]': index < catalogos.length - 1,
                }"
                v-for="(c, index) in catalogos"
                :key="index"
              >
                <a
                  :id="'pdf-' + index"
                  target="_blank"
                  :href="pathCatalogos + c.pdf"
                  class="pl-8 pr-4 text-[11pt] text-[#0c5938]"
                >
                  {{ c.titulo }}
                </a>
              </div>
              <!-- <div class="border-b border-b-[#308040] py-2 pl-8">
                LNHA RAPID
              </div>

              <div class="py-2 pl-8">LNHA PRISMA</div> -->
            </div>
          </li>

          <li class="cursor-pointer">
            <div
              class="flex h-[55px] w-full items-center border-t-[1px] border-[#004425] pl-8 text-[#1b3346]"
            >
              <a
                :href="MNU_TOPO_lang[3].rota"
                target="_top"
                class="router_link_active_movel"
                >{{ MNU_TOPO_lang[3].titulo }}</a
              >
            </div>
          </li>

          <li id="ondeComparID" class="MNUCategoria cursor-pointer">
            <div
              @click="mnuMovelSub('ondeComparID')"
              class="flex h-[55px] w-full items-center border-t-[1px] border-[#1b3346] pl-8 text-[#1b3346]"
            >
              <button>{{ MNU_TOPO_lang[4].titulo }} +</button>
            </div>
            <div class="flex flex-col space-y-3">
              <li class="flex min-w-[300px] flex-col">
                <a
                  v-for="(link, index) in linksOndeComprar"
                  :key="index"
                  :href="link.link"
                  class="py-2 pl-8 pr-4 text-[11pt] text-[#1b3346]"
                  :class="{
                    'border-b border-b-[#1b3346] ':
                      index < linksOndeComprar.length - 1,
                  }"
                  >{{ link.titulo }}</a
                >
              </li>
            </div>
          </li>
          <li class="cursor-pointer">
            <div
              class="flex h-[55px] w-full items-center border-t-[1px] border-[#1b3346] pl-8 text-[#1b3346]"
            >
              <a
                :href="MNU_TOPO_lang[5].rota"
                class="router_link_active_movel"
                >{{ MNU_TOPO_lang[5].titulo }}</a
              >
            </div>
          </li>
          <li class="cursor-pointer rounded-br-3xl rounded-tl-3xl bg-[#1b3346]">
            <div class="flex h-[55px] w-full items-center pl-8 text-white">
              <a
                href="https://www.eletromar.com.br/"
                to="https://www.eletromar.com.br/"
                target="_blank"
                class="router_link_active_movel"
                >ELETROMAR</a
              >
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- MENU MOBILE -->
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();
//import { PhList, PhX, PhInstagramLogo, PhFacebookLogo } from "phosphor-vue";
import gsap from "gsap";

components: {
  // PhList;
  // PhX;
  // PhInstagramLogo;
  // PhFacebookLogo;
}

const loading = ref(true);
const lPT = ref(null);
const lEN = ref(null);
const lES = ref(null);
const nuxtApp = useNuxtApp();
// nuxtApp.hook("page:finish", () => {
//   lang.value = localStorage.getItem("lang");
// });

const pathCatalogos = "\\media\\catalogos\\";
function clickDownload(index) {
  document.getElementById("pdf-" + index).click();
}

let lang = ref();
function setStoreLocale(l) {
  localStorage.setItem("lang", l);
  lang.value = l;
}
const loc = ref(null);
onBeforeMount(() => {
  if (process.client) {
    const { t, locale } = useI18n();
    loc.value = locale.value;
    if (localStorage.getItem("lang") && localStorage.getItem("lang") != "") {
      locale.value = localStorage.getItem("lang");
      lang.value = localStorage.getItem("lang");
      i18nLocale.locale.value = localStorage.getItem("lang");
    } else {
      setStoreLocale("pt");
      locale.value = "pt";
      locale.value = "pt";
      lang.value = "pt";
      i18nLocale.locale.value = "pt";
      setMenuLang();
    }
  }

  setMenuLang();
});
watch(i18nLocale.locale, () => {
  setMenuLang();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
  i18nLocale.locale.value = localStorage.getItem("lang");
}

onMounted(() => {
  //SET LOCALE

  //this.$i18n.locale = "pt";

  //

  // ROLAGEM MACIA

  let tl = gsap.timeline();
  tl.to("#mnuTopoDeskID", { duration: 0.1, y: 0, opacity: 1 })
    .to("#logoMect", { duration: 0.3, y: 0, opacity: 1 })
    .to("#mnuTopoDeskLinksID", { duration: 0.5, y: 0, opacity: 1 });

  document.addEventListener("wheel", function (event) {
    //only vertical scroll
    if (event.deltaY > 0) {
      //event.preventDefault();
      smoothScroll(document.documentElement, 0, 0);
    }
  });
  function smoothScroll(domElement, pixel, delay) {
    const intervalToRepeat = 25;
    const step = (intervalToRepeat * pixel) / delay;
    if (step < pixel) {
      domElement.scrollTop += step;
      setTimeout(function () {
        smoothScroll(domElement, pixel - step, delay);
      }, intervalToRepeat);
    }
  }
  // ROLAGEM MACIA

  // ICL EM 04/09-2023
  // document.body.style.overflowY = "scroll";
  // let mnuID = document.getElementById("mnuDeskSolucao");
  // mnuID.classList.toggle("fechado");

  // let mnuOndeCompprarID = document.getElementById("mnuDeskOndeComprarID");
  // mnuOndeCompprarID.classList.toggle("fechado");
});

const MNU_TOPO_lang = ref([]);
const MNU_TOPO_pt = ref([
  { titulo: "A EMPRESA", rota: "/empresa" },
  { titulo: "PRODUTOS", rota: "/solucoes" },
  { titulo: "CATALOGO", rota: "/catalogo" },
  { titulo: "BLOG", rota: "/blog" },
  {
    titulo: "LOJA MEC-TRONIC / ELETROMAR",
    rota: "https://loja.mectronic-eletromar.com.br/",
  },
  //{ titulo: "ONDE COMPRAR", rota: "/comprar" },
  { titulo: "CONTATO", rota: "/contato" },
]);
const MNU_TOPO_en = ref([
  { titulo: "THE COMPANY", rota: "/empresa" },
  { titulo: "PRODUCTS", rota: "/solucoes" },
  { titulo: "CATALOG", rota: "/catalogo" },
  { titulo: "BLOG", rota: "/blog" },
  {
    titulo: "MEC-TRONIC / ELETROMAR STORE",
    rota: "https://loja.mectronic-eletromar.com.br/",
  },
  { titulo: "CONTACT", rota: "/contato" },
]);
const MNU_TOPO_es = ref([
  { titulo: "LA EMPRESA", rota: "/empresa" },
  { titulo: "PRODUCTOS", rota: "/solucoes" },
  { titulo: "CATALOGAR", rota: "/catalogo" },
  { titulo: "BLOG", rota: "/blog" },
  {
    titulo: "TIENDA MEC-TRONIC / ELETROMAR",
    rota: "https://loja.mectronic-eletromar.com.br/",
  },
  { titulo: "CONTACTO", rota: "/contato" },
]);

function setMenuLang() {
  if (lang.value == "pt") {
    MNU_TOPO_lang.value = MNU_TOPO_pt.value;
  }
  if (lang.value == "en") {
    MNU_TOPO_lang.value = MNU_TOPO_en.value;
  }
  if (lang.value == "es") {
    MNU_TOPO_lang.value = MNU_TOPO_es.value;
  }
}

const MNUPrincipal = ref([
  { titulo: "A EMPRESA", rota: "/empresa" },
  { titulo: "SOLUÇÕES", rota: "/solucoes" },
  { titulo: "CATALOGO", rota: "/catalogo" },
  { titulo: "BLOG", rota: "/blog" },
  { titulo: "ONDE COMPRAR", rota: "/comprar" },
  { titulo: "CONTATO", rota: "/contato" },
]);
const linksOndeComprar = ref([
  {
    titulo: "Mec-Tronic",
    link: "https://www.loja.mectronic-eletromar.com.br/",
  },
  { titulo: "Eletromar", link: "https://www.loja.mectronic-eletromar.com.br/" },
]);
const liksSolucoes = ref([
  {
    col: [
      { titulo: "LINHA RAPID", linhaID: "456897" },
      { titulo: "LINHA PRISMA", linhaID: "456897" },
      { titulo: "LINHA PETRA", linhaID: "456897" },
      { titulo: "LINHA MEC-PLUS", linhaID: "456897" },
      { titulo: "LINHA VOLTS", linhaID: "456897" },
      { titulo: "LINHA MILLENIUN", linhaID: "456897" },
      { titulo: "LINHA CLÁSSICA", linhaID: "456897" },
      { titulo: "LINHA SOBREPOR MILLENIUM", linhaID: "456897" },
    ],
  },
  {
    col: [
      { titulo: "LINHA SOBREPOR PETRA", linhaID: "456897" },
      { titulo: "LINHA INFORMÁTICA", linhaID: "456897" },
      { titulo: "LINHA EXTERNA", linhaID: "456897" },
      { titulo: "LINHA POTES", linhaID: "456897" },
      { titulo: "LINHA FITAS", linhaID: "456897" },
      { titulo: "LINHA CAIXA DE PASSAGEM", linhaID: "456897" },
      {
        titulo: "LINHA DE EXTESÕES E CORDÕES PROLONGADORES",
        linhaID: "456897",
      },
    ],
  },
]);
let mnuMovelAberto = ref(false);

onMounted(() => {
  getSolucoesLinhas();
  getCatalogos();
});
let q = {
  ativo: "s", // s | n | t
};
let menuLinhas = ref([]);
let menuLinhasCol1 = ref([]);
let menuLinhasCol2 = ref([]);

function getSolucoesLinhas() {
  let R = null;

  R = $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
    params: q,
  }).then((R) => {
    menuLinhas.value = JSON.parse(R);

    let isPar = menuLinhas.value.length % 2 == 0 ? true : false;
    let divisor = Math.floor(menuLinhas.value.length / 2);
    divisor = isPar ? divisor : divisor + 1;
    menuLinhas.value.map((m, index) => {
      if (index <= divisor - 1) {
        menuLinhasCol1.value.push(m);
      } else {
        menuLinhasCol2.value.push(m);
      }
    });
  });
}
const catalogos = ref();
async function getCatalogos() {
  let R = await $fetch("/api/formCatalogo.php", {
    method: "GET",
  }).then((R) => {
    if (JSON.parse(R).length > 0) {
      catalogos.value = JSON.parse(R);
    } else {
      catalogos.value = [];
    }
  });
}

function mnuMovel() {
  if (mnuMovelAberto.value) {
    mnuMovelAberto.value = false;
    document.body.style.overflow = "auto";
  } else {
    mnuMovelAberto.value = true;
    document.body.style.overflow = "hidden";
  }
}

function mnuMovelSub(idMNU) {
  let mnuID = document.getElementById(idMNU);
  if (mnuID.classList.contains("aberto")) {
    mnuID.classList.toggle("aberto");
  } else {
    const allElements = document.querySelectorAll(".MNUCategoria");

    allElements.forEach((element) => {
      element.classList.remove("aberto");
    });
    mnuID.classList.add("aberto");
  }
}
function mnuDesk(idMNUDesk) {
  let mnuID = document.getElementById(idMNUDesk);
  document.getElementById("mnuDeskOndeComprarID").classList.remove("aberto");
  mnuID.classList.toggle("aberto");
}
function mnuDeskOndeComprar(idMNUDesk) {
  document.getElementById("mnuDeskSolucao").classList.remove("aberto");
  let mnuID = document.getElementById(idMNUDesk);
  let mnulinkID = document.getElementById("ondeComprarLinkID");

  //controla a cor do link ondecomprar
  if (mnulinkID.style.color == "rgb(153, 223, 82)") {
    mnulinkID.style.color = "#FFF";
  } else {
    mnulinkID.style.color = "#00b1ef";
  }

  mnuID.classList.toggle("aberto");
}

/// LANG

/// LANG
</script>

<style scoped>
html {
  scroll-behavior: smooth;
}
#XmnuTopoDeskID {
  opacity: 1;
  transform: translateY(0%);
  --animation-name: mnuTopAnimBaixo;
  animation-delay: 0s;
  animation-duration: 0.3s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in-out;
}

@keyframes mnuTopAnimBaixo {
  0% {
    transform: translateY(-100%);
    opacity: 0;
  }
  25% {
    opacity: 0.25;
  }
  50% {
    opacity: 0.4;
  }
  100% {
    opacity: 1;
    transform: translateY(0%);
  }
}
#mnuTopoDeskLinksID {
  transform: translateY(-100%);
  opacity: 0;
}
#logoMect {
  transform: translateY(-100%);
  opacity: 0;
  display: block;
  top: -5px;
  position: relative;
  text-indent: -9999px;
  background: url("/img/logo-eletromar.png");
  background-repeat: no-repeat;
  width: 345px;
  height: 90px;
  background-size: 345px 90px;
}
#mnuIdiomDeskID {
  animation-name: mnuTopAnimBaixo;
  animation-delay: 0.3s;
  animation-duration: 0.5s;
}
@keyframes logoAnimaCima {
  0% {
    transform: translateY(30%);
    opacity: 0;
  }
  25% {
    opacity: 0.25;
  }
  50% {
    opacity: 0.4;
  }
  100% {
    opacity: 1;
    transform: translateY(0%);
  }
}
/* ANIMA TIT */
.praCimaTit .linha1 {
  animation-name: paraCima;
  display: inline-block;
  animation-delay: 0.3s;
  animation-duration: 0.3s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in;
  transform: rotate(0deg) translateY(100%);

  /* animation: paraCima 0.6s ease-in-out forwards; */
}
.praCimaTit .linha2 {
  animation-name: paraCima;
  display: inline-block;
  animation-delay: 0.5s;
  animation-duration: 0.3s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in;
  transform: rotate(0deg) translateY(100%);
}
.envelopLinha {
  display: block;
  overflow: hidden;
}

.praCimaTit {
  opacity: 1 !important;
  animation-delay: 1s;
}
@keyframes paraCima {
  from {
    z-index: 1;
    opacity: 0.3;
    transform: rotate(0deg) translateY(100%);
  }
  to {
    z-index: 1;
    opacity: 1;
    transform: rotate(0deg) translateY(0%);
  }
}
/* ANIMA TIT */
</style>
<style scoped>
.router-link-active:not(.router_link_active_movel) {
  color: #00b1ef;
}
#mnuDeskSolucao {
  display: none;
}
#mnuDeskSolucao.fechado {
  display: none;
}
#mnuDeskSolucao.aberto {
  display: flex;
  z-index: 999;
}
.MNUCategoria > div:nth-child(2) {
  display: none;
}
.MNUCategoria.aberto > div:nth-child(1) {
  --tw-bg-opacity: 1;
  background-color: rgb(0 68 37 / var(--tw-bg-opacity));
  border-top-left-radius: 1.5rem;
  border-bottom-right-radius: 1.5rem;
  font-weight: 700;
  --tw-text-opacity: 1;
  color: rgb(48 128 64 / var(--tw-text-opacity));
}

.MNUCategoria.aberto > div:nth-child(2) {
  display: none;
}

#mnuDeskOndeComprarID {
  display: none;
}
#mnuDeskOndeComprarID.fechado {
  display: none;
}
#mnuDeskOndeComprarID.aberto {
  display: flex;
  z-index: 999;
}
.MNUCategoria > div:nth-child(2) {
  display: none;
}
.MNUCategoria.aberto > div:nth-child(1) {
  --tw-bg-opacity: 1;
  background-color: #1b3346;
  border-top-left-radius: 1.5rem;
  border-bottom-right-radius: 1.5rem;
  font-weight: 700;
  --tw-text-opacity: 1;
  color: #00b1ef;
}

.MNUCategoria.aberto > div:nth-child(2) {
  display: block;
}

/* @media screen and (min-width: 1501px) {
  #logoMect {
    width: 345px;
    height: 90px;
    background-size: 345px 90px;
    left: 100px;
  } 
}*/
@media screen and (max-width: 1500px) {
  #logoMect {
    width: 185px;
    height: 52px;
    background-size: 185px 52px;
    --left: 100px;
  }
}

#logoMect-mob {
  display: block;
  text-indent: -9999px;
  width: 175px;
  height: 50px;
  background: url("/img/logo-eletromar-escuro.png");
  background-size: 175px 50px;
}
#logoMect-mobFechado {
  display: block;
  text-indent: -9999px;
  width: 175px;
  height: 50px;
  background: url("/img/logo-eletromar.png");
  background-size: 175px 50px;
}
#logoFacebook {
  display: block;
  text-indent: -9999px;
  width: 48px;
  height: 48px;
  background: url("/img/iconFaceboockMb.png");
  background-size: 48px 48px;
}
#logoInstagram {
  display: block;
  text-indent: -9999px;
  width: 48px;
  height: 48px;
  background: url("/img/iconInstagramMb.png");
  background-size: 48px 48px;
}
</style>
<style scoped>
.menu-button-container {
  display: none;
  height: 100%;
  width: 30px;
  cursor: pointer;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#menu-toggle {
  display: none;
}

.menu-button,
.menu-button::before,
.menu-button::after {
  display: block;
  background-color: #00b1ef;
  position: absolute;
  height: 4px;
  width: 30px;
  transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
  border-radius: 2px;
}

.menu-button::before {
  content: "";
  margin-top: -8px;
}

.menu-button::after {
  content: "";
  margin-top: 8px;
}

#menu-toggle:checked + .menu-button-container .menu-button::before {
  margin-top: 0px;
  transform: rotate(405deg);
  background-color: #1b3346;
}

#menu-toggle:checked + .menu-button-container .menu-button {
  background: rgba(255, 255, 255, 0);
}

#menu-toggle:checked + .menu-button-container .menu-button::after {
  margin-top: 0px;
  transform: rotate(-405deg);
  background-color: #1b3346;
}

.menu-button-container {
  display: flex;
}
.menu {
  position: absolute;
  top: 0;
  margin-top: 50px;
  left: 0;
  flex-direction: column;
  width: 100%;
  justify-content: center;
  align-items: center;
}
#menu-toggle ~ .menu li {
  height: 0;
  margin: 0;
  padding: 0;
  border: 0;
  transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
}
#menu-toggle:checked ~ .menu li {
  border: 1px solid #333;
  height: 2.5em;
  padding: 0.5em;
  transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1);
}
.menu > li {
  display: flex;
  justify-content: center;
  margin: 0;
  padding: 0.5em 0;
  width: 100%;
  color: white;
  background-color: #222;
}
.menu > li:not(:last-child) {
  border-bottom: 1px solid #444;
}
</style>

<style scoped>
.dropdown {
  position: relative;
  display: inline-block;
  padding: 24px 0;
}
/* //grid min-w-[550px] grid-cols-2 gap-x-2 */
.dropdown-content {
  display: none;
  position: absolute;
  left: -120px;
  top: 70px;
  padding: 24px;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 9999999;
  padding-left: 50px;
  padding-right: 50px;
}
.dropdown-content:before {
  content: " ";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  background-color: rgba(255, 255, 255, 0.88);
  border-radius: 30px;
}
.dropdown-content-onde-comprar {
  display: none;
  position: absolute;

  top: 70px;
  padding: 24px;
  background-color: #f1f1f1;
  min-width: 325px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 9999999;
}

.dropdown:hover .dropdown-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  width: 800px;
}
.dropdown:hover .dropdown-content-onde-comprar {
  display: grid;
  grid-template-columns: 1fr;
  width: 300px;
}

.dropdown:hover .dropbtn {
  color: #00b1ef;
}
.border_bottom_menu {
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
  -webkit-background-clip: padding-box; /* for Safari */
  background-clip: padding-box;
}
/* #color {
  azulPadrao: '#00b1ef'
  azulFD: '#1b3346'
  azulFD2: '#0c1a25'
} */
</style>
