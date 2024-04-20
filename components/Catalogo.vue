<template>
  <div envelope="solucoesDetalhe">
    <div class="drawLineContCata">
      <div
        class="drawLineInnerContCata"
        id="drawLineInnerContIDCata"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      class="bg_catalogo relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txCatalogoID"
        class="container relative mx-auto text-center text-[3rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("catalogo") }}
      </div>
    </div>
    <div class="bg-[#1b3346] px-5 pb-[60px]">
      <div
        id="catalogoTitID"
        class="space-y-4 overflow-hidden pt-[130px] text-center"
      >
        <div class="H1Cat">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("catalogosdisponiveis")
          }}</span>
        </div>
        <div class="H2Cat">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("cliquenolinkparavisualizaropd")
          }}</span>
        </div>
      </div>

      <!-- GRID DE CATALOGO -->
      <div
        class="container mx-auto flex min-h-screen flex-col flex-wrap items-center justify-center gap-40 py-20 xl:flex-row"
      >
        <div
          v-for="(catalogo, index) in catalogos"
          :key="index"
          class="catalogoEvelope h-[300px] w-[300px] sm:h-[500px] sm:w-[500px]"
        >
          <div
            @click="clickDownload(index)"
            class="pdfOverlay absolute left-0 top-0 h-[300px] w-[300px] opacity-0 sm:h-[500px] sm:w-[500px]"
          ></div>
          <figure
            class="absolute left-0 top-0 h-[300px] w-[300px] sm:h-[500px] sm:w-[500px]"
          >
            <a
              :id="'pdf-' + index"
              target="_blank"
              :href="pathCatalogos + catalogo.pdf"
            >
              <img
                v-bind:src="pathCatalogos + catalogo.imagem"
                class="h-[300px] w-[300px] sm:h-[500px] sm:w-[500px]"
              />
            </a>
            <figcaption
              class="w-full pt-10 text-center text-3xl font-bold uppercase text-[#00b1ef] underline opacity-100 xl:opacity-0"
            >
              {{ catalogo.titulo }}
            </figcaption>
          </figure>
        </div>
      </div>
      <!-- Oauths google e facebook-->
      <div>
              <!-- <GoogleSignInButton
                  @success="handleLoginSuccess"
                  @error="handleLoginError"
                ></GoogleSignInButton>
                <FacebookSignin
                    :appId="facebookAppId"
                    @success="onSignInSuccessFacebook"
                    @error="onSignInErrorFacebook"
                    class="text-white cursor-pointer">
                      <span class="btn-primary">Login com Facebook</span>
                </FacebookSignin> -->
            </div>
    </div>
  </div>
</template>
  
  <script setup>
import { ref, onMounted } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

import { FacebookSignin } from 'vue3-google-facebook-signin';

const facebookAppId = ref('1656170781561123');

function onSignInSuccessFacebook(response) {
// Dados de sucesso do login
console.log(response)

// acessa os dados do usuário
const userID = response.authResponse.userID;
const accessToken = response.authResponse.accessToken;

// Obter nome e foto do perfil
window.FB.api(`/${userID}?fields=name,picture`, function (response) {
  if (response && !response.error) {
    const userName = response.name;
    const userPicture = response.picture.data.url;

    console.log('Nome do usuário:', userName);
    console.log('URL da foto do perfil:', userPicture);

  }
});
}
function onSignInErrorFacebook(error) {
  // Manipula erro do login
  console.log("login failed");
}

import { GoogleSignInButton, decodeCredential } from "vue3-google-signin";

// handle success event
const handleLoginSuccess = (response) => {
  const { credential } = response;
  console.log("Access Token", credential);
  const decodedCredential = decodeCredential(credential);
  console.log("User:", decodedCredential);

  // email: "da.visaoazul@gmail.com";
  // email_verified: true;
  // family_name: "Azul";
  // given_name: "Digital";
  // hd: undefined;
  // id: "117730128828758432247";
  // name: "Digital Azul";
  // picture: "https://lh3.googleusercontent.com/a/AAcHTte4v6BXerdgbt9Ib2Yc7jeFk23bYGqGF45xs-WM=s96-c";
};
// handle an error event
const handleLoginError = () => {
  console.error("Login failed");
};


gsap.registerPlugin(ScrollTrigger);
const pathCatalogos = "\\media\\catalogos\\";
const catalogos = ref([]);

let lang = ref("");
const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});

watch(i18nLocale.locale, () => {
  atualizaLocale();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}

let atualY = ref(-100);
let ultimaPosicao = ref(0);
onMounted(() => {
  // obtem catalogos
  getCatalogos();

  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#catalogoTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1Cat", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2Cat", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  ScrollTrigger.create({
    trigger: ".drawLineContCata",
    start: "center bottom",
    end: "+=1000px",
    onEnter: () => {
      atualY.value = -100;
    },
    onLeave: () => {
      atualY.value = 100;
    },
    onEnterBack: () => {
      atualY.value = 100;
    },
    onUpdate: (self) => setTranslate(self.progress),
  });

  function setTranslate(pg) {
    let yInicial = pg;
    let txCatalogoIDspacer = document.getElementById("txCatalogoID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDCata.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txCatalogoIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txCatalogoIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDCata.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

function clickDownload(index) {
  document.getElementById("pdf-" + index).click();
}
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
</script>
  
  <style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}

#faixaHorzCat {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0;
  width: 3px;
  height: 220px;
  background-color: #9ade53;
}
.catalogoEvelope {
  cursor: pointer;
  position: relative;
}

.catalogoEvelope:hover > figure > figcaption {
  opacity: 1;
}

.catalogoEvelope:hover > div:nth-child(1) {
  opacity: 0.6;
  z-index: 99;
}

.pdfOverlay {
  background-color: #1b3346;
  background-image: url("/img/pdfOver.svg");
  background-repeat: no-repeat;
  background-size: contain;
  border: 2px solid #00b1ef;
}
.bg_catalogo {
  background: url("/img/bg_banner_1.jpg");
  background-size: cover;
}

.drawLineContCata {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContCata {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
</style>
  