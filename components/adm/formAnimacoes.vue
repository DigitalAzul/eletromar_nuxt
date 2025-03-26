<template>
  <div class="scpace-x-3 flex flex-row">
    <div
      id="overlayID"
      class="absolute left-0 top-0 z-[9999] hidden h-screen w-screen opacity-0 backdrop-blur-md"
    >
      <div class="flex h-full w-full flex-row items-center justify-center">
        <svg
          class="rotate-180 animate-spin"
          style="
            width: 10em;
            height: 10em;
            vertical-align: middle;
            fill: currentColor;
            overflow: hidden;
          "
          viewBox="0 0 1024 1024"
          version="1.1"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M853.333333 512c0-185.045333-156.288-341.333333-341.333333-341.333333v85.333333c138.752 0 256 117.248 256 256s-117.248 256-256 256v42.666667l-0.085333-42.666667h-0.469334a244.906667 244.906667 0 0 1-52.565333-5.717333l-18.346667 83.328c23.296 5.12 47.189333 7.722667 70.912 7.722666h0.64C697.088 853.290667 853.333333 697.002667 853.333333 512z"
            fill=""
          />
          <path
            d="M510.933333 85.333333L341.333333 213.333333l169.6 128zM170.666667 512c0 41.045333 7.466667 81.322667 22.144 119.808l79.744-30.421333a248.96 248.96 0 0 1-15.914667-107.349334l-85.077333-6.101333A322.218667 322.218667 0 0 0 170.666667 512z m161.194666-180.352L271.530667 271.232a348.074667 348.074667 0 0 0-78.933334 121.6l79.744 30.336a262.826667 262.826667 0 0 1 59.52-91.52z m17.749334 479.744l41.088-74.752a265.130667 265.130667 0 0 1-82.645334-71.509333l-68.010666 51.584a350.933333 350.933333 0 0 0 109.568 94.677333z"
            fill=""
          />
        </svg>
      </div>
    </div>

    <div COLUNA="1" class="h-screen min-w-[480px] overflow-x-scroll border-r-2 p-6">
      <div class="p-4 text-center text-3xl">ANIMAÇÃO</div>

      <div v-if="emEdicao == false" class="w-[400px] pt-10">
        <form class="w-[400px]">
          <div class="flex flex-col space-y-3 w-[360px]">
            <div class="border p-3">
              <x-input
                class="w-[90%]"
                v-model="animForm.titulo_esquerdo"
                label="TEXTO LADO ESQUERDO - PT"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_esquerdo_en"
                label="TEXTO LADO ESQUERDO - EN"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_esquerdo_es"
                label="TEXTO LADO ESQUERDO - ES"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[70%] pt-2"
                @keyup="translate_X_Esq()"
                @change="translate_X_Esq()"
                v-model="animForm.translateEsq"
                label="AFASTAMENTO DO CENTRO (Texto Esquerdo)"
                size="sm"
                name="translateEsq"
                type="number"
              />
            </div>
            <div class="border p-3">
              <x-input
                class="w-[90%]"
                v-model="animForm.titulo_direito"
                label="TEXTO LADO DIREITO - PT"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_direito_en"
                label="TEXTO LADO DIREITO - EN"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_direito_es"
                label="TEXTO LADO DIREITO - ES"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[70%] pt-2"
                @keyup="translate_X_Dir()"
                @change="translate_X_Dir()"
                v-model="animForm.translateDir"
                label="AFASTAMENTO DO CENTRO (Texto Direito)"
                size="sm"
                name="translateEsq"
                type="number"
              />
            </div>
            <div>
              <x-select
                v-model="animForm.linha_id"
                label="categoria"
                :options="solucaoLinhasOPT"
                placeholder="categoria"
                class="w-full"
              />
            </div>
            <div>
              <x-select
                size="sm"
                v-model="animForm.ativo"
                label="Ativar/Desativar"
                :options="SN"
                placeholder="Sele..."
                class="w-[100px] py-4"
              />
            </div>
            <div v-if="animForm.ativo == 1">
              <x-select
                size="sm"
                v-model="animForm.ordem"
                label="Ordem"
                :options="ORDEM"
                placeholder="Ordem"
                class="w-[100px] pb-4"
              />
            </div>
          </div>

          <div v-if="emEdicao == false" class="w-[90%] border bg-yellow-200">
            <p class="p-3 py-4">
              OBS: Arquivos devem ser do tipo ".webp", nomes com sequência de:
              0.webp, 1.webp, 2.webp, ...9.webp a 29.webp
            </p>
            <label
              for="sequencias"
              class="cursor-pointer bg-slate-500 px-4 py-4 text-white"
            >
              Selecionar Arquivos
            </label>
            <input
              class="hidden"
              id="sequencias"
              type="file"
              name="animacoes"
              multiple="multiple"
            />
          </div>
          <div class="flex w-[90%] flex-row justify-between pt-10">
            <x-button color="#000" light @click="submitFormData">
              Salvar
            </x-button>
            <x-button @click="resetFormTag()" color="#000" light
              >Cancelar</x-button
            >
          </div>
        </form>
      </div>

      <div v-if="emEdicao == true" class="w-[400px] pt-10">
        <div
          class="mb-4 w-[90%] animate-pulse rounded-xl bg-yellow-300 p-3 text-center text-2xl font-semibold"
        >
          EM EDIÇÃO
        </div>
        <form>
          <div class="flex flex-col space-y-3">
            <div>
              <x-input
                class="w-[90%]"
                v-model="animForm.titulo_esquerdo"
                label="TEXTO LADO ESQUERDO - PT"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_esquerdo_en"
                label="TEXTO LADO ESQUERDO - EN"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_esquerdo_es"
                label="TEXTO LADO ESQUERDO - ES"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[70%] pt-2"
                @keyup="translate_X_Esq()"
                @change="translate_X_Esq()"
                v-model="animForm.translateEsq"
                label="AFASTAMENTO DO CENTRO (Texto Esquerdo)"
                size="sm"
                name="translateEsq"
                type="number"
              />
            </div>
            <div>
              <x-input
                class="w-[90%]"
                v-model="animForm.titulo_direito"
                label="TEXTO LADO DIREITO"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_direito_en"
                label="TEXTO LADO DIREITO - EN"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[90%] pt-2"
                v-model="animForm.titulo_direito_es"
                label="TEXTO LADO DIREITO - ES"
                size="sm"
                name="nome"
              />
              <x-input
                class="w-[70%] pt-2"
                @keyup="translate_X_Dir()"
                @change="translate_X_Dir()"
                v-model="animForm.translateDir"
                label="AFASTAMENTO DO CENTRO (Texto Direito)"
                size="sm"
                name="translateEsq"
                type="number"
              />
            </div>
            <div>
              <x-select
                v-model="animForm.linha_id"
                label="categoria"
                :options="solucaoLinhasOPT"
                placeholder="categoria"
                class="w-full"
              />
            </div>
            <div>
              <x-select
                size="sm"
                v-model="animForm.ativo"
                label="Ativar/Desativar"
                :options="SN"
                placeholder="Sele.."
                class="w-[100px] py-4"
              />
            </div>
            <div>
              <x-select
                size="sm"
                v-model="animForm.ordem"
                label="Ordem"
                :options="ORDEM"
                placeholder="Ordem"
                class="w-[100px] pb-4"
              />
            </div>
          </div>

          <div class="flex w-[90%] flex-row justify-between space-x-2 pt-10">
            <x-button color="#84cc16" @click="submitFormData" class="w-[70%]">
              Salvar
            </x-button>
            <x-button @click="resetFormTag()" color="#c27803"
              >Cancelar</x-button
            >
            <x-button @click="deleteAmina(animForm.id)" color="#e74694"
              >Deletar</x-button
            >
          </div>
        </form>
      </div>
    </div>

    <div
      class="relative flex h-screen w-full flex-col items-center overflow-scroll"
    >
      <!-- TAB A COLUNA 2A -->
      <div COLUNA="1A" id="rolagem" class="zhidden h-[1200px] p-10">
        <div class="realtive w-full">
          <div
            class="relative flex h-[600px] w-[600px] flex-row items-center border-2 border-black"
          >
            <!-- ANIMACAO AQUI -->
            <div
              class="relative z-10 flex h-screen w-screen flex-row items-center justify-center"
            >
              <div
                id="P-textoEsqID-Form"
                class="textoDescricao ztop-[calc(100vh-600px)] zmd:relative zmd:top-0 zhidden zmd:block absolute right-[50%] z-[999] text-black text-right min-w-[800px]"
              >
                {{ animForm.titulo_esquerdo }}
              </div>
              <div
                class="animatedimage flex h-[600px] w-[600px] flex-row items-center justify-center pt-[55px]"
              >
                <img
                  v-show="emEdicao == true"
                  class="anima-e EDITA"
                  v-for="(item, index) in 30"
                  :key="index"
                  :id="'ani_e' + index"
                  :src="PATH + animForm.pasta + '\\' + index + '.webp'"
                />

                <img
                  v-show="emEdicao == false"
                  class="anima-b INSERT"
                  v-for="(item, index) in 30"
                  :key="index"
                  :id="'ani_' + index"
                />
              </div>

              <!-- ANIMACAO AQUI -->
              <div
                id="P-textoDirID-Form"
                class="textoDescricao z-top-6 zmd:relative zmd:top-0 zmd:block zhidden absolute left-[50%] z-[999] text-black text-left min-w-[800px]"
              >
                {{ animForm.titulo_direito }}
              </div>
            </div>

            <!-- <div
              id="P-textoEsqID-Form"
              class="textoDescricao absolute top-[300px] z-[999]  text-black"
            >
              {{ animForm.titulo_esquerdo }}
            </div>
            <div
              v-if="remounta"
              class="animatedimage flex h-[600px] w-[600px]  flex-row items-center justify-center "
            >
              <img
                v-show="emEdicao == true"
                class="anima-e EDITA"
                v-for="(item, index) in 30"
                :key="index"
                :id="'ani_e' + index"
                :src="PATH + animForm.pasta + '\\' + index + '.webp'"
              />

              <img
                v-show="emEdicao == false"
                class="anima-b INSERT"
                v-for="(item, index) in 30"
                :key="index"
                :id="'ani_' + index"
              />
            </div>
            <div
              id="P-textoDirID-Form"
              class="absolute top-[300px] z-[999] text-[40px] font-bold text-black"
            >
              {{ animForm.titulo_direito }}
            </div> -->
          </div>
          <div
            class="absolute z-50 flex w-full flex-row items-center justify-start space-x-6 py-4"
          >
            <div
              :class="{ 'pointer-events-none select-none opacity-30': playing }"
              class="flex h-8 w-[100px] cursor-pointer flex-row items-center justify-center rounded-full bg-sky-400 font-bold"
              @click="play"
            >
              play
            </div>
            <div
              class="flex h-8 w-[100px] cursor-pointer flex-row items-center justify-center rounded-full bg-rose-400 font-bold"
              @click="stop"
            >
              stop
            </div>
          </div>
        </div>
      </div>
      <!-- TAB A COLUNA 3A -->

      <div class="mt-10 h-screen  p-4 w-full">
        <div class="p-4 text-center text-3xl">ANIMAÇÕES CADASTRADAS</div>
        <table class="w-11/12 border text-left text-sm font-light">
          <thead
            class="border-b bg-slate-200 font-medium dark:border-neutral-500"
          >
            <tr>
              <th scope="col" class="px-6 py-4">#ID</th>
              <th scope="col" class="px-6 py-4">Imagem</th>
              <th scope="col" class="px-6 py-4">Ordem</th>
              <th scope="col" class="px-6 py-4">Ativo</th>
              <th scope="col" class="px-6 py-4">Categoria</th>
              <th scope="col" class="px-6 py-4">Titulo Esquesdo</th>
              <th scope="col" class="px-6 py-4">Titulo Esquesdo EN</th>
              <th scope="col" class="px-6 py-4">Titulo Esquesdo ES</th>
              <th scope="col" class="px-6 py-4">Tit. Esq. Eixo -X</th>
              <th scope="col" class="px-6 py-4">Titulo Direito</th>
              <th scope="col" class="px-6 py-4">Titulo Direito EN</th>
              <th scope="col" class="px-6 py-4">Titulo Direito ES</th>
              <th scope="col" class="px-6 py-4">Tit. Dir. Eixo +X</th>
              <th scope="col" class="px-6 py-4">Pasta <br />media/anima/</th>
              <th scope="col" class="px-6 py-4">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-b text-black dark:border-neutral-500"
              v-for="(t, index) in ANIMACOES"
              :key="index"
              :class="{ 'bg-slate-300': t.id === animFormCopy.id }"
            >
              <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                {{ t.id }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium text-black">
                <img
                  class="max-w-16 w-16"
                  :src="PATH + t.pasta + '\\' + 0 + '.webp'"
                />
              </td>
              <td
                class="whitespace-nowrap px-6 py-4 font-medium text-black"
                v-bind:class="
                  t.ordem == 1
                    ? ' bg-lime-400'
                    : t.ordem == 2
                    ? 'bg-lime-300'
                    : t.ordem == 3
                    ? 'bg-lime-200'
                    : ''
                "
              >
                {{ t.ordem }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.ativo == 1 ? "SIM" : "NÃO" }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.categoria }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_esquerdo }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_esquerdo_en }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_esquerdo_es }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.translateEsq }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_direito }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_direito_en }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.titulo_direito_es }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                {{ t.translateDir }}
              </td>
              <td class="whitespace-nowrap px-6 py-4 font-medium">
                / {{ t.pasta }}
              </td>
              <td
                @click="editaAnima(t)"
                class="cursor-pointer whitespace-nowrap px-6 py-4 font-medium hover:bg-yellow-400 hover:text-white"
              >
                Editar
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  createUI,
  XAlert,
  XButton,
  XSelect,
  XTab,
  XTabGroup,
  XTable,
  XTextarea,
} from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, XTab, XTabGroup, XTable, XSelect;
}

const tab = ref("a");
const PATH = "\\media\\anima\\";
const emEdicao = ref(false);
const remounta = ref(true);
let animForm = ref({
  ativo: "2",
  id: "",
  ordem: "9",
  pasta: "",
  titulo_direito: "",
  titulo_esquerdo: "",
  titulo_direito_en: "",
  titulo_direito_es: "",
  titulo_esquerdo_en: "",
  titulo_esquerdo_es: "",
  translateEsq: 0,
  translateDir: 0,
  emEdicao: false,
  linha_id: 0,
});
let animFormCopy = ref({
  ativo: "",
  id: "",
  ordem: "",
  pasta: "",
  titulo_direito: "",
  titulo_esquerdo: "",
  titulo_direito_en: "",
  titulo_direito_es: "",
  titulo_esquerdo_en: "",
  titulo_esquerdo_es: "",
  translateEsq: 0,
  translateDir: 0,
  emEdicao: false,
});

let titEsq1 = "";
let titDir1 = "";
const translate_X_Esq = () => {
  titEsq1 = document.getElementById("P-textoEsqID-Form");
  //titDir1 = document.getElementById("P-textoDirID-Form");
  titEsq1.style.transform = `translateX(-${animForm.value.translateEsq}px)`;

  //titDir1.style.transform = `translateX(${animForm.translateDir.value}px)`;
};
const translate_X_Dir = () => {
  titDir1 = document.getElementById("P-textoDirID-Form");

  titDir1.style.transform = `translateX(${animForm.value.translateDir}px)`;
};

onMounted(() => {
  //  titEsq1 = document.getElementById("P-textoEsqID-Form");
  //  titDir1 = document.getElementById("P-textoDirID-Form");
  //  titEsq1.style.transform = `translateX(-${animForm.translateEsq.value}px)`;
  //  titDir1.style.transform = `translateX(${animForm.translateDir.value}px)`;
});

let queryNews = ref({
  q: "",
  offset: 0,
  qpag: 30,
  email: "",
  dataInicio: "",
  dataFim: "",
});

const SN = ref([
  { value: "1", label: "SIM" },
  { value: "2", label: "NÃO" },
]);
const ORDEM = ref([
  { value: "1", label: "1" },
  { value: "2", label: "2" },
  { value: "3", label: "3" },
  { value: "9", label: "9" },
]);

function editaAnima(a) {
  console.log('edicao',a);
  emEdicao.value = true;
  animForm.value = { ...a, emEdicao: true };
  animFormCopy.value = { ...a };
  translate_X_Esq();
  translate_X_Dir();
  //ANIMACOES_SEL.value = { ...a }; // estava assim
  //tagsForm.value.emEdicao = true;
}

function resetFormNewsQuery() {
  queryNews.value = {
    q: "",
    offset: 0,
    qpag: 30,
    email: "",
    dataInicio: "",
    dataFim: "",
  };
}

let seq = "";
let seqE = "";
let anime2 = null;
let X = 0;
let expande = true;
let playing = ref(false);
let formDataAnima = new FormData();

function CompAnimaListener() {
  seq = document.querySelectorAll(".anima-b");
  seqE = document.querySelectorAll(".anima-e");

  // INICIA COIM O PRIMEIRO VISIVEL
  seq[0].style.visibility = "visible";
  seqE[0].style.visibility = "visible";

  const filesAnimacoes = document.getElementById("sequencias");

  // LISTENER FILES

  filesAnimacoes.addEventListener("change", async (event) => {
    const fileList = event.target.files;

    emEdicao.value = false;

    // valida 30 files
    const c = [...fileList].length;
    if (c != 30) {
      alert("Quantidade de arquivos diverge de 30, encontrados " + c);
      return;
    }

    formDataAnima = new FormData();
    [...fileList].forEach((file) => {
      const seqFile = file.name.split(".");

      for (let index = 0; index <= 30; index++) {
        if (index == seqFile[0]) {
          document.getElementById("ani_" + index).src =
            window.URL.createObjectURL(file);

          formDataAnima.append(index, file);
        }
      }
    });
  });
}

onMounted(() => {
  // GET ANIMACOES
  getAnimacoes();
  getLinhas();

  // animacoes
  seq = document.querySelectorAll(".anima-b");
  seqE = document.querySelectorAll(".anima-e");

  // INICIA COIM O PRIMEIRO VISIVEL
  seq[0].style.visibility = "visible";
  seqE[0].style.visibility = "visible";

  CompAnimaListener();
  // const filesAnimacoes = document.getElementById("sequencias");

  // // LISTENER FILES

  //  filesAnimacoes.addEventListener("change", async(event) => {
  //   const fileList = event.target.files;

  //   emEdicao.value = false;

  //   // valida 30 files
  //   const c = [...fileList].length;
  //   if (c != 30) {
  //     alert("Quantidade de arquivos diverge de 30, encontrados " + c);
  //     return;
  //   }

  //   formDataAnima = new FormData();
  //   [...fileList].forEach((file) => {
  //     const seqFile = file.name.split(".");

  //     for (let index = 0; index <= 30; index++) {

  //       if (index == seqFile[0]) {
  //         document.getElementById("ani_" + index).src =
  //           window.URL.createObjectURL(file);

  //         formDataAnima.append(index, file);
  //       }
  //     }
  //   });
  // });
});

function stop() {
  clearInterval(anime2);
  anime2 = null;
  playing.value = false;
}
function play() {
  let SEQ = seq;
  if (emEdicao.value == true) {
    SEQ = seqE;
  } else {
    SEQ = seq;
  }
  stop();

  playing.value = true;
  anime2 = setInterval(() => {
    SEQ.forEach((el) => {
      el.style.visibility = "hidden";
    });

    SEQ[X].style.visibility = "visible";

    if (expande) {
      if (X > 25) {
        X = 25;
        //clearInterval(anime2);
        //anime2 = null;
        expande = false;
      }
      X += 1;
    } else {
      if (X < 2) {
        X = 2;
        //clearInterval(anime2);
        //anime2 = null;
        expande = true;
      }
      X -= 1;
    }
  }, 35);
}

function validaAnimaPosition() {
  let ativo1 = 0;
  let ativo2 = 0;
  let ativo3 = 0;

  // VALIDA POSICAO
  ANIMACOES.value.map((a) => {
    if (a.ativo == "1" && a.ordem == 1) {
      ativo1 += 1;
    }
    if (a.ativo == "1" && a.ordem == 2) {
      ativo2 += 1;
    }
    if (a.ativo == "1" && a.ordem == 3) {
      ativo3 += 1;
    }
  });
  console.log(animForm.value.ordem, ativo1, ativo2, ativo3);

  if (animForm.value.ordem != animFormCopy.value.ordem) {
    if (ativo1 > 0 && animForm.value.ordem == 1) {
      alert("Destaive uma animação na posição  ' 1 ' para inserir outra");
      return false;
    }
    if (ativo2 > 0 && animForm.value.ordem == 2) {
      alert("Destaive uma animação na posição  ' 2 ' para inserir outra");
      return false;
    }
    if (ativo3 > 0 && animForm.value.ordem == 3) {
      alert("Destaive uma animação na posição  ' 3 ' para inserir outra");
      return false;
    }
  }

  return true;
}
async function submitFormData() {
  if (animForm.value.ativo == 1) {
    if (!validaAnimaPosition()) {
      return;
    }
  }

  // VALIDA LENGTH TEXTOS
  if (
    animForm.value.titulo_esquerdo.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  if (
    animForm.value.titulo_esquerdo_en.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  if (
    animForm.value.titulo_esquerdo_es.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  if (
    animForm.value.titulo_direito.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  if (
    animForm.value.titulo_direito_en.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  if (
    animForm.value.titulo_direito_es.length < 1  
  ) {
    alert("Textos devem ser maiore que 1 caracteres");
    return;
  }
  


  // VALIDA FORMDATA 30 ARQUIVOS
  if (animForm.value.emEdicao == false) {
    let c = 0;
    for (const key of formDataAnima.keys()) {
      console.log(key);
      c += 1;
    }
    if (c < 30) {
      alert("Sequência de arquivos menor que 30 !");
      return;
    }
  }

  formDataAnima.append("titulo_esquerdo", animForm.value.titulo_esquerdo);
  formDataAnima.append("translateEsq", animForm.value.translateEsq);
  formDataAnima.append("titulo_esquerdo_en", animForm.value.titulo_esquerdo_en);
  formDataAnima.append("titulo_esquerdo_es", animForm.value.titulo_esquerdo_es);
  formDataAnima.append("titulo_direito", animForm.value.titulo_direito);
  formDataAnima.append("titulo_direito_en", animForm.value.titulo_direito_en);
  formDataAnima.append("titulo_direito_es", animForm.value.titulo_direito_es);
  formDataAnima.append("translateDir", animForm.value.translateDir);
  formDataAnima.append("ativo", animForm.value.ativo);
  formDataAnima.append("linha_id", animForm.value.linha_id);
  if (animForm.value.ativo == 2) {
    formDataAnima.append("ordem", "9");
  } else {
    formDataAnima.append("ordem", animForm.value.ordem);
  }
  formDataAnima.append("emEdicao", animForm.value.emEdicao);
  if (animForm.value.emEdicao == true) {
    formDataAnima.append("id", animForm.value.id);
  }

  overLay();

  await $fetch("/api/formAnima.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formDataAnima,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      overLay();
      alert(RS.msg);
      resetFormTag();
    } else {
      overLay();
      alert(RS.msg);
    }
  });
}

async function deleteAmina(id) {
  const c = confirm("Deseja realmente deletar aminação de ID: " + id);

  if (!c) {
    return;
  }

  const formData = new FormData();
  formData.append("emEdicao", "delete");
  formData.append("delete_id", id);
  await $fetch("/api/formAnima.php", {
    mode: "cors",
    method: "POST",
    body: formData,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      alert(RS.msg);
      resetFormTag();
    } else {
      alert("ERROR", RS.msg);
    }
  });
}

let ANIMACOES = ref();
let ANIMACOES_SEL = ref({
  pasta: "1",
});

const queryTagBlog = ref({
  q: "formAnim",
  offset: 0,
  qpag: 10,
});

async function getAnimacoes() {
  let R = await $fetch("/api/formAnima.php", {
    method: "GET",
    //    params: queryTagBlog.value,
  }).then((R) => {
    let r = JSON.parse(R);
    console.log(r.dados);
    if (r.dados.length > 0) {
      ANIMACOES.value = r.dados;
    } else {
      ANIMACOES.value = [];
    }
  });
}

let q = {
  ativo: "s", // s | n | t
};
const solucaoLinhasOPT = ref([]);
async function getLinhas() {
  let L = await $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
    params: q,
  }).then((L) => {
    let soluTMP = [];
    if (JSON.parse(L).length > 0) {
      let LI = JSON.parse(L);

      LI.forEach((L) => {
        soluTMP.push({ value: L.id, label: L.titulo });
      });
    } else {
      alert("Não há Linhas cadastrados !");
    }
    solucaoLinhasOPT.value = soluTMP;
  });
}
async function formRequestAnima() {
  let formdDataTags = new FormData();
  formdDataTags.append("json", JSON.stringify(tagsForm.value));
  return await $fetch("/api/formGetTags.php", {
    mode: "cors",
    method: "POST",
    body: formdDataTags,
  }).then((r) => {
    let R = JSON.parse(r);

    getTags();
    resetFormTag();
    alert(R.msg);
  });
}

function resetFormTag() {
  animForm.value = {
    ativo: "2",
    id: "",
    ordem: "9",
    pasta: "",
    titulo_direito: "",
    titulo_esquerdo: "",
    translateEsq: 0,
    translateDir: 0,
    emEdicao: false,
  };
  emEdicao.value = false;
  getAnimacoes();
  formDataAnima = new FormData();
  remounta.value = false;
  setTimeout(() => {
    window.location.href = "/admin?c=anima";
  }, 100);
}

///// OVERLAY
function overLay() {
  var element = document.getElementById("overlayID");
  element.classList.toggle("overLayClass");
}
</script>

<style scoped>
@media screen and (max-width: 1000px) {
  .textoDescricao {
    font-size: 30pt;
  }
}

.textoDescricao {
  --font-size: 40pt;
  letter-spacing: 1rem;
  font-weight: 400;
}

@media screen and (min-width: 1000px) {
  .textoDescricao {
    font-size: 30pt;
  }
}
@media screen and (min-width: 1200px) {
  .textoDescricao {
    font-size: 40pt;
  }
}

.animatedimage {
  position: relative;
  display: inline-block;
  line-height: 0;
  overflow: hidden;
}
.animatedimage > * {
  position: absolute;
  display: inline-block;
  visibility: hidden;
  border: 0;
}

.overLayClass {
  display: block !important;
  opacity: 1;
  transition: all 0.5s ease;
}
</style>
