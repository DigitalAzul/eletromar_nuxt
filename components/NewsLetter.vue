<template>
  <div
    class="NewsLetter relative flex h-[800px] w-full flex-col items-center bg-[#1b3346]"
  >
    <div class="drawLineNews">
      <div
        class="drawLineInnerNews"
        id="drawLineInnerNewsID"
        style="
          will-change: transform;
          transform: translate3d(0px, 0%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      id="newsLetterTitID"
      class="flex w-full flex-col items-center overflow-hidden lg:w-[700px]"
    >
      <div class="space-y-4 pt-[130px] text-center">
        <div class="H1News">
          <span class="text-3xl uppercase text-[#00b1ef]">NEWS LETTER</span>
        </div>
        <div class="H2News">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("sejaoprimeiroasaber")
          }}</span>
        </div>
      </div>

      <!-- FORM -->
      <div
        class="flex h-[440px] w-full flex-col overflow-clip px-6 pb-10 pt-20 lg:w-[700px]"
      >
        <div id="formNewsSendID" class="h-[440px] w-full lg:w-[700px]">
          <div>
            <div class="envelopLinha overflow-clip">
              <div class="lnForm w-full">
                <div
                  class="sublnForm flex h-16 w-full flex-row border-b border-white py-14"
                >
                  <div class="text-[#00b1ef]"><ph-user :size="32" /></div>
                  <div class="mx-8 w-full">
                    <input
                      v-model="formNews.nome"
                      class="h-10 w-full bg-transparent"
                      type="text"
                      :placeholder="$t('seunome')"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="envelopLinha overflow-clip">
              <div class="lnForm w-full">
                <div
                  class="sublnForm flex h-16 w-full flex-row border-b border-white py-14"
                >
                  <div class="text-[#00b1ef]">
                    <ph-envelope-simple :size="32" />
                  </div>
                  <div class="mx-8 w-full">
                    <input
                      v-model="formNews.email"
                      class="h-10 w-full bg-transparent"
                      type="text"
                      :placeholder="$t('seuemail')"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="lnForm">
            <div class="sublnForm pr-6">
              <div
                @click="cadastraNews()"
                class="SETANEWS flex flex-row justify-end space-x-14 pr-6 pt-24"
              >
                <div>
                  {{ $t("enviar") }}
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
        <div
          class="flex h-[420px] w-full items-center justify-center py-10 lg:w-[700px]"
        >
          <div class="p-10 text-center text-2xl leading-snug text-[#00b1ef]">
            <p v-if="!formValido">É necessário um nome e email válidos</p>
            <p v-else>
              Parabéns <span class="text-white">{{ formNews.nome }}</span> pela
              sua inscrição.<br />Lhe enviaremos as novidades de nossas Linhas e
              Soluções.
            </p>
            <p
              @click="animaFormSend()"
              class="cursor-pointer py-6 text-xl text-white"
            >
              Voltar
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { PhEnvelope, PhEnvelopeSimple, PhUser } from "phosphor-vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

gsap.registerPlugin(ScrollTrigger);

components: {
  PhUser;
  PhEnvelopeSimple;
}
const respNewsModal = ref(true);
let formNews = ref({
  nome: "",
  email: "",
});
function cadastraNews() {
  console.log(formNews.value);
  formRequestNews();
}

async function formRequestNews() {
  if (!validaEmail(formNews.value.email)) {
    formValido.value = false;
    animaFormSend();
    return;
  }
  formValido.value = true;
  let formdDataNews = new FormData();
  formdDataNews.append("json", JSON.stringify(formNews.value));
  return await $fetch("/api/formNewsLetter.php", {
    mode: "cors",
    method: "POST",
    body: formdDataNews,
  }).then(() => {
    animaFormSend();
  });
}

const formNewsSendID = ref(true);
const formValido = ref(false);

function animaFormSend() {
  let formNewsSend = document.getElementById("formNewsSendID");
  //ao enviar form
  if (formNewsSendID.value) {
    formNewsSend.classList.add("newsSucesso");
    formNewsSendID.value = false;
  } else {
    // ao voltar form
    formNewsSend.classList.remove("newsSucesso");
    formNewsSendID.value = true;
    if (formValido.value === true) {
      formNews.value = {
        nome: "",
        email: "",
      };
    }
    formValido.value = false;
  }
}

onMounted(() => {
  setTimeout(() => {
    ScrollTrigger.refresh();
    // const childSplitEsqNews = new SplitType(".H1News", {
    //   type: "lines",
    //   linesClass: "split-childNews",
    // });
    // const childSplitDirNews = new SplitType(".H2News", {
    //   type: "lines",
    //   linesClass: "split-childNews",
    // });

    const tlNotTitNews = gsap.timeline({
      scrollTrigger: {
        trigger: "#newsLetterTitID",
        start: "top center",
        end: "bottom bottom",
        //toggleActions: "play none play reverse",
      },
    });
    tlNotTitNews.from(".H1News", {
      duration: 0.6,
      opacity: 1,
      xPercent: 100,
      ease: "power4",
      stagger: 0.1,
    });
    tlNotTitNews.from(".H2News", {
      duration: 0.6,
      opacity: 1,
      xPercent: -150,
      ease: "power4",
      stagger: 0.1,
    });
    const tllnForm = gsap.timeline({
      scrollTrigger: {
        trigger: "#formNewsSendID",
        start: "top center",
        //end: "bottom bottom",
        toggleActions: "play restart play reverse",
      },
    });

    tllnForm.from(".lnForm .sublnForm", 1, {
      y: "100%",
      ease: "expo.inOut",

      stagger: {
        amount: 0.3,
      },
    });

    let ultimaPosicao = 0;
    let Y = -100;
    let ease = 0.5;

    let drawLineInnerNewsID = document.getElementById("drawLineInnerNewsID");
    let topPosRep = drawLineInnerNewsID.offsetTop;

    setTranslate(-100);
    function setTranslate(yPos) {
      drawLineInnerNewsID.style.transform = `translate3d(0, ${yPos}%, 0)`;
      if (Y < -100) Y = -100;
      if (Y > 100) Y = 100;
    }

    window.addEventListener("scroll", () => {
      let { scrollY } = window;

      let yInicial = window.scrollY;
      if (scrollY > topPosRep - 1000) {
        if (yInicial > ultimaPosicao) {
          if (Y <= 100) {
            Y += 10 * ease;
            setTranslate(Y);
          }
        } else {
          if (scrollY == 0) {
            setTranslate(-100);
            Y = -100;
            return;
          }
          if (Y >= -100) {
            Y -= 10 * ease;
            setTranslate(Y);
          }
        }
        ultimaPosicao = yInicial;
      }
    });
  }, 3000);
});

function validaEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}
</script>


<style scoped>
body {
  overflow: auto;
}

.newsSucesso {
  animation-name: newsSend;
  animation-duration: 1s;
  animation-fill-mode: forwards;
}
@keyframes newsSend {
  0% {
    margin-top: 0px;
    opacity: 1;
  }

  100% {
    margin-top: -460px;
    opacity: 0;
  }
}

#newsLetterTitID {
  opacity: 1;
  transform: rotate(0deg) translateY(0%);
}
.drawLineNews {
  z-index: 9999999;
  position: absolute;
  left: 50%;
  top: -150px;
  right: auto;

  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerNews {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
input {
  color: #fff;
  font-size: 1.5em;
  border: none;
  -webkit-appearance: none;
  -ms-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
input:focus {
  border: none;
  outline: none;
  box-shadow: none;
}
input::placeholder {
  color: #fff;
}
#setaNewsMais {
  position: relative;
  cursor: pointer;
  display: flex;
  flex-direction: row;
  align-items: center;
}
#setaNewsMais:hover div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
#setaNewsMais:hover div:nth-child(2) {
  background-color: #00b1ef;
}

#setaNewsMais > div:nth-child(1) {
  position: absolute;
  top: 0px;
  padding: 9px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
}
#setaNewsMais > div:nth-child(2) {
  position: absolute;
  top: 8px;
  left: -30px;
  width: 50px;
  height: 2px;
  background-color: #fff;
}
.SETANEWS:hover {
  position: relative;
  cursor: pointer;
}
.SETANEWS > div:nth-child(1) {
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
  transform: translateY(-5px);
}
.SETANEWS:hover div:nth-child(1) {
  color: #00b1ef;
}
.SETANEWS:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
.SETANEWS:hover #seta > div:nth-child(2) {
  background-color: #00b1ef;
}

#seta {
  position: relative;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 10px;
  box-shadow: 2px -2px 0 1px #fff inset;
  border: solid transparent;
  border-width: 0 0 3px 3px;
  transform: rotate(225deg);
}
#seta > div:nth-child(2) {
  position: absolute;
  top: 10px;
  left: -37px;
  width: 60px;
  height: 3px;
  background-color: #fff;
}
</style>