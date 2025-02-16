<template>
  <div
    class="bg_rodape relative flex min-h-[1300px] w-full flex-col justify-center bg-[#1b3346]"
  >
    <div
      id="logoDuplo"
      class="absolute bottom-[450px] right-[10%] z-0 h-[600px] w-[1100px]"
    >
      <div class="relative">
        <div class="absolute right-0 top-5 opacity-30">
          <img src="/img/eletromar_borda.png" />
        </div>
        <div class="absolute right-28 top-[50px] hidden lg:block">
          <img src="/img/eletromar_cheio.png" />
        </div>
      </div>
    </div>
    <div
      class="container z-10 mx-auto flex h-full w-full flex-col items-center space-y-16 py-20 lg:h-[790px] lg:flex-row lg:space-x-5 lg:space-y-0 lg:px-20 lg:py-0"
    >
      <div
        class="paraDireita w-[300px] py-10 pb-0 sm:w-[350px] lg:min-h-[450px] lg:py-0 lg:pb-0"
      >
        <h1
          class="pb-6 text-xl font-medium uppercase tracking-wider text-[#00b1ef]"
        >
          {{ $t("institucional") }}
        </h1>
        <div
          class="linksRodape flex flex-col space-y-2 text-lg tracking-wider text-white"
        >
          <a
            :href="MNU_TOPO_lang[0].rota"
            target="_top"
            class="m_title cursor-pointer lowercase"
            >{{ MNU_TOPO_lang[0].titulo }}</a
          >
          <a
            :href="MNU_TOPO_lang[1].rota"
            target="_top"
            class="cursor-pointer"
            >{{ MNU_TOPO_lang[1].titulo }}</a
          >
          <a
            :href="MNU_TOPO_lang[2].rota"
            target="_top"
            class="cursor-pointer"
            >{{ MNU_TOPO_lang[2].titulo }}</a
          >
          <a
            :href="MNU_TOPO_lang[3].rota"
            target="_top"
            class="cursor-pointer"
            >{{ MNU_TOPO_lang[3].titulo }}</a
          >
          <div class="flex cursor-pointer flex-col">
            <div
              @click="toggleOndeComprar()"
              class="flex cursor-pointer flex-col"
            >
              {{ MNU_TOPO_lang[4].titulo }}
            </div>
            <div id="ondeComprarMnuID" class="hidden">
              <a
                href="https://loja.mectronic.com.br/"
                target="_blank"
                class="cursor-pointer pl-4 text-base"
                >Mec-Tronic / Eletromar</a
              >

              <!-- <a
                href="https://loja.eletromar.com.br/"
                target="_blank"
                class="cursor-pointer pl-4 text-base hover:text-[#71DF43]"
                >Eletromar</a
              > -->
            </div>
          </div>
          <a :href="MNU_TOPO_lang[5].rota" class="cursor-pointer">{{
            MNU_TOPO_lang[5].titulo
          }}</a>
          <a
            href="https://www.mectronic.com.br/"
            target="_blank"
            class="cursor-pointer"
            >Mec-Tronic</a
          >
          <a :href="MNU_TOPO_lang[7].rota" class="cursor-pointer">{{
            MNU_TOPO_lang[7].titulo
          }}</a>

          <!-- 
          <a href="">A Empresa</a>
          <a href="">Soluções</a>
          <a href="">Catálogo</a>
          <a href="">Blog</a>
          <a href="">Onde Comprar</a>
          <a href="">Contato</a>
          <a href="">Eletromar</a>
          <a href="">Trabalhe Conosco</a> -->
        </div>

        <div
          class="daHoverSlide Xabsolute mt-10 w-[300px] cursor-pointer text-[1rem] sm:w-[340px] sm:text-[1.2rem]"
        >
          <div @click="botaoComprar()">
            <span @click="botaoComprar()">{{
              $t("encontreumrepresentante")
            }}</span>
          </div>
          <div @click="botaoComprar()">
            <span class="daspan" @click="botaoComprar()">{{
              $t("encontreumrepresentante")
            }}</span>
          </div>
        </div>
      </div>

      <div
        class="paraDireita w-[280px] tracking-wider sm:w-[350px] lg:min-h-[450px] lg:py-0 lg:pt-0"
      >
        <h1 class="pb-6 text-xl font-medium uppercase text-[#00b1ef]">
          {{ $t("centraldocliente") }}
        </h1>
        <div class="linksRodape flex flex-col space-y-2 text-lg text-white">
          <a
            href="/garantias"
            target="_top"
            class="cursor-pointer capitalize"
            >{{ $t("termosgarantia") }}</a
          >
          <a href="/politica" target="_top" class="cursor-pointer capitalize">{{
            $t("politicaqualidade")
          }}</a>
          <a href="/meio-ambiente" class="cursor-pointer capitalize">{{
            $t("meioambiente")
          }}</a>
          <a
            href="https://web.whatsapp.com/send?phone=5581992787518"
            target="_blank"
            >SAC</a
          >
          <a href="/faq" class="cursor-pointer">FAQ</a>
          <a href="/sociais" class="cursor-pointer capitalize">{{
            $t("programassociais")
          }}</a>
        </div>
      </div>

      <div class="paraDireita w-[300px] sm:w-[350px] lg:min-h-[450px]">
        <h1 class="text-xl font-medium uppercase tracking-wider text-[#00b1ef]">
          {{ $t("redesociais") }}
        </h1>
        <!-- SOCIAL -->
        <div class="w-[200px] pt-3">
          <div class="flex h-[80px] flex-row items-center justify-around">
            <div
              id="rodape_instagran"
              class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] transition-all hover:bg-[#00b1ef]"
            >
              <img
                src="/img/icon_insta.png"
                alt=""
                width="24px"
                height="24px"
              />
            </div>
            <div
              id="xlogoFacebook"
              class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] p-[20px] transition-all hover:bg-[#00b1ef]"
            >
              <img src="/img/icon_face.png" alt="" width="16px" height="16px" />
            </div>
            <div
              class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] p-[16px] transition-all hover:bg-[#00b1ef]"
            >
              <img src="/img/icon_in.png" alt="" width="16px" height="16px" />
            </div>
          </div>
        </div>
        <h1
          class="pb-6 pt-8 text-xl font-medium uppercase tracking-wider text-[#00b1ef]"
        >
          {{ $t("registro") }}
        </h1>
        <h3 class="w-60">
          <a href="https://linktr.ee/mectronic.eletromar" target="_blank">
            <img src="/img/logo-cialdnb-white.webp" alt="" />
          </a>
        </h3>

        <h1
          class="pt-8 text-xl font-medium uppercase tracking-wider text-[#00b1ef]"
        >
          {{ $t("CONTATO") }}
        </h1>
        <div
          class="mt-6 flex flex-col space-y-6 md:flex-row md:space-x-5 md:space-y-0"
        >
          <div class="h-20 w-auto text-xl text-white">
            <p class="w-[400px] text-lg lg:text-lg">{{ contato.email }}</p>
            <p class="text-lg">{{ contato.fone1 }}</p>
            <div class="flex flex-row space-x-2g">
              <p class="text-lg">
                {{ contato.fone2 }}
              </p>
              <p class="relative -top-4 hidden md:block pl-3">
                <ph-whatsapp-logo :size="52" class="text-[#70df3f]" />
              </p>
              <p class="relative -top-2 block md:hidden pl-3">
                <ph-whatsapp-logo :size="32" class="text-[#70df3f]" />
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MAP GOO -->
    <div id="map" class="h-[420px] w-full bg-slate-400"></div>

    <div
      class="container mx-auto flex h-[90px] w-full flex-row items-center justify-between px-6"
    >
      <div
        class="flex flex-row items-center space-x-2 text-sm uppercase text-white"
      >
        <span><ph-copyright :size="16" /> </span
        ><span>2023 {{ $t("direitosreservados") }}</span>
      </div>
      <a
        id="seta"
        class="animate-bounce"
        onclick='window.scrollTo({top: 0, behavior: "smooth"});'
      >
        <div></div>
      </a>
    </div>
  </div>
</template>

<script setup>
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ref } from "vue";
import { useI18n } from "vue-i18n";
gsap.registerPlugin(ScrollTrigger);
const i18nLocale = useI18n();

import {
  PhArrowCircleUp,
  PhCopyright,
  PhFacebookLogo,
  PhInstagramLogo,
  PhWhatsappLogo,
} from "phosphor-vue";

import { Loader } from "@googlemaps/js-api-loader";
components: {
  PhCopyright;
  PhArrowCircleUp;
  PhInstagramLogo;
  PhFacebookLogo;
}

const contato = ref({
  email: "contato@mectronic-eletromar.com.br",
  fone1: "+55 (81) 2138.7200",
  fone2: "+55 (81) 99278-7518",
});

onMounted(() => {
  function hide(elem) {
    gsap.set(elem, { autoAlpha: 0 });
  }

  function animateFrom(elem, direction, i) {
    direction = direction || 1;
    var x = 0,
      y = direction * 100;
    if (elem.classList.contains("paraEsquerda")) {
      x = -100;
      y = 0;
    } else if (elem.classList.contains("paraDireita")) {
      x = 100;
      y = 0;
    }
    elem.style.transform = "translate(" + x + "px, " + y + "px)";
    elem.style.opacity = "0";
    gsap.fromTo(
      elem,
      { x: x, y: y, autoAlpha: 0 },
      {
        duration: 0.5 * i,
        x: 0,
        y: 0,
        autoAlpha: 1,
        ease: "Poewer1",
        overwrite: "auto",
        stagger: 1.5,
      }
    );
  }

  gsap.utils.toArray(".paraDireita").forEach(function (elem, i) {
    hide(elem);

    ScrollTrigger.create({
      trigger: elem,
      onEnter: function () {
        animateFrom(elem, 1, i + 1);
      },
      onEnterBack: function () {
        animateFrom(elem, -1);
      },
      onLeave: function () {
        //hide(elem);
      },
    });
  });
});

const habilitaMaps = true;
//GOOGLE MAPS
onMounted(() => {
  if (habilitaMaps == true) {
    const center = { lat: -7.9804445019963595, lng: -35.059436727566066 };
    const KEY = "AIzaSyAkGBT5cz9VvGP1MNsm0Nz1R_mHDJzWTLc";
    const loader = new Loader({
      apiKey: "AIzaSyAkGBT5cz9VvGP1MNsm0Nz1R_mHDJzWTLc",
    });

    const mapOptions = {
      center: {
        lat: -7.9807258675503885,
        lng: -35.060058338040676,
      },

      zoom: 16,
    };
    const zoom = ref(15);

    const mapMarker = { lat: -7.9804445019963595, lng: -35.059436727566066 };

    loader.load().then((google) => {
      const map = new google.maps.Map(
        document.getElementById("map"),
        mapOptions
      );

      const image = {
        url: "/img/makerMaps.png",
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(200, 302),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(74, 95),
      };

      const contentString =
        '<div id="content">' +
        '<div id="siteNotice">' +
        "</div>" +
        '<h1 id="firstHeading" class="firstHeading">Mec-Tronic</h1>' +
        '<div id="bodyContent">' +
        "<p>Rodovia PE 05, Km 22.5, Lote 1, Quadra A, s/n - Tiuma, São Lourenço da Mata - PE, 54737-200</p>" +
        "</div>" +
        "</div>";

      const infowindow = new google.maps.InfoWindow({
        content: contentString,
        ariaLabel: "Uluru",
      });

      const marker = new google.maps.Marker({
        position: {
          lat: mapOptions.center.lat,
          lng: mapOptions.center.lng,
        },
        icon: image,
        map,
        title: "Mec-Tronic",
      });

      marker.addListener("click", () => {
        infowindow.open({
          anchor: marker,
          map,
        });
      });
    });
  }

  //window.initMap = initMap;
});

// const MNUPrincipal = ref([
//   { titulo: "A Empresa", rota: "/empresa" },
//   { titulo: "Solucoes", rota: "/solucoes" },
//   { titulo: "Catálogo", rota: "/catalogo" },
//   { titulo: "Blog", rota: "/blog" },
//   { titulo: "Onde Comprar", rota: "/comprar" },
//   { titulo: "Contato", rota: "/contato" },
//   { titulo: "Eletromar", rota: "/" },
//   { titulo: "Trabalhe Conosco", rota: "/trabalheconosco" },
// ]);

const lang = ref();
onBeforeMount(() => {
  lang.value = localStorage.getItem("lang");
  if (!lang.value) {
    MNU_TOPO_lang.value = MNU_TOPO_pt.value;
  }
  setMenuLang();
});
onMounted(() => {
  setMenuLang();
});

const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});

watch(i18nLocale.locale, () => {
  atualizaLocale();
  setMenuLang();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}
const MNUPrincipal = ref([
  { titulo: "A Empresa", rota: "/empresa" },
  { titulo: "Produtos", rota: "/solucoes" },
  { titulo: "Catalogo", rota: "/catalogo" },
  { titulo: "Blog", rota: "/blog" },
  { titulo: "Onde Comprar", rota: "/comprar" },
  { titulo: "Contato", rota: "/contato" },
  { titulo: "Eletromar", rota: "/" },
  { titulo: "Trabalhe Conosco", rota: "/trabalheconosco" },
]);

const MNU_TOPO_lang = ref([]);
const MNU_TOPO_pt = ref([
  { titulo: "A Empresa", rota: "/empresa" },
  { titulo: "Produtos", rota: "/solucoes" },
  { titulo: "Catalogo", rota: "/catalogo" },
  { titulo: "Blog", rota: "/blog" },
  { titulo: "Onde Comprar", rota: "/comprar" },
  { titulo: "Contato", rota: "/contato" },
  { titulo: "Mec-Tronic", rota: "/" },
  { titulo: "Trabalhe Conosco", rota: "/trabalheconosco" },
]);
const MNU_TOPO_en = ref([
  { titulo: "The company", rota: "/empresa" },
  { titulo: "Products", rota: "/solucoes" },
  { titulo: "Catalog", rota: "/catalogo" },
  { titulo: "Blog", rota: "/blog" },
  { titulo: "Where to buy", rota: "/comprar" },
  { titulo: "Contact", rota: "/contato" },
  { titulo: "Mec-Tronic", rota: "/" },
  { titulo: "Work with us", rota: "/trabalheconosco" },
]);
const MNU_TOPO_es = ref([
  { titulo: "La Empresa", rota: "/empresa" },
  { titulo: "Productos", rota: "/solucoes" },
  { titulo: "Catalogar", rota: "/catalogo" },
  { titulo: "Blog", rota: "/blog" },
  { titulo: "Donde Comprar", rota: "/comprar" },
  { titulo: "Contacto", rota: "/contato" },
  { titulo: "Mec-Tronic", rota: "/" },
  { titulo: "Trabaja con nosotros", rota: "/trabalheconosco" },
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

function toggleOndeComprar() {
  document.getElementById("ondeComprarMnuID").classList.toggle("aberto");
}

function botaoComprar() {
  //const POST = JSON.stringify(post);

  window.location.assign("/comprar");
}
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
.m_title::first-letter {
  text-transform: uppercase;
}
.aberto {
  position: relative;
  top: 10px;
  display: flex;
  flex-direction: column;
  opacity: 0;
  animation: opacidade 0.5s forwards;
}

@keyframes opacidade {
  0% {
    opacity: 0;
    top: 10px;
  }
  100% {
    opacity: 1;
    top: 0px;
  }
}
#seta {
  position: relative;
  width: 45px;
  height: 45px;
  padding: 4px;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  background-color: #00b1ef;
  border-radius: 100%;
}
#seta:hover {
  cursor: pointer;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 5px;
  box-shadow: 2px -2px 0 1px #ffffff inset;
  border: solid transparent;
  border-width: 0 0 3px 3px;
  transform: rotate(135deg);
}
#logoFacebook {
  display: block;
  text-indent: -9999px;
  width: 40px;
  height: 40px;
}
#logoFacebook:hover {
  width: 50px;
  height: 50px;
  background-size: 50px 50px;
}
.linksRodape > a:hover {
  color: #00b1ef;
}

.daHoverSlide {
  display: flex;
  flex-direction: column;
  transition: 3s;
  --width: 100%;
  height: 60px;
  background-color: #fff;

  overflow-y: hidden;
  scroll-snap-type: y mandatory;

  scroll-behavior: smooth;
}
.daHoverSlide > div:nth-child(1),
.daHoverSlide > div:nth-child(2) {
  scroll-snap-align: start;
  flex-shrink: 0;
  position: relative;
  widows: 100%;
  height: 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding-left: 1.3rem;
  transition: 0.3s;
  font-weight: 700;
  --font-size: 1.6rem;
  line-height: 2rem;
}
.daHoverSlide > div:nth-child(1) {
  background-color: #00b1ef;
  border: solid 3px #48ceff;
  color: #fff;
}
.daHoverSlide > div:nth-child(2) {
  background-color: #fff;
  color: #00b1ef;

  padding-top: 0px;
}
.daHoverSlide:hover > div:nth-child(1) {
  margin-top: -17%;
}
.daHoverSlide:hover > div:nth-child(2) > .daspan {
  animation-duration: 0.5s;

  animation-name: slidein;
}

@keyframes slidein {
  from {
    padding-top: 150px;
  }

  to {
    padding-top: 0px;
  }
}

.eletroTx {
  -webkit-text-stroke: 4px black;
  color: white;
  font-size: 15rem;
}
.bg_rodape {
  background-image: url("/img/fd_rodape.png");
  background-size: cover;

  /* background-position-x: -300px; */
  /* background: radial-gradient(
    96.76% 96.76% at 62.8% 3.24%,
    #26442c 0%,
    #37603e 100%
  ); */
}
</style>
