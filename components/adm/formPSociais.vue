<template>
  <div
    class="overflow-x-hidem flex h-screen flex-row space-x-3 overflow-y-auto p-6"
  >
    <div
      v-if="false"
      COLUNA="1"
      class="h-screen min-w-[500px] max-w-[500px] overflow-y-auto border-r-2 p-6"
    >
      <div class="p-4 text-center text-3xl">PSociais</div>
      <div>
        <form
          @submit.prevent="formRequestPSociais"
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
                :idContainer="'editorPSociaisPT'"
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
                :idContainer="'editorPSociaisEN'"
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
                :idContainer="'editorPSociaisES'"
                :existingContent="editorContentTexto_es"
                @contentChanged="_onChangeTextoES"
              />
            </div>
          </div>
          <div>
            <input
              type="file"
              accept="application/pdf,application/vnd.ms-excel"
              id="arqPSociais"
            />
          </div>

          <div class="flex flex-row justify-between">
            <x-button color="#000" light type="submit"> Salvar </x-button>
            <x-button color="#000" light @click="cancelaEdiPSociais"
              >Cancelar</x-button
            >
          </div>
        </form>
      </div>
    </div>
    <div CLUNA="2" class="container mx-auto w-full">
      <div class="p-4 text-center text-3xl">PSociais</div>

      <div class="flex flex-col">
        <div
          v-if="Object.keys(PSociais).length > 0"
          class="flex h-full flex-col"
        >
          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Pol. Sociais Português
            </h1>
            <div
              v-for="(ppt, indexPT) in PSociais[0].texto"
              :key="indexPT"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="ppt.texto" class="w-[1000px]" size="xl" />
              </div>
              <div>
                <x-button
                  class="h-8 w-8 text-sm hover:text-red-600"
                  @click="remPSociais(indexPT)"
                >
                  X
                </x-button>
              </div>
            </div>
            <div
              @click="addPSociais()"
              class="my-6 flex h-[60px] w-[1000px] cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-slate-300 bg-slate-400 text-2xl text-black hover:bg-slate-200"
            >
              <span>+</span>
            </div>
          </div>

          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Pol. Sociais Inglês
            </h1>
            <div
              v-for="(pen, indexEN) in PSociais[0].texto_en"
              :key="indexEN"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="pen.texto" class="w-[1000px]" size="xl" />
              </div>
            </div>
          </div>

          <div class="flex w-full flex-col items-center text-center">
            <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
              Texto Pol. Sociais Espanhol
            </h1>
            <div
              v-for="(pes, indexES) in PSociais[0].texto_es"
              :key="indexES"
              class="flex w-full flex-row justify-center gap-x-3 py-3"
            >
              <div class="space-y-3">
                <x-textarea v-model="pes.texto" class="w-[1000px]" size="xl" />
              </div>
            </div>
          </div>

          <div
            v-if="false"
            @click="editaPSociais()"
            class="grid cursor-pointer grid-cols-3 p-6 hover:bg-yellow-100"
          >
            <div class="border-r-2">
              <p>EM PORTUGUÊS</p>
              <div>
                <p v-for="i in PSociais[0].texto.blocks" :key="i" class="py-2">
                  {{ i.data.text }}
                </p>
              </div>
            </div>
            <div class="border-r-2">
              <p>EM INGLÊS</p>
              <div>
                <p
                  v-for="i in PSociais[0].texto_en.blocks"
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
                  v-for="i in PSociais[0].texto_es.blocks"
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
            <div class="flex flex-row gap-x-3 pt-4">
              <div class="flex flex-row gap-x-3 pt-4">
                <div class="p-3 hover:bg-slate-500">
                  <a target="_blank" :href="pathPSociais + PSociais[0].arquivo">
                    <div class="text-xl">Download</div>
                  </a>
                </div>
              </div>
            </div>
            <div>
              <input
                type="file"
                accept="application/pdf,application/vnd.ms-excel"
                id="arqPSociais"
              />
            </div>
          </div>
          <div
            class="mt-10 flex flex-row justify-center space-x-6 py-6 text-black"
          >
            <div
              @click="formRequestPSociais"
              class="cursor-pointer hover:text-green-400"
            >
              SALVAR
            </div>
            <div>
              <span
                @click="cancelaEdiPSociais()"
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
const pathPSociais = "\\media\\psociais\\";

/// editor
let resetEditor = "";
let editorContentTexto = ref({});
let editorContentTexto_en = ref({});
let editorContentTexto_es = ref({});

function _onChangeTextoBR(data) {
  PSociaisForm.value.texto = JSON.stringify(data);
  editorContentTexto.value = data;
}
function _onChangeTextoEN(data) {
  PSociaisForm.value.texto_en = JSON.stringify(data);
  editorContentTexto_en.value = data;
}
function _onChangeTextoES(data) {
  PSociaisForm.value.texto_es = JSON.stringify(data);
  editorContentTexto_es.value = data;
}

async function formRequestPSociais() {
  apendFilePSociais();
  return await $fetch("/api/formPSociais.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------97476729985249432331610575",
    },
    method: "POST",
    body: formPSociais,
  }).then((R) => {
    let r = JSON.parse(R);
    getPSociais();
    alert(r.msg);
  });
}

onBeforeMount(() => {});

onMounted(() => {
  getPSociais();
});
let PSociais = ref([]);

function addPSociais() {
  PSociais.value[0].texto.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  PSociais.value[0].texto_en.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  PSociais.value[0].texto_es.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
}

function remPSociais(index) {
  PSociais.value[0].texto.splice(index, 1);
  PSociais.value[0].texto_en.splice(index, 1);
  PSociais.value[0].texto_es.splice(index, 1);
}

async function getPSociais() {
  let R = await $fetch("/api/formPSociais.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      PSociais.value = r.dados;

      PSociais.value.map((g, index) => {
        PSociais.value[index].texto = JSON.parse(g.texto);
        PSociais.value[index].texto_en = JSON.parse(g.texto_en);
        PSociais.value[index].texto_es = JSON.parse(g.texto_es);
      });
    } else {
    }
  });
}

function editaPSociais() {
  cancelaEdiPSociais();
  editorA.value = false;
  PSociaisForm.value.emEdicao = true;
  PSociaisForm.value.id = PSociais.value[0].id;
  _onChangeTextoBR(PSociais.value[0].texto);
  _onChangeTextoEN(PSociais.value[0].texto_en);
  _onChangeTextoES(PSociais.value[0].texto_es);
  setTimeout(() => {
    editorA.value = true;
  }, 300);
}
function cancelaEdiPSociais() {
  // resetEditor = randonico(7);
  // editorContentTexto.value = {};
  // editorContentTexto_en.value = {};
  // editorContentTexto_es.value = {};
  PSociais.value[0] = {
    emEdicao: true,
    texto: [],
    texto_en: [],
    texto_es: [],
    arquivo: "",
  };
  document.getElementById("arqPSociais").src = "";
  document.getElementById("arqPSociais").value = "";
  getPSociais();
}

let PSociaisForm = ref({
  emEdicao: true,
  texto: [],
  texto_en: [],
  texto_es: [],
  arquivo: "",
});

let formPSociais = new FormData();
function apendFilePSociais() {
  formPSociais = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("arqPSociais");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formPSociais.append("0", arqData);
  }

  //ADD FORM JSON
  (PSociais.value[0].emEdicao = true),
    (PSociais.value[0].texto = JSON.stringify(PSociais.value[0].texto));
  PSociais.value[0].texto_en = JSON.stringify(PSociais.value[0].texto_en);
  PSociais.value[0].texto_es = JSON.stringify(PSociais.value[0].texto_es);

  formPSociais.append("json", JSON.stringify(PSociais.value[0]));
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