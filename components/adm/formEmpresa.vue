<template>
  <div
    class="flex max-h-screen flex-row space-x-3 overflow-x-auto overflow-y-hidden"
  >
    <div COLUNA="1" class="h-screen w-full overflow-y-auto border-r-2 p-6">
      <div class="py-4 text-center text-3xl">EMPRESA</div>
      <x-tab-group
        v-model="tabEmpresa"
        class="w-full pb-10"
        variant="line"
        grow
      >
        <x-tab value="a" label="Anos/Empresa">
          <div
            class="my-6 flex flex-col items-center justify-center rounded-xl bg-slate-600 p-6"
          >
            <form
              v-if="formAddAno"
              @submit.prevent="formRequestEmpresa"
              method="post"
              class="flex w-[900px] flex-col justify-center space-y-3"
            >
              <div class="flex flex-col">
                <div class="w-[150px]">
                  <x-input
                    v-model="EmpresaForm.ano"
                    label="Ano:"
                    size="lg"
                    name="ano"
                    block
                    type="number"
                  />
                </div>
                <div class="w-full">
                  <p class="py-4">Texto Português</p>
                  <x-textarea
                    v-model="EmpresaForm.texto_ano[0].texto"
                    class="w-[900px]"
                    size="lg"
                  />
                </div>
                <div class="w-full">
                  <p class="py-4">Texto Inglês</p>
                  <x-textarea
                    v-model="EmpresaForm.texto_ano_en[0].texto"
                    class="w-[900px]"
                    size="lg"
                  />
                </div>
                <div class="w-full">
                  <p class="py-4">Texto Espanhol</p>
                  <x-textarea
                    v-model="EmpresaForm.texto_ano_es[0].texto"
                    class="w-[900px]"
                    size="lg"
                  />
                </div>
              </div>

              <p class="py-4">Imagem ano :: 1415 x 710</p>
              <div
                class="relative flex flex-row items-center justify-between space-x-2"
              >
                <div
                  class="absolute right-0 top-0 flex h-10 w-[550px] flex-row justify-between bg-white opacity-50 hover:opacity-100"
                >
                  <input
                    id="imagemAno-1"
                    onchange="document.getElementById('imagemAnoTag-1').src = window.URL.createObjectURL(this.files[0])"
                    label="imagemURL:"
                    name="imagemURL1"
                    placeholder="Placeholder"
                    block
                    type="file"
                  />
                  <p
                    @click="resetEmpresaForm(1)"
                    class="h-full cursor-pointer p-1 text-3xl hover:text-red-400"
                  >
                    X
                  </p>
                </div>
                <img id="imagemAnoTag-1" class="h-[525px] w-full" />
              </div>
            </form>
            <div class="flex flex-row space-x-6 py-6 text-white">
              <div
                v-if="formAddAno"
                @click="formRequestEmpresa"
                class="cursor-pointer hover:text-green-400"
              >
                SALVAR
              </div>
              <div>
                <span
                  v-if="!formAddAno"
                  @click="formAddAno = true"
                  class="cursor-pointer"
                  >ADICIONAR ANO EMPRESA</span
                >
                <span
                  v-if="formAddAno"
                  @click="(formAddAno = false), resetEmpresaForm()"
                  class="cursor-pointer hover:text-slate-800"
                  >CANCELAR</span
                >
              </div>
            </div>
          </div>
          <div>
            <div class="flex flex-col items-center justify-center">
              <table class="w-[80%] text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                  <tr>
                    <th scope="col" class="px-6 py-4">ANO</th>
                    <th scope="col" class="px-6 py-4">TEXTO PORTUGÊS</th>
                    <th scope="col" class="px-6 py-4">TEXTO INGLÊS</th>
                    <th scope="col" class="px-6 py-4">TEXTO ESPANHOL</th>
                    <th scope="col" class="px-6 py-4">IMAGEM</th>
                  </tr>
                </thead>
                <tbody
                  v-if="Object.keys(anosCadastrados).length > 0"
                  class="w-full"
                >
                  <tr
                    class="cursor-pointer border-b text-black hover:bg-slate-300 dark:border-neutral-500"
                    v-for="(ano, index) in anosCadastrados"
                    :key="index"
                    :class="{ 'bg-yellow-400': ano.emEdicao == true }"
                    @click="editaRep(ano)"
                  >
                    <td class="px-6 py-4 font-medium text-black">
                      {{ ano.ano }}
                    </td>

                    <td class="w-[400px] break-words px-6 py-4 font-medium">
                      <p
                        v-for="(b, index) in ano.texto_ano"
                        :key="index"
                        class="py-2"
                      >
                        {{ b.texto }}
                      </p>
                    </td>
                    <td class="w-[400px] break-words px-6 py-4 font-medium">
                      <p
                        class="break-words"
                        v-for="(b, index) in ano.texto_ano_en"
                        :key="index"
                      >
                        {{ b.texto }}
                      </p>
                    </td>
                    <td class="w-[400px] break-words px-6 py-4 font-medium">
                      <p
                        class="break-words"
                        v-for="(b, index) in ano.texto_ano_es"
                        :key="index"
                      >
                        {{ b.texto }}
                      </p>
                    </td>
                    <td
                      class="whitespace-nowrap px-6 py-4 font-medium text-black"
                    >
                      <img width="400" :src="pathEmpresa + ano.imagem_ano" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </x-tab>
        <x-tab value="b" label="A Empresa">
          <div class="container mx-auto flex flex-col items-center p-6 py-10">
            <div class="flex flex-row flex-wrap justify-center gap-x-2">
              <div
                class="flex w-full flex-col items-center text-center"
                v-if="empresa.historia != null"
              >
                <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
                  Texto Institucinal Português
                </h1>
                <div
                  v-for="(hpt, indexPT) in empresa.historia"
                  :key="indexPT"
                  class="flex w-full flex-row justify-center gap-x-3 py-3"
                >
                  <div class="space-y-3">
                    <x-textarea
                      v-model="hpt.texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                  </div>
                  <div>
                    <x-button
                      class="h-8 w-8 text-sm hover:text-red-600"
                      @click="remHistoriaEmpresa(indexPT)"
                    >
                      X
                    </x-button>
                  </div>
                </div>
                <div
                  @click="addHistoriaEmpresa()"
                  class="my-6 flex h-[60px] w-[1000px] cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-slate-300 bg-slate-400 text-2xl text-black hover:bg-slate-200"
                >
                  <span>+</span>
                </div>
                <!-- <p
                  v-for="(e, index) in empresa.historia.blocks"
                  :key="index"
                  class="py-3 text-sm"
                >
                  {{ e.data.text }}
                </p> -->
              </div>
              <div
                class="w-full py-3 text-center"
                v-if="empresa.historia_en != null"
              >
                <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
                  Texto Institucinal Inglês
                </h1>
                <div
                  v-for="(hen, indexEN) in empresa.historia_en"
                  :key="indexEN"
                  class="flex flex-row justify-between gap-x-3 py-3"
                >
                  <div class="w-full space-y-3">
                    <x-textarea
                      v-model="hen.texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                  </div>
                </div>
              </div>
              <div
                class="w-full py-3 text-center"
                v-if="empresa.historia_es != null"
              >
                <h1 class="w-full rounded-lg bg-slate-600 py-3 text-white">
                  Texto Institucinal Espanhol
                </h1>
                <div
                  v-for="(hes, indexES) in empresa.historia_es"
                  :key="indexES"
                  class="flex flex-row justify-between gap-x-3 py-3"
                >
                  <div class="w-full space-y-3">
                    <x-textarea
                      v-model="hes.texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                  </div>
                </div>
              </div>
              <h1
                class="my-6 w-full rounded-lg bg-slate-600 py-6 text-center text-white"
              >
                Imagem 1320 x 890
              </h1>

              <div
                class="relative flex flex-row items-center justify-between space-x-2"
              >
                <div
                  class="absolute right-0 top-0 flex h-10 w-[550px] flex-row justify-between bg-white opacity-50 hover:opacity-100"
                >
                  <input
                    id="imagemEmp-2"
                    onchange="document.getElementById('imagemEmpTag-1').src = window.URL.createObjectURL(this.files[0])"
                    label="imagemURL:"
                    name="imagemURL1"
                    block
                    type="file"
                  />
                  <p
                    @click="remEmpresaImg()"
                    class="cursor-pointer text-3xl hover:text-red-400"
                  >
                    X
                  </p>
                </div>
                <img
                  id="imagemEmpTag-1"
                  class="h-[890px] w-[1320px]"
                  :src="pathEmpresa + empresa.img_url"
                />
              </div>

              <div>
                <div>
                  <h1
                    class="my-6 w-full rounded-lg bg-slate-600 py-6 text-center text-white"
                  >
                    MISSÃO | PT/EN/ES
                  </h1>
                  <div class="flex flex-col space-y-3">
                    <p>PT</p>
                    <x-textarea
                      v-model="empresa.missao[0].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>EN</p>
                    <x-textarea
                      v-model="empresa.missao[1].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>ES</p>
                    <x-textarea
                      v-model="empresa.missao[2].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                  </div>
                  <h1
                    class="my-6 w-full rounded-lg bg-slate-600 py-6 text-center text-white"
                  >
                    VISÃO | PT/EN/ES
                  </h1>
                  <div>
                    <p>PT</p>
                    <x-textarea
                      v-model="empresa.visao[0].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>EN</p>
                    <x-textarea
                      v-model="empresa.visao[1].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>ES</p>
                    <x-textarea
                      v-model="empresa.visao[2].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                  </div>
                  <h1
                    class="my-6 w-full rounded-lg bg-slate-600 py-6 text-center text-white"
                  >
                    VALORES | PT/EN/ES
                  </h1>
                  <div>
                    <p>PT</p>
                    <x-textarea
                      v-model="empresa.valores[0].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>EN</p>
                    <x-textarea
                      v-model="empresa.valores[1].texto"
                      class="w-[1000px]"
                      size="xl"
                    />
                    <p>ES</p>
                    <x-textarea
                      v-model="empresa.valores[2].texto"
                      class="w-[1000px]"
                      size="xl"
                    />o
                  </div>
                </div>
              </div>
            </div>

            <div class="flex flex-row space-x-6 py-6 text-black">
              <div
                @click="formRequestEmpresaInst"
                class="cursor-pointer hover:text-green-400"
              >
                SALVAR
              </div>
              <div>
                <span
                  @click="getEmpresaAnos()"
                  class="cursor-pointer hover:text-slate-800"
                  >CANCELAR</span
                >
              </div>
            </div>
          </div>
          <div v-if="false">
            <form
              @submit.prevent="formRequestEmpresaInst"
              method="post"
              class="felx felx-col space-y-3"
            >
              <div>
                <p class="py-4">Texto Português Institucional</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstPT'"
                    :existingContent="editorContentAnoTextoInst"
                    @contentChanged="_onChangeAnoTextoInstBR"
                  />
                </div>
              </div>
              <div>
                <p class="py-4">Texto Inglês Institucional</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstEN'"
                    :existingContent="editorContentAnoTextoInst_en"
                    @contentChanged="_onChangeAnoTextoInstEN"
                  />
                </div>
              </div>
              <div>
                <p class="py-4">Texto Espanhol Institucional</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstES'"
                    :existingContent="editorContentAnoTextoInst_es"
                    @contentChanged="_onChangeAnoTextoInstES"
                  />
                </div>
              </div>
              <div>
                <p class="py-4">MISSÃO | PT/EN/ES</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstMissao'"
                    :existingContent="editorContentAnoTextoInst_missao"
                    @contentChanged="_onChangeAnoTextoInstMissao"
                  />
                </div>
              </div>
              <div>
                <p class="py-4">VISÃO | PT/EN/ES</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstVisao'"
                    :existingContent="editorContentAnoTextoInst_visao"
                    @contentChanged="_onChangeAnoTextoInstVisao"
                  />
                </div>
              </div>
              <div>
                <p class="py-4">VALORES | PT/EN/ES</p>
                <div
                  class="h-[350px] max-w-[500px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    v-if="editorA"
                    :resetEditor="resetEditor"
                    :idContainer="'editorEmpresaInstValores'"
                    :existingContent="editorContentAnoTextoInst_valores"
                    @contentChanged="_onChangeAnoTextoInstValores"
                  />
                </div>
              </div>
              <p class="pt-2">Imagem institucional :: 1415 x 710</p>
              <div class="flex flex-row items-center justify-between space-x-2">
                <input
                  id="zimagemAno-2"
                  label="imagemURL:"
                  name="imagemURL1"
                  block
                  type="file"
                />
                <p
                  @click="resetProdFORMEdita(1)"
                  class="cursor-pointer text-3xl hover:text-red-400"
                >
                  X
                </p>
              </div>
              <div class="flex flex-row justify-between py-4">
                <x-button color="#000" light type="submit"> Salvar </x-button>
                <x-button color="#000" light>Cancelar</x-button>
              </div>
            </form>
          </div>
        </x-tab>
        <x-tab value="c" label="Galeria">
          <div class="flex flex-row space-x-3">
            <div class="w-[350px]">
              <form
                @submit.prevent="formRequestEmpresaGaleria"
                method="post"
                class="felx felx-col space-y-3"
              >
                <div>
                  <p class="py-10 pt-2">Imagem Galeria | 380x380 px</p>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      id="imagemGaleria-2"
                      label="imagemURL:"
                      name="imagemURL1"
                      block
                      type="file"
                      multiple
                    />
                    <p
                      @click="resetProdFORMEGaleria()"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                </div>
                <div class="flex flex-row justify-between py-4">
                  <x-button color="#000" light type="submit"> Salvar </x-button>
                  <x-button color="#000" light>Cancelar</x-button>
                </div>
              </form>
            </div>

            <div class="p-10">
              <div class="flex flex-row flex-wrap">
                <div
                  v-for="(im, index) in galeriaArrayImg"
                  :key="index"
                  class="relative"
                >
                  <img
                    width="300"
                    height="300"
                    class="h-[300px] object-cover"
                    :src="pathGaleria + im.img_url"
                  />
                  <div class="absolute left-2 top-2">
                    <x-button @click="excluirImagemGaleria(im)" size="xs"
                      >excluir</x-button
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </x-tab>
      </x-tab-group>
    </div>

    <div
      COLUNA="2TB"
      v-if="tabEmpresa == 'b' && false"
      class="w-[1200px] cursor-pointer overflow-y-auto overflow-x-hidden pl-4 pt-10 hover:bg-yellow-50"
      @click="editarAEmpresa()"
    >
      <div class="flex w-[1200px] flex-row flex-wrap gap-x-2">
        <div class="w-[300px]" v-if="empresa.historia != null">
          <h1>Texto Institucinal Português</h1>
          <p>PT</p>
          <div
            v-show="indexPT > 1"
            v-for="(hpt, indexPT) in empresa.historia"
            :key="indexPT"
            class="flex flex-row justify-between gap-x-3"
          >
            <div class="w-full space-y-3">
              <x-textarea v-model="hpt.texto" class="w-full" size="xl" />
            </div>
            <div>
              <x-button
                class="h-8 w-8 text-sm hover:text-red-600"
                @click="remParagrafoBlog(indexPT)"
              >
                X
              </x-button>
            </div>
          </div>
          <p
            v-for="(e, index) in empresa.historia.blocks"
            :key="index"
            class="py-3 text-sm"
          >
            {{ e.data.text }}
          </p>
        </div>
        <div class="w-[300px]" v-if="empresa.historia_en != null">
          <h1>Texto Institucinal Inglês</h1>
          <p
            v-for="(e, index) in empresa.historia_en.blocks"
            :key="index"
            class="py-3 text-sm"
          >
            {{ e.data.text }}
          </p>
        </div>
        <div class="w-[300px]" v-if="empresa.historia_es != null">
          <h1>Texto Institucinal Espanhol</h1>
          <p
            v-for="(e, index) in empresa.historia_es.blocks"
            :key="index"
            class="py-3 text-sm"
          >
            {{ e.data.text }}
          </p>
        </div>
      </div>

      <div>
        <div v-if="empresa.missao != null">
          <h1 class="py-4 text-2xl">MISSÃO</h1>
          <div
            v-for="(m, index) in empresa.missao.blocks"
            :key="index"
            class="py-2"
          >
            <p v-if="index == 0" class="font-semibold">PORTUGUÊS</p>
            <p v-if="index == 1" class="font-semibold">INGLÊS</p>
            <p v-if="index == 2" class="font-semibold">ESPANHOL</p>

            {{ m.data.text }}
          </div>
        </div>
        <div v-if="empresa.visao != null">
          <h1 class="py-4 text-2xl">VISÃO</h1>
          <div
            v-for="(v, index) in empresa.visao.blocks"
            :key="index"
            class="py-2"
          >
            <p v-if="index == 0" class="font-semibold">PORTUGUÊS</p>
            <p v-if="index == 1" class="font-semibold">INGLÊS</p>
            <p v-if="index == 2" class="font-semibold">ESPANHOL</p>
            {{ v.data.text }}
          </div>
        </div>
        <div v-if="empresa.valores != null">
          <h1 class="py-4 text-2xl">VALORES</h1>
          <div
            v-for="(v, index) in empresa.valores.blocks"
            :key="index"
            class="py-2"
          >
            <p v-if="index == 0" class="font-semibold">PORTUGUÊS</p>
            <p v-if="index == 1" class="font-semibold">INGLÊS</p>
            <p v-if="index == 2" class="font-semibold">ESPANHOL</p>
            {{ v.data.text }}
          </div>
        </div>
      </div>

      <div class="py-10" v-if="empresa.img_url != null">
        <p class="font-semibold">IMAGEM EMPRESA</p>
        <img :src="pathEmpresa + empresa.img_url" />
      </div>
    </div>
    <div
      COLUNA="3TC"
      v-if="tabEmpresa == 'c' && false"
      class="overflow-y-auto overflow-x-hidden"
    >
      <div>
        <div class="flex items-center justify-center text-2xl">GALERIA</div>
        <div class="flex flex-row flex-wrap">
          <div
            v-for="(im, index) in galeriaArrayImg"
            :key="index"
            class="relative"
          >
            <img
              width="300"
              height="300"
              class="h-[300px] object-cover"
              :src="pathGaleria + im.img_url"
            />
            <div class="absolute left-2 top-2">
              <x-button @click="excluirImagemGaleria(im)" size="xs"
                >excluir</x-button
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import {
  createUI,
  XButton,
  XAlert,
  XTextarea,
  XTab,
  XTabGroup,
} from "@indielayer/ui";
import Editor from "~/components/Editor.vue";

components: {
  createUI, XButton, XAlert, XTextarea, XTab, XTabGroup, Editor;
}

let anosCadastrados = ref([]);
const tabEmpresa = ref("a");
const pathEmpresa = "\\media\\empresa\\";
const pathGaleria = "\\media\\galeria\\";
const formAddAno = ref(false);
onMounted(() => {
  getEmpresaAnos();
});

const tableHead = ref([
  { text: "#ID", value: "id", sortable: true, align: "center" },
  { text: "ANO", value: "ano" },
  { text: "TEXTO PORTUGÊS", value: "portugues" },
  { text: "TEXTO INGLÊS", value: "ingles" },
  { text: "TEXTO ESPANHOL", value: "espanhol" },
]);
function addHistoriaEmpresa() {
  empresa.value.historia.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  empresa.value.historia_en.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
  empresa.value.historia_es.push({
    texto: "",
    tipo: "PARAGRAFO",
  });
}
function remHistoriaEmpresa(index) {
  empresa.value.historia.splice(index, 1);
  empresa.value.historia_en.splice(index, 1);
  empresa.value.historia_es.splice(index, 1);
}

function editarAEmpresa() {
  editorA.value = false;
  EmpresaFormInst.value.emEdicao = true;
  EmpresaFormInst.value.id = empresa.value.id;
  _onChangeAnoTextoInstBR(empresa.value.historia);
  _onChangeAnoTextoInstEN(empresa.value.historia_en);
  _onChangeAnoTextoInstES(empresa.value.historia_es);
  _onChangeAnoTextoInstMissao(empresa.value.missao);
  _onChangeAnoTextoInstVisao(empresa.value.visao);
  _onChangeAnoTextoInstValores(empresa.value.valores);
  setTimeout(() => {
    editorA.value = true;
  }, 300);
}
function selecionaAno(tx) {
  console.log(tx);
}

const editorA = ref(true);
function editaRep(ano) {
  editorA.value = false;
  ano.emEdicao = true;
  EmpresaForm.value = ano;
  formAddAno.value = true;

  // EmpresaForm.value.ano = ano.ano;
  // EmpresaForm.value.id = ano.id;

  // EmpresaForm.value.texto_ano = ano.texto_ano;
  // EmpresaForm.value.texto_ano_en = ano.texto_ano_en;
  // EmpresaForm.value.texto_ano_es = ano.texto_ano_es;

  // _onChangeAnoTextoBR(ano.texto_ano);
  // _onChangeAnoTextoEN(ano.texto_ano_en);
  // _onChangeAnoTextoES(ano.texto_ano_es);
  // setTimeout(() => {
  //   editorA.value = true;
  // }, 300);
}

/// editor
let resetEditor = "";
let editorContentAnoTexto = ref({});
let editorContentAnoTexto_en = ref({});
let editorContentAnoTexto_es = ref({});

function _onChangeAnoTextoBR(data) {
  EmpresaForm.value.texto_ano = JSON.stringify(data);
  editorContentAnoTexto.value = data;
}
function _onChangeAnoTextoEN(data) {
  EmpresaForm.value.texto_ano_en = JSON.stringify(data);
  editorContentAnoTexto_en.value = data;
}
function _onChangeAnoTextoES(data) {
  EmpresaForm.value.texto_ano_es = JSON.stringify(data);
  editorContentAnoTexto_es.value = data;
}

// COL B
let editorContentAnoTextoInst = ref({});
let editorContentAnoTextoInst_en = ref({});
let editorContentAnoTextoInst_es = ref({});
let editorContentAnoTextoInst_missao = ref({});
let editorContentAnoTextoInst_visao = ref({});
let editorContentAnoTextoInst_valores = ref({});

function _onChangeAnoTextoInstBR(data) {
  EmpresaFormInst.value.historia = JSON.stringify(data);
  editorContentAnoTextoInst.value = data;
}
//[0].replace(/'/g, "\\'")
function _onChangeAnoTextoInstEN(data) {
  EmpresaFormInst.value.historia_en = JSON.stringify(data);
  editorContentAnoTextoInst_en.value = data;
}
function _onChangeAnoTextoInstES(data) {
  EmpresaFormInst.value.historia_es = JSON.stringify(data);
  editorContentAnoTextoInst_es.value = data;
}
function _onChangeAnoTextoInstMissao(data) {
  EmpresaFormInst.value.missao = JSON.stringify(data);
  editorContentAnoTextoInst_missao.value = data;
}
function _onChangeAnoTextoInstVisao(data) {
  EmpresaFormInst.value.visao = JSON.stringify(data);
  editorContentAnoTextoInst_visao.value = data;
}
function _onChangeAnoTextoInstValores(data) {
  EmpresaFormInst.value.valores = JSON.stringify(data);
  editorContentAnoTextoInst_valores.value = data;
}

let EmpresaFormInst = ref({
  emEdicao: false,
  historia: "",
  missao: "",
  visao: "",
  valores: "",
});
function remEmpresaImg() {
  document.getElementById("imagemEmpTag-1").src = null;
  document.getElementById("imagemEmp-2").value = null;
}

async function formRequestEmpresaInst() {
  apendFileEmpresaInst();
  return await $fetch("/api/formEmpresa.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formEmpresaInst,
  }).then((R) => {
    let r = JSON.parse(R);
    alert(r.msg);
    getEmpresaAnos();
  });
}

// editor

async function getEmpresaAnos() {
  let R = await $fetch("/api/formEmpresaAno.php", {
    method: "GET",
  }).then((R) => {
    let X = JSON.parse(R);
    if (X.codigo == 0) {
      anosCadastrados.value = X.dados.empresa_ano;

      // TRATA TEXTO INSTITUCIONAL
      empresa.value = X.dados.empresa[0];
      console.log("X.dados.empresa[0]", X.dados.empresa[0]);
      if (X.dados.empresa[0] == undefined) {
        empresa.value = {};
        empresa.value.historia = {};
        empresa.value.missao = {};
        empresa.value.visao = {};
        empresa.value.valores = {};
      } else {
        if (empresa.value.historia != undefined) {
          empresa.value.historia = JSON.parse(empresa.value.historia);
          empresa.value.missao = JSON.parse(empresa.value.missao);
          empresa.value.visao = JSON.parse(empresa.value.visao);
          empresa.value.valores = JSON.parse(empresa.value.valores);
        }
        if (empresa.value.historia_en != undefined) {
          empresa.value.historia_en = JSON.parse(empresa.value.historia_en);
        }
        if (empresa.value.historia_es != undefined) {
          empresa.value.historia_es = JSON.parse(empresa.value.historia_es);
        }
        // FIM TRATA TEXTO INSTITUCIONAL
      }

      if (anosCadastrados.value != undefined || anosCadastrados.isArray) {
        anosCadastrados.value.map((ano, index) => {
          if (
            anosCadastrados.value[index].texto_ano != undefined &&
            anosCadastrados.value[index].texto_ano != ""
          ) {
            anosCadastrados.value[index].texto_ano = JSON.parse(
              anosCadastrados.value[index].texto_ano
            );
          }
          if (
            anosCadastrados.value[index].texto_ano_en != undefined &&
            anosCadastrados.value[index].texto_ano_en != ""
          ) {
            anosCadastrados.value[index].texto_ano_en = JSON.parse(
              anosCadastrados.value[index].texto_ano_en
            );
          }
          if (
            anosCadastrados.value[index].texto_ano_es != undefined &&
            anosCadastrados.value[index].texto_ano_es != ""
          ) {
            anosCadastrados.value[index].texto_ano_es = JSON.parse(
              anosCadastrados.value[index].texto_ano_es
            );
          }
        });
      }
    } else {
    }
  });
}
let queryGaleriaImg = ref({
  q: "",
  offset: 0,
  qpag: 0,
});
let galeriaArrayImg = ref([]);
onBeforeMount(() => {
  queryGaleriaImg.value.q = "";
  queryGaleriaImg.value.offset = 0;
  queryGaleriaImg.value.qpag = 99;
  getGaleriaImagens();
});
async function excluirImagemGaleria(imagem) {
  let Q = confirm("Continuar com a exclusão?");
  if (!Q) {
    return;
  }

  let J = { emEdicao: true, q: "exc", id_img: imagem.id };
  let formExcluir = new FormData();
  formExcluir.append("json", JSON.stringify(J));
  let R = await $fetch("/api/formGaleria.php", {
    method: "POST",
    body: formExcluir,
  }).then((R) => {
    let X = JSON.parse(R);
    if (X.codigo == 0) {
      alert(X.msg);
      getGaleriaImagens();
    } else {
    }
  });
}

async function getGaleriaImagens() {
  let R = await $fetch("/api/formGaleria.php", {
    method: "GET",
    params: queryGaleriaImg.value,
  }).then((R) => {
    let X = JSON.parse(R);
    if (X.codigo == 0) {
      galeriaArrayImg.value = X.dados;
    } else {
    }
  });
}

let formEmpresa = new FormData();
async function formRequestEmpresa() {
  apendFileEmpresa();
  return await $fetch("/api/formEmpresaAno.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formEmpresa,
  }).then((r) => {
    alert(r);
    resetEmpresaForm();
    getEmpresaAnos();
  });
}

let EmpresaForm = ref({
  emEdicao: false,
  ano: "",
  texto_ano: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  texto_ano_en: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  texto_ano_es: [
    {
      texto: "",
      tipo: "PARAGRAFO",
    },
  ],
  imagem_ano: "",
});
let empresa = ref([]);

function resetEmpresaForm(arg) {
  if (arg == 1) {
    document.getElementById("imagemAnoTag-1").src = null;
    document.getElementById("imagemAno-1").value = null;
    return;
  }
  EmpresaForm.value = {
    emEdicao: false,
    ano: "",
    texto_ano: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    texto_ano_en: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    texto_ano_es: [
      {
        texto: "",
        tipo: "PARAGRAFO",
      },
    ],
    imagem_ano: "",
  };
  anosCadastrados.value.map((a) => {
    a.emEdicao = false;
  });
  document.getElementById("imagemAno-1").src = null;
  document.getElementById("imagemAno-1").value = null;
  resetEditor = randonico(7);
}
function apendFileEmpresa() {
  formEmpresa = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemAno-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formEmpresa.append("0", arqData);
  }

  //ADD FORM JSON
  EmpresaForm.value.texto_ano = JSON.stringify(EmpresaForm.value.texto_ano);
  EmpresaForm.value.texto_ano_en = JSON.stringify(
    EmpresaForm.value.texto_ano_en
  );
  EmpresaForm.value.texto_ano_es = JSON.stringify(
    EmpresaForm.value.texto_ano_es
  );
  formEmpresa.append("json", JSON.stringify(EmpresaForm.value));
}
let formEmpresaInst = new FormData();
function apendFileEmpresaInst() {
  formEmpresaInst = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemEmp-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formEmpresaInst.append("0", arqData);
  }

  //ADD FORM JSON
  empresa.value.emEdicao = true;
  empresa.value.historia = JSON.stringify(empresa.value.historia);
  empresa.value.historia_en = JSON.stringify(empresa.value.historia_en);
  empresa.value.historia_es = JSON.stringify(empresa.value.historia_es);

  empresa.value.missao = JSON.stringify(empresa.value.missao);
  empresa.value.visao = JSON.stringify(empresa.value.visao);
  empresa.value.valores = JSON.stringify(empresa.value.valores);

  formEmpresaInst.append("json", JSON.stringify(empresa.value));
}

function resetProdFORMEGaleria(input) {
  document.getElementById("imagemGaleria-2").src = "";
  document.getElementById("imagemGaleria-2").value = "";
}
let galeriaFormData = new FormData();

async function formRequestEmpresaGaleria() {
  galeriaFormData = new FormData();
  var files = document.getElementById("imagemGaleria-2").files;

  for (var i = 0; i < files.length; i++) {
    galeriaFormData.append(i, files[i]);
  }
  galeriaFormData.append("json", JSON.stringify({ emEdicao: false }));
  return await $fetch("/api/formGaleria.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    enctype: "multipart/form-data",
    method: "POST",
    body: galeriaFormData,
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      alert(r.msg);
      getGaleriaImagens();
    }
  });
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
  