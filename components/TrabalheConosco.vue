<template>
  <div envelope="trabalheConosco">
    <div class="drawLineContTrab">
      <div
        class="drawLineInnerContTrab"
        id="drawLineInnerContIDTrab"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>
    <div
      class="bg_trabalheConosco relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txTrabalheID"
        class="container relative mx-auto text-center text-[3rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("trabalheconosco") }}
      </div>
    </div>
    <div class="bg-[#1b3346] py-[60px]">
      <div class="space-y-4 pt-[130px] text-center">
        <p class="text-3xl uppercase text-[#00b1ef]">
          {{ $t("enviesuamensagem") }}
        </p>
        <p class="text-4xl font-bold uppercase text-white">
          {{ $t("venhafazerpartedonossotime") }}
        </p>
      </div>

      <!-- FORM Trabalhe conosco -->

      <div id="formTrabalheConID" class="container mx-auto min-h-screen">
        <div class="px-4 lg:px-20">
          <form action="">
            <div
              class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
            >
              <div
                class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
              >
                <input
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('seunome')"
                  v-model="formTrabalheConosco.nome"
                />
              </div>
            </div>

            <div
              class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
            >
              <div
                class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
              >
                <input
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('seuemail')"
                  v-model="formTrabalheConosco.email"
                />
              </div>
            </div>

            <!--Por um selector das areas de interesses -->
            <div class="flex flex-col lg:flex-row lg:space-x-14">
              <div
                class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
              >
                <div
                  class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                >
                  <div class="selectdiv h-[10px] w-full">
                    <select class="w-full" @change="setSelect($event, 'setor')">
                      <option selected class="lowercase">
                        {{ $t("setordeinteresse") }}
                      </option>
                      <option
                        class="uppercase"
                        v-for="(opt, index) in selectOptions"
                        :key="index"
                        :value="opt.id"
                      >
                        {{ opt.label }}
                      </option>
                    </select>
                    <div for="" class="setaPraBaixo"></div>
                  </div>
                  <!-- <input
                    class="h-10 w-full bg-transparent"
                    type="text"
                    value=""
                    placeholder="Setor de interesse*"
                  /> -->
                </div>
              </div>
              <!--Por um selector de estados-->
              <div
                class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
              >
                <div
                  class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                >
                  <div class="selectdiv h-[10px] w-full">
                    <select class="w-full" @change="setSelect($event, 'uf')">
                      <option selected>{{ $t("seueestado") }}</option>
                      <option
                        v-for="(uf, index) in estadosOptions"
                        :key="index"
                      >
                        {{ uf.text }}
                      </option>
                    </select>
                    <div for="" class="setaPraBaixo"></div>
                  </div>
                  <!-- <input
                    class="h-10 w-full bg-transparent"
                    type="text"
                    value=""
                    placeholder="Seu estado*"
                  /> -->
                </div>
              </div>
            </div>
            <div class="flex flex-row space-x-14">
              <div
                class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
              >
                <div
                  class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
                >
                  <input
                    class="h-10 w-full bg-transparent"
                    type="text"
                    :placeholder="$t('suacidade')"
                    v-model="formTrabalheConosco.cidade"
                  />
                </div>
              </div>
              <!--Colocar para aceitar documentos no Anexar curriculo-->
              <div
                class="lnCont justify-around' relative flex h-16 w-full flex-row overflow-hidden border-b border-[#00b1ef] py-10 pb-11"
              >
                <label
                  for="curriculoID"
                  id="labelCurriculoID"
                  class="sublnCont absolute mr-8 w-full cursor-pointer pb-[10px] pl-4 text-white"
                >
                  Anexar curriculo*
                </label>
                <input
                  id="curriculoID"
                  selectdivClip
                  class="inputfile invisible h-10 w-full cursor-pointer bg-transparent"
                  data-multiple-caption="( {nome} ) Selecionado"
                  type="file"
                  accept="application/pdf, application/vnd.ms-excel"
                  :placeholder="$t('anexarcurriculo')"
                />
                <div for="curriculoID" class="clip"></div>
              </div>
            </div>

            <div
              class="lnCont relative flex min-h-[370px] w-full flex-row overflow-hidden py-10 pb-11"
            >
              <div class="sublnCont absolute mr-8 w-full">
                <div
                  class="my-10 flex h-[210px] w-full flex-row border border-[#00b1ef]"
                >
                  <textarea
                    name=""
                    id=""
                    cols="30"
                    rows="10"
                    :placeholder="$t('seucomentario')"
                    class="h-48 w-full border-none border-[#00b1ef] bg-transparent p-4 text-white"
                    v-model="formTrabalheConosco.comentario"
                  ></textarea>
                </div>
                <div class="mt-10">
                  <label class="checkboxID text-sm font-light text-white"
                    >{{ $t("aceitepolitica") }}
                    <input
                      type="checkbox"
                      v-model="formTrabalheConosco.politica"
                    />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>

            <div class="lnCont">
              <div
                class="sublnCont mt-10 flex flex-col space-y-6 md:flex-row md:space-x-5 md:space-y-0"
              >
                <div class="h-20 w-72 pt-2"><div ref="root" /></div>
                <div class="h-20 w-auto pl-4 text-xl text-white">
                  <p>{{ contato.email }}</p>
                  <p>{{ contato.fone1 }}</p>
                  <div class="flex flex-row space-x-2">
                    <p>
                      {{ contato.fone2 }}
                    </p>
                    <p class="relative -top-4 hidden md:block">
                      <ph-whatsapp-logo :size="52" class="text-[#00b1ef]" />
                    </p>
                    <p class="relative -top-2 block md:hidden">
                      <ph-whatsapp-logo :size="32" class="text-[#00b1ef]" />
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div
              @click="enviarCurriculo()"
              class="SETANEWS flex flex-row justify-start space-x-14 pr-6 pt-24"
            >
              <div>{{ $t("enviar") }}</div>
              <div>
                <div id="seta">
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>

            <!-- <div class="container mx-auto flex pt-24">
              <div id="setaNewsMais">
                <div></div>
                <div></div>
                <div>{{ $t("enviar") }}</div>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
    <x-modal v-model="modalTrabalhe" show-close backdrop>
      {{ modalTrabalheTXT }}
    </x-modal>
  </div>
</template>
    
    <script setup>
import { ref, onMounted } from "vue";
import { PhWhatsappLogo } from "phosphor-vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import SplitType from "split-type";
gsap.registerPlugin(ScrollTrigger);

import { XModal } from "@indielayer/ui";

components: {
  XModal;
}

// REMOVIDO 10-09-2024--21-27 PARA TESTE,  ESTA DANDO ERRO
//import { useRecaptchaProvider } from "vue-recaptcha";
//import { useChallengeV2 } from "vue-recaptcha";
//useRecaptchaProvider();
//const { root, widgetID, execute, onVerify, onExpired, onError, reset } =
//  useChallengeV2({
//    options: {
//      size: "normal",
//    },
//  });

//const captchaValido = ref(false);
//onVerify(async (response) => {
//  captchaValido.value = true;
//});

//onExpired(() => {
//  reset();
//  captchaValido.value = false;
//});

components: {
  PhWhatsappLogo;
}

const modalTrabalhe = ref(false);
const modalTrabalheTXT = ref("");
const formTrabalheConosco = ref({
  politica: "",
  comentario: "",
  cidade: "",
  uf: "",
  setor: "",
  email: "",
  nome: "",
});

function setSelect(ev, select) {
  console.log(ev.target.value);
  if (select == "setor") {
    formTrabalheConosco.value.setor = ev.target.value;
  }
  if (select == "uf") {
    formTrabalheConosco.value.uf = ev.target.value;
  }
}
const catalogos = ref([
  {
    titulo: "LINHA PRISMA - EDIÇÃO 2022",
    link: "/RAPID",
    img: "/img/tomada.png",
  },
  {
    titulo: "LINHA PRISMA - EDIÇÃO 2022",
    link: "/RAPID",
    img: "/img/tomada.png",
  },
]);
const contato = ref({
  email: "contato@mectronic-eletromar.com.br",
  fone1: "(81) 2138.7200",
  fone2: "(81) 99278-7518",
});
const estadosOptions = ref([
  { text: "Acre", value: "AC" },
  { text: "Alagoas", value: "AL" },
  { text: "Amapá", value: "AP" },
  { text: "Amazonas", value: "AM" },
  { text: "Bahia", value: "BA" },
  { text: "Ceará", value: "CE" },
  { text: "Distrito Federal", value: "DF" },
  { text: "Espírito Santo", value: "ES" },
  { text: "Goiás", value: "GO" },
  { text: "Maranhão", value: "MA" },
  { text: "Mato Grosso", value: "MT" },
  { text: "Mato Grosso do Sul", value: "MS" },
  { text: "Minas Gerais", value: "MG" },
  { text: "Pará", value: "PA" },
  { text: "Paraíba", value: "PB" },
  { text: "Paraná", value: "PR" },
  { text: "Pernambuco", value: "PE" },
  { text: "Piauí", value: "PI" },
  { text: "Rio de Janeiro", value: "RJ" },
  { text: "Rio Grande do Norte", value: "RN" },
  { text: "Rio Grande do Sul", value: "RS" },
  { text: "Rondônia", value: "RO" },
  { text: "Roraima", value: "RR" },
  { text: "Santa Catarina", value: "SC" },
  { text: "São Paulo", value: "SP" },
  { text: "Sergipe", value: "SE" },
  { text: "Tocantins", value: "TO" },
]);

const selectOptions = ref([]);

onMounted(() => {
  // INPUT CURRICULO
  var input = document.getElementById("curriculoID");
  var labelCurriculoID = document.getElementById("labelCurriculoID");

  input.addEventListener("change", function (e) {
    var fileName = "";
    if (this.files) {
      fileName = (this.getAttribute("data-multiple-caption") || "").replace(
        "{nome}",
        this.files[0].name
      );
      formTrabalheConoscoBody.append("0", this.files[0]);
      formTrabalheValido.value.arquivo = true;
    } else {
      fileName = e.target.value.split("\\").pop();
      formTrabalheValido.value.arquivo = false;
    }
    if (fileName) labelCurriculoID.innerHTML = fileName;
    else labelCurriculoID.innerHTML = labelVal;
  });

  // INPUT CURRICULO
});
onMounted(() => {
  let atualY = ref(-100);
  let ultimaPosicao = ref(0);

  ScrollTrigger.create({
    trigger: ".drawLineContTrab",
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
    let txTrabalheIDspacer = document.getElementById("txTrabalheID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDTrab.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txTrabalheIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txTrabalheIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDTrab.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

onMounted(() => {
  const tlCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#formTrabalheConID",
      start: "top center",
      end: "bottom bottom",
    },
  });

  tlCont.from(".lnCont .sublnCont", 1, {
    y: "100%",
    ease: "expo.inOut",
    stagger: {
      amount: 0.5,
    },
  });
});

let formTrabalheValido = ref({
  comentario: false,
  cidade: false,
  uf: false,
  setor: false,
  email: false,
  nome: false,
  arquivo: false,
});

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function ValidaformTrabalhe() {
  let RTX = false;

  if (formTrabalheConosco.value.nome.length > 8)
    formTrabalheValido.value.nome = true;
  else formTrabalheValido.value.nome = false;

  if (formTrabalheConosco.value.comentario.length > 8)
    formTrabalheValido.value.comentario = true;
  else formTrabalheValido.value.comentario = false;

  if (validateEmail(formTrabalheConosco.value.email))
    formTrabalheValido.value.email = true;
  else formTrabalheValido.value.email = false;

  if (formTrabalheConosco.value.cidade.length > 3)
    formTrabalheValido.value.cidade = true;
  else formTrabalheValido.value.cidade = false;

  if (formTrabalheConosco.value.setor.length > 3)
    formTrabalheValido.value.setor = true;
  else formTrabalheValido.value.setor = false;

  if (formTrabalheConosco.value.uf.length > 3)
    formTrabalheValido.value.uf = true;
  else formTrabalheValido.value.uf = false;

  Object.keys(formTrabalheValido.value).forEach((key) => {
    //console.log(`key: ${key}, value: ${formTrabalheValido.value[key]}`)

    if (formTrabalheValido.value[key] == false) RTX = false;
    else RTX = true;
  });
  return RTX;
}

const formTrabalheConoscoBody = new FormData();
async function enviarCurriculo() {
  //valida form
  const V = ValidaformTrabalhe();
  if (V === false) {
    modalTrabalhe.value = true;
    modalTrabalheTXT.value = "Preencha todos os campos requeridos.";
    return;
  }

  if (!captchaValido.value) {
    //alert("Clique na caixa de verificação do Captcha");
    modalTrabalhe.value = true;
    modalTrabalheTXT.value =
      "lique na caixa de verificação do Captcha testo  Clique na caixa de verificação do Captcha testo ";
    return;
  }

  formTrabalheConosco.value.origem = "FormCurriculo";
  formTrabalheConoscoBody.append(
    "json",
    JSON.stringify(formTrabalheConosco.value)
  );
  let R = await $fetch("/api/mailForm.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formTrabalheConoscoBody,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      modalTrabalhe.value = true;
      modalTrabalheTXT.value = RS.msg;
    } else {
      alert(RS.msg);
    }
  });
}

async function getSetores() {
  let R = await $fetch("/api/setores.php", {
    method: "GET",
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        selectOptions.value = [];
        selectOptions.value = RS.dados;
      }
    }
  });
}
onMounted(() => {
  getSetores();
});
</script>
    
    <style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}

input {
  color: #fff;
  font-size: 1em;
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
select:focus {
  outline: none;
  box-shadow: none;
}
textarea {
  outline: none;

  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
input::placeholder,
textarea::placeholder {
  color: #fff;
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
  background-color: #006038;
  background-image: url("/img/pdfOver.svg");
  background-repeat: no-repeat;
  background-size: cover;
  border: 2px solid #9ade53;
}
.bg_trabalheConosco {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}

.checkboxID {
  display: block;
  position: relative;
  padding-left: 25px;
  margin-bottom: 12px;
  cursor: pointer;

  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkboxID input {
  position: absolute;

  opacity: 0;
  cursor: pointer;
  height: 0px;
  width: 0px;
  border: 1px solid #00b1ef;
  background-color: transparent;
  border-radius: 5px;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 3px;
  left: 0;
  height: 16px;
  width: 16px;
  background-color: transparent;
  border: 1px solid #00b1ef;
  background-color: transparent;
  border-radius: 4px;
}

/* On mouse-over, add a grey background color */
.checkboxID:hover input ~ .checkmark {
  background-color: transparent;
}

/* When the checkbox is checked, add a blue background */
.checkboxID input:checked ~ .checkmark {
  background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkboxID input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkboxID .checkmark:after {
  left: 6px;
  top: -3px;
  width: 8px;
  height: 15px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
/* 
#setaNewsMais {
  position: relative;
  left: 120px;
  cursor: pointer;
  display: flex;
  flex-direction: row;
  align-items: center;
}
#setaNewsMais:hover div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #71df43 inset;
}
#setaNewsMais:hover div:nth-child(2) {
  background-color: #71df43;
}
#setaNewsMais:hover div:nth-child(3) {
  color: #71df43;
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
#setaNewsMais > div:nth-child(3) {
  position: absolute;
  top: -10px;
  right: 20px;
  width: 100px;
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
} */

.drawLineContTrab {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContTrab {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}

.selectdiv {
  position: relative;
  top: -30px;
  width: 100%;
}

.selectdiv:after {
  content: url("data:image/svg+xml,%3Csvg version='1.1' id='svg-map' xmlns='https://www.w3.org/2000/svg' xmlns:xlink='https://www.w3.org/1999/xlink' x='0px' y='0px' width='20px' height='20px' viewBox='0 0 80 80' xml:space='preserve'%3E%3Cpath fill='%23fff' d='M45.3247 69.5468C43.3978 72.8676 38.6022 72.8676 36.6753 69.5468L1.1878 8.38748C-1.18799 4.29303 2.9528-0.591471 7.40567 1.01504C19.0966 5.23292 35.0841 10.58 41 10.58C46.9159 10.58 62.9034 5.23292 74.5943 1.01505C79.0472-0.591467 83.188 4.29303 80.8122 8.38748L45.3247 69.5468Z'%3E%3C/path%3E%3C/svg%3E");
  right: 11px;
  top: 6px;
  height: 34px;
  padding: 15px 0px 0px 8px;
  position: absolute;
  pointer-events: none;
}

/* IE11 hide native button (thanks Matt!) */
select::-ms-expand {
  display: none;
}

.selectdiv select {
  border: none;
  width: 100%;
  background: #1b3346;
  margin: 0 0 5px 0;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  color: #fff;
  font-size: 1em;
  border: none;
  -webkit-appearance: none;
  -ms-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: block;
  width: 100%;
  height: 50px;
  font-size: 16px;
  line-height: 1.75;
  word-break: normal;
}
.selectdivClip {
  position: relative;
  top: -30px;
  width: 100%;
}

.xclip {
  content: url("data:image/svg+xml,%3Csvg width='80px' height='80px' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' transform='matrix(-1,0,0,-1,0,0)'%3E%3Cpath fill='%23fff' d='M12.021 4.234v8.498h-1V4.234c0-1.091-.799-2.266-2.554-2.266-1.941 0-2.459 1.424-2.459 2.266v8.121h.007v1.457c0 .62.693 1.206 1.426 1.206.844 0 1.567-.683 1.567-1.241v-.27h-.003l.008-7.617c0-.874-.247-.874-.466-.874-.369 0-.547.035-.547.823v5.146H7V5.839c0-.451 0-1.823 1.547-1.823.669 0 1.466.325 1.466 1.875l-.007 6.43h.002v1.457c0 1.173-1.224 2.241-2.567 2.241-1.292 0-2.426-1.031-2.426-2.206v-.074h-.007V4.234C5.008 2.661 6.09.968 8.467.968c2.333.001 3.554 1.643 3.554 3.266z'%3E%3C/path%3E%3C/svg%3E");
  right: 10px;
  top: 5px;
  height: 60px;

  position: absolute;
  pointer-events: none;
}
.clip {
  background-image: url("/img/clip.png");
  right: 0px;
  top: 45px;
  width: 30px;
  height: 30px;
  background-size: contain;
  position: absolute;
  pointer-events: none;
}
.setaPraBaixo {
  background-image: url("/img/setaPraBaixo.png");
  right: 10px;
  top: 27px;
  width: 16px;
  height: 16px;
  background-size: contain;
  position: absolute;
  pointer-events: none;
}
.inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile + label {
  font-size: 1.25em;
  font-weight: 700;
  color: white;
  background-color: black;
  display: inline-block;
}

.inputfile:focus + label,
.inputfile + label:hover {
  background-color: red;
}
.inputfile + label {
  cursor: pointer; /* "hand" cursor */
}
.inputfile:focus + label {
  outline: 1px dotted #000;
  outline: -webkit-focus-ring-color auto 5px;
}
.inputfile + label * {
  pointer-events: none;
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
    