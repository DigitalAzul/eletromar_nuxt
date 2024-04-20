<template>
  <div
    class="overflow-x-hidem flex h-screen flex-row space-x-3 overflow-y-auto p-6"
  >
    <div
      v-if="false"
      COLUNA="1"
      class="h-screen min-w-[500px] max-w-[500px] overflow-y-auto border-r-2 p-6"
    >
      <div class="p-4 text-center text-3xl">Politica de Garantia</div>
      <div v-if="false">
        <form
          @submit.prevent="formRequestGarantia"
          method="post"
          class="felx felx-col space-y-3"
          v-if="editorA"
        >
          <div>
            <p class="py-4">Texto Português</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorGarantiaPT'"
                :existingContent="editorContentTexto"
                @contentChanged="_onChangeTextoBR"
              />
            </div>
          </div>
          <div>
            <p class="py-4">Texto Inglês</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorGarantiaEN'"
                :existingContent="editorContentTexto_en"
                @contentChanged="_onChangeTextoEN"
              />
            </div>
          </div>
          <div>
            <p class="py-4">Texto Espanhol</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorGarantiaES'"
                :existingContent="editorContentTexto_es"
                @contentChanged="_onChangeTextoES"
              />
            </div>
          </div>
          <div>
            <input
              type="file"
              accept="application/pdf,application/vnd.ms-excel"
              id="arqgarantia"
            />
          </div>

          <div class="flex flex-row justify-between">
            <x-button color="#000" light type="submit"> Salvar </x-button>
            <x-button color="#000" light @click="cancelaEdiGarantia"
              >Cancelar</x-button
            >
          </div>
        </form>
      </div>
    </div>
    <div CLUNA="2" class="container mx-auto w-full">
      <div class="p-4 text-center text-3xl">Politica de Garantia</div>
      <div class="flex flex-col">
        <div
          v-if="Object.keys(garantia).length > 0"
          class="flex flex-col pb-10"
        >
          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Garantia Português
            </h1>
            <div
              v-for="(gpt, indexPT) in garantia[0].texto"
              :key="indexPT"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="gpt.texto" class="w-[1000px]" size="xl" />
              </div>
              <div>
                <x-button
                  class="h-8 w-8 text-sm hover:text-red-600"
                  @click="remGarantiaEmpresa(indexPT)"
                >
                  X
                </x-button>
              </div>
            </div>
            <div
              @click="addGarantia()"
              class="my-6 flex h-[60px] w-[1000px] cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-slate-300 bg-slate-400 text-2xl text-black hover:bg-slate-200"
            >
              <span>+</span>
            </div>
          </div>
          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Garantia Inglês
            </h1>
            <div
              v-for="(gen, indexEN) in garantia[0].texto_en"
              :key="indexEN"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="gen.texto" class="w-[1000px]" size="xl" />
              </div>
            </div>
          </div>
          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Garantia Espanhol
            </h1>
            <div
              v-for="(ges, indexES) in garantia[0].texto_es"
              :key="indexES"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="ges.texto" class="w-[1000px]" size="xl" />
              </div>
            </div>
          </div>

          <div
            v-if="false"
            @click="editaGarantia()"
            class="grid cursor-pointer grid-cols-3 p-6 hover:bg-yellow-100"
          >
            <div class="border-r-2">
              <p>EM PORTUGÊS</p>
              <div>
                <p v-for="i in garantia[0].texto.blocks" :key="i" class="py-2">
                  {{ i.data.text }}
                </p>
              </div>
            </div>
            <div class="border-r-2">
              <p>EM INGLÊS</p>
              <div>
                <p
                  v-for="i in garantia[0].texto_en.blocks"
                  :key="i"
                  class="py-2"
                >
                  {{ i.data.text }}
                </p>
              </div>
            </div>
            <div class="border-r-2">
              <p>EM ESPANHOL</p>
              <div>
                <p
                  v-for="i in garantia[0].texto_es.blocks"
                  :key="i"
                  class="py-2"
                >
                  {{ i.data.text }}
                </p>
              </div>
            </div>
          </div>

          <h1
            class="my-10 w-full rounded-lg bg-slate-600 py-3 text-center text-white"
          >
            Arquivo PDF
          </h1>
          <div class="flex flex-row justify-around gap-x-3 pt-4">
            <div class="p-3 hover:bg-slate-500">
              <a target="_blank" :href="pathGarantia + garantia[0].arquivo">
                <div class="text-xl">Download</div>
              </a>
            </div>
            <div>
              <input
                type="file"
                accept="application/pdf,application/vnd.ms-excel"
                id="arqgarantia"
              />
            </div>
          </div>
          <div
            class="mt-10 flex flex-row justify-center space-x-6 py-6 text-black"
          >
            <div
              @click="formRequestGarantia"
              class="cursor-pointer hover:text-green-400"
            >
              SALVAR
            </div>
            <div>
              <span
                @click="cancelaEdiGarantia()"
                class="cursor-pointer hover:text-slate-800"
                >CANCELAR</span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>









<script setup>
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea;
}

const editorA = ref(true);
const pathGarantia = "\\media\\garantia\\";

/// editor
let resetEditor = "";
let editorContentTexto = ref({});
let editorContentTexto_en = ref({});
let editorContentTexto_es = ref({});

// function _onChangeTextoBR(data) {
//   GarantiaForm.value.texto = JSON.stringify(data);
//   editorContentTexto.value = data;
// }
// function _onChangeTextoEN(data) {
//   GarantiaForm.value.texto_en = JSON.stringify(data);
//   editorContentTexto_en.value = data;
// }
// function _onChangeTextoES(data) {
//   GarantiaForm.value.texto_es = JSON.stringify(data);
//   editorContentTexto_es.value = data;
// }

async function formRequestGarantia() {
  apendFileGarantia();
  return await $fetch("/api/formGarantia.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------97476729985249432331610575",
    },
    method: "POST",
    body: formGarantia,
  }).then((R) => {
    let r = JSON.parse(R);
    cancelaEdiGarantia();
    getGarantia();
    alert(r.msg);
  });
}

onBeforeMount(() => {});

onMounted(() => {
  getGarantia();
});
let garantia = ref([]);

function addGarantia() {
  garantia.value[0].texto.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  garantia.value[0].texto_en.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  garantia.value[0].texto_es.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
}

function remGarantiaEmpresa(index) {
  garantia.value[0].texto.splice(index, 1);
  garantia.value[0].texto_en.splice(index, 1);
  garantia.value[0].texto_es.splice(index, 1);
}
async function getGarantia() {
  let R = await $fetch("/api/formGarantia.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      garantia.value = r.dados;

      garantia.value.map((g, index) => {
        garantia.value[index].texto = JSON.parse(g.texto);
        garantia.value[index].texto_en = JSON.parse(g.texto_en);
        garantia.value[index].texto_es = JSON.parse(g.texto_es);
      });
    } else {
    }
  });
}

function editaGarantia() {
  cancelaEdiGarantia();
  editorA.value = false;
  GarantiaForm.value.emEdicao = true;
  GarantiaForm.value.id = garantia.value[0].id;
  _onChangeTextoBR(garantia.value[0].texto);
  _onChangeTextoEN(garantia.value[0].texto_en);
  _onChangeTextoES(garantia.value[0].texto_es);
  setTimeout(() => {
    editorA.value = true;
  }, 300);
}
function cancelaEdiGarantia() {
  // resetEditor = randonico(7);
  // editorContentTexto.value = {};
  // editorContentTexto_en.value = {};
  // editorContentTexto_es.value = {};
  garantia.value[0] = {
    emEdicao: true,
    texto: [],
    texto_en: [],
    texto_es: [],
    arquivo: "",
  };
  document.getElementById("arqgarantia").src = "";
  document.getElementById("arqgarantia").value = "";
  getGarantia();
}

let GarantiaForm = ref({
  emEdicao: true,
  texto: [],
  texto_en: [],
  texto_es: [],
  arquivo: "",
});

let formGarantia = new FormData();
function apendFileGarantia() {
  formGarantia = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("arqgarantia");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formGarantia.append("0", arqData);
  }

  //ADD FORM JSON
  (garantia.value[0].emEdicao = true),
    (garantia.value[0].texto = JSON.stringify(garantia.value[0].texto));
  garantia.value[0].texto_en = JSON.stringify(garantia.value[0].texto_en);
  garantia.value[0].texto_es = JSON.stringify(garantia.value[0].texto_es);
  formGarantia.append("json", JSON.stringify(garantia.value[0]));
}

function randonico(length) {
  let result = "";
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
</script>