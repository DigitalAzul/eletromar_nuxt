<template>
  <div envelope="contatoComp" id="contatoCompID">
    <div class="drawLineContCataComp">
      <div
        class="drawLineInnerContCataComp"
        id="drawLineInnerContIDCataComp"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>
    <div
      id="bannercontID"
      class="bg_contato relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txContatoID"
        class="container relative mx-auto text-center text-[3rem] font-normal tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        CONTATO
      </div>
    </div>
    <div class="overflow-hidden bg-[#1b3346] py-[60px]">
      <div
        class="container mx-auto space-y-4 overflow-hidden pt-[130px] text-center"
      >
        <p class="H1Cont text-3xl uppercase text-[#00b1ef]">
          {{ $t("enviesuamensagem") }}
        </p>
        <p class="H2Cont text-4xl font-bold text-white">
          {{ $t("vejaaquicomoentraremcontato") }}
        </p>
      </div>

      <!-- FORM CONTATO -->
      <div id="formContatoID" class="container mx-auto min-h-screen">
        <div class="px-4 lg:px-20">
          <form>
            <div
              class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
            >
              <div
                class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
              >
                <input
                  v-model="formContato.nome"
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('seunome')"
                  required
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
                  v-model="formContato.email"
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('seuemail')"
                />
              </div>
            </div>
            
            <div class="flex w-full flex-col lg:flex-row lg:space-x-14">
              <div class="lg:w-1/2 w-full">
                <div
                  class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
                >
                  <div
                    class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                  >
                    <div class="selectdiv h-[10px] w-full">
                      <select class="w-full" @change="setContinente($event)">
                        <option selected>
                          {{ $t("continente") }}
                        </option>
                        <option
                          v-for="(uf, index) in ContinentesOptions"
                          :key="index"
                        >
                          {{ uf.text }}
                        </option>
                      </select>
                      <div for="" class="setaPraBaixo"></div>
                    </div>
                  </div>
                </div>
                <div
                  class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
                >
                  <div
                    class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                  >
                    <div 
                    :class="{'opacity-30 pointer-events-none': PaisesOptions.length == 0 }"
                    class="selectdiv h-[10px] w-full "
                    >
                      <select class="w-full" @change="setPais($event)">
                        <option selected>{{ $t("pais") }}</option>
                        <option
                          v-for="(uf, index) in PaisesOptions"
                          :key="index"
                        >
                          {{ uf.text }}
                        </option>
                      </select>
                      <div for="" class="setaPraBaixo"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex w-full lg:w-1/2 flex-col">
                <div
                  class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
                >
                  <div
                  
                    class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                  >
                    <div 
                    :class="{'opacity-30 pointer-events-none': EstadosOptions.length == 0 }"
                    class="selectdiv h-[10px] w-full">
                      <select class="w-full" @change="setEstado($event)">
                        <option selected>{{ $t("seueestado") }}</option>
                        <option
                          v-for="(uf, index) in EstadosOptions"
                          :key="index"
                        >
                          {{ uf.text }}
                        </option>
                      </select>
                      <div for="" class="setaPraBaixo"></div>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div
                    class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
                  >
                    <div
                      class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef] py-4"
                    >
                      <div 
                      :class="{'opacity-30 pointer-events-none': CidadesOptions.length == 0 }"
                      class="selectdiv h-[10px] w-full">
                        <select class="w-full" @change="setCidade($event)">
                          <option selected>{{ $t("suacidade") }}
                          </option>
                          <option
                            v-for="(uf, index) in CidadesOptions"
                            :key="index"
                          >
                            {{ uf.text }}
                          </option>
                        </select>
                        <div for="" class="setaPraBaixo"></div>
                      </div>
                    </div>
                  </div>

                  <!-- <div
                    class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
                  >
                    <div
                      class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
                    >
                      <input
                        v-model="formContato.cidade"
                        class="h-10 w-full bg-transparent"
                        type="text"
                        :placeholder="$t('suacidade')"
                      />
                    </div>
                  </div> -->
                </div>
              </div>
            </div>

            <div class="flex lg:flex-row lg:space-x-14 flex-col">
              <div
                class="lnCont relative flex h-16 w-full flex-row overflow-hidden py-10 pb-11"
              >
                <div
                  class="sublnCont absolute mr-8 w-full border-b border-[#00b1ef]"
                >
                  <input
                    v-model="formContato.empresa"
                    class="h-10 w-full bg-transparent"
                    type="text"
                    :placeholder="$t('suaempresa')"
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
                    v-model="formContato.cnpj"
                    class="h-10 w-full bg-transparent"
                    type="number"
                    placeholder="CNPJ*"
                  />
                </div>
              </div>
            </div>

            <div class="flex w-full flex-col">
              <div
                class="lnCont relative flex min-h-[350px] w-full flex-row overflow-hidden py-10"
              >
                <div class="sublnCont absolute w-full">
                  <div
                    class="my-10 flex h-[210px] w-full flex-row border border-[#00b1ef]"
                  >
                    <textarea
                      v-model="formContato.mensagem"
                      name=""
                      id=""
                      cols="30"
                      rows="10"
                      :placeholder="$t('seucomentario')"
                      class="h-48 w-full border-none bg-transparent p-4 text-white"
                    ></textarea>
                  </div>
                  <div class="mt-10">
                    <label class="checkboxID text-sm font-light text-white"
                      >{{ $t("aceitepolitica") }}
                      <input type="checkbox" v-model="formContato.politica" />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div
              class="lnCont relative flex h-[360px] flex-row overflow-hidden"
            >
              <div
                class="sublnCont absolute flex w-full flex-col justify-between md:flex-row"
              >
                <div>
                  <div
                    class="mt-10 flex flex-col space-y-6 md:flex-row md:space-x-5 md:space-y-0"
                  >
                    <div class="h-20 w-auto text-xl text-white">
                      <p>{{ contato.email }}</p>
                      <p>{{ contato.fone1 }}</p>
                      <div class="flex flex-row space-x-2">
                        <p>
                          {{ contato.fone2 }}
                        </p>
                        <p class="relative -top-4 hidden md:block">
                          <ph-whatsapp-logo :size="52" class="text-[#70df3f]" />
                        </p>
                        <p class="relative -top-2 block md:hidden">
                          <ph-whatsapp-logo :size="32" class="text-[#70df3f]" />
                        </p>
                      </div>
                    </div>
                  </div>

                  <div
                    @click="enviaContato()"
                    class="SETAENVIAR flex flex-row space-x-14 pr-6 pt-24"
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

                <div class="top-3">
                  <div
                    class="daHoverSlide Xabsolute mt-10 w-[300px] cursor-pointer text-[1rem] sm:w-[340px] sm:text-[1.2rem]"
                  >
                    <div @click="botaoTrabalheConosco()">
                      <span
                        @click="botaoTrabalheConosco()"
                        class="capitalize"
                        >{{ $t("trabalheconosco") }}</span
                      >
                    </div>
                    <div @click="botaoTrabalheConosco()">
                      <span
                        class="daspan capitalize"
                        @click="botaoTrabalheConosco()"
                        >{{ $t("trabalheconosco") }}</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <x-modal v-model="modalContato" show-close backdrop>
      {{ modalContatoTXT }}
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
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

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

function botaoTrabalheConosco() {
  //const POST = JSON.stringify(post);

  window.location.assign("/trabalheconosco");
}

const formContato = ref({
  politica: "",
  nome: "",
  email: "",
  uf: "",
  cidade: "",
  empresa: "",
  cnpj: null,
  mensagem: "",
});

let lang = ref("pt");
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
  i18nLocale.locale.value = localStorage.getItem("lang");
}
const contato = ref({
  email: "contato@mectronic-eletromar.com.br",
  fone1: "+55 (81) 2138.7200",
  fone2: "+55 (81) 99278-7518",
});
let Y = -100;
let ease = 0.5;
let atualY = ref(-100);
let ultimaPosicao = ref(0);

const ContinentesOptions = ref([
  { text: "South America", value: "6255150" },
  { text: "Africa", value: "6255146" },
  { text: "Antarctica", value: "6255152" },
  { text: "Europe", value: "6255148" },
  { text: "North America", value: "6255149" },
  { text: "Oceania", value: "6255151" },
]);

const PaisesOptions = ref([]);
const EstadosOptions = ref([]);
const CidadesOptions = ref([]);



function setContinente(event) {

  const pais = ContinentesOptions.value.find(
    (o) => o.text == event.target.value
  );

  // resetes
  formContato.value.pais = ""
  PaisesOptions.value = []
  formContato.value.uf = ""
  EstadosOptions.value = []
  formContato.value.cidade = ""
  CidadesOptions.value = []


  formContato.value.continente = event.target.value;
  getPaises(pais.value);
}


function setPais(event) {
  console.log('PAIS',event.target.value, PaisesOptions);
  const pais = PaisesOptions.value.find(
    (o) => o.text == event.target.value
  );

    // resetes
  formContato.value.uf = ""
  EstadosOptions.value = []
  formContato.value.cidade = ""


  formContato.value.pais = event.target.value;
  getEstados(pais.value);
}
function setEstado(event) {
  console.log(event.target.value);
  const estado = EstadosOptions.value.find(
    (o) => o.text == event.target.value
  );

    // resetes
  formContato.value.cidade = ""


  formContato.value.uf = event.target.value;
  getCidades(estado.value);
}
function setCidade(event) {
  console.log(event.target.value);
  formContato.value.cidade = event.target.value;
}

//http://api.geonames.org/children?geonameId=6255150&username=dazl&hierarchy=tourism
async function getPaises(continenteID) {
  console.log('get pais', continenteID);
  // get paises
  //http://www.geonames.org/childrenJSON?geonameId=6255150&callback=listPlaces&style=long&noCacheIE=1736693942234

  await $fetch(`http://api.geonames.org/childrenJSON?geonameId=${continenteID}&username=dazl`, {
    method: "GET",
  }).then((response) => {
    //let RS = JSON.parse(R);
    PaisesOptions.value = []
    response.geonames.map((p) => {
      PaisesOptions.value.push({
        text: p.countryName,
        value: p.countryId,
      });
    });
    console.log(response, PaisesOptions.value);
   // getEstados();
  });
}
async function getEstados(paisID) {
  console.log('get estados', paisID);
  // get estados
  //http://www.geonames.org/childrenJSON?geonameId=3469034&callback=listPlaces&style=long&noCacheIE=1736693989369

  await $fetch(`http://api.geonames.org/childrenJSON?geonameId=${paisID}&username=dazl`, {
    method: "GET",
  }).then((response) => {
    //let RS = JSON.parse(R);

    EstadosOptions.value = []

    response.geonames.map((p) => {
      EstadosOptions.value.push({
        text: p.adminName1,
        value: p.geonameId,
      });
    });
    console.log('ESTADOS',response, EstadosOptions.value);
    //getCidades();
  });
}
async function getCidades(estadoID) {
  console.log('get CIDADES', estadoID);
  // get estados
  //http://www.geonames.org/childrenJSON?geonameId=3665474&callback=listPlaces&style=long&noCacheIE=1736694812187

  await $fetch(`http://api.geonames.org/childrenJSON?geonameId=${estadoID}&username=dazl`, {
    method: "GET",
  }).then((response) => {
    //let RS = JSON.parse(R);

    CidadesOptions.value = []

    response.geonames.map((p) => {
      CidadesOptions.value.push({
        text: p.name,
        value: p.geonameId,
      });
    });
    console.log(response, CidadesOptions.value);
  });
}

let formContatoValido = ref({
  mensagem: false,
  uf: false,
  email: false,
  nome: false,
  empresa: false,
  cnpj: false,
  continente: false,
  pais: false,
  cidade: false,
});

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}
const modalContato = ref(false);
const modalContatoTXT = ref("");

function ValidaformContato() {
  let RTX = false;

  try {
    if (formContato.value.politica) formContato.value.politica = 1;
    else formContato.value.politica = 0;
  } catch (error) {
    formContato.value.politica = 0;
  }

  try {
    if (formContato.value.nome.length > 3) formContatoValido.value.nome = true;
    else formContatoValido.value.nome = false;
  } catch (error) {
    formContatoValido.value.nome = false;
  }

  try {
    if (formContato.value.empresa.length > 3)
      formContatoValido.value.empresa = true;
    else formContatoValido.value.empresa = false;
  } catch (error) {
    formContatoValido.value.empresa = false;
  }

  try {
    if (formContato.value.mensagem.length > 8)
      formContatoValido.value.mensagem = true;
    else formContatoValido.value.mensagem = false;
  } catch (error) {
    formContatoValido.value.mensagem = false
  }

  try {
    if (validateEmail(formContato.value.email))
      formContatoValido.value.email = true;
    else formContatoValido.value.email = false;
  } catch (error) {
    formContatoValido.value.email = false;
  }

  try {
    if (formContato.value.continente.length > 3)
      formContatoValido.value.continente = true;
    else formContatoValido.value.continente = false;
  } catch (error) {
    formContatoValido.value.continente = false;
  }
  try {
    if (formContato.value.pais.length > 3)
      formContatoValido.value.pais = true;
    else formContatoValido.value.pais = false;
  } catch (error) {
    formContatoValido.value.pais = false;
  }
  // try {
  //   if (formContato.value.estado.length > 3)
  //     formContatoValido.value.estado = true;
  //   else formContatoValido.value.estado = false;
  // } catch (error) {
  //   formContatoValido.value.estado = false;
  // }

  try {
    if (formContato.value.cidade.length > 3)
      formContatoValido.value.cidade = true;
    else formContatoValido.value.cidade = false;
  } catch (error) {
    formContatoValido.value.cidade = false;
  }

  try {
    if (formContato.value.cnpj.toString().length > 3)
      formContatoValido.value.cnpj = true;
    else formContatoValido.value.cnpj = false;
  } catch (error) {
    formContatoValido.value.cnpj = false;
  }

  try {
    if (formContato.value.uf.length > 3) formContatoValido.value.uf = true;
    else formContatoValido.value.uf = false;
  } catch (error) {
    formContatoValido.value.uf = false
  }

let contFalse = 0
  Object.keys(formContatoValido.value).forEach((key) => {
    if (formContatoValido.value[key] == false) {
      RTX = false;
      contFalse +=1
    }
    else RTX = true;
  });
  console.log('formContatoValido.value',formContatoValido.value);
  return contFalse;
}

const formContatoBody = new FormData();
async function enviaContato() {
  // if (!captchaValido.value) {
  //   modalContato.value = true;
  //   modalContatoTXT.value = "Clique na caixa de verificação do Captcha!";
  //   return;
  // }

  const V = ValidaformContato();

  if (V > 0) {
    modalContato.value = true;
    modalContatoTXT.value = "Preencha os campos Requeridos!";
    return;
  }

  formContato.value.origem = "formContato";
  formContatoBody.append("json", JSON.stringify(formContato.value));
  let R = await $fetch("/api/mailForm.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formContatoBody,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      alert(RS.msg);
    } else {
      alert(RS.msg);
    }
  });
}

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

// onMounted(() => {
//   const { data, error } = useFetch("api/formUfs.php");
//   estadosOptions.value = data;
//   console.log(data);
// }),
onMounted(() => {
  const txContatoID = new SplitType("#txContatoID", {
    charClass: "caracter",
  });

  // const childSplitEsqCont = new SplitType(".H1Cont", {
  //   type: "lines",
  //   linesClass: "split-childCont",
  // });
  // const childSplitDirCont = new SplitType(".H2Cont", {
  //   type: "lines",
  //   linesClass: "split-childCont",
  // });

  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#txContatoID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1Cont", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2Cont", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  // anim texto
  gsap.from(txContatoID.chars, {
    y: "100%",
    stagger: 0.05,
    duration: 0.5,
    ease: "power4.out",
  });

  const tlCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#formContatoID",
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

  // linha Y
  let drawLineInnerContIDCataComp = document.getElementById(
    "drawLineInnerContIDCataComp"
  );

  ScrollTrigger.create({
    trigger: ".drawLineContCataComp",
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
});

function setTranslate(pg) {
  let yInicial = pg;
  let txContatoIDspacer = document.getElementById("txContatoID");
  if (yInicial > ultimaPosicao.value) {
    //pra baixo

    if (atualY.value < 100) {
      atualY.value += 5;

      //txContatoIDspacer.style.transform = `translateY(${atualY.value + 1}%)`;
      drawLineInnerContIDCataComp.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
      if (pg > 0.25) txContatoIDspacer.style.letterSpacing = `${pg}em`;
    } else {
      atualY.value = 100;
    }
  } else {
    if (atualY.value > -100) {
      atualY.value -= 5;
    }
    if (pg > 0.25) txContatoIDspacer.style.letterSpacing = `${pg}em`;
    //txContatoIDspacer.style.transform = `translateY(${atualY.value + 1}%)`;
    drawLineInnerContIDCataComp.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
  }

  ultimaPosicao.value = yInicial;
}
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}

#txContatoID {
  transform: translateY(100%);
  transition: transform 0.5s;
  clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
}
.drawLineContCataComp {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContCataComp {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
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
textarea {
  outline: none;

  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
}
select:focus {
  outline: none;
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
  bottom: -100px;
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
.bg_contato {
  background: url("/img/bg_banner_1.jpg");
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
.SETAENVIAR:hover {
  position: relative;
  cursor: pointer;
}
.SETAENVIAR > div:nth-child(1) {
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
  transform: translateY(-5px);
}
.SETAENVIAR:hover div:nth-child(1) {
  color: #00b1ef;
}
.SETAENVIAR:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
.SETAENVIAR:hover #seta > div:nth-child(2) {
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

.clip {
  content: url("data:image/svg+xml,%3Csvg width='80px' height='80px' viewBox='0 0 40 40' xmlns='https://www.w3.org/2000/svg' version='1.1' xmlns:xlink='https://www.w3.org/1999/xlink' transform='matrix(-1,0,0,-1,0,0)'%3E%3Cpath fill='%23fff' d='M12.021 4.234v8.498h-1V4.234c0-1.091-.799-2.266-2.554-2.266-1.941 0-2.459 1.424-2.459 2.266v8.121h.007v1.457c0 .62.693 1.206 1.426 1.206.844 0 1.567-.683 1.567-1.241v-.27h-.003l.008-7.617c0-.874-.247-.874-.466-.874-.369 0-.547.035-.547.823v5.146H7V5.839c0-.451 0-1.823 1.547-1.823.669 0 1.466.325 1.466 1.875l-.007 6.43h.002v1.457c0 1.173-1.224 2.241-2.567 2.241-1.292 0-2.426-1.031-2.426-2.206v-.074h-.007V4.234C5.008 2.661 6.09.968 8.467.968c2.333.001 3.554 1.643 3.554 3.266z'%3E%3C/path%3E%3C/svg%3E");
  right: 10px;
  top: 5px;
  height: 60px;

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
</style>
